<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Welcome_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function signin_check($emp_id, $pass)
	{
 
		$this->db->select('c.ea_id,c.ea_emp_id,c.ea_name,c.ea_email,c.ea_role,c.ea_designation');
		$this->db->from('be_emp_aduser as c');
		$this->db->where('c.ea_emp_id',$emp_id);
		$this->db->where('c.ea_password',md5($pass));
		$this->db->where('c.ea_user_st','1');
		$this ->db-> limit(1);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 1) { 
			 return $query->result();
			}
		else {
			 return false;
			}
	}
}