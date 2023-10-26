<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_meeting_request_model extends CI_Model
{
      var $column_order = [null, 'meeting_date', 'start_time','end_time','firstname','lastname','subject_name', null]; //set column field database for datatable orderable
      var $column_search = ['meeting_date','start_time','end_time','firstname','lastname','subject_name']; //set column field database for datatable searchable
      var $order = ['student_meeting_request_id' => 'desc']; // default order

      public function __construct()
      {
            parent::__construct();
      }

      private function _get_query()
      {
            $this->db->select("SMRM.*,UM.firstname,UM.lastname,SM.subject_name,SUM.firstname as studentfirstname, SUM.lastname as studentlastname");
            $this->db->from("student_meeting_request_master as SMRM");
            $this->db->join('user_master as UM', 'UM.user_id = SMRM.teacher_fid');
            $this->db->join('user_master as SUM', 'SUM.user_id = SMRM.student_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = SMRM.subject_fid');
            $this->db->where(['SMRM.is_deleted' => 0]);
            if ($_SESSION['role_fid'] == 3) {
             $this->db->where(['SMRM.teacher_fid' => $_SESSION['user_id']]);
            }
             if ($_SESSION['role_fid'] == 4) {
             $this->db->where(['SMRM.student_fid' => $_SESSION['user_id']]);
            }


            if($this->input->post('subject_fid') != '')
              {
                  $this->db->where('SMRM.subject_fid', $this->input->post('subject_fid'));
              }
            if($this->input->post('teacher_fid') != '')
              {
                  $this->db->where('SMRM.teacher_fid', $this->input->post('teacher_fid'));
              }
            if($this->input->post('status') != '')
              {
                  $this->db->where('SMRM.status', $this->input->post('status'));
              }
             if($this->input->post('meeting_date') != '')
              {
                  $this->db->where('SMRM.meeting_date', date('Y-m-d',strtotime($this->input->post('meeting_date'))));
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

      public function get_requested_meeting_data($student_meeting_request_id)
      {
           $this->db->select("SMRM.*,UM.firstname,UM.lastname,SM.subject_name,SUM.firstname as studentfirstname, SUM.lastname as studentlastname");
            $this->db->from("student_meeting_request_master as SMRM");
            $this->db->join('user_master as UM', 'UM.user_id = SMRM.teacher_fid');
            $this->db->join('user_master as SUM', 'SUM.user_id = SMRM.student_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = SMRM.subject_fid');
            $this->db->where(['SMRM.student_meeting_request_id' => $student_meeting_request_id, 'SMRM.is_deleted' => 0]);
            return $this->db->get()->row();  
      }

      public function getRequestMeetingExportData($subject_fid,$teacher_fid,$meeting_date,$status)
      {
             $this->db->select("SMRM.*,UM.firstname,UM.lastname,SM.subject_name,SUM.firstname as studentfirstname, SUM.lastname as studentlastname");
            $this->db->from("student_meeting_request_master as SMRM");
            $this->db->join('user_master as UM', 'UM.user_id = SMRM.teacher_fid');
            $this->db->join('user_master as SUM', 'SUM.user_id = SMRM.student_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = SMRM.subject_fid');
            $this->db->where(['SMRM.is_deleted' => 0]);
            if ($_SESSION['role_fid'] == 3) {
             $this->db->where(['SMRM.teacher_fid' => $_SESSION['user_id']]);
            }
             if ($_SESSION['role_fid'] == 4) {
             $this->db->where(['SMRM.student_fid' => $_SESSION['user_id']]);
            }


            if($subject_fid != '')
              {
                  $this->db->where('SMRM.subject_fid', $subject_fid);
              }
            if($teacher_fid != '')
              {
                  $this->db->where('SMRM.teacher_fid', $teacher_fid);
              }
            if($status != '')
              {
                  $this->db->where('SMRM.status', $status);
              }
             if($meeting_date != '')
              {
                  $this->db->where('SMRM.meeting_date', date('Y-m-d',strtotime($meeting_date)));
              }

            return $this->db->get()->result(); 
      }


     

}
