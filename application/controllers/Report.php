<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');  
		$this->load->model('Autoload_model'); 
		$this->load->model('Report_model');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;  
	}

	public function index()
	{

		
	}

	function userReport()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Manage User Results";
			$data = array();
        
	        //total rows count
	        $totalRec = count($this->Report_model->getUsersResults());
	        
	        //pagination configuration
	        $config['target']      = '#resultList';
	        $config['base_url']    = base_url().'report/manageUserReportAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserResult';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_result']   = $this->Report_model->getUsersResults(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->template('report/manage_user_result', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageUserReportAjax()
	{
		if($this->session->userdata('logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Report_model->getUsersResults());
	        
	        //pagination configuration
	        $config['target']      = '#resultList';
	        $config['base_url']    = base_url().'report/manageUserReportAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getUserResult';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['user_result']   = $this->Report_model->getUsersResults(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('report/manage_user_result_ajax', $data, false);
		}
	}

	function getUserAnsers()
	{
		if($this->session->userdata('logged_in')){
			$data['questions'] = $this->Report_model->getUserQuestions();
			$data['answer']    = $this->Report_model->getUserAnswers();
	        //load the view
	        $this->load->view('report/view_user_answers', $data, false);
		}
	}

	function alloweditAnsAcc()
	{
		$result = $this->Report_model->allowAnsEditAcc();
		$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully created access to edit answers',1));
		redirect('report/userReport');
	}

}
