<?php
require APPPATH.'/libraries/REST_Controller.php';

class Restful_api extends REST_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('student_model');
    }
    
    public function login_get(){
        $username = $this->get('username');
        $password = $this->get('password');
        $login = $this->student_model->isRegisteredUser($username,$password);
        if($login !== -1){
            $data['username'] = $username;
            $data['last_name'] = $login->last_name;
            $data['first_name'] = $login->first_name;
            $data['email_ad'] = $login->email_ad;
        }
        else{
            $data['ERROR'] = "Invalid login. Go die.";
        }
        
        $this->response($data,200);
    }
}