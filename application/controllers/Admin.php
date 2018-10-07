<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');  
		$this->load->model('Autoload_model');  
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;
	}

	public function index()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Manage Admin";
			$data = array();
        
	        //total rows count
	        $totalRec = @count($this->Admin_model->getAdminUsers());
	        
	        //pagination configuration
	        $config['target']      = '#adminList';
	        $config['base_url']    = base_url().'admin/manageAdminAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getAdminList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['admins'] = $this->Admin_model->getAdminUsers(array('limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->template('admin/manage_admin', $data);
		} else {
			redirect('welcome/login');
		}
	}

	function manageAdminAjax()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['ea_role']=='1'){
			
			$page = $this->input->post('page');
	        if(!$page){
	            $offset = 0;
	        }else{
	            $offset = $page;
	        }
	        
	        //total rows count
	        $totalRec = @count($this->Admin_model->getAdminUsers());
	        
	        //pagination configuration
	        $config['target']      = '#adminList';
	        $config['base_url']    = base_url().'admin/manageAdminAjax';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'getAdminList';
	        $this->ajax_pagination->initialize($config);
	        
	        //get the posts data
	        $data['admins'] = $this->Admin_model->getAdminUsers(array('start'=>$offset,'limit'=>$this->perPage));
	        
	        //load the view
	        $this->load->view('admin/manage_admin_ajax', $data, false);
		} 
	}

	function addAdmin()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['ea_role']=='1'){
			$data['title'] = "Add Admin";
			$this->load->template('admin/add_admin',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function saveAdmin()
	{
		$result = $this->Admin_model->saveAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Created Admin User',1));
			redirect('Admin');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to create user due to database error',3));
			redirect('Admin/addAdmin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('User already exists with same Employee ID. Check the information',4));
			redirect('Admin/addAdmin');
		}
	}

	function editAdmin()
	{
		
		if($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['ea_role']=='1'){
			$data['title']    		= "Edit Admin";
			$data['admin_id'] 		= $this->uri->segment(3);
			$admin_id 				= $this->Autoload_model->encrypt_decrypt('dc',$this->uri->segment(3));
			$data['admin_detail'] 	= $this->Admin_model->getAdminDetail($admin_id);
			$this->load->template('admin/edit_admin',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function updateAdmin()
	{
		$result = $this->Admin_model->updateAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Updated Admin User',1));
			redirect('Admin');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update user due to database error',3));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('User already exists with same Employee ID. Check the information',4));
			redirect('Admin');
		}
	}

	function resetPassword()
	{
		$result = $this->Admin_model->updateAdminUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Updated Admin Password',1));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update Admin user Password. Try again',4));
			redirect('Admin');
		}
	}

	function deleteAdmin()
	{
		$result = $this->Admin_model->deleteAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully Deleted Admin user',1));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to Delete Adminuser. Try again',4));
			redirect('Admin');
		}
	}

	function changePassword()
	{
		if($this->session->userdata('logged_in')){
			$data['title'] = "Change Password";
			$this->load->template('admin/change_password',$data);
		} else {
			redirect('welcome/login');
		}
	}

	function updatePassword()
	{
		$result = $this->Admin_model->changeAdminUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Successfully updated your Password',1));
			redirect('Admin/changePassword');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Unable to update due to technical error',3));
			redirect('Admin/changePassword');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg('Invalid current Password. Try Again!',4));
			redirect('Admin/changePassword');
		}
	}


}
