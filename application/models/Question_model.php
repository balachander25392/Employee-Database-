<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Question_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	
	function addQuestion()
	{
		$question    = addslashes($this->input->post('question'));
		$question_to = $this->input->post('questn_to');
		$answer_type = $this->input->post('ques_type');

		$quest_arr = array(

				"eq_question" 		=> $question,
				"eq_question_to" 	=> $question_to,
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
		$this->db->select('eq_id,eq_question,eq_question_to,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_status','1');
        $this->db->order_by('eq_add_on','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
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
    	$this->db->select('eq_id,eq_question,eq_question_to,eq_answer_type');
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
    	$questn_id   = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('quest_id'));
    	$question    = addslashes($this->input->post('question'));
		$question_to = $this->input->post('questn_to');
		$answer_type = $this->input->post('ques_type');

		$quest_arr = array(

				"eq_question" 		=> $question,
				"eq_question_to" 	=> $question_to,
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
}