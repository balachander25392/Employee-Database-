<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function saveAdminUser()
	{

		$emp_id    = $this->input->post('emp_id');
		$emp_name  = $this->input->post('emp_name');
		//$emp_pass  = $this->input->post('emp_pass');
		$emp_email = $this->input->post('emp_email');
		$emp_desig = $this->input->post('emp_desig');
 
		$this->db->select('c.ea_id');
		$this->db->from('be_emp_aduser as c');
		$this->db->where('c.ea_emp_id',$emp_id);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 0) { 
			 
			 $admin_arr = array(

			 	"ea_emp_id" 		=> $emp_id,
			 	"ea_name" 			=> $emp_name,
			 	"ea_password" 		=> MD5($emp_id),
			 	"ea_email" 			=> $emp_email,
			 	"ea_designation" 	=> $emp_desig,
			 	"ea_role" 			=> '2',
			 	"ea_added_on" 		=> date('Y-m-d H:i:s'),
			 	"ea_user_st" 		=> '1'

			 );

			 $ins_qurey = $this->db->insert('be_emp_aduser',$admin_arr);

			 if ($ins_qurey) {
			 	return 1;
			 } else {
			 	return 2;
			 }
		}
		else {
			 
			 return 3;
		}
	}

	function getAdminUsers($params = array())
    {
        $search_key = addslashes($this->input->post('search_key'));

        $sql   = "SELECT ea_id,ea_emp_id,ea_name,ea_email,ea_designation,ea_added_on FROM be_emp_aduser";

        $where = " WHERE ea_role='2' AND ea_user_st='1'";

        if($search_key){

        	$where .= " AND (ea_emp_id LIKE '%$search_key%' || ea_name LIKE '%$search_key%' || ea_email LIKE '%$search_key%' || ea_designation LIKE '%$search_key%') ";
        }

        $order_by = " ORDER BY ea_added_on";

        $sql .= $where.$order_by;

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['start'].",".$params['limit'];
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['limit'];
        }
        //echo $sql;exit;
        $query = $this->db->query($sql);        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;

    }

    function getAdminDetail($id)
    {
    	$this->db->select('ea_id,ea_emp_id,ea_name,ea_email,ea_designation');
        $this->db->from('be_emp_aduser');
        $this->db->where('ea_id',$id);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():FALSE;
    }

    function updateAdminUser()
    {
    	$admin_id  = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('admin_idd'));
    	$emp_id    = $this->input->post('emp_id');
		$emp_name  = $this->input->post('emp_name');
		$emp_pass  = $this->input->post('emp_pass');
		$emp_email = $this->input->post('emp_email');
		$emp_desig = $this->input->post('emp_desig');
 
		$this->db->select('c.ea_id');
		$this->db->from('be_emp_aduser as c');
		$this->db->where('c.ea_emp_id',$emp_id);
		$this->db->where('c.ea_id!=',$admin_id);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 0) { 
			 
			 $admin_arr = array(
			 	"ea_emp_id" 		=> $emp_id,
			 	"ea_name" 			=> $emp_name,
			 	"ea_email" 			=> $emp_email,
			 	"ea_designation" 	=> $emp_desig,
			 	"ea_last_updated" 	=> date('Y-m-d H:i:s'),
			 );

			 $this->db->where('ea_id',$admin_id);
			 $update_qurey = $this->db->update('be_emp_aduser',$admin_arr);

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

    function updateAdminUserPassword()
    {
    	$admin_id  = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('adminUserPassResetID'));
    	/*$password  = $this->input->post('admin_new_pass');

    	$pass_array = array('ea_password' => MD5($password));

    	$this->db->where('ea_id',$admin_id);
    	$update_qurey = $this->db->update('be_emp_aduser',$pass_array);*/

    	$query = "Update be_emp_aduser Set ea_password = MD5(ea_emp_id) WHERE ea_id='$admin_id'";
    	$update_qurey = $this->db->query($query);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}

    }

    function deleteAdminUser()
    {
    	$admin_id  = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('adminUserDeelteID'));

    	$pass_array = array('ea_user_st' => '0');

    	$this->db->where('ea_id',$admin_id);
    	$update_qurey = $this->db->update('be_emp_aduser',$pass_array);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}
    }

    function changeAdminUserPassword()
    {
    	$admin_id = $this->session->userdata['logged_in']['ea_id'];
    	$current_pass  = $this->input->post('curr_pass');
    	$new_pass  	   = $this->input->post('new_pass');

    	$this->db->select('c.ea_id');
		$this->db->from('be_emp_aduser as c');
		$this->db->where('c.ea_password',MD5($current_pass));
		$this->db->where('c.ea_id',$admin_id);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 1) { 
			 
			 $admin_arr = array(
			 	"ea_password" 		=> MD5($new_pass),
			 );

			 $this->db->where('ea_id',$admin_id);
			 $update_qurey = $this->db->update('be_emp_aduser',$admin_arr);

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
}