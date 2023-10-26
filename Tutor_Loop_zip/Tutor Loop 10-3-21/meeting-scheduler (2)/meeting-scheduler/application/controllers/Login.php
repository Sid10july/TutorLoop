<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
      

    }

    /*login form view*/
    public function index()
    {
        $this->load->view('login/login_view');
    }

    /*login form action*/
    public function login_action()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();

            $username = isset($post['username']) ? trim($post['username']) : '';
            $password = isset($post['password']) ? trim($post['password']) : '';

            $condition = ['UM.username' => $username, 'UM.password' => $this->hash_password($password), 'UM.is_deleted' => 0,'UM.login_right' => 1];
            
            /*check username and password*/
            $loginData = $this->common_model->getLoginData($condition);
 
            if (count($loginData) > 0) {
                $sessionData = [
                    'user_id' => $loginData[0]->user_id,
                    'username' => $loginData[0]->username,
                    'firstname' => $loginData[0]->firstname,
                    'middlename' => $loginData[0]->middlename,
                    'lastname' => $loginData[0]->lastname,
                    'role_fid' => $loginData[0]->role_fid,
                    'role_name' => $loginData[0]->role_name,
                    'profile_img' => $loginData[0]->profile_img,
                    'date_of_birth' => $loginData[0]->date_of_birth,
                    'logged_in' => true,
                ];

                $this->session->set_userdata($sessionData);

                $output = ["status" => 1, "message" => "Success"];
            } else {
                $output = ["status" => 3, "message" => "Username or Password Do Not Match"];
            }
        } else {
            $output = ["status" => 0, "message" => "Ajax request not completed"];
        }
        echo json_encode($output);
        exit();
    }

    /*logout action*/
    function logout()
    {
        $this->session->sess_destroy();
        redirect('Login', 'refresh');
    }


    /*create new account for student*/
    public function student_signup()
    {
        $this->load->view('login/student_signup_view');
    }

    public function student_sign_up_action()
    {
       /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $firstname = isset($post['firstname']) ? trim($post['firstname']) : ''; 
            $lastname = isset($post['lastname']) ? trim($post['lastname']) : ''; 
            $username = isset($post['username']) ? trim($post['username']) : ''; 
            $date_of_birth = isset($post['date_of_birth']) ? trim(date('Y-m-d',strtotime($post['date_of_birth'])))  : ''; 
            $student_id = isset($post['student_id']) ? trim($post['student_id']) : '';
            $password = isset($post['password']) ? trim($this->hash_password($post['password'])) : '';
            $login_right = 1;
            $role_fid = 4;
          
            $dupli_cond = array('username' => $username, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData("user_master",$dupli_cond);
            
            if(count($duplicate) > 0)
            {
                $output = array("status" => 2, "message" => "Already exists");
            }
            else
           {        //insert record
                    $saveData = array(
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "username" => $username,
                        "date_of_birth" => $date_of_birth,
                        "student_id" => $student_id,
                        "password" => $password,
                        "login_right" => 1,
                        "role_fid" => 4,
                      //  "created_by" => $_SESSION['user_id'],
                        "created_on" =>  date('Y-m-d H:i:s'),
                    );
                    $saveAction = $this->common_model->insert("user_master",$saveData);
                    
                    if($saveAction > 0){

                            /*start session */
                         $condition = ['UM.username' => $username, 'UM.password' => $password, 'UM.is_deleted' => 0,'UM.login_right' => 1];
                            
                            /*check username and password*/
                            $loginData = $this->common_model->getLoginData($condition);
                 
                            if (count($loginData) > 0) {
                                $sessionData = [
                                    'user_id' => $loginData[0]->user_id,
                                    'username' => $loginData[0]->username,
                                    'firstname' => $loginData[0]->firstname,
                                    'middlename' => $loginData[0]->middlename,
                                    'lastname' => $loginData[0]->lastname,
                                    'role_fid' => $loginData[0]->role_fid,
                                    'role_name' => $loginData[0]->role_name,
                                    'profile_img' => $loginData[0]->profile_img,
                                    'date_of_birth' => $loginData[0]->date_of_birth,
                                    'logged_in' => true,
                                ];

                                $this->session->set_userdata($sessionData);

                            $output = array("status" => 1, "message" => "Save Success");
                        } 
            }
        }
    }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
    }


    /*create new account for teacher*/
    public function teacher_signup()
    {
        $this->load->view('login/teacher_signup_view');
    }

     public function teacher_sign_up_action()
    {
       /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $firstname = isset($post['firstname']) ? trim($post['firstname']) : ''; 
            $lastname = isset($post['lastname']) ? trim($post['lastname']) : ''; 
            $username = isset($post['username']) ? trim($post['username']) : ''; 
            $date_of_birth = isset($post['date_of_birth']) ? trim(date('Y-m-d',strtotime($post['date_of_birth'])))  : ''; 
         
            $password = isset($post['password']) ? trim($this->hash_password($post['password'])) : '';
            $login_right = 1;
            $role_fid = 4;
          
            $dupli_cond = array('username' => $username, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData("user_master",$dupli_cond);
            
            if(count($duplicate) > 0)
            {
                $output = array("status" => 2, "message" => "Already exists");
            }
            else
           {        //insert record
                    $saveData = array(
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "username" => $username,
                        "date_of_birth" => $date_of_birth,
                        
                        "password" => $password,
                        "login_right" => 1,
                        "role_fid" => 3,
                    
                        "created_on" =>  date('Y-m-d H:i:s'),
                    );
                    $saveAction = $this->common_model->insert("user_master",$saveData);
                    
                    if($saveAction > 0){

                            /*start session */
                         $condition = ['UM.username' => $username, 'UM.password' => $password, 'UM.is_deleted' => 0,'UM.login_right' => 1];
                            
                            /*check username and password*/
                            $loginData = $this->common_model->getLoginData($condition);
                 
                            if (count($loginData) > 0) {
                                $sessionData = [
                                    'user_id' => $loginData[0]->user_id,
                                    'username' => $loginData[0]->username,
                                    'firstname' => $loginData[0]->firstname,
                                    'middlename' => $loginData[0]->middlename,
                                    'lastname' => $loginData[0]->lastname,
                                    'role_fid' => $loginData[0]->role_fid,
                                    'role_name' => $loginData[0]->role_name,
                                    'profile_img' => $loginData[0]->profile_img,
                                    'date_of_birth' => $loginData[0]->date_of_birth,
                                    'logged_in' => true,
                                ];

                                $this->session->set_userdata($sessionData);

                            $output = array("status" => 1, "message" => "Save Success");
                        } 
            }
        }
    }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
    }
    
}
