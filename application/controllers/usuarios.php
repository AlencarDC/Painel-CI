<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->library('sistema');//ele colocou isso como aotoload
        iniciar_painel();
    }
    
    public function index(){
        $this->load->view('');
    }
    
    public function login(){
        //vai carregar o modulo usuarios e mostrar a tela de login
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'login'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
}
