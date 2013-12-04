<?php
require APPPATH.'/libraries/REST_Controller.php';

class Teacher extends REST_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
    }
    
    public function student_get(){
        $username = $this->get('username');
        $password = $this->get('password');
        $login = $this->student_model->getUser($username,$password);
        if($login !== -1){
            $data['username'] = $username;
            $data['last_name'] = $login->last_name
;            $data['first_name'] = $login->first_name;
            $data['email_ad'] = $login->email_ad;
        }
        else{
            $data['ERROR'] = "Invalid login. Go die.";
        }
        $this->response($login,200);
    }

    public function signup_post(){
        $username = $this->post('username');
        $password1 = $this->post('password1');
        $password2 = $this->post('password2');
        $first_name = $this->post('first_name');
        $last_name = $this->post('last_name');
        $email_ad = $this->post('email_ad');
    }

    public function users_get(){
        $data = $this->student_model->getUsers();
        $this->response($data,200);
    }
}