<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends MY_Controller
{
      var $table = 'meeting_master';
      public function __construct()
      {
            parent::__construct();
            $this->load->model('meeting_model');
             
       }

      /*list page*/
      public function index()
      {
         /*get subject master*/
          $getSubjectMaster = $this->common_model->getAllData("subject_master","is_deleted = 0 AND status = 1","subject_name ASC");

          /*get tutor master*/
          $getTutors = $this->common_model->getAllData('user_master',array('role_fid' => 3,'is_deleted' => 0, ));
          
           $data = [
                  'main_title' => 'Meeting | Meeting-Scheduler',
                  'page_title' => 'Meeting Mgmt',
                  'getSubjectMaster' => $getSubjectMaster,
                  'getTutors' => $getTutors,
            ];

            $this->load->view('meeting/meeting_list', $data);
      }

      /*ajax list page*/
      public function ajax_meeting_list()
      {
            $listData = $this->meeting_model->get_datatables();
           
            

            $data = [];
            $no = $_POST['start'];
            foreach ($listData as $row) {
                  $btn = '<button data-id ="'.$row->meeting_id.'" type="button" class="btn btn-default btn-xs" id="view-btn" title="View"><i class="fa fa-eye"></i></button>';
                  
                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->meeting_id.'" type="button" class="btn btn-default btn-xs" id="edit-btn" title="Edit"><i class="fa fa-pencil"></i></button>';

                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->meeting_id.'" type="button" class="btn btn-default btn-xs" id="delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>';
                    
                  if ($row->status==1) {
                        $status = '<button data-id ="'.$row->meeting_id.'" type="button" class="btn btn-success btn-xs" id="status-btn" title="Change Status">Active</button>';
                  }else{
                        $status = '<button data-id ="'.$row->meeting_id.'" type="button" class="btn btn-danger btn-xs" id="status-btn" title="Change Status">Inactive</button>';
                  }

                  $no++;
                  $nestedData = [];
                  $nestedData[] = $no;
                  $nestedData[] = $row->subject_name;
                  $nestedData[] = ucfirst($row->firstname)." ".ucfirst($row->lastname);
                  $nestedData[] = date('d M Y',strtotime($row->meeting_date));
                  $nestedData[] = $row->start_time." - ".$row->end_time;
                  $nestedData[] = "<center>".$row->reminder_time." - Min"."</center>";
                  $nestedData[] = "<center><span class='badge bg-darkblue c-white'>".$row->total_student."</span></center>";
                  /* $nestedData[] = $status; */
                  $nestedData[] = $btn;
                  $data[] = $nestedData;
            }

            $output = [
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->meeting_model->count_all(),
                  "recordsFiltered" => $this->meeting_model->count_filtered(),
                  "data" => $data,
            ];

            // Output to JSON format
            echo json_encode($output);
      }

      /*add form*/
      public function add()
      {
          $teacher_fid = $_SESSION['user_id'];
          /*get subject master*/
          $getSubjectMaster = $this->common_model->getAllData("subject_master","is_deleted = 0 AND status = 1","subject_name ASC");
          $getTeacherLeavesDays = $this->common_model->getAllData("teacher_leave_days","is_deleted = 0 AND status = 1 AND teacher_fid = $teacher_fid");

          $leave_days = '';
          if(isset($getTeacherLeavesDays[0]->leave_days)){
            $leave_days = $getTeacherLeavesDays[0]->leave_days;
          }
           
            $data = [
                  'main_title' => 'Add New Meeting | Meeting-Scheduler',
                  'page_title' => 'Add New Meeting',
                  'btn' => 'Add',
                  'getSubjectMaster' => $getSubjectMaster,
                  'leave_days' => $leave_days,
             ];
 
            $this->load->view('meeting/meeting_add_edit', $data);
      }

      /*student personal details add/edit action*/
      public function add_edit_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
 
             
            $meeting_id = isset($post['meeting_id']) ? trim($post['meeting_id']) : 0; 
        
            $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : 0; 
            $teacher_fid = isset($post['teacher_fid']) ? trim($post['teacher_fid']) : 0; 
            $student_fid = isset($post['student_fid']) ? $post['student_fid'] : 0; 
            $meeting_date = isset($post['meeting_date']) ? trim(date('Y-m-d',strtotime($post['meeting_date'])))  : ''; 
            $start_time = isset($post['start_time']) ? trim($post['start_time']) : '';
            $end_time = isset($post['end_time']) ? trim($post['end_time']) : '';
            $reminder_time = isset($post['reminder_time']) ? trim($post['reminder_time']) : '';
          
          
            
            
           // print_r(count($duplicate)); exit;

            $duplicateStudentArray=array();
            for ($i=0; $i < count($student_fid); $i++) { 
 
             /*check duplication*/
             $duplicate = $this->meeting_model->checkMeetingDuplication($meeting_id,$student_fid[$i],$subject_fid,$teacher_fid,$meeting_date,$start_time,$end_time); 

             if(count($duplicate)){

                array_push($duplicateStudentArray,$duplicate[0]->student_fid);
               }
            }

            
            
            if(count($duplicateStudentArray) > 0)
            {

                $getDuplicateStudentname = $this->meeting_model->get_duplicate_student_name($duplicateStudentArray);

                $duplicateHtml ='';

                foreach ($getDuplicateStudentname as $key => $value) {
                  
                  $duplicateHtml .= "<li>".ucfirst($value->firstname)." ".ucfirst($value->lastname)."</li>";
                }


                $output = array("status" => 2, "message" => "Already exists",'duplicateHtml' => $duplicateHtml);
            }
            else
            {
                    if($meeting_id == 0)
                    {
                            //insert record
                            $saveData = array(
                                  "subject_fid" => $subject_fid,
                                  "teacher_fid" => $teacher_fid,
                                  "meeting_date" => $meeting_date,
                                  "start_time" => $start_time,
                                  "end_time" => $end_time,
                                  "reminder_time" => $reminder_time,
                                  "total_student" => count($student_fid),
                                  "created_by" => $_SESSION['user_id'],
                                  "created_on" =>  date('Y-m-d H:i:s'),
                            );
                            $saveAction = $this->common_model->insert($this->table,$saveData);
                            
                            if($saveAction > 0){

                              for ($i=0; $i < count($student_fid); $i++) { 
                                    
                                    $meeting_fid =  $saveAction;

                                    $saveMeetingStudentData = array(
                                          "meeting_fid" => $meeting_fid,
                                          "student_fid" => $student_fid[$i],
                                          "ms_subject_fid" => $subject_fid,
                                          "ms_teacher_fid" => $teacher_fid,
                                          "ms_meeting_date" => $meeting_date,
                                          "ms_start_time" => $start_time,
                                          "ms_end_time" => $end_time,
                                          "created_by" => $_SESSION['user_id'],
                                          "created_on" =>  date('Y-m-d H:i:s'),
                                    );

                                    $this->common_model->insert("meeting_student_master",$saveMeetingStudentData);

                              }

                                    $output = array("status" => 1, "message" => "Save Success");
                            } 
                    }
                    else
                    {
                            //update record
                            $updateData = array(
                                "subject_fid" => $subject_fid,
                                "teacher_fid" => $teacher_fid,
                                "meeting_date" => $meeting_date,
                                "start_time" => $start_time,
                                "end_time" => $end_time,
                                "reminder_time" => $reminder_time,
                                "total_student" => count($student_fid),
                                "updated_by" => $_SESSION['user_id'],
                                "updated_on" =>  date('Y-m-d H:i:s'),
                            );
                            $condition = array('meeting_id' => $meeting_id);
          
                            $updateAction = $this->common_model->update($this->table,$updateData,$condition);
                            if($updateAction > 0){

                            /*update is_delete_flag and status flag as a soft delete
                              0 = Inactive
                              1 = Deleted Yes
                            */  
                            $DeleteStatusData = array('status' => 0,'is_deleted' => 1, );
                            $this->common_model->update("meeting_student_master",$DeleteStatusData,array('meeting_fid' => $meeting_id));

                                for ($i=0; $i < count($student_fid); $i++) { 
                                   
                                  $saveMeetingStudentData = array(
                                        "meeting_fid" => $meeting_id,
                                        "student_fid" => $student_fid[$i],
                                        "ms_subject_fid" => $subject_fid,
                                        "ms_teacher_fid" => $teacher_fid,
                                        "ms_meeting_date" => $meeting_date,
                                        "ms_start_time" => $start_time,
                                        "ms_end_time" => $end_time,
                                        "created_by" => $_SESSION['user_id'],
                                        "created_on" =>  date('Y-m-d H:i:s'),
                                  );

                                  $this->common_model->insert("meeting_student_master",$saveMeetingStudentData);

                               }



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
            $meeting_id = $this->uri->segment(3);
            if(empty($meeting_id) || !isset($meeting_id) || $meeting_id==0)
            {
                  redirect('Meeting','refresh');
            }
            /*get  datat by id*/
            $condition = array('meeting_id' => $meeting_id);
            $view = $this->common_model->getSingleData($this->table,$condition);

            /*get subject master*/
            $getSubjectMaster = $this->common_model->getAllData("subject_master","is_deleted = 0 AND status = 1","subject_name ASC");
            $getTutorMaster = $this->common_model->getAllData("user_master","is_deleted = 0 AND status = 1 AND role_fid = 3","firstname ASC");
            $getStudentMaster = $this->common_model->getAllData("user_master","is_deleted = 0 AND status = 1 AND role_fid = 4","firstname ASC");

            $getparticipate = $this->meeting_model->getMeetingData($meeting_id);
            $getStudentIds = array_column($getparticipate, 'student_fid');

            $teacher_fid = $_SESSION['user_id'];
            $getTeacherLeavesDays = $this->common_model->getAllData("teacher_leave_days","is_deleted = 0 AND status = 1 AND teacher_fid = $teacher_fid");

              $leave_days = '';
              if(isset($getTeacherLeavesDays[0]->leave_days)){
                $leave_days = $getTeacherLeavesDays[0]->leave_days;
              }

              
            $data = [
                  'main_title' => 'Update Meeting | Meeting-Scheduler',
                  'page_title' => 'Update Meeting',
                  'btn' => 'Update',
                  'view' => $view,
                  'getSubjectMaster' => $getSubjectMaster,
                  'getTutorMaster' => $getTutorMaster,
                  'getStudentMaster' => $getStudentMaster,
                  'getStudentIds' => $getStudentIds,
                  'leave_days' => $leave_days,
             ];      
       
              $this->load->view('meeting/meeting_add_edit', $data);
      }
      
      /*view page*/
      public function view()
      {
            $meeting_id = $this->uri->segment(3);
            if(empty($meeting_id) || !isset($meeting_id) || $meeting_id==0)
            {
                  redirect('Color','refresh');
            }
            /*get meeting data by id*/

            $data = [
                  'main_title' => 'Meeting | Meeting-Scheduler',
                  'page_title' => 'Meeting View',
                  'view' => $view,
                  'meeting_id' => $meeting_id,
            ];      
       
            $this->load->view('meeting/meeting_view', $data);
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

     /*public function get_subject_tutor_list()
      {
      if($this->input->is_ajax_request())
      {
          $post = $this->input->post();
          $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : '0'; 
          $getData = $this->common_model->getSubjectTeacherList($subject_fid);
          $html = '';
          if(count($getData) > 0 ){
              $html = ' <option value=""></option>';
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
      }*/

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

      /*export meeting start*/
      public function export_meeting()
      {
         $post = $this->input->post();
       
         $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : '0'; 
         $teacher_fid = isset($post['teacher_fid']) ? trim($post['teacher_fid']) : '0'; 
         $meeting_date = isset($post['meeting_date']) ? trim($post['meeting_date']) : '0';

        $listData = $this->meeting_model->getMeetingExportData($subject_fid,$teacher_fid,$meeting_date); 

        // load excel library
             $this->load->library('excel');

              // create file name
              $fileName = 'meeting_details_report_'.time().'.xlsx';
 
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);


                /*for client name*/
                  $objPHPExcel->getActiveSheet()->mergeCells('B2:E2'); //merge 
                    
                  $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Title : Meeting Detailed Report');
                  $objPHPExcel->getActiveSheet()->getStyle('B2:E2')->getFont()->setBold( true );
                  $objPHPExcel->getActiveSheet()->getStyle('B2:E2')->getFont()->setSize(13);
                  $styleArray0 = array(
                        'font' => array(
                            'bold' => true,
                            'color' => array('rgb' => '00008B')
                       ),
                         'alignment' => array(
                          //'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                          'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                      )
                             
                    );
                  $objPHPExcel->getActiveSheet()->getStyle('B2:E2')->applyFromArray($styleArray0);  

                  /*for date downloaded on*/
                  $objPHPExcel->getActiveSheet()->mergeCells('F2:G2'); //merge
                  $objPHPExcel->getActiveSheet()->getStyle('F2:G2')->getFont()->setSize(9);
                  $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Downloaded On : '.date('d-m-Y'));
                  $styleArraydown = array(
                         
                        'alignment' => array(
                        //    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        )
                         
                    );
                  $objPHPExcel->getActiveSheet()->getStyle('F2:G2')->applyFromArray($styleArraydown); 

                  $objPHPExcel->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
                 
                  $border_style11= array('borders' => array('top' => array('style' => 
                  PHPExcel_Style_Border::BORDER_MEDIUM,'color' => array('argb' => '000000'),)),
                       );

                        $border_style12= array('borders' => array('left' => array('style' => 
                  PHPExcel_Style_Border::BORDER_MEDIUM,'color' => array('argb' => '000000'),)),
                       );
                        $border_style13= array('borders' => array('right' => array('style' => 
                  PHPExcel_Style_Border::BORDER_MEDIUM,'color' => array('argb' => '000000'),)),
                       );
                        $border_style14= array('borders' => array('bottom' => array('style' => 
                  PHPExcel_Style_Border::BORDER_MEDIUM,'color' => array('argb' => '000000'),)),
                       );

                  $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($border_style11);
                  $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($border_style14);
                  $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EEEEEE');

                  $objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($border_style13);
                  /*$objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('M4')->applyFromArray($border_style13)*/;

                $styleArray1 = array(
                    'font' => array(
                        'bold' => true,
                      //  'color' => array('rgb' => '#000000')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
              $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($styleArray1);

                // set Header
                $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
                $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Meeting Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Tutor Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Meeting Date');
                $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Meeting Start Time');       
                $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Meeting End Time');  
                $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Total Participantes');  
                $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Participantes Name');  
             /*   $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Member Since');  
                $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Total Ticket');  
                $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Total Device');  
                $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Total Users');  
                $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Expiry Date');  
                $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Member Address');  */
              
                // set Row
                $rowCount = 5;

               // $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
               // $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


                $styleArray2 = array(
             
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                 
                foreach ($listData as $index => $val) 
                {
                    
                  $getStudentName = $this->meeting_model->getMeetingStudentData($val->meeting_id);



                   /*set center*/ 
                  $objPHPExcel->getActiveSheet()->getStyle("A$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("B$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("C$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("D$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("E$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("F$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("G$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("H$rowCount")->applyFromArray($styleArray2);
        
                 

                  $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $index+1);
                  $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, ucfirst($val->subject_name));
                  $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, ucfirst($val->firstname)." ".ucfirst($val->lastname) );
                  $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, date('d-m-Y',strtotime($val->meeting_date)));
                  $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->start_time);
                  $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val->start_time);
                  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->total_student);
                  $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $getStudentName->studentfullname);
                  /*$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, date('d-m-Y H:i', $val->created_on));
                  $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $count_ticket);
                  $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $count_asset);
                  $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, count($total_users));
                  $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, !empty($val->membership_end_date) ? date('M d, Y',$val->membership_end_date) : '--');
                  $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $member_final_address);*/
                          
                  $rowCount++;
                }  
              
              $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');
              $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
              header("Content-Type: application/vnd.ms-excel");
              header('Content-Disposition: attachment; filename="'.$fileName.'"');
              $objWriter->save('php://output');
              exit;  
      }  

      /*export meeting end*/

}
