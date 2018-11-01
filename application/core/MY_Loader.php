<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * custom loader file extends CI_Loader
 */
 
class MY_Loader extends CI_Loader {
    static $add_data = array();
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $vars = array_merge($vars,self::$add_data);

        $header  = $this->view('header', $vars, $return); // header
        $menu	 = $this->view('menu', $vars, $return); // header
        $content = $this->view($template_name, $vars, $return); // view
        $footer  = $this->view('footer', $vars, $return); // footer

        if ($return)
        {
            return $header.$menu.$content.$footer;
        }
    }

    public function user_template($template_name, $vars = array(), $return = FALSE)
    {
        $vars = array_merge($vars,self::$add_data);
        
        $header  = $this->view('user/header', $vars, $return); // header
        $menu    = $this->view('user/menu', $vars, $return); // header
        $content = $this->view('user/'.$template_name, $vars, $return); // view
        $footer  = $this->view('user/footer', $vars, $return); // footer

        if ($return)
        {
            return $header.$menu.$content.$footer;
        }
    }
}