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
	        $data['admins'] 	= $this->Admin_model->getAdminUsers(array('start'=>$offset,'limit'=>$this->perPage));

	        //get language
	        $language = MY_Loader::$add_data;
			$data     = array_merge($data,$language);
	        
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
		$language = MY_Loader::$add_data['language'];

		$result = $this->Admin_model->saveAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['1'],1));
			redirect('Admin');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['2'],3));
			redirect('Admin/addAdmin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['3'],4));
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
		$language = MY_Loader::$add_data['language'];
		$result   = $this->Admin_model->updateAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['4'],1));
			redirect('Admin');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['5'],3));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['6'],4));
			redirect('Admin');
		}
	}

	function resetPassword()
	{
		$language = MY_Loader::$add_data['language'];
		$result   = $this->Admin_model->updateAdminUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['7'],1));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['8'],4));
			redirect('Admin');
		}
	}

	function deleteAdmin()
	{
		$language = MY_Loader::$add_data['language'];
		$result   = $this->Admin_model->deleteAdminUser();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['9'],1));
			redirect('Admin');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['10'],4));
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
		$language = MY_Loader::$add_data['language'];
		$result   = $this->Admin_model->changeAdminUserPassword();

		if($result==1){
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['11'],1));
			redirect('Admin/changePassword');
		} else if($result==2) {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['12'],3));
			redirect('Admin/changePassword');
		} else {
			$this->session->set_flashdata('flash_msg', $this->Autoload_model->genAlertMsg($language['admin_flash']['13'],4));
			redirect('Admin/changePassword');
		}
	}


}
