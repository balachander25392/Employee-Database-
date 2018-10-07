<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Question_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	
	function addQuestion()
	{
		$question     = addslashes($this->input->post('question'));
		$questn_templ = $this->input->post('questn_templ');
		$answer_type  = $this->input->post('ques_type');

		$quest_arr = array(

				"eq_question" 		=> $question,
				"eq_templ_id" 		=> $questn_templ,
				"eq_answer_type" 	=> $answer_type,
				"eq_added_by" 		=> $this->session->userdata['logged_in']['ea_id'],
				"eq_add_on" 		=> date('Y-m-d H:i:s'),
				"eq_status" 		=> "1"
			);

		$quest_qurey = $this->db->insert('be_emp_questions',$quest_arr);

	 	if ($quest_qurey && $answer_type!='text') {
	 		
	 		$quest_id = $this->db->insert_id();
	 		$options  = $this->input->post('option');

	 		for ($i=0;$i<count($options);$i++) {
	 			
	 			$option_arr = array(

	 					"eqo_option" => $options[$i],
	 					"eqo_option_question" => $quest_id,
	 					"eqo_option_st" => "1"

	 				);
	 			$optin_query = $this->db->insert('be_emp_questn_option',$option_arr);
	 		}

	 		return 1;

		} else if($quest_qurey) {
		 	return 1;
	 	} else {
	 		return 2;
	 	}
	}

	function getQuestions($params = array())
	{
		$search_key = addslashes($this->input->post('search_key'));
 		$templ_id   = $this->input->post('templ_id');

        $sql   = "SELECT A.eq_id,A.eq_question,A.eq_templ_id,A.eq_answer_type,B.qt_id,B.qt_name,B.qt_templ_to FROM be_emp_questions A, be_emp_qstn_templ B";

        $where = " WHERE A.eq_templ_id=B.qt_id AND A.eq_status='1' AND B.qt_status='1'";

        if($templ_id){

        	$where .= " AND A.eq_templ_id='$templ_id'";
        }

        if($search_key){

        	$where .= " AND A.eq_question LIKE '%$search_key%' ";
        }

        $order_by = " ORDER BY A.eq_add_on";

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

	function questionDelete()
	{
		$quest_id    = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('questionDeelteID'));

    	$quest_array = array('eq_status' => '0');
    	$this->db->where('eq_id',$quest_id);
    	$update_qurey = $this->db->update('be_emp_questions',$quest_array);

    	$opti_array = array('eqo_option_st' => '0');
    	$this->db->where('eqo_option_question',$quest_id);
    	$update_qurey = $this->db->update('be_emp_questn_option',$opti_array);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}
	}

	function getQuestionDetail($id)
    {
    	$this->db->select('eq_id,eq_question,eq_templ_id,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_id',$id);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():FALSE;
    }

    function getOptionsDetail($id)
    {
    	$this->db->select('eqo_id,eqo_option,eqo_option_question');
        $this->db->from('be_emp_questn_option');
        $this->db->where('eqo_option_question',$id);
        $this->db->where('eqo_option_st','1');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function questionUpdate()
    {
    	$questn_id    = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('quest_id'));
    	$question     = addslashes($this->input->post('question'));
		$questn_templ = $this->input->post('questn_templ');
		$answer_type  = $this->input->post('ques_type');

		$quest_arr = array(

				"eq_question" 		=> $question,
				"eq_templ_id" 		=> $questn_templ,
				"eq_answer_type" 	=> $answer_type,
				"eq_update_by" 		=> $this->session->userdata['logged_in']['ea_id'],
				"eq_update_on" 		=> date('Y-m-d H:i:s')
			);
		$this->db->where('eq_id',$questn_id);
		$quest_qurey = $this->db->update('be_emp_questions',$quest_arr);


		$opt_up_arr  = array('eqo_option_st'=>'0');
		$this->db->where('eqo_option_question',$questn_id);
		$opti_up_qurey = $this->db->update('be_emp_questn_option',$opt_up_arr);

		if ($quest_qurey && $answer_type!='text') {
	 		
	 		$quest_id  = $questn_id;
	 		$options   = $this->input->post('option');
	 		$option_id = $this->input->post('option_id');

	 		for ($i=0;$i<count($options);$i++) {
	 			
	 			$option_arr = array(

	 					"eqo_option" => $options[$i],
	 					"eqo_option_question" => $quest_id,
	 					"eqo_option_st" => "1"

	 				);
	 			if($option_id[$i]!=''){
	 				$this->db->where('eqo_id',$option_id[$i]);
	 				$optin_query = $this->db->update('be_emp_questn_option',$option_arr);
	 			} else {
	 				$optin_query = $this->db->insert('be_emp_questn_option',$option_arr);
	 			}
	 			
	 		}

	 		return 1;

		} else if($quest_qurey) {
		 	return 1;
	 	} else {
	 		return 2;
	 	}
    }

    function getTemplates($params = array())
	{
        $search_key = addslashes($this->input->post('search_key'));
 		$user_type  = $this->input->post('user_type');

        $sql   = "SELECT qt_id,qt_name,qt_desc,qt_templ_to,qt_add_on FROM be_emp_qstn_templ";

        $where = " WHERE qt_status='1'";

        if($user_type){

        	$where .= " AND qt_templ_to='$user_type'";
        }

        if($search_key){

        	$where .= " AND (qt_name LIKE '%$search_key%' || qt_desc LIKE '%$search_key%') ";
        }

        $order_by = " ORDER BY qt_add_on";

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

	function templateAdd()
	{
		$templ_name = $this->input->post('templ_name');
		$templ_to   = $this->input->post('templ_to');
		$templ_desc = $this->input->post('templ_desc');

		$templ_arr  = array(

				"qt_name" 		=> $templ_name,
				"qt_templ_to" 	=> $templ_to,
				"qt_desc" 		=> $templ_desc,
				"qt_add_on" 	=> date('Y-m-d H:i:s'),
				"qt_add_by" 	=> $this->session->userdata['logged_in']['ea_id'],
			);

		$query = $this->db->insert('be_emp_qstn_templ',$templ_arr);

		if($query){
			return 1;
		} else {
			return 0;
		}
	}

	function getTemplDetail()
	{
		$templ_id_enc = $this->input->post('templ_id');
		$templ_id     = $this->Autoload_model->encrypt_decrypt('dc',$templ_id_enc);
		$this->db->select('qt_id,qt_name,qt_desc,qt_templ_to,qt_add_on');
        $this->db->from('be_emp_qstn_templ');
        $this->db->where('qt_id',$templ_id);
        $query = $this->db->get()->row_array();

        $st_sel = '';
        $tc_sel = '';

        if($query['qt_templ_to']=='student'){
        	$st_sel = 'Selected';
        } else{
        	$tc_sel = 'Selected';
        }

        $output = '<input type="hidden" name="templ_id_edit" id="templ_id_edit" value="'.$templ_id_enc.'"> 
        			<div class="box-body">
		            <div class="col-md-6">
		              <div class="form-group">
		                <label for="exampleInputEmail1">Template Name</label>
		                <input type="text" class="form-control" id="templ_name" name="templ_name" required="true" placeholder="Enter Template Name" autocomplete="off" value="'.$query['qt_name'].'">
		              </div>
		            </div>

		            <div class="col-md-6">
		              <div class="form-group">
		                <label for="exampleInputEmail1">Template to</label>
		                <select name="templ_to" id="templ_to" required="" class="form-control">
		                  <option value="">--Select--</option>
		                  <option value="student"'.$st_sel.'>Student</option>
		                  <option value="teacher"'.$tc_sel.'>Teacher</option>
		                </select>
		              </div>
		            </div>

		            <div class="col-md-12">
		              <div class="form-group">
		                <label for="exampleInputEmail1">Template Description</label>
		                <textarea name="templ_desc" id="templ_desc" required="" class="form-control" placeholder="Describe about template">'.$query['qt_desc'].'</textarea>
		              </div>
		            </div>
		          </div>';

		return $output; 
	}

	function templateEdit()
	{
		$templ_id   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('templ_id_edit'));
		$templ_name = $this->input->post('templ_name');
		$templ_to   = $this->input->post('templ_to');
		$templ_desc = $this->input->post('templ_desc');

		$templ_arr  = array(

				"qt_name" 		=> $templ_name,
				"qt_templ_to" 	=> $templ_to,
				"qt_desc" 		=> $templ_desc,
				"qt_updt_on" 	=> date('Y-m-d H:i:s'),
				"qt_updt_by" 	=> $this->session->userdata['logged_in']['ea_id'],
			);

		$this->db->where('qt_id',$templ_id);
		$query = $this->db->update('be_emp_qstn_templ',$templ_arr);

		if($query){
			return 1;
		} else {
			return 0;
		}
	}

	function templateDelete()
	{
		$templ_id    = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('templDeleteID'));

    	$templ_array = array('qt_status' => '0');
    	$this->db->where('qt_id',$templ_id);
    	$update_qurey = $this->db->update('be_emp_qstn_templ',$templ_array);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}
	}
}