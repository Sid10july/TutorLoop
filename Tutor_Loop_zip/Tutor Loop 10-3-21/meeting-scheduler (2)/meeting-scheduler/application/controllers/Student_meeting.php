<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_meeting extends MY_Controller
{
      var $table = 'meeting_master';
      public function __construct()
      {
            parent::__construct();
            $this->load->model('student_meeting_model');
             
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
                  'page_title' => 'Student Meeting Mgmt',
                  'getSubjectMaster' => $getSubjectMaster,
                  'getTutors' => $getTutors,
            ];

            $this->load->view('student_meeting/student_meeting_list', $data);
      }

      /*ajax list page*/
      public function ajax_student_meeting_list()
      {
            $listData = $this->student_meeting_model->get_datatables();
           
           

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
                 /* $nestedData[] = "<center>".$row->reminder_time." - Min"."</center>";
                  $nestedData[] = "<center><span class='badge bg-darkblue c-white'>".$row->total_student."</span></center>";*/
                  /* $nestedData[] = $status; */
                 /* $nestedData[] = $btn;*/
                  $data[] = $nestedData;
            }

            $output = [
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->student_meeting_model->count_all(),
                  "recordsFiltered" => $this->student_meeting_model->count_filtered(),
                  "data" => $data,
            ];

            // Output to JSON format
            echo json_encode($output);
      }

     
      /*export meeting start*/
      public function export_meeting()
      {
         $post = $this->input->post();
       
         $subject_fid = isset($post['subject_fid']) ? trim($post['subject_fid']) : '0'; 
         $teacher_fid = isset($post['teacher_fid']) ? trim($post['teacher_fid']) : '0'; 
         $meeting_date = isset($post['meeting_date']) ? trim($post['meeting_date']) : '0';

        $listData = $this->student_meeting_model->getStudentMeetingExportData($subject_fid,$teacher_fid,$meeting_date); 

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

                  $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($border_style11);
                  $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($border_style14);
                  $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EEEEEE');

                  $objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($border_style13);
                  $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($border_style13);
                  ;
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
              $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($styleArray1);

                // set Header
                $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
                $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Meeting Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Tutor Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Meeting Date');
                $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Meeting Start Time');       
                $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Meeting End Time');  
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
                // $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);


                $styleArray2 = array(
             
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                 
                foreach ($listData as $index => $val) 
                {
                    
                         /*set center*/ 
                  $objPHPExcel->getActiveSheet()->getStyle("A$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("B$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("C$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("D$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("E$rowCount")->applyFromArray($styleArray2);
                  $objPHPExcel->getActiveSheet()->getStyle("F$rowCount")->applyFromArray($styleArray2);
                 
                 

                  $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $index+1);
                  $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, ucfirst($val->subject_name));
                  $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, ucfirst($val->firstname)." ".ucfirst($val->lastname) );
                  $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, date('d-m-Y',strtotime($val->meeting_date)));
                  $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->start_time);
                  $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val->start_time);
                
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
