<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leaves extends MY_Controller
{
      var $table = 'teacher_subject_master';
      public function __construct()
      {
            parent::__construct(); 
             
       }

      /*list page*/
      public function index($flag="")
      {
         $teacher_fid = $_SESSION['user_id'];   
         $getTeacherLeavesDays = $this->common_model->getAllData("teacher_leave_days","is_deleted = 0 AND status = 1 AND teacher_fid = $teacher_fid");

          $leave_days = [];
          if(isset($getTeacherLeavesDays[0]->leave_days) && $getTeacherLeavesDays[0]->leave_days!=''){
            $leave_days =  explode(',', $getTeacherLeavesDays[0]->leave_days);
          }
          


           $data = [
                  'main_title' => 'My Leaves | Meeting-Scheduler',
                  'page_title' => 'My Leave Days Mgmt',
                  'leave_days' => $leave_days,
                  'flag' => $flag,
            ];

            $this->load->view('leaves/leaves_list', $data);
      }

      
    public function save_leaves_days()
    {

       
          $post = $this->input->post();
          $teacher_fid = $_SESSION['user_id'];   
          $leave_days = isset($post['leave_days']) ? implode(',', $post['leave_days']) : ''; 
        
           /*check duplication*/
          $getTeacherLeavesDays = $this->common_model->getAllData("teacher_leave_days","is_deleted = 0 AND status = 1 AND teacher_fid = $teacher_fid");
          
          
          if(count($getTeacherLeavesDays) > 0)
          {
                //update record
                $updateData = array(
                   "teacher_fid" => $teacher_fid,
                    "leave_days" => $leave_days,
                    "updated_by" => $_SESSION['user_id'],
                    "updated_on" =>  date('Y-m-d H:i:s'),
                );
                $condition = array('teacher_fid' => $teacher_fid);

                $updateAction = $this->common_model->update("teacher_leave_days",$updateData,$condition);
          }
          else
          {
               //insert record
                $saveData = array(
                      "teacher_fid" => $teacher_fid,
                      "leave_days" => $leave_days,
                      "created_by" => $_SESSION['user_id'],
                      "created_on" =>  date('Y-m-d H:i:s'),
                );
                $saveAction = $this->common_model->insert("teacher_leave_days",$saveData);
          }


          redirect('Leaves/index/1');
    }

}
