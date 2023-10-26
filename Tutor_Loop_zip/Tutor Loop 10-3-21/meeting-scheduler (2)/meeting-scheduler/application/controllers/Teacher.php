<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teacher extends MY_Controller
{
      var $table = 'user_master';
      public function __construct()
      {
            parent::__construct();
            $this->load->model('teacher_model');
             
       }

      /*list page*/
      public function index()
      {
          
           $data = [
                  'main_title' => 'Tutor | Meeting-Scheduler',
                  'page_title' => 'Tutor Mgmt',
            ];

            $this->load->view('teacher/teacher_list', $data);
      }

      /*ajax list page*/
      public function ajax_teacher_list()
      {
            $listData = $this->teacher_model->get_datatables();

            $data = [];
            $no = $_POST['start'];
            foreach ($listData as $row) {
                  $btn = '<button data-id ="'.$row->user_id.'" type="button" class="btn btn-default btn-xs" id="view-btn" title="Edit"><i class="fa fa-eye"></i></button>';
                 

                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->user_id.'" type="button" class="btn btn-default btn-xs" id="edit-btn" title="Edit"><i class="fa fa-pencil"></i></button>';

                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->user_id.'" type="button" class="btn btn-default btn-xs" id="delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>';
                    
                  if ($row->status==1) {
                        $status = '<button data-id ="'.$row->user_id.'" type="button" class="btn btn-success btn-xs" id="status-btn" title="Change Status">Active</button>';
                  }else{
                        $status = '<button data-id ="'.$row->user_id.'" type="button" class="btn btn-danger btn-xs" id="status-btn" title="Change Status">Inactive</button>';
                  }

                  $no++;
                  $nestedData = [];
                  $nestedData[] = $no;
                  $nestedData[] = ucfirst($row->firstname)." ".ucfirst($row->lastname);
                  $nestedData[] = $row->username;
                  $nestedData[] = date('d M Y',strtotime($row->date_of_birth));
                /*  $nestedData[] = $status;
                  $nestedData[] = $btn;*/
                  $data[] = $nestedData;
            }

            $output = [
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->teacher_model->count_all(),
                  "recordsFiltered" => $this->teacher_model->count_filtered(),
                  "data" => $data,
            ];

            // Output to JSON format
            echo json_encode($output);
      }

      /*add form*/
      public function add()
      {
            $data = [
                  'main_title' => 'Add Teacher | Meeting-Scheduler',
                  'page_title' => 'Add Teacher',
                  'btn' => 'Add',
             ];
 
            $this->load->view('teacher/teacher_add_edit', $data);
      }

      /*add/edit action*/
      public function add_edit_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $firstname = isset($post['firstname']) ? trim($post['firstname']) : ''; 
            $lastname = isset($post['lastname']) ? trim($post['lastname']) : ''; 
            $username = isset($post['username']) ? trim($post['username']) : ''; 
            $date_of_birth = isset($post['date_of_birth']) ? trim(date('Y-m-d',strtotime($post['date_of_birth'])))  : ''; 
          //  $student_id = isset($post['student_id']) ? trim($post['student_id']) : '';
            $password = isset($post['password']) ? trim($this->hash_password($post['password'])) : '';
            $login_right = 1;
            $role_fid = 4;
          
            $dupli_cond = array('username' => $username, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData("user_master", $dupli_cond);
            
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
                        //"student_id" => $student_id,
                        //"date_of_birth" => $date_of_birth,
                        "password" => $password,
                        "login_right" => 1,
                        "role_fid" => 3,
                      //  "created_by" => $_SESSION['user_id'],
                        "created_on" =>  date('Y-m-d H:i:s'),
                    );
                    $saveAction = $this->common_model->insert("user_master", $saveData);
                    
                    $output = array("status" => 1, "message" => "Save Success");
              }
      }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
        
      }

      /*edit form*/
      public function edit()
      {
            $color_id = $this->uri->segment(3);
            if(empty($color_id) || !isset($color_id) || $color_id==0)
            {
                  redirect('Color','refresh');
            }
            /*get  datat by id*/
            $condition = array('color_id' => $color_id);
            $view = $this->common_model->getSingleData($this->table,$condition);

            $data = [
                  'main_title' => 'Update Color | Automobile',
                  'page_title' => 'Update Color',
                  'btn' => 'Update',
                  'view' => $view,
            ];      
       
              $this->load->view('color/color_add_edit', $data);
      }
      
      /*view page*/
      public function view()
      {
            $color_id = $this->uri->segment(3);
            if(empty($color_id) || !isset($color_id) || $color_id==0)
            {
                  redirect('Color','refresh');
            }
            /*get role databy id*/
            $view = $this->color_model->getColorData($color_id);
            
            $data = [
                  'main_title' => 'View Color | Automobile',
                  'page_title' => 'View Color',
                  'view' => $view,
                  'color_id' => $color_id,
            ];      
       
            $this->load->view('color/color_view', $data);
      }

      /*change status */
      public function change_status_action()
      {
           /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $user_id = isset($post['user_id']) ? trim($post['user_id']) : '0'; 

            $condition = array('user_id' => $user_id);
            $getData = $this->common_model->getSingleData($this->table,$condition);
            
             
             if($getData->status == 0)
                {
                        $udateStatusData = array(
                            "status" => 1,
                            "status_updated_by" => $_SESSION['user_id'],
                            "status_updated_on" =>  date('Y-m-d H:i:s'),
                        );
                }
                else
                {
                        $udateStatusData = array(
                            "status" => 0,
                            "status_updated_by" => $_SESSION['user_id'],
                            "status_updated_on" =>  date('Y-m-d H:i:s'),
                        );
                }

                if($this->common_model->update($this->table,$udateStatusData,$condition)) {
                
                  $output = array("status" => 1, "message" => "Update Success");
                }
        }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
      }

}
