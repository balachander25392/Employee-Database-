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
	        //get language
	        $language = MY_Loader::$add_data;
			$data     = array_merge($data,$language);
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
		$language 	= MY_Loader::$add_data['language'];
		$result 	= $this->Employee_model->saveEmployeeUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['1'],1));
			redirect('Employee');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['2'],3));
			redirect('Employee/addEmployee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['3'],4));
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
		$language 	= MY_Loader::$add_data['language'];
		$result 	= $this->Employee_model->updateEmpUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['4'],1));
			redirect('Employee');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['5'],3));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['6'],4));
			redirect('Employee');
		}
	}

	function resetPassword()
	{
		$language 	= MY_Loader::$add_data['language'];
		$result 	= $this->Employee_model->updateEmpUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['7'],1));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['8'],4));
			redirect('Employee');
		}
	}

	function deleteEmployee()
	{
		$language 	= MY_Loader::$add_data['language'];
		$result	 	= $this->Employee_model->deleteEmpUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['9'],1));
			redirect('Employee');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['10'],4));
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
		$language 	   = MY_Loader::$add_data['language'];
		$result 	   = $this->Employee_model->saveBulkEmployee();
		$action_type   = $this->input->post('eadd_act_type');

		if($action_type=='insert'){
			$succ_msg  = $language['empl_flash']['regi_ed'].' ';
			$fail_msg  = $language['empl_flash']['regi'].' ';
		} else if($action_type=='update') {
			$succ_msg  = $language['empl_flash']['upda_ed'].' ';
			$fail_msg  = $language['empl_flash']['upda'].' ';
		} else if($action_type=='both') {
			$succ_msg  = $language['empl_flash']['rege_updd'].' ';
			$fail_msg  = $language['empl_flash']['rege_upda'].' ';
		} else {
			$succ_msg  = $language['empl_flash']['rege_updd'].' ';
			$fail_msg  = $language['empl_flash']['rege_upda'].' ';
		}

		if(count($result['success_list'])>0){
			$this->session->set_flashdata('eu_succ_flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['succ'].' '.$succ_msg.count($result['success_list']).' '.$language['empl_flash']['empl'],1));
		}

		if(count($result['failed_list'])>0) {
			$this->session->set_flashdata('eu_fail_flash_msg', $this->Autoload_model->genAlertMsg($language['empl_flash']['fail_to'].' '.$fail_msg.count($result['failed_list']).' '.$language['empl_flash']['empl'].' '.$language['empl_flash']['find_list'].'<br>'.implode('<br>', $result['failed_list']),4));
		}

		redirect('Employee');
	}
}
