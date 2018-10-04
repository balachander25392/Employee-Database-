<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');  
		$this->load->model('Autoload_model');  
		$this->load->library('excel');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Manage Employee";
			$data = array();
        
	        //total rows count
	        $totalRec = count($this->Employee_model->getEmployeeUsers());
	        
	        //pagination configuration
	        $config['target']      = '#empList';
	        $config['base_url']    = base_url().'employee/manageEmployeeAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getEmployeeData';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['emps'] = $this->Employee_model->getEmployeeUsers(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->template('emp/manage_employee', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageEmployeeAjax()
	{
		if($this->session->userdata('logged_in')){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Employee_model->getEmployeeUsers());
	        
	        //pagination configuration
	        $config['target']      = '#empList';
	        $config['base_url']    = base_url().'employee/manageEmployeeAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getEmployeeData';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['emps'] = $this->Employee_model->getEmployeeUsers(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('emp/manage_employee_ajax', $data, false);
		} 
	}

	function addEmployee()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Add Employee";
			$this->load->template('emp/add_employee',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function saveEmployee()
	{
		$result = $this->Employee_model->saveEmployeeUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Created Employee',1));
			redirect('Employee');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to create employee due to database error',3));
			redirect('Employee/addEmployee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('User already exists with same Employee ID. Check the information entered',4));
			redirect('Employee/addEmployee');
		}
	}

	function editEmployee()
	{
		
		if($this->session->userdata('logged_in')){
			$data['title']    		= "Edit Employee";
			$data['emp_id'] 		= $this->uri->segment(3);
			$emp_id 				= $this->Autoload_model->encrypt_decrypt('dc',$this->uri->segment(3));
			$data['emp_detail'] 	= $this->Employee_model->getEmpDetail($emp_id);
			$this->load->template('emp/edit_employee',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function updateEmployee()
	{
		$result = $this->Employee_model->updateEmpUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Updated Employee',1));
			redirect('Employee');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update Employee due to database error',3));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Employee already exists with same Employee ID. Check the information',4));
			redirect('Employee');
		}
	}

	function resetPassword()
	{
		$result = $this->Employee_model->updateEmpUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Updated Employee Password',1));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update Employee Password. Try again',4));
			redirect('Employee');
		}
	}

	function deleteEmployee()
	{
		$result = $this->Employee_model->deleteEmpUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Deleted Employee',1));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to Delete Employee. Try again',4));
			redirect('Employee');
		}
	}

	function addEmpBulk()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Add Employee in Bulk";
			$this->load->template('emp/add_employee_bulk',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function saveEmployeeBulk()
	{
		$result = $this->Employee_model->saveBulkEmployee();
		$action_type = $this->input->post('eadd_act_type');

		if($action_type=='insert'){
			$succ_msg  = 'Registered ';
			$fail_msg  = 'Register ';
		} else if($action_type=='update') {
			$succ_msg  = 'Updated ';
			$fail_msg  = 'Update ';
		} else if($action_type=='both') {
			$succ_msg  = 'Registered/Updated ';
			$fail_msg  = 'Register/Update ';
		} else {
			$succ_msg  = 'Registered/Updated ';
			$fail_msg  = 'Register/Update ';
		}

		if(count($result['success_list'])>0){
			$this->session->set_flashdata('eu_succ_flash_msg', $this->Autoload_model->genAlertMsg('Successfully '.$succ_msg.count($result['success_list']).' Employee(s)',1));
		}

		if(count($result['failed_list'])>0) {
			$this->session->set_flashdata('eu_fail_flash_msg', $this->Autoload_model->genAlertMsg('Failed to '.$fail_msg.count($result['success_list']).' Employee(s). Find the list below <br>'.implode('<br>', $result['failed_list']),4));
		}

		redirect('Employee');
	}
}
