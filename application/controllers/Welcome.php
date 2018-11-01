<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Welcome_model');  
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){

			//$data['title'] = "Home";
			//$this->load->template('home',$data);
			redirect('employee');

		} else {
			redirect('welcome/login');
		}
		
	}

	function login()
	{
		if($this->session->userdata('logged_in')){
			
			redirect('welcome');

		} else {

			$data['title'] = "Login";
			//get language
	        $language = MY_Loader::$add_data;
			$data     = array_merge($data,$language);
			$this->load->view('login',$data);
		}

	}

	function signin()
	{
		$this->form_validation->set_rules('emp_id', 'Employee ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_datails');
				 
		if($this->form_validation->run() == FALSE)
	    {
		    $this->session->set_flashdata('message_required','Please fill-in required textbox.');
			redirect('welcome/login');
	    }
		else
		{
			redirect('welcome');
		}
	}

	public function check_datails($pass)
	{
	   $emp_id = $this->input->post('emp_id');
	   $result = $this->Welcome_model->signin_check($emp_id, $pass);
	   
	   $language 	= MY_Loader::$add_data['language'];

	   if($result)
	   {
		    foreach($result as $row)
		    {
				$sess_array = array('ea_id' => $row->ea_id,
								'ea_emp_id'=>$row->ea_emp_id,
								'ea_name'=>$row->ea_name,
								'ea_email'=>$row->ea_email,
								'ea_designation'=>$row->ea_designation,
								'ea_role'=>$row->ea_role);
				$this->session->set_userdata('logged_in', $sess_array);
		    }
		 	
		    return true;
	   }
	   else
	   {
			$this->session->set_flashdata('message_failed', $language['login_flash']['1']);
			redirect('welcome/login');
			return false;
	   }
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		redirect('welcome/login');
	}
}
