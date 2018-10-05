<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Autoload_model');
		$this->load->library('Ajax_pagination');
		$this->load->model('Question_model');  
		$this->perPage = 10;
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){
		
		$data = array();
    	$data['title']    = "Manage Questions";
		$data['template'] = $this->Autoload_model->getTemplateList();
        //total rows count
        $totalRec = @count($this->Question_model->getQuestions());
        
        //pagination configuration
        $config['target']      = '#questList';
        $config['base_url']    = base_url().'question/manageQuestionAjax';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'getQuestionList';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['questions'] = $this->Question_model->getQuestions(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->template('question/manage_question', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageQuestionAjax()
	{
		if($this->session->userdata('logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Question_model->getQuestions());
	        
	        //pagination configuration
	        $config['target']      = '#questList';
	        $config['base_url']    = base_url().'question/manageQuestionAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getQuestionList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['questions'] = $this->Question_model->getQuestions(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('question/manage_question_ajax', $data, false);
		} 
	}

	function addQuestion()
	{
		if($this->session->userdata('logged_in')){
			$data['title']    = "Add Question";
			$data['template'] = $this->Autoload_model->getTemplateList();
			$this->load->template('question/add_question',$data);
		} else {
			redirect('welcome/login');
		}	
	}

	function saveQuestion()
	{
		$result = $this->Question_model->addQuestion();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Created Qustion',1));
			redirect('question');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to create question. Try again!',3));
			redirect('question/addQuestion');
		}
	}

	function deleteQuestion()
	{
		$result = $this->Question_model->questionDelete();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Deleted Question',1));
			redirect('question');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to Delete Question. Try again',4));
			redirect('question');
		}
	}

	function editQuestion()
	{
		if($this->session->userdata('logged_in')){
			$data['title']    		= "Edit Question";
			$data['template'] 		= $this->Autoload_model->getTemplateList();
			$data['questn_id'] 		= $this->uri->segment(3);
			$quest_id 				= $this->Autoload_model->encrypt_decrypt('dc',$this->uri->segment(3));
			$data['questn_detail'] 	= $this->Question_model->getQuestionDetail($quest_id);
			if($data['questn_detail']['eq_answer_type']!='text'){
				$data['option_detail'] 	= $this->Question_model->getOptionsDetail($data['questn_detail']['eq_id']);
			}
			$this->load->template('question/edit_question',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function updateQuestion()
	{
		$result = $this->Question_model->questionUpdate();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Updated Question',1));
			redirect('question');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update question. Try again!',3));
			redirect('question');
		}
	}

	function manageTemplate()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Manage Template";
			$data = array();
	    
	        //total rows count
	        $totalRec = @count($this->Question_model->getTemplates());
	        
	        //pagination configuration
	        $config['target']      = '#tempList';
	        $config['base_url']    = base_url().'question/manageTemplateAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['template'] = $this->Question_model->getTemplates(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->template('question/manage_template', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageTemplateAjax()
	{
		if($this->session->userdata('logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Question_model->getTemplates());
	        
	        //pagination configuration
	        $config['target']      = '#tempList';
	        $config['base_url']    = base_url().'question/manageTemplateAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['template'] = $this->Question_model->getTemplates(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('question/manage_template_ajax', $data, false);
		}
	}

	function addTemplate()
	{
		$result = $this->Question_model->templateAdd();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Added new Template',1));
			redirect('question/manageTemplate');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to add template. Try again!',3));
			redirect('question/manageTemplate');
		}
	}

	function getTemplEdit()
	{
		echo $this->Question_model->getTemplDetail();
	}

	function editTemplate()
	{
		$result = $this->Question_model->templateEdit();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully updated new Template',1));
			redirect('question/manageTemplate');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update template. Try again!',3));
			redirect('question/manageTemplate');
		}
	}

	function deleteTemplate()
	{
		$result = $this->Question_model->templateDelete();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully deleted new Template',1));
			redirect('question/manageTemplate');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to delete template. Try again!',3));
			redirect('question/manageTemplate');
		}
	}

}
