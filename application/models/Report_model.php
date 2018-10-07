<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report_model extends CI_Model {
 
 	function getUsersResults($params = array())
 	{
 		$search_key = addslashes($this->input->post('search_key'));
 		$emp_type   = $this->input->post('emp_type');
        $templ_id   = $this->input->post('templ_id');

        $sql   = "SELECT A.qa_id,A.qa_emp_id,A.qa_templ_id,A.qa_emp_ans,A.qa_add_on,B.ed_id,B.ed_emp_id,B.ed_emp_name,B.ed_emp_email,B.ed_emp_desig,B.ed_emp_div,B.ed_emp_team,B.ed_emp_leader,B.ed_emp_type,C.qt_id,C.qt_name,C.qt_templ_to,C.qt_desc,C.qt_add_on FROM be_qstn_answer A, be_emp_db B, be_emp_qstn_templ C";

        $where = " WHERE A.qa_emp_id=B.ed_id AND A.qa_templ_id=C.qt_id";

        if($emp_type){

        	$where .= " AND B.ed_emp_type='$emp_type'";
        }

        if($templ_id){

            $where .= " AND C.qt_id='$templ_id'";
        }

        if($search_key){

        	$where .= " AND (B.ed_emp_id LIKE '%$search_key%' OR B.ed_emp_name LIKE '%$search_key%' OR B.ed_emp_email LIKE '%$search_key%' OR B.ed_emp_desig LIKE '%$search_key%' OR B.ed_emp_div LIKE '%$search_key%' OR B.ed_emp_team LIKE '%$search_key%' OR B.ed_emp_leader LIKE '%$search_key%' )";
        }

        //$group_by = " GROUP BY B.qa_emp_id";

        $order_by = " ORDER BY A.qa_add_on";

        $sql .= $where.$order_by;

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['start'].",".$params['limit'];
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['limit'];
        }
        //echo $sql;exit;
        $query = $this->db->query($sql);        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
 	}

 	function getUserAnswersReport($templ_id,$user_id)
    {
        $query   = "SELECT qa_id,qa_emp_id,qa_templ_id,qa_emp_ans,qa_edit_access,qa_add_on FROM be_qstn_answer WHERE qa_emp_id='$user_id' AND qa_templ_id='$templ_id'";
        return $this->db->query($query)->row_array();
    }

    function allowAnsEditAcc()
    {
    	$emp_id = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('ans_acc_emp_id'));
    	$emp_arr = array("qa_edit_access" => "1");

    	$this->db->where('qa_id',$emp_id);
    	$this->db->update('be_qstn_answer',$emp_arr);
    }

}