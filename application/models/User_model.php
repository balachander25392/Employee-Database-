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

    function getUserTestStatus($templ_id)
    {
    	$user_id = $this->session->userdata['user_logged_in']['ed_id'];

    	$this->db->select('qa_id');
        $this->db->from('be_qstn_answer');
        $this->db->where('qa_emp_id',$user_id);
        $this->db->where('qa_templ_id',$templ_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?1:0;
    }

    function getQuestions($templ_id)
    {
    	$question_to = $this->session->userdata['user_logged_in']['ed_emp_type'];

    	$this->db->select('eq_id,eq_question,eq_templ_id,eq_answer_type');
        $this->db->from('be_emp_questions');
        $this->db->where('eq_status','1');
        $this->db->where('eq_templ_id',$templ_id);
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

        $ans_arr = array();

    	for($i=0;$i<count($name_ref);$i++){
    		
    		if($ans_type[$i]=='text'){
                 $ans_arr[$quest_id[$i]] = $this->input->post('qstn_'.$name_ref[$i]);
    		} else {
    			$option_id = $this->input->post('qstn_'.$name_ref[$i]);    			
    			if(is_array($option_id)){
                    $ans_arr[$quest_id[$i]] = implode(',', $option_id);
    			} else {
                    $ans_arr[$quest_id[$i]] = $option_id;
    			}
    		}
    	}

        $ans_data = array();
        $ans_data['qa_emp_id']    = $this->session->userdata['user_logged_in']['ed_id'];
        $ans_data['qa_templ_id']  = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('templ_id'));
        $ans_data['qa_emp_ans']   = json_encode($ans_arr);
        $ans_data['qa_add_on']    = date('Y-m-d H:i:s');
        $this->db->insert('be_qstn_answer',$ans_data);
        
    }

    function getAnswers($templ_id)
    {
    	
        $query   = "SELECT A.eq_id,A.eq_question,A.eq_templ_id,A.eq_answer_type,A.eq_status FROM be_emp_questions A WHERE A.eq_templ_id='$templ_id' AND A.eq_status='1'";
    	return $this->db->query($query)->result_array();
    }

    function getUserAnswers($templ_id)
    {
        $user_id = $this->session->userdata['user_logged_in']['ed_id'];
        $query   = "SELECT qa_id,qa_emp_id,qa_templ_id,qa_emp_ans,qa_edit_access,qa_add_on FROM be_qstn_answer WHERE qa_emp_id='$user_id' AND qa_templ_id='$templ_id'";
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

    /*function getAnswersEdit()
    {
    	$user_id   = $this->session->userdata['user_logged_in']['ed_id'];
    	$user_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

    	$query   = "SELECT A.eq_id,A.eq_question,A.eq_question_to,A.eq_answer_type,A.eq_status,C.qa_option_id,C.qa_text_ans,C.qa_add_on FROM be_emp_questions A LEFT JOIN be_qstn_answer C  ON A.eq_id = C.qa_qstn_id AND C.qa_emp_id='$user_id' WHERE A.eq_question_to='$user_type' AND A.eq_status='1'";
    	return $this->db->query($query)->result_array();
    }*/

    function updateQstnAns()
    {
    	$name_ref = $this->input->post('name_ref');
    	$quest_id = $this->input->post('quest_id');
    	$ans_type = $this->input->post('ans_type');
    	$user_id  = $this->session->userdata['user_logged_in']['ed_id'];
        $templ_id = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('templ_id'));
    	$ans_arr = array();

        for($i=0;$i<count($name_ref);$i++){
            
            if($ans_type[$i]=='text'){
                 $ans_arr[$quest_id[$i]] = $this->input->post('qstn_'.$name_ref[$i]);
            } else {
                $option_id = $this->input->post('qstn_'.$name_ref[$i]);             
                if(is_array($option_id)){
                    $ans_arr[$quest_id[$i]] = implode(',', $option_id);
                } else {
                    $ans_arr[$quest_id[$i]] = $option_id;
                }
            }
        }

        $ans_data = array();
        $ans_data['qa_emp_id']      = $this->session->userdata['user_logged_in']['ed_id'];
        $ans_data['qa_emp_ans']     = json_encode($ans_arr);
        $ans_data['qa_edit_access'] = "0";
        $ans_data['qa_updt_on']     = date('Y-m-d H:i:s');

        $this->db->where('qa_emp_id',$user_id);
        $this->db->where('qa_templ_id',$templ_id);
        $this->db->update('be_qstn_answer',$ans_data);

    }

    function getUserTemplates($params = array())
    {
        $user_type = $this->session->userdata['user_logged_in']['ed_emp_type'];

        $this->db->select('qt_id,qt_name,qt_desc,qt_templ_to,qt_add_on');
        $this->db->from('be_emp_qstn_templ');
        $this->db->where('qt_status','1');
        $this->db->where('qt_templ_to',$user_type);
        $this->db->order_by('qt_add_on','desc');
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        $query = $this->db->get();
        //echo $this->db->last_query();exit;        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }
    
}