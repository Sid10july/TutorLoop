<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_meeting_model extends CI_Model
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
            $this->db->select("MM.*,UM.firstname,UM.lastname,SM.subject_name,MSM.student_fid");
            $this->db->from("meeting_master as MM");
            $this->db->join('meeting_student_master as MSM', 'MSM.meeting_fid = MM.meeting_id');
            $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
            $this->db->where(['MM.is_deleted' => 0,'MSM.student_fid' => $_SESSION['user_id']]);

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

   

      public function getStudentMeetingExportData($subject_fid,$teacher_fid,$meeting_date)
      { 

            $this->db->select("MM.*,UM.firstname,UM.lastname,SM.subject_name,MSM.student_fid");
            $this->db->from("meeting_master as MM");
            $this->db->join('meeting_student_master as MSM', 'MSM.meeting_fid = MM.meeting_id');
            $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
            $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
            $this->db->where(['MM.is_deleted' => 0,'MSM.student_fid' => $_SESSION['user_id']]);

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

            $this->db->order_by('MM.meeting_date','asc');
            return $this->db->get()->result();  
      }

      

}
