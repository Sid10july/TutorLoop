<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_subject_tutor extends MY_Controller
{
      public function __construct()
      {
            parent::__construct(); 
             
      }

      /*list page*/
      public function index()
      {
          
           /*get studen subject-tutor list*/
             $student_fid = $_SESSION['user_id'];
             $getStudentSubjectTutorList = $this->common_model->getStudentSubjectTutorList($student_fid);

           $data = [
                  'main_title' => 'My Subject-Tutor | Meeting-Scheduler',
                  'page_title' => 'My Subject-Tutor List',
                  'getStudentSubjectTutorList' => $getStudentSubjectTutorList,
            ];

            $this->load->view('student_subject_tutor/student_subject_tutor_list', $data);
      }

      

      

}
