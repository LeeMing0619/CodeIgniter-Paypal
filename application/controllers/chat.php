<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Admin_model');
        $this->load->model('Chat_model');
    }
    
    public function chat_func() {
        $my_email = $this->session->userdata['user_email'];
        $email = $this->input->post('email_addr');
        $withName = $this->Auth_model->getUserNameByEmail($email);
        $photo = $this->Auth_model->getPhotoByEmail($email);
        
        $chat_histories['histories'] = $this->Chat_model->getHistoriesByEmail($my_email, $email);
        $chat_histories['name'] = $withName;
        $chat_histories['email'] = $email;
        $chat_histories['photo'] = $photo;
        
        $this->load->view('chat/chat_board', $chat_histories);
    }
    
    public function sendMessage() {
        $sender = $this->session->userdata['user_email'];
        $receiver = $this->input->get_post('receiver');
        $message = json_encode($this->input->get_post('message'));
        //echo json_encode($message);exit();
        $this->Chat_model->send_chat_message($sender, $receiver, $message);
    }
    
    public function isGetNewMessage() {
        $my_email = $this->session->userdata['user_email'];
        
        $isNew = $this->Chat_model->isGetNewMessage($my_email);
        echo json_encode($isNew);
    } 
    
    public function getNewMessage() {
        $receiver = $this->input->get_post('receiver');
        $my_email = $this->session->userdata['user_email'];
        $res = $this->Chat_model->getNewMessage($my_email, $receiver);
        
        echo json_encode($res);
    }
}

?>