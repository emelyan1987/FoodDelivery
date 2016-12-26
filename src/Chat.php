<?php
    namespace Mataam;
    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface; 

    require 'mysql.php'; 

    class Chat implements MessageComponentInterface {
        protected $clients;

        public function __construct() {
            $this->clients = new \SplObjectStorage;

            define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
            if(ENVIRONMENT === 'production') {
                $this->db = new \PDO('mysql:host=localhost:3306;dbname=kandil_restro;', 'root', 'mataam@2016');
            } else {
                $this->db = new \PDO('mysql:host=localhost:3306;dbname=kandil_restro;', 'root', '');
            }

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        }

        public function onOpen(ConnectionInterface $conn) {
            // Store the new connection to send messages to later
            $this->clients->attach($conn);

            echo "New connection! ({$conn->resourceId})\n";
        }

        public function onMessage(ConnectionInterface $client, $msg) {
            $numRecv = count($this->clients) - 1;
            echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
                , $client->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

            $msg = json_decode($msg);

            /*foreach ($this->clients as $client) {
            if ($from !== $client) {
            // The sender is not the receiver, send to each client connected
            $client->send($msg);
            }
            }*/

            $event = $msg->event;
            $data = $msg->data;

            if($data) {
                switch($event) {
                    case 'login':
                        $this->handleLogin($client, $data->access_token);
                        break;
                    case 'admin login':
                        $this->handleLogin($client, $data->access_token, true);
                        break;
                    case 'join':
                        $this->handleJoin($client, $data->to);
                        break;
                    case 'typing':
                        $this->handleTyping($client, $data->to);
                        break;
                    case 'create message':
                        $this->handleCreateMessage($client, $data->message, isset($data->to)?$data->to:'admin');
                        break;
                    case 'update message':
                        $this->handleUpdateMessage($client, $data->message_id, $data->message);
                        break;
                    case 'delete message':
                        $this->handleDeleteMessage($client, $data->message_id);
                        break;
                    case 'read message':
                        $this->handleReadMessage($client, $data->message_id);
                        break;
                }    
            }
        }

        public function onClose(ConnectionInterface $conn) {
            // The connection is closed, remove it, as we can no longer send it messages
            $this->clients->detach($conn);

            echo "Connection {$conn->resourceId} has disconnected\n";
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            echo "An error has occurred: {$e->getMessage()}\n";

            $conn->close();
        }

        private function handleLogin($client, $token, $isAdmin=false) {
            try{
                if(!$token) {
                    throw new \Exception('access_token required');
                }
                $accessToken = $this->db->query("SELECT * FROM user_access_tokens WHERE access_token='$token'")->fetch();
                if(!$accessToken) {
                    throw new \Exception('access_token invalid');
                } else {
                    if(strtotime($accessToken["created_at"])+$accessToken["ttl"] < time()) {
                        throw new \Exception('access_token expired');
                    }
                }

                $userId = $accessToken["user_id"];
                $user = $this->db->query("SELECT * FROM users WHERE id=$userId")->fetchObject();
                $profile = $this->db->query("SELECT * FROM user_profiles WHERE user_id=$userId")->fetchObject();

                $client->userid = $userId;
                $client->username = $profile->f_name." ".$profile->l_name;
                $client->gid = $isAdmin ? 'admin' : 'user_'.$userId;
                $client->user = $user;
                $client->profile = $profile;

                $client->send(json_encode(array(
                    'event'=>'login',
                    'data'=>array(
                        "userid"=>$client->userid,
                        "username"=>$client->username, 
                        'profile'=>$profile
                    )
                )));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }


        private function handleJoin($client, $to) {
            try{
                if(!$to) {
                    throw new \Exception('to required');
                }
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $profile = $this->db->query("SELECT * FROM user_profiles WHERE user_id=$to")->fetchObject();

                foreach($this->clients as $c) {
                    if($c->userid == $toUserId) {
                        $c->send(json_encode(
                            array(
                                "event"=>"join",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username
                            ))
                        ));
                        break;
                    }
                }
                $client->send(json_encode(array('success'=>true, 'data'=>$profile)));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }

        private function handleTyping($client, $to) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                foreach($this->clients as $c) {
                    if($c->gid == $to) {
                        $c->send(json_encode(
                            array(
                                "event"=>"typing",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username
                            ))
                        ));
                        break;
                    }
                }

                $client->send(json_encode(array('success'=>true)));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }

        private function handleCreateMessage($client, $message, $to) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                // Insert message data to database table
                $data[':from_id'] = $client->userid;
                $data[':to_id'] = ($to=='admin'|| strlen($to)<6 ? null : substr($to,5));    // 'admin' or 'user_276
                $data[':message'] = $message;
                $data[':created_time'] = $data[':updated_time'] = date('Y-m-d H:i:s');

                $this->db->beginTransaction();
                $this->db->prepare("INSERT INTO tbl_messages (from_id,to_id,message,created_time,updated_time) VALUES (:from_id,:to_id,:message,:created_time,:updated_time)")->execute($data);

                $message_id = $this->db->lastInsertId();
                $this->db->commit();

                $message = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();

                $profile = $client->profile;
                $user = $client->user;

                $message->user_image = file_exists(dirname(__FILE__)."/..".$profile->image)?$profile->image:'/assets/common/image/male.png';
                $message->user_fullname = $profile->f_name." ". $profile->l_name;
                $message->user_mobile = $user->mobile_no;
                $message->user_email = $user->email;
                $message->arrow = 'left';

                foreach($this->clients as $c) {
                    if($c->gid == $to) {
                        $c->send(json_encode(
                            array(
                                "event"=>"create message",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username,
                                    "message"=>$message
                            ))
                        ));


                        break;
                    }
                }

                $message->arrow = 'right';
                $client->send(json_encode(
                    array(
                        "event"=>"create message",
                        "data"=>array(
                            "userid"=>$client->userid,
                            "username"=>$client->username,
                            "message"=>$message
                    ))
                ));
            } catch(\Exception $e) {   
                if($this->db->inTransaction()) $this->db->rollback();
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }

        private function handleUpdateMessage($client, $message_id, $message) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();

                if($msg->from_id != $client->userid) {
                    throw new \Exception('You are not writer of this message');
                }       

                if($msg->message !== $message) {
                    $data[':id'] = $message_id;                    
                    $data[':message'] = $message;                    
                    $data[':updated_time'] = date('Y-m-d H:i:s');

                    $this->db->beginTransaction();
                    $this->db->prepare('UPDATE tbl_messages SET message=:message, is_updated=1, updated_time=:updated_time WHERE id=:id')->execute($data);

                    $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();
                    $this->db->commit();

                    foreach($this->clients as $c) {
                        if($c->userid == $msg->to_id || ($msg->to_id==0 || $msg->to_id=null) && $c->gid=='admin') {
                            $c->send(json_encode(
                                array(
                                    "event"=>"update message",
                                    "data"=>array(
                                        "userid"=>$client->userid,
                                        "username"=>$client->username,
                                        "message"=>$msg
                                ))
                            ));


                            break;
                        }
                    }
                }

                $client->send(json_encode(
                    array(
                        "event"=>"update message",
                        "data"=>array(
                            "userid"=>$client->userid,
                            "username"=>$client->username,
                            "message"=>$msg
                    ))
                ));
            } catch(\Exception $e) {
                if($this->db->inTransaction()) $this->db->rollback();
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }  

        private function handleDeleteMessage($client, $message_id) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();

                if($msg->from_id != $client->userid) {
                    throw new \Exception('You are not writer of this message');
                }       

                $data['message'] = $message;
                $data['is_deleted'] = true;

                $this->db->beginTransaction();
                $this->db->prepare('UPDATE tbl_messages SET is_deleted=1 WHERE id=:id')->execute(array(':id'=>$message_id));

                $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();

                $this->db->commit();

                foreach($this->clients as $c) {
                    if($c->userid == $msg->to_id || ($msg->to_id==0 || $msg->to_id=null) && $c->gid=='admin') {
                        $c->send(json_encode(
                            array(
                                "event"=>"delete message",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username,
                                    "message_id"=>$message_id
                            ))
                        ));


                        break;
                    }
                }


                $client->send(json_encode(
                    array(
                        "event"=>"delete message",
                        "data"=>array(
                            "userid"=>$client->userid,
                            "username"=>$client->username,
                            "message_id"=>$message_id,
                            "message"=>$msg
                    ))
                ));
            } catch(\Exception $e) {
                if($this->db->inTransaction()) $this->db->rollback();
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        } 

        private function handleReadMessage($client, $message_id) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();

                if(($msg->to_id==0||$msg->to_id==null)&&$client->gid!=='admin' || $msg->to_id>0&&$msg->to_id != $client->userid) {
                    throw new \Exception('You are not owner of this message');
                }       

                $data['is_read'] = true;

                $this->db->beginTransaction();
                $this->db->prepare('UPDATE tbl_messages SET is_read=1 WHERE id=:id')->execute(array(':id'=>$message_id));

                $msg = $this->db->query("SELECT * FROM tbl_messages WHERE id=$message_id")->fetchObject();
                $unread_cnt = $this->db->query("SELECT COUNT(*) AS cnt FROM tbl_messages WHERE (to_id IS NULL OR to_id=0) AND from_id=".$msg->from_id." AND is_read!=1")->fetchObject()->cnt;

                $this->db->commit();

                foreach($this->clients as $c) {
                    if($c->userid == $msg->from_id) {
                        $c->send(json_encode(
                            array(
                                "event"=>"read message",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username,
                                    "message"=>$msg,
                                    "unread_cnt"=>$unread_cnt
                            ))
                        ));


                        break;
                    }
                }


                $client->send(json_encode(array(
                    "event"=>"read message",
                    "data"=>array(
                        "userid"=>$client->userid,
                        "username"=>$client->username,
                        "message"=>$msg,
                        "unread_cnt"=>$unread_cnt
                    ))
                ));
            } catch(\Exception $e) {
                if($this->db->inTransaction()) $this->db->rollback();
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        } 
    }
