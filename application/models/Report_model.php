<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report_model extends CI_Model {
 
 	function getUsersResults($params = array())
 	{
 		$search_key = addslashes($this->input->post('search_key'));
 		$emp_type   = $this->input->post('emp_type');

        $sql   = "SELECT A.ed_id,A.ed_emp_id,A.ed_emp_name,A.ed_emp_email,A.ed_emp_desig,A.ed_emp_div,A.ed_emp_team,A.ed_emp_leader,A.ed_emp_type,B.qa_id,B.qa_emp_id,B.qa_add_on FROM be_emp_db A,be_qstn_answer B  ";

        $where = " WHERE B.qa_emp_id=A.ed_id";

        if($emp_type){

        	$where .= " AND A.ed_emp_type='$emp_type'";
        }

        if($search_key){

        	$where .= " AND (A.ed_emp_id LIKE '%$search_key%' OR A.ed_emp_name LIKE '%$search_key%' OR A.ed_emp_email LIKE '%$search_key%' OR A.ed_emp_desig LIKE '%$search_key%' OR A.ed_emp_div LIKE '%$search_key%' OR A.ed_emp_team LIKE '%$search_key%' OR A.ed_emp_leader LIKE '%$search_key%' )";
        }

        $group_by = " GROUP BY B.qa_emp_id";

        $order_by = " ORDER BY B.qa_add_on";

        $sql .= $where.$group_by.$order_by;

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['start'].",".$params['limit'];
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['limit'];
        }
        //echo $sql;exit;
        $query = $this->db->query($sql);        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
 	}

 	function getUserQuestions()
    {
    	$user_id   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('emp_id'));
    	$user_type = $this->input->post('emp_type');
    	
        $query   = "SELECT A.eq_id,A.eq_question,A.eq_question_to,A.eq_answer_type,A.eq_status FROM be_emp_questions A WHERE A.eq_question_to='$user_type' AND A.eq_status='1'";
    	return $this->db->query($query)->result_array();
    }

    function getUserAnswers()
    {
    	$user_id   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('emp_id'));
    	$user_type = $this->input->post('emp_type');

        $query   = "SELECT qa_id,qa_emp_id,qa_emp_ans,qa_add_on FROM be_qstn_answer WHERE qa_emp_id='$user_id'";
        return $this->db->query($query)->row_array();
    }

    function getOptionsforAnswer($quest_id)
    {
    	$this->db->select('eqo_id,eqo_option,eqo_option_question,eqo_option_st');
        $this->db->from('be_emp_questn_option');
        $this->db->where('eqo_option_question',$quest_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function allowAnsEditAcc()
    {
    	$emp_id = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('ans_acc_emp_id'));
    	$emp_arr = array("qa_edit_access" => "1");

    	$this->db->where('qa_emp_id',$emp_id);
    	$this->db->update('be_qstn_answer',$emp_arr);
    }

}