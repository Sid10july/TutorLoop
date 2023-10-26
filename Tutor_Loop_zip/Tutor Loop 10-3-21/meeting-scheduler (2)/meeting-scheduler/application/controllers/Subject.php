<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject extends MY_Controller
{
      var $table = 'teacher_subject_master';
      public function __construct()
      {
            parent::__construct(); 
             
       }

      /*list page*/
      public function index()
      {
          
           $getSubjectData = $this->common_model->getTeacherSubjectData();
            
           $data = [
                  'main_title' => 'My Subject | Meeting-Scheduler',
                  'page_title' => 'My Subject Mgmt',
                  'getSubjectData' => $getSubjectData,
            ];

            $this->load->view('subject/subject_list', $data);
      }

      

      /*add form*/
      public function add()
      {
           /*get teacher subject master*/
          $getTeacherSubject = $this->common_model->getAllData("teacher_subject_master", array('status' => 1 , 'is_deleted' => 0 , 'user_fid' => $_SESSION['user_id']));
          $subject_id_array = implode(',', array_column($getTeacherSubject, 'subject_fid'));
          
          /*get subject master*/
          $condition = "is_deleted = 0 AND status = 1";
          if (count($getTeacherSubject) > 0 ) {
            $condition = "is_deleted = 0 AND status = 1 AND subject_id NOT IN (".$subject_id_array.")";
          }
           
          $getSubjectMaster = $this->common_model->getAllData("subject_master",$condition,"subject_name ASC");
 
            $data = [
                  'main_title' => 'Add Subject | Meeting-Scheduler',
                  'page_title' => 'Add Subject',
                  'btn' => 'Add',
                  'getSubjectMaster' => $getSubjectMaster,
             ];
 
            $this->load->view('subject/subject_add_edit', $data);
      }

      /*add/edit action*/
      public function add_edit_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
        
            $subject_fid = isset($post['subject_fid']) ? $post['subject_fid'] : 0; 
            $user_fid = $_SESSION['user_id']; 
            
            for ($i=0; $i < count($subject_fid) ; $i++) { 
                   
                          
                //insert record
                $saveData = array(
                      "user_fid" => $user_fid,
                      "subject_fid" => $subject_fid[$i],
                      "created_by" => $_SESSION['user_id'],
                      "created_on" =>  date('Y-m-d H:i:s'),
                );
                $saveAction = $this->common_model->insert($this->table,$saveData);
                
              }
                if($saveAction > 0){
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
            $subject_id = $this->uri->segment(3);
            if(empty($subject_id) || !isset($subject_id) || $subject_id==0)
            {
                  redirect('Subject','refresh');
            }
            /*get  datat by id*/
            $condition = array('subject_id' => $subject_id);
            $view = $this->common_model->getSingleData($this->table,$condition);

            $data = [
                  'main_title' => 'Update Subject | Meeting-Scheduler',
                  'page_title' => 'Update Subject',
                  'btn' => 'Update',
                  'view' => $view,
            ];      
       
              $this->load->view('subject/subject_add_edit', $data);
      }
      
      /*view page*/
      /*public function view()
      {
            $color_id = $this->uri->segment(3);
            if(empty($color_id) || !isset($color_id) || $color_id==0)
            {
                  redirect('Color','refresh');
            }
             
            $view = $this->color_model->getColorData($color_id);
            
            $data = [
                  'main_title' => 'View Color | Automobile',
                  'page_title' => 'View Color',
                  'view' => $view,
                  'color_id' => $color_id,
            ];      
       
            $this->load->view('color/color_view', $data);
      }*/

      /*change status */
      public function change_status_action()
      {
           /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $teacher_subject_id = isset($post['teacher_subject_id']) ? trim($post['teacher_subject_id']) : '0'; 

            $condition = array('teacher_subject_id' => $teacher_subject_id);
            $getData = $this->common_model->getSingleData("teacher_subject_master",$condition);
            
             
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


      /* soft delete upload */
      public function delete_subject()
      {
            if($this->input->is_ajax_request())
            {
                  $updateData = array(
                  "is_deleted" => 1,  
                  "deleted_by" => $_SESSION['user_id'],
                  "updated_by" => $_SESSION['user_id'],
                  "updated_on" =>  date('Y-m-d H:i:s'),
                  );
                  
                  $updateAction = $this->common_model->update($this->table,$updateData,array('subject_id' => $_POST['subject_id']));

                  if($updateAction > 0){  
                        $output = array("status" => 1, "message" => "Delete succesfully");
                  } 
            }  else{
                  $output = array("status" => 0, "message" => "Ajax request not completed");
            }
      
            echo json_encode($output); exit;
      }

}
