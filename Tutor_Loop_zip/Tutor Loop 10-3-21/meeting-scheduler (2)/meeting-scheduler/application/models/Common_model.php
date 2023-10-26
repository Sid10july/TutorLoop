<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    //SELECT SINGLE ROW DATA BY CONDITION WITH DYNAMIC TABLE NAME
    function getSingleData($tablename, $condition)
    {
        $this->db->where($condition);
        return $this->db->get($tablename)->row();
    }
    //SELECT All ROW DATA BY CONDITION WITH DYNAMIC TABLE NAME
    function getAllData($tablename, $condition = '', $order = '', $limit = '', $select = '')
    {   
        if ($select != '') {
            $this->db->select($select);
        }
        if ($condition != '') {
            $this->db->where($condition);
        }
        if ($order != '') {
            $this->db->order_by($order);
        }
        if ($limit != '') {
            $this->db->limit($limit);
        }

        return $this->db->get($tablename)->result();
    }
    // INSERT ALL DATA WITH DYNAMIC TABLE NAME
    function insert($tablename, $data)
    {
        if($this->db->insert($tablename, $data))
        {
            $insert_id = $this->db->insert_id();

            return  $insert_id;
        }
    }
    // UPDATE QUERY STATEMENT WITH DYNAMIC TABLE NAME
    function update($tableName, $data, $condition)
    {
        $this->db->where($condition);
        if($this->db->update($tableName, $data))
        {
            return TRUE;
        }
    }
     function delete($tableName, $condition)
    {
        $this->db->where($condition);
        if($this->db->delete($tableName))
        {
            return TRUE;
        }
    }
     // INSERT bulk DATA WITH DYNAMIC TABLE NAME
    function insert_bulk($tablename, $data)
    {
        if($this->db->insert_batch($tablename, $data))
        {
            return TRUE;
        }
    }

    /*get login data*/
    function getLoginData($condition = '')
    {
        $this->db->select('UM.*,RM.role_name');
        $this->db->from('user_master as UM');
        $this->db->join('role_master as RM', 'RM.role_id = UM.role_fid','left');
        $this->db->where($condition);
        return $this->db->get()->result();
    }


    
    function getTeacherSubjectData()
    {
        $condition = array('TSM.is_deleted' => 0 , 'TSM.user_fid' => $_SESSION['user_id']);
        $this->db->select('TSM.teacher_subject_id,TSM.status,SM.subject_name');
        $this->db->from('teacher_subject_master as TSM');
        $this->db->join('subject_master as SM', 'SM.subject_id = TSM.subject_fid');
        $this->db->where($condition);
        $this->db->order_by('TSM.teacher_subject_id','desc');
        return $this->db->get()->result();
    }

    
    function getSubjectTeacherList($subject_fid)
    {
        $condition = array('TSM.status' => 1 ,'TSM.is_deleted' => 0 , 'TSM.subject_fid' => $subject_fid);
        $this->db->select('TSM.teacher_subject_id,TSM.user_fid,UM.firstname,UM.lastname');
        $this->db->from('teacher_subject_master as TSM');
        $this->db->join('user_master as UM', 'UM.user_id = TSM.user_fid');
        $this->db->where($condition);
        $this->db->order_by('UM.firstname','asc');
        return $this->db->get()->result();
    }

    function getStudentSubjectTutorList($student_fid)
    {
        $condition = array('STSM.is_deleted' => 0 , 'STSM.student_fid' => $student_fid);
        $this->db->select('STSM.student_teacher_subject_id,STSM.status,SM.subject_name,UM.firstname as teacherfirstname,UM.lastname as teacherlastname');
        $this->db->from('student_teacher_subject_master as STSM');
        $this->db->join('user_master as UM', 'UM.user_id = STSM.teacher_fid');
        $this->db->join('subject_master as SM', 'SM.subject_id = STSM.subject_fid');
        $this->db->where($condition);
        $this->db->order_by('STSM.student_teacher_subject_id','desc');
        return $this->db->get()->result();
    }

    function getStudentListByTeacher($teacher_fid,$subject_fid)
    {
        $condition = array('STSM.is_deleted' => 0 , 'STSM.status' => 1 , 'STSM.teacher_fid' => $teacher_fid, 'STSM.subject_fid' => $subject_fid ,'UM.status' => 1,'UM.is_deleted' => 0);
        $this->db->select('STSM.student_teacher_subject_id,STSM.student_fid,UM.firstname as studentfirstname,UM.lastname as studentlastname');
        $this->db->from('student_teacher_subject_master as STSM');
        $this->db->join('user_master as UM', 'UM.user_id = STSM.student_fid');
        $this->db->where($condition);
        $this->db->order_by('UM.firstname','asc');
        return $this->db->get()->result();
    }
    
     function getStudentSubjectTeacherList($subject_fid,$student_fid)
    {
        $condition = array('STSM.status' => 1 ,'STSM.is_deleted' => 0 , 'STSM.subject_fid' => $subject_fid,'STSM.student_fid' => $student_fid);
        $this->db->select('STSM.teacher_fid,UM.firstname,UM.lastname');
        $this->db->from('student_teacher_subject_master as STSM');
         $this->db->join('user_master as UM', 'UM.user_id = STSM.teacher_fid');
        $this->db->where($condition);
        $this->db->order_by('UM.firstname','asc');
        return $this->db->get()->result();
    }

    public function getTutorMeetings($current_date="") {
            
        $this->db->select("MM.*,UM.firstname,UM.lastname,SM.subject_name");
        $this->db->from("meeting_master as MM");
        $this->db->join('user_master as UM', 'UM.user_id = MM.teacher_fid');
        $this->db->join('subject_master as SM', 'SM.subject_id = MM.subject_fid');
        $this->db->where(['MM.is_deleted' => 0,'MM.teacher_fid' => $_SESSION['user_id']]);
        if($current_date!=''){
            $this->db->where(['MM.meeting_date' => $current_date]);
        }
        return $this->db->get()->result();
    }
    

    /*get role data*/
    function getRoleData()
    {
        $this->db->select('role_id,role_name');
        $this->db->from('role_master');
        $this->db->where(array('status' => 1,'is_deleted' => 0));
         $this->db->order_by('role_id','asc');
        return $this->db->get()->result();
    }
    

     
}
