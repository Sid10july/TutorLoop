<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_master_model extends CI_Model
{
      var $column_order = [null, 'subject_name', null]; //set column field database for datatable orderable
      var $column_search = ['subject_master']; //set column field database for datatable searchable
      var $order = ['subject_id' => 'desc']; // default order

      public function __construct()
      {
            parent::__construct();
      }

      private function _get_query()
      {
            $this->db->from($this->table);
            $this->db->where(['is_deleted' => 0]);

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

      public function getColorData($color_id)
      {
            $this->db->select('CM.*,
                  CONCAT(CB.firstname," ",CB.lastname) as created_by_name,
                  CONCAT(UB.firstname," ",UB.lastname) as updated_by_name,
                  CONCAT(SB.firstname," ",SB.lastname) as status_updated_by_name'
            );
            $this->db->from("$this->table as CM");
            $this->db->join('user_master as CB', 'CB.user_id = CM.created_by','left');
            $this->db->join('user_master as UB', 'UB.user_id = CM.updated_by','left');
            $this->db->join('user_master as SB', 'SB.user_id = CM.status_updated_by','left');
            $this->db->where(array('CM.color_id' => $color_id,'CM.is_deleted' => 0, ));
            return $this->db->get()->row();  
      }
}
