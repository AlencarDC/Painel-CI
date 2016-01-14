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
        //eu adicionei
        if($this->session->userdata('usuario_logado')){
            redirect('painel');
        }
        //regras de validação de login
        $this->form_validation->set_rules('usuario', 'USUÁRIO', 'trim|required|min_length[4]|strtolower');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
        if($this->form_validation->run()==TRUE){
            $usuario = $this->input->post('usuario', TRUE);
            $senha = md5($this->input->post('senha', TRUE));
            if($this->usuarios_model->fazer_login($usuario, $senha) == TRUE){
                $consulta = $this->usuarios_model->pega_login($usuario)->row();
                $dados = array(
                        'usuario_id' => $consulta->id,
                        'usuario_nome' => $consulta->nome,
                        'usuario_email' => $consulta->email,//eu adcicionei
                        'usuario_login' => $consulta->login,//eu adcicionei
                        'usuario_adm' => $consulta->adm,
                        'usuario_logado' => TRUE,
                        
                );
                $this->session->set_userdata($dados);
                redirect('painel');
            }else{ 
                echo 'login falho';
            } 
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de login
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'login'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
}
