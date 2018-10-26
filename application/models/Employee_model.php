<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Employee_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function saveEmployeeUser()
	{

		$emp_id     	= $this->input->post('emp_id');
		$emp_name   	= $this->input->post('emp_name');
		$emp_pass  		= $this->input->post('emp_pass');
		$emp_email  	= $this->input->post('emp_email');
		$emp_desig  	= $this->input->post('emp_desig');
		$emp_grade  	= $this->input->post('emp_grade');
		$emp_div    	= $this->input->post('emp_div');
		$emp_team   	= $this->input->post('emp_team');
		$emp_section 	= $this->input->post('emp_section');
		$emp_leader 	= $this->input->post('emp_leader');
		$emp_type		= $this->input->post('emp_type');
		$emp_dob    	= $this->input->post('emp_dob');
		$emp_doj    	= $this->input->post('emp_doj');
 
		$this->db->select('c.ed_id');
		$this->db->from('be_emp_db as c');
		$this->db->where('c.ed_emp_id',$emp_id);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 0) { 
			 
			 $admin_arr = array(

			 	"ed_emp_id" 		=> $emp_id,
			 	"ed_emp_name" 		=> $emp_name,
			 	"ed_emp_pass" 		=> MD5($emp_pass),
			 	"ed_emp_email" 		=> $emp_email,
			 	"ed_emp_desig" 		=> $emp_desig,
			 	"ed_emp_grade" 		=> $emp_grade,
			 	"ed_emp_div" 		=> $emp_div,
			 	"ed_emp_team" 		=> $emp_team,
			 	"ed_emp_section"	=> $emp_section,
			 	"ed_emp_leader" 	=> $emp_leader,
			 	"ed_emp_type"		=> $emp_type,
			 	"ed_emp_dob" 		=> $emp_dob,
			 	"ed_emp_doj" 		=> $emp_doj,
			 	"ed_emp_add_on" 	=> date('Y-m-d H:i:s'),
			 	"ed_emp_add_by" 	=> $this->session->userdata['logged_in']['ea_id'],
			 	"ed_emp_st"			=> '1',
			 	"ed_emp_add_from"   => 'single'

			 );

			 $ins_qurey = $this->db->insert('be_emp_db',$admin_arr);

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

	function getEmployeeUsers($params = array())
	{
		$search_key = addslashes($this->input->post('search_key'));
		$user_type  = $this->input->post('user_type');

        $sql   = "SELECT A.ed_id,A.ed_emp_id,A.ed_emp_name,A.ed_emp_pass,A.ed_emp_email,A.ed_emp_desig,A.ed_emp_grade,A.ed_emp_div,A.ed_emp_team,A.ed_emp_section,A.ed_emp_leader,A.ed_emp_dob,A.ed_emp_doj,A.ed_emp_add_on,A.ed_emp_add_by,A.ed_emp_name,B.ea_id,B.ea_name FROM be_emp_db A, be_emp_aduser B  ";

        $where = " WHERE A.ed_emp_add_by=B.ea_id AND A.ed_emp_st='1'";

        if($user_type){

        	$where .= " AND ed_emp_type='$user_type'";
        }

        if($search_key){

        	$where .= " AND (A.ed_emp_id LIKE '%$search_key%' OR A.ed_emp_name LIKE '%$search_key%' OR A.ed_emp_email LIKE '%$search_key%' OR A.ed_emp_desig LIKE '%$search_key%' OR A.ed_emp_grade LIKE '%$search_key%' OR A.ed_emp_div LIKE '%$search_key%' OR A.ed_emp_team LIKE '%$search_key%' OR A.ed_emp_section LIKE '%$search_key%' OR A.ed_emp_leader LIKE '%$search_key%' )";
        }

        $order_by = " ORDER BY ed_emp_add_on DESC";

        $sql .= $where.$order_by;

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['start'].",".$params['limit'];
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $sql .= " LIMIT ".$params['limit'];
        }
        
        $query = $this->db->query($sql);        
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}

	function getEmpDetail($id)
	{
		$this->db->select('A.ed_id,A.ed_emp_id,A.ed_emp_name,A.ed_emp_pass,A.ed_emp_email,A.ed_emp_desig,A.ed_emp_grade,A.ed_emp_div,A.ed_emp_team,A.ed_emp_section,A.ed_emp_leader,A.ed_emp_type,A.ed_emp_dob,A.ed_emp_doj,A.ed_emp_add_on,A.ed_emp_add_by,A.ed_emp_name');
        $this->db->from('be_emp_db as A');
        $this->db->where('A.ed_id',$id);
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():FALSE;
	}

	function updateEmpUser()
    {
    	$emp_upidd  	= $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('emp_idd'));
    	$emp_id     	= $this->input->post('emp_id');
		$emp_name   	= $this->input->post('emp_name');
		$emp_pass   	= $this->input->post('emp_pass');
		$emp_email  	= $this->input->post('emp_email');
		$emp_desig  	= $this->input->post('emp_desig');
		$emp_grade 		= $this->input->post('emp_grade');
		$emp_div    	= $this->input->post('emp_div');
		$emp_team   	= $this->input->post('emp_team');
		$emp_section 	= $this->input->post('emp_section');
		$emp_leader 	= $this->input->post('emp_leader');
		$emp_type		= $this->input->post('emp_type');
		$emp_dob    	= $this->input->post('emp_dob');
		$emp_doj    	= $this->input->post('emp_doj');
 
		$this->db->select('c.ed_id');
		$this->db->from('be_emp_db as c');
		$this->db->where('c.ed_emp_id',$emp_id);
		$this->db->where('c.ed_id!=',$emp_upidd);
		$query = $this->db->get();
	 
		if($query -> num_rows() == 0) { 

			 $admin_arr = array(

			 	"ed_emp_id" 		=> $emp_id,
			 	"ed_emp_name" 		=> $emp_name,
			 	"ed_emp_email" 		=> $emp_email,
			 	"ed_emp_desig" 		=> $emp_desig,
			 	"ed_emp_grade" 		=> $emp_grade,
			 	"ed_emp_div" 		=> $emp_div,
			 	"ed_emp_team" 		=> $emp_team,
			 	"ed_emp_section"	=> $emp_section,
			 	"ed_emp_leader" 	=> $emp_leader,
			 	"ed_emp_type"		=> $emp_type,
			 	"ed_emp_dob" 		=> $emp_dob,
			 	"ed_emp_doj" 		=> $emp_doj,
			 	"ed_emp_lup_on" 	=> date('Y-m-d H:i:s'),
			 	"ed_emp_lup_by" 	=> $this->session->userdata['logged_in']['ea_id'],
			 	"ed_emp_add_from"   => 'single'

			 );

			 $this->db->where('ed_id',$emp_upidd);
			 $update_qurey = $this->db->update('be_emp_db',$admin_arr);

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

    function updateEmpUserPassword()
    {
    	$emp_id    = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('empUserPassResetID'));
    	$password  = $this->input->post('emp_new_pass');

    	$pass_array = array(
    					'ed_emp_pass' => MD5($password),
    					"ed_emp_pas_rt_on" => date('Y-m-d H:i:s'),
    					"ed_emp_pas_tr_by" => $this->session->userdata['logged_in']['ea_id']
    					);

    	$this->db->where('ed_id',$emp_id);
    	$update_qurey = $this->db->update('be_emp_db',$pass_array);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}

    }

    function deleteEmpUser()
    {
    	$emp_id     = $this->Autoload_model->encrypt_decrypt('dc',$this->input->post('empUserDeelteID'));

    	$pass_array = array(
    			'ed_emp_st'      => '0',
    			'ed_emp_deac_on' => date('Y-m-d H:i:s'),
    			'ed_emp_deac_by' => $this->session->userdata['logged_in']['ea_id']
    		);

    	$this->db->where('ed_id',$emp_id);
    	$update_qurey = $this->db->update('be_emp_db',$pass_array);

		if ($update_qurey) {
			return 1;
		} else {
		 	return 2;
		}
    }

    function saveBulkEmployee()
    {
    	$action_type = $this->input->post('eadd_act_type');
    	$configUpload['upload_path'] = FCPATH.'uploads/emp_bulk/';
     	$configUpload['allowed_types'] = '*';
     	$configUpload['max_size'] = '5000';
     	$status = '';
    	$this->load->library('upload', $configUpload);
     
     	if ( ! $this->upload->do_upload('userfile'))
	 	{
			$error  = array('error' => $this->upload->display_errors());
			//print_r($error);
			$status = 0;
	 	}
	 	else
	 	{
			$data = array('upload_data' => $this->upload->data());
	 	}

      	$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
      	$file_name = $upload_data['file_name']; //uploded file name
	  	$extension=$upload_data['file_ext'];    // uploded file extension

	  	$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name']; //uploded file name
	  	$extension=$upload_data['file_ext'];    // uploded file extension
		
	  	$inputfiletype = PHPExcel_IOFactory::identify(FCPATH.'uploads/emp_bulk/'.$file_name);
	  	$objReader =PHPExcel_IOFactory::createReader($inputfiletype);     //For excel 2003 
		//$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
	    //Set to read only
	    $objReader->setReadDataOnly(true); 		  
	    //Load excel file
		$objPHPExcel=$objReader->load(FCPATH.'uploads/emp_bulk/'.$file_name);		 
	    $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();  //Count Numbe of rows avalable in excel      	 
	    $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
	    //loop from first data untill last data

	    $succ_list = array();
	    $fail_list = array();
	     
	    for($i=2;$i<=$totalrows;$i++)
	    {

	        $data_emp['ed_emp_id']			= $objWorksheet->getCellByColumnAndRow(0,$i)->getCalculatedValue();
	        $data_emp['ed_emp_name']		= $objWorksheet->getCellByColumnAndRow(1,$i)->getCalculatedValue();
	        $data_emp['ed_emp_pass']		= MD5($objWorksheet->getCellByColumnAndRow(2,$i)->getCalculatedValue());
	        $data_emp['ed_emp_email']		= $objWorksheet->getCellByColumnAndRow(3,$i)->getCalculatedValue();
	        $data_emp['ed_emp_type']		= $objWorksheet->getCellByColumnAndRow(4,$i)->getCalculatedValue();
	        $data_emp['ed_emp_desig']		= $objWorksheet->getCellByColumnAndRow(5,$i)->getCalculatedValue();
	        $data_emp['ed_emp_grade']		= $objWorksheet->getCellByColumnAndRow(6,$i)->getCalculatedValue();
	        $data_emp['ed_emp_div']			= $objWorksheet->getCellByColumnAndRow(7,$i)->getCalculatedValue();
	        $data_emp['ed_emp_team']		= $objWorksheet->getCellByColumnAndRow(8,$i)->getCalculatedValue();
	        $data_emp['ed_emp_section']		= $objWorksheet->getCellByColumnAndRow(9,$i)->getCalculatedValue();
	        $data_emp['ed_emp_leader']		= $objWorksheet->getCellByColumnAndRow(10,$i)->getCalculatedValue();
	        $data_emp['ed_emp_dob']			= date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(11,$i)->getCalculatedValue()));
	        $data_emp['ed_emp_doj']			= date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(12,$i)->getCalculatedValue()));
	        $data_emp['ed_emp_add_from']	= 'bulk';

	        if($data_emp['ed_emp_id']!='' && $data_emp['ed_emp_name']!='' && $data_emp['ed_emp_pass']!=''){

	        	if($action_type=='insert'){

	        		$this->db->select('c.ed_id');
					$this->db->from('be_emp_db as c');
					$this->db->where('c.ed_emp_id',$data_emp['ed_emp_id']);
					$query = $this->db->get();

					if($query -> num_rows() == 0) { 
			 			$data_emp['ed_emp_add_on']  = date('Y-m-d H:i:s');
			 			$data_emp['ed_emp_add_by']  = $this->session->userdata['logged_in']['ea_id'];
				 		$ins_qurey     = $this->db->insert('be_emp_db',$data_emp);
				 		array_push($succ_list, $data_emp['ed_emp_id']);
		        	} else {
		        		array_push($fail_list, $data_emp['ed_emp_id'].' - Unable to Register. User already exists with same employee ID.');
		        	}	
		        }

	        	else if($action_type=='update'){

	        		$this->db->select('c.ed_id');
					$this->db->from('be_emp_db as c');
					$this->db->where('c.ed_emp_id',$data_emp['ed_emp_id']);
					$query = $this->db->get();

					if($query -> num_rows() == 1) { 
			 			
			 			$data_emp['ed_emp_lup_on']  = date('Y-m-d H:i:s');
			 			$data_emp['ed_emp_lup_by']  = $this->session->userdata['logged_in']['ea_id'];
				 		$this->db->where('ed_emp_id',$data_emp['ed_emp_id']);
			 			$update_qurey = $this->db->update('be_emp_db',$data_emp);
			 			array_push($succ_list, $data_emp['ed_emp_id']);
		        	} else {
		        		array_push($fail_list, $data_emp['ed_emp_id'].' - Unable to update since there is no employee already registered with this employee ID.');
		        	}
	        	}

	        	else if($action_type=='both'){

	        		$this->db->select('c.ed_id');
					$this->db->from('be_emp_db as c');
					$this->db->where('c.ed_emp_id',$data_emp['ed_emp_id']);
					$query = $this->db->get();

					if($query -> num_rows() == 0) { 
			 			
			 			$data_emp['ed_emp_add_on']  = date('Y-m-d H:i:s');
			 			$data_emp['ed_emp_add_by']  = $this->session->userdata['logged_in']['ea_id'];
				 		$ins_qurey     = $this->db->insert('be_emp_db',$data_emp);
				 		array_push($succ_list, $data_emp['ed_emp_id']);
		        	} else if($query -> num_rows() == 1){
		        		$data_emp['ed_emp_lup_on']  = date('Y-m-d H:i:s');
			 			$data_emp['ed_emp_lup_by']  = $this->session->userdata['logged_in']['ea_id'];
				 		$this->db->where('ed_emp_id',$data_emp['ed_emp_id']);
			 			$update_qurey = $this->db->update('be_emp_db',$data_emp);
			 			array_push($succ_list, $data_emp['ed_emp_id']);
		        	} else {
		        		array_push($fail_list, $data_emp['ed_emp_id'].' - Unable to register/update due to invalid data.');
		        	} 
		    	} else {
		    		array_push($fail_list, $data_emp['ed_emp_id'].' - Unable to register due to invalid action type.');
		    	}
		    } else {
		    	array_push($fail_list, $data_emp['ed_emp_id'].' - Unable to register due to missing of mandatory items.');
		    }
	    }

	    return array("success_list" => $succ_list, "failed_list"=>$fail_list);
	}

}