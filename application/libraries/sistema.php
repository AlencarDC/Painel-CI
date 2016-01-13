<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema{
    
    protected $CI;
    public $tema = array();
    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->helper('funcoes');
    }
    
}


