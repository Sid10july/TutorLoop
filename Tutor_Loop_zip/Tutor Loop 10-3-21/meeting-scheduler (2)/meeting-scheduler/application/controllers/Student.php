<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends MY_Controller
{
      var $table = 'user_master';
      public function __construct()
      {
            parent::__construct();
            $this->load->model('student_model');
             
       }

      /*list page*/
      public function index()
      {
          
           $data = [
                  'main_title' => 'Student | Meeting-Scheduler',
                  'page_title' => 'Student Mgmt',
            ];

            $this->load->view('student/student_list', $data);
      }

      /*ajax list page*/
      public function ajax_student_list()
      {
            $listData = $this->student_model->get_datatables();
            
            $data = [];
            $no = $_POST['start'];
            foreach ($listData as $row) {
                  /*$btn = '<button data-id ="'.$row->user_id.'" type="button" class="btn btn-default btn-xs" id="view-btn" title="Edit"><i class="fa fa-eye"></i></button>';*/
                 $btn = '';

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
                  $nestedData[] = $row->student_id;
                  $nestedData[] = $row->username;
                  $nestedData[] = date('d M Y',strtotime($row->date_of_birth));
                  $nestedData[] = $status;
                  $nestedData[] = $btn;
                  $data[] = $nestedData;
            }

            $output = [
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->student_model->count_all(),
                  "recordsFiltered" => $this->student_model->count_filtered(),
                  "data" => $data,
            ];

            // Output to JSON format
            echo json_encode($output);
      }

      /*add form*/
      public function add()
      {

         /*get subject master*/
          $condition = "is_deleted = 0 AND status = 1";
        /*  if (count($getTeacherSubject) > 0 ) {
            $condition = "is_deleted = 0 AND status = 1 AND subject_id NOT IN (".$subject_id_array.")";
          }*/
           
          $getSubjectMaster = $this->common_model->getAllData("subject_master",$condition,"subject_name ASC");
           
            $data = [
                  'main_title' => 'Add Student | Meeting-Scheduler',
                  'page_title' => 'Add Student',
                  'btn' => 'Add',
                  'getSubjectMaster' => $getSubjectMaster,
             ];
 
            $this->load->view('student/student_add_edit', $data);
      }

      /*student personal details add/edit action*/
      public function add_edit_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
             
            $user_id = isset($post['user_id']) ? trim($post['user_id']) : 0; 
            $firstname = isset($post['firstname']) ? trim($post['firstname']) : ''; 
            $lastname = isset($post['lastname']) ? trim($post['lastname']) : ''; 
            $username = isset($post['username']) ? trim($post['username']) : ''; 
            $date_of_birth = isset($post['date_of_birth']) ? trim(date('Y-m-d',strtotime($post['date_of_birth'])))  : ''; 
            $student_id = isset($post['student_id']) ? trim($post['student_id']) : '';
            $password = isset($post['password']) ? trim($this->hash_password($post['password'])) : '';
            $login_right = 1;
            $role_fid = 4;
          
            $dupli_cond = array('user_id <>' => $user_id,'username' => $username, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData("user_master",$dupli_cond);
            
            
            if(count($duplicate) > 0)
            {
                $output = array("status" => 2, "message" => "Already exists");
            }
            else
            {
                    if($user_id == 0)
                    {
                            //insert record
                            $saveData = array(
                                 "firstname" => $firstname,
                                  "lastname" => $lastname,
                                  "username" => $username,
                                  "date_of_birth" => $date_of_birth,
                                  "student_id" => $student_id,
                                  "date_of_birth" => $date_of_birth,
                                  "password" => $password,
                                  "login_right" => 1,
                                  "role_fid" => 4,
                                "created_by" => $_SESSION['user_id'],
                                "created_on" =>  date('Y-m-d H:i:s'),
                            );
                            $saveAction = $this->common_model->insert($this->table,$saveData);
                            
                            if($saveAction > 0){
                                    $output = array("status" => 1, "message" => "Save Success");
                            } 
                    }
                    else
                    {
                            //update record
                            $updateData = array(
                                "firstname" => $firstname,
                                "lastname" => $lastname,
                                "date_of_birth" => $date_of_birth,
                                "username" => $username,
                                "updated_by" => $_SESSION['user_id'],
                                "updated_on" =>  date('Y-m-d H:i:s'),
                            );
                            $condition = array('user_id' => $user_id);
          
                            $updateAction = $this->common_model->update($this->table,$updateData,$condition);
                            if($updateAction > 0){  
                                $output = array("status" => 1, "message" => "Update Success");
                            } 
                    }
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
            $user_id = $this->uri->segment(3);
            if(empty($user_id) || !isset($user_id) || $user_id==0)
            {
                  redirect('Color','refresh');
            }
            /*get  datat by id*/
            $condition = array('user_id' => $user_id);
            $view = $this->common_model->getSingleData($this->table,$condition);


            /*get subject master*/
            $getSubjectMaster = $this->common_model->getAllData("subject_master","is_deleted = 0 AND status = 1","subject_name ASC");

            /*get studen subject-tutor list*/
             $student_fid = $user_id;
             $getStudentSubjectTutorList = $this->common_model->getStudentSubjectTutorList($student_fid);

            $data = [
                  'main_title' => 'Update Student | Meeting-Scheduler',
                  'page_title' => 'Update Student',
                  'btn' => 'Update',
                  'view' => $view,
                  'getSubjectMaster' => $getSubjectMaster,
                  'getStudentSubjectTutorList' => $getStudentSubjectTutorList,
            ];      
       
              $this->load->view('student/student_add_edit', $data);
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


      /* soft delete for student */
      public function delete_student()
      {
            if($this->input->is_ajax_request())
            {
                  $updateData = array(
                  "is_deleted" => 1,  
                  "deleted_by" => $_SESSION['user_id'],
                  "updated_by" => $_SESSION['user_id'],
                  "updated_on" =>  date('Y-m-d H:i:s'),
                  );
                  
                  $updateAction = $this->common_model->update("user_master",$updateData,array('user_id' => $_POST['user_id']));

                  if($updateAction > 0){  
                        $output = array("status" => 1, "message" => "Delete succesfully");
                  } 
            }  else{
                  $output = array("status" => 0, "message" => "Ajax request not completed");
            }
      
            echo json_encode($output); exit;
      }

      /*get subject -tutor list*/

     public function get_subject_tutor_list()
      {
      if($this->input->is_ajax_request())
      {
          $post = $this->input->post();
          $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : '0'; 
          $getData = $this->common_model->getSubjectTeacherList($subject_fid);
          $html = '<option value=""></option>';
          if(count($getData) > 0 ){
             // $html = ' ';
                foreach ($getData as $key => $value) {
                $teacher_full_name  = ucfirst($value->firstname)." ".ucfirst($value->lastname);
                $html .= '
                <option value='.$value->user_fid.'>'.$teacher_full_name.'</option>
                ';
                }
          }else{
            $html .= '
            <option value="">No Teacher Found..! Please Add Subject Against Teacher</option>
            ';
          }
           $output = array("status" => 1, "message" => "Success", 'html' => $html);
      }
      else{
           $output = array("status" => 0, "message" => "Ajax request not completed");
      }
           echo json_encode($output); exit;
      }


       /*get student name by using teacher id list*/

     public function get_student_by_teacher_list()
     {
     if($this->input->is_ajax_request())
     {
         $post = $this->input->post();

           
         $teacher_fid = isset($post['teacher_fid']) ? trim($post['teacher_fid']) : '0'; 
         $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : '0'; 
         $getData = $this->common_model->getStudentListByTeacher($teacher_fid,$subject_fid);

        
         $html = '';
         if(count($getData) > 0 ){
            // $html = ' ';
               foreach ($getData as $key => $value) {
               $student_full_name  = ucfirst($value->studentfirstname)." ".ucfirst($value->studentlastname);
               $html .= '
               <option value='.$value->student_fid.'>'.$student_full_name.'</option>
               ';
               }
         }else{
           $html .= '
           <option value="">No Student Found..! Please Add Subject-Tutor Against Student</option>
           ';
         }
          $output = array("status" => 1, "message" => "Success", 'html' => $html);
     }
     else{
          $output = array("status" => 0, "message" => "Ajax request not completed");
     }
          echo json_encode($output); exit;
     }

      /*student subject tutor action*/
      public function save_student_subject_tutor_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
           
            $student_fid = isset($post['student_fid']) ? trim($post['student_fid']) : 0; 
            $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : ''; 
            $teacher_fid = isset($post['teacher_fid']) ? trim($post['teacher_fid']) : ''; 
             
          
            $dupli_cond = array('student_fid' => $student_fid,'subject_fid' => $subject_fid,'teacher_fid' => $teacher_fid, 'status' => 1, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData("student_teacher_subject_master",$dupli_cond);
  
            if(count($duplicate) > 0)
            {
                $output = array("status" => 2, "message" => "Already exists");
            }
            else
            {                    
                  //insert record
                  $saveData = array(
                        "student_fid" => $student_fid,
                        "subject_fid" => $subject_fid,
                        "teacher_fid" => $teacher_fid,
                        "created_by" => $_SESSION['user_id'],
                        "created_on" =>  date('Y-m-d H:i:s'),
                  );
                  $saveAction = $this->common_model->insert("student_teacher_subject_master",$saveData);
                  
                  if($saveAction > 0){
                          $output = array("status" => 1, "message" => "Save Success");
                  } 
                   
            }
        }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
      }


       /*change student subject tutor status */
      public function change_student_sub_tutor_status_action()
      {
           /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $student_teacher_subject_id = isset($post['student_teacher_subject_id']) ? trim($post['student_teacher_subject_id']) : '0'; 

            $condition = array('student_teacher_subject_id' => $student_teacher_subject_id);
            $getData = $this->common_model->getSingleData("student_teacher_subject_master",$condition);
            
             
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

                if($this->common_model->update("student_teacher_subject_master",$udateStatusData,$condition)) {
                
                  $output = array("status" => 1, "message" => "Update Success");
                }
        }
        else{
            $output = array("status" => 0, "message" => "Ajax request not completed");
        }
        
        echo json_encode($output); exit;
      }

       /* soft delete for student subject tutor */
      public function delete_student_subject_tutor()
      {
            if($this->input->is_ajax_request())
            {
                  $updateData = array(
                  "is_deleted" => 1,  
                  "deleted_by" => $_SESSION['user_id'],
                  "updated_by" => $_SESSION['user_id'],
                  "updated_on" =>  date('Y-m-d H:i:s'),
                  );
                  
                  $updateAction = $this->common_model->update("student_teacher_subject_master",$updateData,array('student_teacher_subject_id' => $_POST['student_teacher_subject_id']));

                  if($updateAction > 0){  
                        $output = array("status" => 1, "message" => "Delete succesfully");
                  } 
            }  else{
                  $output = array("status" => 0, "message" => "Ajax request not completed");
            }
      
            echo json_encode($output); exit;
      }

}
