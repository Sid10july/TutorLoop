<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_master extends MY_Controller
{
      var $table = 'subject_master';
      public function __construct()
      {
            parent::__construct();
            $this->load->model('subject_master_model');
             
       }

      /*list page*/
      public function index()
      {
          
           $data = [
                  'main_title' => 'Subject Master | Meeting-Scheduler',
                  'page_title' => 'Subject Master Mgmt',
            ];

            $this->load->view('subject_master/subject_master_list', $data);
      }

      /*ajax list page*/
      public function ajax_subject_master_list()
      {
            $listData = $this->subject_master_model->get_datatables();
            
            $data = [];
            $no = $_POST['start'];
            foreach ($listData as $row) {
                  /*$btn = '<button data-id ="'.$row->user_id.'" type="button" class="btn btn-default btn-xs" id="view-btn" title="Edit"><i class="fa fa-eye"></i></button>';*/
                 $btn = '';

                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->subject_id.'" type="button" class="btn btn-default btn-xs" id="edit-btn" title="Edit"><i class="fa fa-pencil"></i></button>';

                  $btn .= '&nbsp;&nbsp;<button data-id ="'.$row->subject_id.'" type="button" class="btn btn-default btn-xs" id="delete-btn" title="Delete"><i class="fa fa-trash-o"></i></button>';
                    
                  if ($row->status==1) {
                        $status = '<button data-id ="'.$row->subject_id.'" type="button" class="btn btn-success btn-xs" id="status-btn" title="Change Status">Active</button>';
                  }else{
                        $status = '<button data-id ="'.$row->subject_id.'" type="button" class="btn btn-danger btn-xs" id="status-btn" title="Change Status">Inactive</button>';
                  }

                  $no++;
                  $nestedData = [];
                  $nestedData[] = $no;
                  $nestedData[] = ucfirst($row->subject_name);
                  $nestedData[] = $status;
                  $nestedData[] = $btn;
                  $data[] = $nestedData;
            }

            $output = [
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->subject_master_model->count_all(),
                  "recordsFiltered" => $this->subject_master_model->count_filtered(),
                  "data" => $data,
            ];

            // Output to JSON format
            echo json_encode($output);
      }

      /*add form*/
      public function add()
      {
   
            $data = [
                  'main_title' => 'Add Subject Master | Meeting-Scheduler',
                  'page_title' => 'Add Subject Master',
                  'btn' => 'Add',
              ];
 
            $this->load->view('subject_master/subject_master_add_edit', $data);
      }

      /*student personal details add/edit action*/
      public function add_edit_action()
      {
        /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
               
            $subject_id = isset($post['subject_id']) ? trim($post['subject_id']) : 0; 
            $subject_name = isset($post['subject_name']) ? trim($post['subject_name']) : ''; 
             
          
            $dupli_cond = array('subject_id <>' => $subject_id,'subject_name' => $subject_name, 'is_deleted' => 0);
             /*check duplication*/
            $duplicate = $this->common_model->getAllData($this->table,$dupli_cond);
            
            
            if(count($duplicate) > 0)
            {
                $output = array("status" => 2, "message" => "Already exists");
            }
            else
            {
                    if($subject_id == 0)
                    {
                            //insert record
                            $saveData = array(
                                 "subject_name" => $subject_name,
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
                                "subject_name" => $subject_name,
                                "updated_by" => $_SESSION['user_id'],
                                "updated_on" =>  date('Y-m-d H:i:s'),
                            );
                            $condition = array('subject_id' => $subject_id);
          
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
            $subject_id = $this->uri->segment(3);
            if(empty($subject_id) || !isset($subject_id) || $subject_id==0)
            {
                  redirect('Subject_master','refresh');
            }
            /*get  datat by id*/
            $condition = array('subject_id' => $subject_id);
            $view = $this->common_model->getSingleData($this->table,$condition);

 
            $data = [
                  'main_title' => 'Update Student | Meeting-Scheduler',
                  'page_title' => 'Update Student',
                  'btn' => 'Update',
                  'view' => $view,
             ];      
       
              $this->load->view('subject_master/subject_master_add_edit', $data);
      }
      
      /*view page*/
      public function view()
      {
            $subject_id = $this->uri->segment(3);
            if(empty($subject_id) || !isset($subject_id) || $subject_id==0)
            {
                  redirect('Subject_master','refresh');
            }
            /*get role databy id*/
            $view = $this->color_model->getColorData($subject_id);
            
            $data = [
                  'main_title' => 'View Color | Automobile',
                  'page_title' => 'View Color',
                  'view' => $view,
                  'subject_id' => $subject_id,
            ];      
       
            $this->load->view('subject_master/subject_master_view', $data);
      }

      /*change status */
      public function change_status_action()
      {
           /*check ajax request*/    
        if($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            
            $subject_id = isset($post['subject_id']) ? trim($post['subject_id']) : '0'; 

            $condition = array('subject_id' => $subject_id);
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
      public function delete_subject_master()
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
