<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	 
	public function index()
	{
	 	
		$this->load->model('meeting_model');

		/*condition for student*/
		if($_SESSION['role_fid'] == 4){

        	$student_fid = $_SESSION['user_id'];  
        	$getStudentMeeting = $this->meeting_model->get_student_meeting($student_fid);




				// total hours today by tutor
				$todayCond = "student_fid = '".$_SESSION['user_id']."' AND ms_meeting_date = '".date('Y-m-d')."' AND is_deleted = 0";
				$studenTodayHour = $this->common_model->getAllData("meeting_student_master",$todayCond);
	
				$studenTodayHourCount = 0;
				foreach ($studenTodayHour as $key => $value) {
					$time1 = strtotime($value->ms_start_time);
					$time2 = strtotime($value->ms_end_time); 
	
					$studenTodayHourCount = $studenTodayHourCount + round(abs($time2 - $time1) / 3600,2); 
				}
				
				// avg hours by student 
				$avgCond = "student_fid = '".$_SESSION['user_id']."' AND ms_meeting_date <= '".date('Y-m-d')."' AND is_deleted = 0";
				$studenAvgHour = $this->common_model->getAllData("meeting_student_master",$avgCond);
	
				$studenAvgHourCount = 0;
				foreach ($studenAvgHour as $key => $value) {
					$time1 = strtotime($value->ms_start_time);
					$time2 = strtotime($value->ms_end_time); 
	
					$studenAvgHourCount = $studenAvgHourCount + round(abs($time2 - $time1) / 3600,2); 
				}

				if(count($studenAvgHour) > 0) { 
					$studenAvgHourCount = $studenAvgHourCount/(count($studenAvgHour));
				}	 


        	$data = array(
			'main_title' => 'Dashboard | Meeting-Scheduler', 
            'page_title' => 'Dashboard', 
            'getStudentMeeting' => $getStudentMeeting, 
			'studenTodayHourCount' => $studenTodayHourCount,
			'studenAvgHourCount' => $studenAvgHourCount
        	);
 			
 			$this->load->view('dashboard/student_dashboard_view',$data);
    	} else {
    		/*condition for tutor*/
    		$toalTutorMeetings = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'] ));
    		$toalTutorRequestMeetings = $this->common_model->getAllData('student_meeting_request_master',array('is_deleted' => 0, 'status' => 0,'teacher_fid' => $_SESSION['user_id']));
    		$getTutorSubjectData = $this->common_model->getTeacherSubjectData();
    		
    		$getTutorMeetingData = $this->common_model->getTutorMeetings();
  
    		/*for bar chart start*/
    		
    		$currentDateData = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d') ));
    		$currentDateDay = date('l \, jS');

    		$currentDateDataOne = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+1 day')) )); 
    		$currentDateDayOne= date('l \, jS',strtotime('+1 day'));


    		$currentDateDataTwo = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+2 day')) )); 
    		$currentDateDayTwo= date('l \, jS',strtotime('+2 day'));

    		$currentDateDataThree = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+3 day')) )); 
    		$currentDateDayThree= date('l \, jS',strtotime('+3 day'));

    		$currentDateDataFour = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+4 day')) )); 
    		$currentDateDayFour= date('l \, jS',strtotime('+4 day'));

    		$currentDateDataFive = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+5 day')) )); 
    		$currentDateDayFive= date('l \, jS',strtotime('+5 day'));

    		$currentDateDataSix = $this->common_model->getAllData('meeting_master',array('is_deleted' => 0, 'teacher_fid' => $_SESSION['user_id'], 'meeting_date' => date('Y-m-d',strtotime('+6 day')) )); 
    		$currentDateDaySix= date('l \, jS',strtotime('+6 day'));
    		 
 
    		/*for bar chart end*/

			// total hours today by tutor
			$todayCond = "teacher_fid = '".$_SESSION['user_id']."' AND meeting_date = '".date('Y-m-d')."' AND is_deleted = 0";
			$tutorTodayHour = $this->common_model->getAllData("meeting_master",$todayCond);

			$tutorTodayHourCount = 0;
			foreach ($tutorTodayHour as $key => $value) {
				$time1 = strtotime($value->start_time);
				$time2 = strtotime($value->end_time); 

				$tutorTodayHourCount = $tutorTodayHourCount + round(abs($time2 - $time1) / 3600,2); 
			}

			// avg hours by teacher 
			$avgCond = "teacher_fid = '".$_SESSION['user_id']."' AND meeting_date <= '".date('Y-m-d')."' AND is_deleted = 0";
			$teacherAvgHour = $this->common_model->getAllData("meeting_master",$avgCond);

			$teacherAvgHourCount = 0;
			foreach ($teacherAvgHour as $key => $value) {
				$time1 = strtotime($value->start_time);
				$time2 = strtotime($value->end_time); 

				$teacherAvgHourCount = $teacherAvgHourCount + round(abs($time2 - $time1) / 3600,2); 
			}

			if(count($teacherAvgHour) > 0) { 
				$teacherAvgHourCount = $teacherAvgHourCount/(count($teacherAvgHour));
			}	 

   
    		$data = array(
			'main_title' => 'Dashboard | Meeting-Scheduler', 
            'page_title' => 'Dashboard', 
            'toalTutorMeetings' => $toalTutorMeetings, 
            'toalTutorRequestMeetings' => $toalTutorRequestMeetings, 
            'getTutorSubjectData' => $getTutorSubjectData, 
            'getTutorMeetingData' => $getTutorMeetingData, 
            'currentDateData' => count($currentDateData), 
            'currentDateDay' => $currentDateDay, 
            'currentDateDataOne' => count($currentDateDataOne), 
            'currentDateDayOne' => $currentDateDayOne, 
            'currentDateDataTwo' => count($currentDateDataTwo), 
            'currentDateDayTwo' => $currentDateDayTwo, 
            'currentDateDataThree' => count($currentDateDataThree), 
            'currentDateDayThree' => $currentDateDayThree, 
            'currentDateDataFour' => count($currentDateDataFour), 
            'currentDateDayFour' => $currentDateDayFour, 
            'currentDateDataFive' => count($currentDateDataFive), 
            'currentDateDayFive' => $currentDateDayFive, 
            'currentDateDataSix' => count($currentDateDataSix), 
            'currentDateDaySix' => $currentDateDaySix, 
			'tutorTodayHourCount' => $tutorTodayHourCount,
			'teacherAvgHourCount' => $teacherAvgHourCount
            );

    		$this->load->view('dashboard/tutor_dashboard_view',$data);
    	}
	}

	public function change_profile()
	{
		$condition = array('user_id' => $_SESSION['user_id']);
        $view = $this->common_model->getSingleData("user_master",$condition);
				 
		$data = array(
			'main_title' => 'Change Profile | Meeting-Scheduler', 
            'page_title' => 'Change Profile', 
            'view' => $view, 
        );

 		$this->load->view('dashboard/change_profile_view',$data);
	}

	  //update user personal details /attachement
	  public function update_user_profile()
	  {  
	        if($this->input->is_ajax_request())
	        {

	        	$post = $this->input->post();
	        	$user_id = isset($post['user_id']) ? trim($post['user_id']) : ''; 
	        	$firstname = isset($post['firstname']) ? trim($post['firstname']) : ''; 
	            $lastname = isset($post['lastname']) ? trim($post['lastname']) : ''; 
	            $username = isset($post['username']) ? trim($post['username']) : ''; 
	            $date_of_birth = isset($post['date_of_birth']) ? trim(date('Y-m-d',strtotime($post['date_of_birth'])))  : ''; 

	        	$dupli_cond = array('user_id <>' => $user_id,'username' => $username, 'is_deleted' => 0);
	             /*check duplication*/
	            $duplicate = $this->common_model->getAllData("user_master",$dupli_cond);
	            
	            if(count($duplicate) > 0)
	            {
	                $output = array("status" => 2, "message" => "Already exists");
	            }else{
	            
				 	if ($_FILES['profile_img']['name'] != '' ) {
	        		
	        		   $UploadpathApprove ='assets/uploads/user';
	                  
	              if( ! is_dir($UploadpathApprove))
	              {
	              mkdir($UploadpathApprove, 0755, true);
	              }	
	              $config['upload_path']          = './assets/uploads/user';
	              $config['allowed_types']        = '*';
	              $config['max_size']             = 20971520;
	              $config['remove_spaces'] = TRUE;
	              $config['encrypt_name'] = TRUE;
	              
	              $this->load->library('upload', $config);

	              if ( ! $this->upload->do_upload('profile_img'))
	              {    
	                    $error = $this->upload->display_errors();
	                    $output = array("status" => 2, "message" => $error);
	              }
	              else
	              {
	              $data = $this->upload->data();
	              $profile_img = $data['file_name'];
	        	  }
	        	}  

	        	else{

	        		$profile_img = $_POST['old_profile_img'];
	        	}

	        	 
	              //update record
	                $updateData = array(
	                    "firstname" => $firstname,
	                    "lastname" => $lastname,
	                    "date_of_birth" => $date_of_birth,
	                    "username" => $username,
	                    "profile_img" => $profile_img,
	                    "updated_by" => $_SESSION['user_id'],
	                    "updated_on" =>  date('Y-m-d H:i:s'),
	                );
	                $condition = array('user_id' => $user_id);

	                $updateAction = $this->common_model->update("user_master",$updateData,$condition);
	                if($updateAction > 0){  

	                	/*start session */
	               		$condition = ['UM.user_id' => $user_id];
	                    
	                    /*check username and password*/
	                    $loginData = $this->common_model->getLoginData($condition);

	                	$sessionData = [
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


	                    $output = array("status" => 1, "message" => "Update Success");
	                } 
	              
	        } 

	        } 
	        else{
	              $output = array("status" => 0, "message" => "Ajax request not completed");
	        }
	  
	        echo json_encode($output); exit;
	  }


	  //update user personal details /attachement
	  public function update_user_profile_password()
	  {  
	        if($this->input->is_ajax_request())
	        {

	        	$post = $this->input->post();

	        	$user_id = isset($post['user_id']) ? trim($post['user_id']) : ''; 
	        	$password = isset($post['password']) ? trim($post['password']) : ''; 
	        	$new_password = isset($post['new_password']) ? trim($post['new_password']) : ''; 
	        	 

	        	$check_oldpass_cond = array('user_id' => $user_id,'password' =>  $this->hash_password($password));
	             /*check duplication*/
	            $checkOldPassword = $this->common_model->getAllData("user_master",$check_oldpass_cond);
	            
	            if(count($checkOldPassword) == 0)
	            {
	                $output = array("status" => 2, "message" => "Old password is not matched");
	            }else{
	         	  
	                //update record
	                $updateData = array(
	                    "password" =>  $this->hash_password($new_password),
	                    "updated_by" => $_SESSION['user_id'],
	                    "updated_on" =>  date('Y-m-d H:i:s'),
	                );
	                
	                 $condition = array('user_id' => $user_id);
	                 $updateAction = $this->common_model->update("user_master",$updateData,$condition);
	                if($updateAction > 0){  

	                    $output = array("status" => 1, "message" => "Password Update Success");
	                } 
	              
	        } 

	        } 
	        else{
	              $output = array("status" => 0, "message" => "Ajax request not completed");
	        }
	  
	        echo json_encode($output); exit;
	  }
}
