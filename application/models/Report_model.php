<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report_model extends CI_Model {
 
 	function getUsersResults($params = array())
 	{
 		$search_key = addslashes($this->input->post('search_key'));
 		$emp_type   = $this->input->post('emp_type');
        $templ_id   = $this->input->post('templ_id');

        $sql   = "SELECT A.qa_id,A.qa_emp_id,A.qa_templ_id,A.qa_ans_for_user,A.qa_emp_ans,A.qa_add_on,B.ed_id,B.ed_emp_id,B.ed_emp_name,B.ed_emp_email,B.ed_emp_desig,B.ed_emp_div,B.ed_emp_team,B.ed_emp_leader,B.ed_emp_type,(SELECT BB.ed_emp_id FROM be_emp_db BB WHERE BB.ed_id=A.qa_ans_for_user) as ans_for_user_empid,(SELECT BBB.ed_emp_name FROM be_emp_db BBB WHERE BBB.ed_id=A.qa_ans_for_user) as ans_for_user_name,C.qt_id,C.qt_name,C.qt_templ_to,C.qt_desc,C.qt_add_on FROM be_qstn_answer A, be_emp_db B, be_emp_qstn_templ C";

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

        $order_by = " ORDER BY A.qa_add_on DESC";

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

 	function getUserAnswersReport($templ_id,$user_id,$ans_for_usr)
    {
        $query   = "SELECT qa_id,qa_emp_id,qa_templ_id,qa_ans_for_user,qa_emp_ans,qa_edit_access,qa_add_on FROM be_qstn_answer WHERE qa_emp_id='$user_id' AND qa_templ_id='$templ_id' AND qa_ans_for_user='$ans_for_usr'";
        return $this->db->query($query)->row_array();
    }

    function allowAnsEditAcc()
    {
    	$emp_id = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('ans_acc_emp_id'));
    	$emp_arr = array("qa_edit_access" => "1");

    	$this->db->where('qa_id',$emp_id);
    	$this->db->update('be_qstn_answer',$emp_arr);
    }

    function getQuestions()
    {
        $templ_enc_id  = $this->input->post('templ_id');

        $this->db->select('eq_id,eq_question,eq_templ_id,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_status','1');
        if($templ_enc_id){
            $this->db->where('eq_templ_id',$templ_enc_id);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getAnsForTemplate()
    {
        $where = '';
        $templ_enc_id  = $this->input->post('templ_id');

        $sql   = "SELECT qa_id,qa_emp_id,qa_templ_id,qa_emp_ans,qa_edit_access,qa_add_on FROM be_qstn_answer WHERE qa_status='1'";

        if($templ_enc_id){
            $where .= " AND qa_templ_id='$templ_enc_id'";
        }

        $query = $sql.$where;
       
        return $this->db->query($query)->result_array();
    }

    function loadFeedTemplt()
    {
        $emp_id = $this->input->post('emp_id');

        $sql    = "SELECT A.qa_id,A.qa_emp_id,A.qa_templ_id,A.qa_ans_for_user,B.qt_id,B.qt_name,B.qt_desc,C.ed_id,C.ed_emp_id,C.ed_emp_name,C.ed_emp_type FROM be_qstn_answer A,be_emp_qstn_templ B,be_emp_db C WHERE A.qa_ans_for_user=C.ed_id AND A.qa_templ_id=B.qt_id AND C.ed_emp_id='$emp_id' GROUP BY A.qa_templ_id";

        $query = $this->db->query($sql);

        if($query->num_rows()>0){

            $res          = $query->result_array();
            $json_arr     = array();
            $opti_all_arr = array();

            foreach($res as $row){

                $json['templ_id']   = $row['qt_id'];
                $json['templ_name'] = $row['qt_name'];
                array_push($json_arr, $json);
                array_push($opti_all_arr, $row['qt_id']);
            }

            $option_all = implode(',', $opti_all_arr);

            return json_encode(array("result" => 1, "templ_data"=>$json_arr, "option_all"=>$option_all ));

        } else {
            return json_encode(array("result" => 0));
        }
    }

    function getQuestionsFeedbk()
    {
        $templ_enc_id  = $this->input->post('templ_id');

        $this->db->select('eq_id,eq_question,eq_templ_id,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_status','1');
        $this->db->where_in('eq_templ_id', explode(',', $templ_enc_id));
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getAnsForTemplateFeedbk()
    {
        $where = '';
        $templ_enc_id  = $this->input->post('templ_id');
        $emp_id        = $this->input->post('emp_id');

        $sql   = "SELECT A.qa_id,A.qa_emp_id,A.qa_templ_id,A.qa_ans_for_user,A.qa_emp_ans,B.qt_id,B.qt_name,B.qt_desc,C.ed_id,C.ed_emp_id,C.ed_emp_name,C.ed_emp_type FROM be_qstn_answer A,be_emp_qstn_templ B,be_emp_db C WHERE A.qa_ans_for_user=C.ed_id AND A.qa_templ_id=B.qt_id AND C.ed_emp_id='$emp_id' AND A.qa_templ_id IN ($templ_enc_id) ";

        $query = $sql;
       
        return $this->db->query($query)->result_array();
    }

}