<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Autoload_model'); 
		$this->load->model('User_model');  
		$this->load->library('Ajax_pagination'); 
		$this->perPage = 10;
	}

	public function index()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title']     = "Home";
			//$data['test_stat'] = $this->User_model->getUserTestStatus(); 
			$this->load->user_template('home',$data);

		} else {
			redirect('user/login');
		}
		
	}

	function login()
	{
		if($this->session->userdata('user_logged_in')){
			
			redirect('user');

		} else {
			$data['title'] = "Login";
			$this->load->view('user/login',$data);
		}

	}

	function signin()
	{
		$this->form_validation->set_rules('emp_id', 'Employee ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_datails');
				 
		if($this->form_validation->run() == FALSE)
	    {
		    $this->session->set_flashdata('message_required','Please fill-in required textbox.');
			redirect('user/login');
	    }
		else
		{
			redirect('user');
		}
	}

	public function check_datails($pass)
	{
	   $emp_id = $this->input->post('emp_id');
	   $result = $this->User_model->signin_check($emp_id, $pass);
	 
	   if($result)
	   {
		    foreach($result as $row)
		    {
				$sess_array = array('ed_id' => $row->ed_id,
								'ed_emp_id'=> $row->ed_emp_id,
								'ed_emp_name'=> $row->ed_emp_name,
								'ed_emp_pass'=> $row->ed_emp_pass,
								'ed_emp_desig'=> $row->ed_emp_desig,
								'ed_emp_div'=> $row->ed_emp_div,
								'ed_emp_team'=> $row->ed_emp_team,
								'ed_emp_leader'=> $row->ed_emp_leader,
								'ed_emp_type' => $row->ed_emp_type);
				$this->session->set_userdata('user_logged_in', $sess_array);
		    }
		 	
		    return true;
	   }
	   else
	   {
			$this->session->set_flashdata('message_failed', 'Invalid username or password');
			redirect('user/login');
			return false;
	   }
	}

	function changePassword()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title'] = "Change Password";
			$this->load->user_template('change_password',$data);
		} else {
			redirect('user/login');
		}
	}

	function updatePassword()
	{
		$result = $this->User_model->changeUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully updated your Password',1));
			redirect('User/changePassword');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update due to technical error',3));
			redirect('User/changePassword');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Invalid current Password. Try Again!',4));
			redirect('User/changePassword');
		}
	}

	function showQuestions()
	{
		if($this->session->userdata('user_logged_in')){
			$templ_enc_id  		  = $this->uri->segment(3);
			$templ_id 			  = $this->Autoload_model->encrypt_decrypt('dc',$templ_enc_id);
			$data['title']        = "Questionnaire";
			$data['templ_id']     = $templ_enc_id;
			$data['questions']    = $this->User_model->getQuestions($templ_id);
			$data['restr_user']   = $this->User_model->getRetrictUser($templ_id);
			$data['user_details'] = $this->User_model->getUserDetails($data['restr_user']);
			$this->load->user_template('user_question',$data);
		} else {
			redirect('user/login');
		}
	}

	function saveAnswer()
	{
		$result = $this->User_model->saveQstnAns();
		$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully saved your answers',1));
		redirect('user/availableQuestions');
	}

	function viewAnswer()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title']     		= "View Answers";
			$templ_enc_id      		= $this->uri->segment(3);
			$ans_for_usr_enc        = $this->uri->segment(4);
			$templ_id 		   		= $this->Autoload_model->encrypt_decrypt('dc',$templ_enc_id);
			$ans_for_usr_id   		= $this->Autoload_model->encrypt_decrypt('dc',$ans_for_usr_enc);
			$data['templ_id']  		= $templ_enc_id;
			$data['ans_for_usr_id'] = $ans_for_usr_enc;
			$data['questions'] 		= $this->User_model->getAnswers($templ_id);
			$data['answer']    		= $this->User_model->getUserAnswers($templ_id,$ans_for_usr_id);
			$this->load->user_template('user_answers',$data);
		} else {
			redirect('user/login');
		}
	}

	function editAnswer()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title']       	= "View Answers";
			$templ_enc_id        	= $this->uri->segment(3);
			$ans_for_usr_enc        = $this->uri->segment(4);
			$templ_id 		     	= $this->Autoload_model->encrypt_decrypt('dc',$templ_enc_id);
			$ans_for_usr_id   		= $this->Autoload_model->encrypt_decrypt('dc',$ans_for_usr_enc);
			$data['templ_id']    	= $templ_enc_id;
			$data['ans_for_usr_id'] = $ans_for_usr_enc;
			$data['questions']   	= $this->User_model->getAnswers($templ_id);
			$data['restr_user']     = $this->User_model->getRetrictUserEdit($templ_id,$ans_for_usr_id);
			$data['user_details']   = $this->User_model->getUserDetails($data['restr_user']);
			$data['answer']      	= $this->User_model->getUserAnswers($templ_id,$ans_for_usr_id);
			$ext_date = date('Y-m-d H:i:s',strtotime($data['answer']['qa_add_on']));
			$new_time = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($ext_date)));
			
			if(date('Y-m-d H:i:s') <= $new_time || $data['answer']['qa_edit_access']){
				$this->load->user_template('answer_edit',$data);
			} else {
				$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('You can\'t edit your answer. The time limit is over' ,4));
				redirect('user/viewAnswer/'.$templ_enc_id.'/'.$ans_for_usr_enc);
			}
			
		} else {
			redirect('user/login');
		}
	}

	function updateAnswer()
	{
		$result = $this->User_model->updateQstnAns();
		$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully saved your answers',1));
		redirect('user/userAnswerManage');
	}

	function availableQuestions()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title'] = "Manage Available Questions";
			$data = array();
	    
	        //total rows count
	        $totalRec = @count($this->User_model->getUserTemplates());
	        
	        //pagination configuration
	        $config['target']      = '#userTempList';
	        $config['base_url']    = base_url().'user/availableQuestionsAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserTempltList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_templ']    = $this->User_model->getUserTemplates(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->user_template('manage_user_template', $data);
		} else {
			redirect('user/login');
		}
	}

	function availableQuestionsAjax()
	{
		if($this->session->userdata('user_logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->User_model->getUserTemplates());
	        
	        //pagination configuration
	        $config['target']      = '#userTempList';
	        $config['base_url']    = base_url().'user/availableQuestionsAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserTempltList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_templ']    = $this->User_model->getUserTemplates(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('user/manage_user_template_ajax', $data, false);
		}
	}

	function startQuestionnaire()
	{
		$templ_enc_id  = $this->uri->segment(3);
		$templ_id = $this->Autoload_model->encrypt_decrypt('dc',$templ_enc_id);

		$quest_status = $this->User_model->getUserTestStatus($templ_id);

		if($quest_status==1){
			redirect('user/viewAnswer/'.$templ_enc_id);
		} else {
			redirect('user/showQuestions/'.$templ_enc_id);
		} 
	}


	function userAnswerManage()
	{
		if($this->session->userdata('user_logged_in')){
			$data['title'] = "Manage Available Questions";
			$data = array();
	    
	        //total rows count
	        $totalRec = @count($this->User_model->getUserAnswerManage());
	        
	        //pagination configuration
	        $config['target']      = '#userAnsList';
	        $config['base_url']    = base_url().'user/availableQuestionsAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserAnswerList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_templ']    = $this->User_model->getUserAnswerManage(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->user_template('manage_user_answers', $data);
		} else {
			redirect('user/login');
		}
	}

	function userAnswerManageAjax()
	{
		if($this->session->userdata('user_logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->User_model->getUserAnswerManage());
	        
	        //pagination configuration
	        $config['target']      = '#userAnsList';
	        $config['base_url']    = base_url().'user/availableQuestionsAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserAnswerList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_templ']    = $this->User_model->getUserAnswerManage(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('user/manage_user_answers_ajax', $data, false);
		}
	}

	function logout()
	{
		$this->session->unset_userdata('user_logged_in');
		redirect('user/login');
	}
}
