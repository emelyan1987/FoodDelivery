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
                $this->db = new \Database('localhost:3306', 'root', 'mataam2016', 'kandil_restro');    
            } else {
                $this->db = new \Database('localhost:3306', 'root', 'mataam2016', 'kandil_restro'); 
            }
            

            // connect to the server 
            $this->db->connect(); 
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
                $accessToken = $this->db->query_first("SELECT * FROM user_access_tokens WHERE access_token='$token'");
                if(!$accessToken) {
                    throw new \Exception('access_token invalid');
                } else {
                    if(strtotime($accessToken["created_at"])+$accessToken["ttl"] < time()) {
                        throw new \Exception('access_token expired');
                    }
                }

                $userId = $accessToken["user_id"];
                $profile = $this->db->query_first("SELECT * FROM user_profiles WHERE user_id=$userId");

                $client->userid = $userId;
                $client->username = $profile["f_name"]." ".$profile["l_name"];
                $client->gid = $isAdmin ? 'admin' : 'user_'.$userId;

                $client->send(json_encode(array('success'=>true, 'data'=>$profile)));
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

                $profile = $this->db->query_first("SELECT * FROM user_profiles WHERE user_id=$to");

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
                $data['from'] = $client->userid;
                $data['to'] = ($to=='admin'|| strlen($to)<6 ? null : substr($to,5));    // 'admin' or 'user_276
                $data['message'] = $message;
                $data['created_time'] = $data['updated_time'] = date('Y-m-d H:i:s');
                $message_id = $this->db->query_insert("tbl_messages", $data);

                $message = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");


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


                $client->send(json_encode(array('success'=>true)));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }

        private function handleUpdateMessage($client, $message_id, $message) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                if($msg["from"]!=$client->userid) {
                    throw new \Exception('You are not writer of this message');
                }       

                if($msg["message"] !== $message) {
                    $data['message'] = $message;
                    $data['is_updated'] = true;
                    $data['updated_time'] = date('Y-m-d H:i:s');

                    $this->db->query_update('tbl_messages', $data, "id=$message_id");

                    $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                    foreach($this->clients as $c) {
                        if($c->userid == $msg["to"]) {
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

                $client->send(json_encode(array('success'=>true)));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        }  

        private function handleDeleteMessage($client, $message_id) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                if($msg["from"]!=$client->userid) {
                    throw new \Exception('You are not writer of this message');
                }       

                $data['message'] = $message;
                $data['is_deleted'] = true;

                $this->db->query_update('tbl_messages', $data, "id=$message_id");

                $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                foreach($this->clients as $c) {
                    if($c->userid == $msg["to"]) {
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


                $client->send(json_encode(array('success'=>true)));
            } catch(\Exception $e) {
                $client->send(json_encode(array('success'=>false,'data'=>$e->getMessage())));
            }
        } 

        private function handleReadMessage($client, $message_id) {
            try{
                if(!$client->userid) {
                    throw new \Exception('login required');
                }

                $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                if($msg["to"]!=$client->userid) {
                    throw new \Exception('You are not owner of this message');
                }       

                $data['message'] = $message;
                $data['is_read'] = true;

                $this->db->query_update('tbl_messages', $data, "id=$message_id");

                $msg = $this->db->query_first("SELECT * FROM tbl_messages WHERE id=$message_id");

                foreach($this->clients as $c) {
                    if($c->userid == $msg["from"]) {
                        $c->send(json_encode(
                            array(
                                "event"=>"read message",
                                "data"=>array(
                                    "userid"=>$client->userid,
                                    "username"=>$client->username,
                                    "message_id"=>$message_id
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
}
