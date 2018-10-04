<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report_model extends CI_Model {
 
 	function getUsersResults($params = array())
 	{
 		$search_key = addslashes($this->input->post('search_key'));

        $sql   = "SELECT A.ed_id,A.ed_emp_id,A.ed_emp_name,A.ed_emp_email,A.ed_emp_desig,A.ed_emp_div,A.ed_emp_team,A.ed_emp_leader,A.ed_emp_type,B.qa_id,B.qa_emp_id,B.qa_add_on FROM be_emp_db A,be_qstn_answer B  ";

        $where = " WHERE B.qa_emp_id=A.ed_id";

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

}