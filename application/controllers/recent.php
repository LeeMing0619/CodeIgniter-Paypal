<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

define('SITE_URL', 'http://localhost/register');

class Recent extends CI_Controller {
    
    public $delete_id = array();

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Recent_model');
        $this->load->Model('Auth_model');
    }

    public function index() {
        $this->load->view('recent_activity/show_recent');
        $this->Auth_model->isLoggedIn();
    }
    
    public function load_recent() {
        $user = $this->session->userdata['user_email'];
        $sql = "select m.id, m.fname, m.user1, a.uname as user1_name, a.photo as photo1, a.bio as bio1, m.user2, b.uname as user2_name,b.photo as photo2, b.bio as bio2, m.status, m.bet_amount, m.note ,m.password, m.game_kind, m.win, m.end_date
                from member m join auth a join auth b 
				where a.email=m.user1 and b.email=m.user2 and m.win !='' and m.win!='draw' and m.end_date!='' order by m.end_date desc limit 50";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
            
        echo json_encode($family);
    }
}
?>