<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Autoload_model extends CI_Model {
 
	public function __construct()
	{
		parent::__construct();
	}
	public function genAlertMsg($message,$msg_type)
	{
		//Success
		if($msg_type==1) {

			return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> '.$message.'.</div>';
			//Information
		} else if($msg_type==2) {

			return '<div class="alert alert-info alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Info!</strong> '.$message.'.</div>';
		//Warning
		} else if($msg_type==3) {

			return '<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> '.$message.'.</div>';
		//Danger-Error
		} else {

			return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failed!</strong> '.$message.'.</div>';

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
}