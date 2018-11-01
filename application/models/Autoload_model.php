<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Autoload_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function genAlertMsg($message,$msg_type)
	{
		$language = MY_Loader::$add_data['language'];
		//Success
		if($msg_type==1) {

			return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$language['flash_common']['1'].'</strong> '.$message.'.</div>';
		//Information
		} else if($msg_type==2) {

			return '<div class="alert alert-info alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$language['flash_common']['2'].'</strong> '.$message.'.</div>';
		//Warning
		} else if($msg_type==3) {

			return '<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$language['flash_common']['3'].'</strong> '.$message.'.</div>';
		//Danger-Error
		} else {

			return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$language['flash_common']['4'].'</strong> '.$message.'.</div>';

		}
	}

	function encrypt_decrypt($action, $string) {
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'bydempdbadmin';
	    $secret_iv = 'bydempdbadmin';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'en' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'dc' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

	function getTemplateList()
	{
		$this->db->select('qt_id,qt_name,qt_desc,qt_templ_to,qt_add_on');
        $this->db->from('be_emp_qstn_templ');
        $this->db->where('qt_status','1');
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}

	function getAnswerType($ans_type)
	{
		$language 	= MY_Loader::$add_data['language'];

		$answer = '';

		if($ans_type=='text'){
			$answer = $language['question_tab']['text_box'];
		}

		if($ans_type=='radio'){
			$answer = $language['question_tab']['radi_butt'];
		}

		if($ans_type=='check'){
			$answer = $language['question_tab']['chec_box'];
		}

		return $answer;
	}

	function getUserType($user)
	{
		$language 	= MY_Loader::$add_data['language'];
		$user_type  = '';

		if($user=='teacher'){
			$user_type = $language['common']['teac'];
		}

		if($user=='student'){
			$user_type = $language['common']['stud'];
		}

		return $user_type;
	}
}