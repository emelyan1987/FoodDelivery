<?php  

    require 'BaseModel.php';
    class MessageModel extends BaseModel
    {     

        function __construct()
        {
            parent::__construct('tbl_messages');    

        }

        function getLastMessagesGroupByFrom($to=null) {
            $query = "SELECT a.from_id, a.to_id, a.message AS last_message, a.created_time AS last_time, a.is_read, a.is_deleted, a.is_updated, u.mobile_no AS user_mobile, u.email AS user_email, CONCAT(p.f_name, ' ', p.l_name) AS user_fullname, p.image AS user_image FROM (SELECT * FROM tbl_messages WHERE ".($to==null?"to_id IS NULL OR to_id=0":"to_id=$to")." ORDER BY created_time DESC) AS a JOIN users AS u ON u.id=a.from_id LEFT JOIN user_profiles AS p ON p.user_id=a.from_id GROUP BY a.from_id";
            $result = $this->db->query($query)->result();

            return $result;
        }

        function getUnreadCount($from_id) {
            $this->db->select('COUNT(*) AS cnt');
            $this->db->where('is_read!=', 1);
            $this->db->where('to_id IS NULL');
            $this->db->where('from_id', $from_id);
            return $this->db->get($this->tableName)->row()->cnt;
        }
        function getUsers($to=null) {
            $this->db->select("u.id, u.mobile_no, u.email, CONCAT(p.f_name, ' ', p.l_name) AS full_name, p.image");
            $this->db->from($this->tableName." AS m");
            $this->db->join("users AS u", "u.id=m.from_id");
            $this->db->join("user_profiles AS p", "p.user_id=u.id", "left");

            if($to==null) {
                $this->db->where("to_id IS NULL");
            } else {
                $this->db->where("to_id=$to");
            }
            $this->db->group_by("u.id");
            $result = $this->db->get()->result();

            return $result;
        }

        function getMessagesWith($whom, $me) {
            $this->db->select("m.*, u.mobile_no AS user_mobile, u.email AS user_email, CONCAT(p.f_name, ' ', p.l_name) AS user_fullname, p.image AS user_image");
            $this->db->from($this->tableName." AS m");
            $this->db->join("users AS u", "u.id=m.from_id");
            $this->db->join("user_profiles AS p", "p.user_id=u.id", "left");

            $this->db->where("(to_id IS NULL OR to_id=0) AND (from_id=$whom)");
            $this->db->or_where("to_id=$whom AND from_id=$me");
            
            $this->db->order_by("m.created_time ASC");
            $result = $this->db->get()->result();

            return $result;
        }

        function getMessagesWithAdmin($user_id) {
            $this->db->select("m.*, u.mobile_no AS user_mobile, u.email AS user_email, CONCAT(p.f_name, ' ', p.l_name) AS user_fullname, p.image AS user_image");
            $this->db->from($this->tableName." AS m");
            $this->db->join("users AS u", "u.id=m.from_id");
            $this->db->join("user_profiles AS p", "p.user_id=u.id", "left");

            $this->db->where("(to_id IS NULL OR to_id=0) AND (from_id=$user_id)");
            $this->db->or_where("to_id=$user_id AND from_id IN (SELECT id FROM users WHERE user_role=1)");
            
            $this->db->order_by("m.created_time ASC");
            $result = $this->db->get()->result();

            return $result;
        }
}