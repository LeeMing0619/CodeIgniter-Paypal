<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat_model extends CI_Model {
    
    public function send_chat_message($sender, $receiver, $message) {
        $created_at = date("Y-m-d H:i:s");
        $chat = array(
            'sender_email' => $sender,
            'receiver_email' => $receiver,
            'message_content' => $message,
            'created_at' => $created_at);
            
        $return_val = $this->db->insert('tbl_chat', $chat);
        $insert_id = $this->db->insert_id();
    }
    
    public function getHistoriesByEmail($send_email, $receive_email) {
        $sql = "select c.*, a.uname as sendname, b.uname as receivename from tbl_chat c join auth a join auth b 
                where a.email=c.sender_email and b.email=c.receiver_email and ((c.sender_email='".$send_email."' 
                and c.receiver_email='".$receive_email."') or (c.sender_email='".$receive_email."' and c.receiver_email='".$send_email."')) ORDER BY c.created_at ASC";
        
        $result =  $this->db->query($sql);
    
        $res_array = array();
        foreach ($result->result() as $row){
            $res_array[] = $row;
        }

        $sql = "update tbl_chat set is_read=1 where (sender_email='".$send_email."' 
                and receiver_email='".$receive_email."') or (sender_email='".$receive_email."' and receiver_email='".$send_email."')";
        $this->db->query($sql);
        
        return $res_array;
    }
    
    
    public function isGetNewMessage($email) {
        $sql = "select a.uname as id from tbl_chat c join auth a where (c.receiver_email='".$email."' and c.is_read=0) and c.sender_email=a.email";
        
        $query = $this->db->query($sql);
        $res_array = array();
        $res_array['cnt'] = $query->num_rows();
        
        foreach ($query->result() as $row){
            $res_array[] = $row;
        }
        
        return $res_array;
    }
    
    public function getNewMessage($email, $with) {
        $sql = "select c.*, a.uname as id from tbl_chat c join auth a where (c.receiver_email='".$email."' and c.sender_email='".$with."' and c.is_read=0) and c.sender_email=a.email";
        
        $query = $this->db->query($sql);
        $res_array = array();
        
        foreach ($query->result() as $row){
            $res_array['message_content'] = $row->message_content;
            $res_array['name'] = $row->id;
            $res_array['created_at'] = $row->created_at;
        }
        
        $sql = "update tbl_chat set is_read=1 where sender_email='".$with."' and receiver_email='".$email."' and is_read=0";
        $this->db->query($sql);
        
        return $res_array;    
    }
    
    public function getPeoples($email) {
        $sql = "SELECT a.uname as sendname, b.uname as receivename, c.*, a.photo as sendphoto, b.photo as receivephoto
								from (select * from tbl_chat order by created_at DESC) c join auth a join auth b 
                where a.email=c.sender_email and b.email=c.receiver_email and c.receiver_email='".$email."'
                Group by c.sender_email order by c.created_at desc";
        
        $result =  $this->db->query($sql);
    
        $res_array = array();
        foreach ($result->result() as $row){
            $res_array[] = $row;
        }

        return $res_array;
    }
}

?>