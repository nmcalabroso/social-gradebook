<?php
require APPPATH.'/libraries/REST_Controller.php';

class Student extends REST_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('student_model');
    }
    
    public function login_get(){
        $username = $this->get('username');
        $password = $this->get('password');
        $login = $this->student_model->getStudent($username,$password);
        if(isset($login)){
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

    public function signup_post(){
        $data = array(
                    'username' => $this->post('username'),
                    'password' => md5($this->post('password')),
                    'first_name' => $this->post('first_name'),
                    'last_name' => $this->post('last_name'),
                    'email_ad' => $this->post('email_ad')
                    );

        if($this->student_model->insertStudent($data)){
            $result['message'] = "Registration successful!";
        }
        else{
            $result['message'] = "Username already taken.";
        }

        $this->response($result,200);
    }

    public function users_get(){
        $data = $this->student_model->getUsers();
        $this->response($data,200);
    }
}