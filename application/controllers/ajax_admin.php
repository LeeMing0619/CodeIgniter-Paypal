<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Admin_model');
    }
/*
public function autoloadPeriod() {
        $id= $this->input->get_post('id');
        
        $query = $this->Admin_model->autoloadPeriod($id);
        echo '<option value="0">Select</option>';
        foreach ($query->result() as $row){
            echo '<option value='.$row->id.'>'.$row->duration.'</option>';
        }
        exit;
}

public function loadPeriod() {
        $id= $this->input->get_post('id');
        $this->db->where('plan_id', $id);
        $query = $this->db->get('teriff');
        echo '<option value="0">Select</option>';
        foreach ($query->result() as $row){
            echo '<option value='.$row->id.'>'.$row->duration.'</option>';
        }
        exit;
}*/
    public function isChangedBalance(){
        
        $val= $this->input->get_post('val');
        $id= $this->input->get_post('id');
        
        $this->gameLogs($id);
        $query = $this->Auth_model->isChangedBalance($id, $val);
        if ($query > 0) {
            echo 'same';
        } else {
            $res = $this->Auth_model->getBalanceByEmail($id);
            $this->session->set_userdata('balance', $res);
            echo $res;
        }
    }
    
    public function gameLogs($email) {
        $wins = $this->Admin_model->getWinsHistory($email);
        $this->session->set_userdata('wins_cnt', $wins->num_rows());
        $losses = $this->Admin_model->getLooseHistory($email);
        $this->session->set_userdata('losses_cnt', $losses->num_rows());
        $draws = $this->Admin_model->getDrawsHistory($email);
        $this->session->set_userdata('draws_cnt', $draws->num_rows());
        $poeples = $this->Admin_model->getWithPeoples($email);
        $this->session->set_userdata('game_cnt', $poeples->num_rows());
    }
    
    public function getGameLogsByEmail() {
        $email = $this->input->get_post('id');
        
        $wins = $this->Admin_model->getWinsHistory($email);
        $data['wins_cnt'] = $wins->num_rows();
        $losses = $this->Admin_model->getLooseHistory($email);
        $data['losses_cnt'] = $losses->num_rows();
        $draws = $this->Admin_model->getDrawsHistory($email);
        $data['draws_cnt'] = $draws->num_rows();
        $poeples = $this->Admin_model->getWithPeoples($email);
        $data['game_cnt'] = $poeples->num_rows();
        
        echo json_encode($data);
    }
    
    public function sendReport() {
        $email = $this->input->get_post('id');
        $name = $this->input->get_post('name');
        
        $config = Array(
                //'smtp_crypto' => 'tls',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',//'smtp.live.com',
                'smtp_port' => 465, //587
                'smtp_user' => 'rps.outgoings@gmail.com',
                'smtp_pass' => 'Sylvia2019$',
                'mailtype' => 'html', 
                'charset' => 'iso-8859-1'
                );
            
            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
            
            $this->email->from('rps.outgoings@gmail.com', "Report Player");
            $this->email->to('online@rpsbet.com');
            $this->email->subject("Report Player");

            //User's email
            $message = "<p>Just sent report player to you from ";
            $message .= $name."</p><br>";
            $message .= "<p>Email Address : ".$email."</p>";
            
            $this->email->message($message);
            
            if(!$this->email->send()){
                echo "Email was not sent, please contact online@rpsbet.com.";
            }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */