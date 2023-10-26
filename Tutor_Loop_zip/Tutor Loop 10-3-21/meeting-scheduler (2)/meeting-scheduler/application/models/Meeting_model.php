<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting_model extends CI_Model
{
      var $column_order = [null, 'meeting_date', 'start_time','end_time','reminder_time','firstname','lastname','subject_name', null]; //set column field database for datatable orderable
      var $column_search = ['meeting_date','start_time','end_time','reminder_time','firstname','lastname','subject_name']; //set column field database for datatable searchable
      var $order = ['meeting_id' => 'desc']; // default order

      public function __construct()
      {
            parent::__construct();
      }

      private function _get_query()
      {
            $this->db->select("MM.*,UM.firstname,UM.lastname,SM.subject_name");
            $this->db->from("meeting_master as MM");
            $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
            $this->db->where(['MM.is_deleted' => 0,'MM.teacher_fid' => $_SESSION['user_id']]);
            $this->db->where('MM.meeting_date >=', date('Y-m-d'));


            if($this->input->post('subject_fid') != '')
              {
                  $this->db->where('MM.subject_fid', $this->input->post('subject_fid'));
              }
            if($this->input->post('teacher_fid') != '')
              {
                  $this->db->where('MM.teacher_fid', $this->input->post('teacher_fid'));
              }
             if($this->input->post('meeting_date') != '')
              {
                  $this->db->where('MM.meeting_date', date('Y-m-d',strtotime($this->input->post('meeting_date'))));
              }

            $i = 0;
            foreach (
                  $this->column_search
                  as $emp // loop column
            ) {
                  if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
                        $_POST['search']['value'] = $_POST['search']['value'];
                  } else {
                        $_POST['search']['value'] = '';
                  }
                  if ($_POST['search']['value']) {
                        // if datatable send POST for search
                        if ($i === 0) {
                              // first loop
                              $this->db->group_start();
                              $this->db->like($emp, $_POST['search']['value']);
                        } else {
                              $this->db->or_like($emp, $_POST['search']['value']);
                        }

                        if (count($this->column_search) - 1 == $i) {
                              //last loop
                              $this->db->group_end();
                        } //close bracket
                  }
                  $i++;
            }

            if (isset($_POST['order'])) {
                  // here order processing
                  $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order)) {
                  $order = $this->order;
                  $this->db->order_by(key($order), $order[key($order)]);
            }
      }

      function get_datatables()
      {
            $this->_get_query();
            if (isset($_POST['length']) && $_POST['length'] < 1) {
                  $_POST['length'] = '10';
            } else {
                  $_POST['length'] = $_POST['length'];
            }

            if (isset($_POST['start']) && $_POST['start'] > 1) {
                  $_POST['start'] = $_POST['start'];
            }
            $this->db->limit($_POST['length'], $_POST['start']);
            //print_r($_POST);die;
            $query = $this->db->get();
            return $query->result();
      }

      function count_filtered()
      {
            $this->_get_query();
            $query = $this->db->get();
            return $query->num_rows();
      }

      public function count_all()
      {
            $this->db->from($this->table);
            $this->db->where(['is_deleted' => 0]);
            return $this->db->count_all_results();
      }

      public function getMeetingData($meeting_id)
      {
            $this->db->select("MM.*,UM.firstname as teacherfirst_name,UM.lastname as teacherlastname,SM.subject_name,MSM.meeting_student_id,MSM.student_fid,SUM.firstname as studentfirst_name,SUM.lastname as studentlastname,SUM.student_id as studentidnumber,SUM.profile_img,CUM.firstname as createdfirst_name,CUM.lastname as createdlastname");
            $this->db->from("meeting_master as MM");
            $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
            $this->db->join('meeting_student_master as MSM', 'MSM.meeting_fid = MM.meeting_id');
            $this->db->join('user_master as SUM', 'SUM.user_id = MSM.student_fid');
            $this->db->join('user_master as CUM', 'CUM.user_id = MM.created_by');
            $this->db->where(['MM.meeting_id' => $meeting_id,'MM.is_deleted' => 0, 'MSM.is_deleted' => 0]);
            return $this->db->get()->result();  
      }

      public function checkMeetingDuplication($meeting_id,$student_fid,$subject_fid,$teacher_fid,$meeting_date,$start_time,$end_time)
      { 
            $this->db->select("*");
            $this->db->from("meeting_student_master");
            $this->db->where(
                  ['meeting_fid <>' => $meeting_id,
                  'student_fid' => $student_fid,
                  'ms_subject_fid' => $subject_fid,
                  'ms_teacher_fid' => $teacher_fid,
                  'ms_meeting_date' => $meeting_date,
                  'ms_start_time' => $start_time,
                  'ms_end_time' => $end_time, 
                  'is_deleted' => 0]);
            return $this->db->get()->result();  
      }

      public function get_duplicate_student_name($duplicateStudentArray)
      { 
            $this->db->select("user_id,firstname,lastname");
            $this->db->from("user_master");
           $this->db->where_in('user_id', $duplicateStudentArray, FALSE);
            return $this->db->get()->result();  
      }

      public function get_student_meeting($student_fid)
      { 
            $this->db->select("MSM.*,SM.subject_name,CONCAT(TUM.firstname,' ',TUM.lastname) as tutor_name");
            $this->db->from("meeting_student_master MSM");
            $this->db->join('subject_master as SM', 'SM.subject_id = MSM.ms_subject_fid');
            $this->db->join('user_master as TUM', 'TUM.user_id = MSM.ms_teacher_fid');
            $this->db->where(
                  ['MSM.student_fid' => $student_fid,
                   'MSM.is_deleted' => 0]);
            $this->db->order_by('MSM.ms_meeting_date','asc');
            return $this->db->get()->result();  
      }

      public function getMeetingExportData($subject_fid,$teacher_fid,$meeting_date)
      {
            $this->db->select("MM.*,UM.firstname,UM.lastname,SM.subject_name");
            $this->db->from("meeting_master as MM");
            $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
            $this->db->where(['MM.is_deleted' => 0]);

            if($subject_fid != '')
              {
                  $this->db->where('MM.subject_fid', $subject_fid);
              }
            if($teacher_fid != '')
              {
                  $this->db->where('MM.teacher_fid', $teacher_fid);
              }
             else{
               $this->db->where('MM.teacher_fid', $_SESSION['user_id']);
              
             } 
             if($meeting_date != '')
              {
                  $this->db->where('MM.meeting_date', date('Y-m-d',strtotime($meeting_date)));
              }

            $this->db->order_by('MM.meeting_date','asc');
            return $this->db->get()->result();  
      }

      /*get meeting students name*/
      public function getMeetingStudentData($meeting_id)
      {
            $this->db->select("GROUP_CONCAT(CONCAT(SUM.firstname,' ',SUM.lastname))  as studentfullname");
            $this->db->from("meeting_master as MM");
            $this->db->join('meeting_student_master as MSM', 'MSM.meeting_fid = MM.meeting_id');
            $this->db->join('user_master as SUM', 'SUM.user_id = MSM.student_fid');
            $this->db->where(['MM.meeting_id' => $meeting_id,'MM.is_deleted' => 0, 'MSM.is_deleted' => 0]);
            return $this->db->get()->row();  
      }

}
