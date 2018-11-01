<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
        	$file_name = $siteLang.'.'.'json';
            $str = file_get_contents(FCPATH."assets/language/".$file_name);
            $json = json_decode($str, true);
            MY_Loader::$add_data['language'] = $json;
            MY_Loader::$add_data['ln'] = $siteLang;
            //echo '<pre>' . print_r($json, true) . '</pre>';exit;
        } else {
            $file_name = 'en.json';
            $str = file_get_contents(FCPATH."assets/language/".$file_name);
            $json = json_decode($str, true); 
            MY_Loader::$add_data['language'] = $json;
            MY_Loader::$add_data['ln'] = 'en';
            //echo '<pre>' . print_r($json, true) . '</pre>';exit;
        }
    }
}