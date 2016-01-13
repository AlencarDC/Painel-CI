<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->inicio();
    }
    
    public function inicio(){
        redirect('usuarios/login');
    }
}

