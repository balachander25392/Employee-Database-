<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function signin_check($emp_id, $pass)
	{
 
		$this->db->select('c.ed_id,c.ed_emp_id,c.ed_emp_name,c.ed_emp_email,c.ed_emp_desig,c.ed_emp_div,c.ed_emp_team,c.ed_emp_leader,c.ed_emp_type,c.ed_emp_dob,c.ed_emp_doj');
		$this->db->from('be_emp_db as c');
		$this->db->where('c.ed_emp_id',$emp_id);
		$this->db->where('c.ed_emp_pass',md5($pass));
		$this->db->where('c.ed_emp_st','1');
		$this ->db-> limit(1);
		$query = $this->db->get();

		//echo $this->db->last_query();exit;
	 
		if($query -> num_rows() == 1) { 
			return $query->result();
		}
		else {
			return false;
		}
	}

	function changeUserPassword()
    {
    	$user_id 	   = $this->session->userdata['user_logged_in']['ed_id'];
    	$current_pass  = $this->input->post('curr_pass');
    	$new_pass  	   = $this->input->post('new_pass');

    	$this->db->select('c.ed_id');
		$this->db->from('be_emp_db as c');
		$this->db->where('c.ed_emp_pass',MD5($current_pass));
		$this->db->where('c.ed_id',$user_id);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 1) { 
			 
			 $admin_arr = array(
			 	"ed_emp_pass" 		=> MD5($new_pass),
			 );

			 $this->db->where('ed_id',$user_id);
			 $update_qurey = $this->db->update('be_emp_db',$admin_arr);

			 if ($update_qurey) {
			 	return 1;
			 } else {
			 	return 2;
			 }
		}
		else {
			 
			 return 3;
		}

    }

    function getUserTestStatus()
    {
    	$user_id = $this->session->userdata['user_logged_in']['ed_id'];

    	$this->db->select('qa_id');
        $this->db->from('be_qstn_answer');
        $this->db->where('qa_emp_id',$user_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?1:0;
    }

    function getQuestions()
    {
    	$question_to = $this->session->userdata['user_logged_in']['ed_emp_type'];

    	$this->db->select('eq_id,eq_question,eq_question_to,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_status','1');
        $this->db->where('eq_question_to',$question_to);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getOptionsforQuestion($quest_id)
    {
    	$this->db->select('eqo_id,eqo_option,eqo_option_question');
        $this->db->from('be_emp_questn_option');
        $this->db->where('eqo_option_question',$quest_id);
        $this->db->where('eqo_option_st','1');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function saveQstnAns()
    {
    	$name_ref = $this->input->post('name_ref');
    	$quest_id = $this->input->post('quest_id');
    	$ans_type = $this->input->post('ans_type');

    	for($i=0;$i<count($name_ref);$i++){

    		$ans_data = array();
    		$ans_data['qa_emp_id']  = $this->session->userdata['user_logged_in']['ed_id'];
    		$ans_data['qa_qstn_id'] = $quest_id[$i];

    		if($ans_type[$i]=='text'){
    			$ans_data['qa_text_ans'] = $this->input->post('qstn_'.$name_ref[$i]);
    		} else {
    			$option_id = $this->input->post('qstn_'.$name_ref[$i]);    			
    			if(is_array($option_id)){
    				$ans_data['qa_option_id'] = implode(',', $option_id);
    			} else {
    				$ans_data['qa_option_id'] = $option_id;
    			}
    		}
    		$ans_data['qa_add_on'] = date('Y-m-d H:i:s');

    		$this->db->insert('be_qstn_answer',$ans_data);
    	}
    }

    function getAnswers()
    {
    	$user_id   = $this->session->userdata['user_logged_in']['ed_id'];
    	$user_type = $this->session->userdata['user_logged_in']['ed_emp_type'];
    	
    	$query   = "SELECT A.eq_id,A.eq_question,A.eq_question_to,A.eq_answer_type,A.eq_status,C.qa_option_id,C.qa_text_ans,C.qa_add_on FROM be_emp_questions A LEFT JOIN be_qstn_answer C  ON A.eq_id = C.qa_qstn_id AND C.qa_emp_id='$user_id' WHERE A.eq_question_to='$user_type' AND A.eq_status='1'";
    	return $this->db->query($query)->result_array();
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

    function getAnswersEdit()
    {
    	$user_id   = $this->session->userdata['user_logged_in']['ed_id'];
    	$user_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

    	$query   = "SELECT A.eq_id,A.eq_question,A.eq_question_to,A.eq_answer_type,A.eq_status,C.qa_option_id,C.qa_text_ans,C.qa_add_on FROM be_emp_questions A LEFT JOIN be_qstn_answer C  ON A.eq_id = C.qa_qstn_id AND C.qa_emp_id='$user_id' WHERE A.eq_question_to='$user_type' AND A.eq_status='1'";
    	return $this->db->query($query)->result_array();
    }

    function updateQstnAns()
    {
    	$name_ref = $this->input->post('name_ref');
    	$quest_id = $this->input->post('quest_id');
    	$ans_type = $this->input->post('ans_type');
    	$user_id  = $this->session->userdata['user_logged_in']['ed_id'];

    	for($i=0;$i<count($name_ref);$i++){

    		$ans_data = array();
    		$ans_data['qa_emp_id']  = $this->session->userdata['user_logged_in']['ed_id'];
    		$ans_data['qa_qstn_id'] = $quest_id[$i];

    		if($ans_type[$i]=='text'){
    			$ans_data['qa_text_ans'] = $this->input->post('qstn_'.$name_ref[$i]);
    		} else {
    			$option_id = $this->input->post('qstn_'.$name_ref[$i]);    			
    			if(is_array($option_id)){
    				$ans_data['qa_option_id'] = implode(',', $option_id);
    			} else {
    				$ans_data['qa_option_id'] = $option_id;
    			}
    		}

    		$this->db->select('c.qa_id');
			$this->db->from('be_qstn_answer as c');
			$this->db->where('c.qa_emp_id',$user_id);
			$this->db->where('c.qa_qstn_id',$quest_id[$i]);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query -> num_rows() == 1) { 

				$ans_data['qa_updt_on'] = date('Y-m-d H:i:s');
				$this->db->where('qa_emp_id',$user_id);
				$this->db->where('qa_qstn_id',$quest_id[$i]);
				$this->db->update('be_qstn_answer',$ans_data);
			} else {

				$ans_data['qa_add_on'] = date('Y-m-d H:i:s');
				$this->db->insert('be_qstn_answer',$ans_data);
			}

    	}
    }
}