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
                $consulta = $this->usuarios_model->pega_login($usuario)->row();
                if(empty($consulta)){
                    define_msg('errologin', 'Esse usuário não existe.', 'erro');
                }elseif($consulta->senha != $senha){
                    define_msg('errologin', 'Senha incorreta.', 'erro');
                }elseif($consulta->ativo == 0){
                    define_msg('errologin', 'Esse usuário está inativo.', 'erro');
                }else{
                    define_msg('errologin', 'Problemas com o LogIn, contate o desenvolvedor.', 'erro');
                }
                redirect('usuarios/login');
            } 
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de login
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'login'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    public function logoff(){
        $this->session->unset_userdata(array('usuario_id','usuario_nome','usuario_email','usuario_login','usuario_adm','usuario_logado'));
        //$this->session->sess_destroy(); //tenho medo de não fazer esse destroy, perguntar sobre para o professor
        $this->session->sess_regenerate(TRUE);
        define_msg('logoffok','O logoff foi efetuado.', 'sucesso');
        redirect('usuarios/login');  
    }
    
    public function nova_senha(){
        //eu adicionei
        if($this->session->userdata('usuario_logado')){
           redirect('painel');
        }
        //regras de validação do formulario de recuperação de senha
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|strtolower');
        if($this->form_validation->run()==TRUE){
            $email = $this->input->post('email');
            $consulta = $this->usuarios_model->pega_email($email);
            if($consulta->num_rows() == 1){
                $novasenha = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm0123456789'), 0, 6);
                $mensagem = "<p>Você solicitou uma nova senha para acesso ao Painel de Administração do site, a partir de agora use a seguinte senha para acesso: <strong>$novasenha</strong></p><p>Troque esta senha para uma senha segura e de sua preferência.</p>";
                if($this->sistema->enviar_email($email, 'Nova senha de acesso!', $mensagem, $mensagem)){
                    $dados['senha'] = md5($novasenha);
                    $this->usuarios_model->fazer_update($dados, array('email' => $email), FALSE);
                    define_msg('msgok', 'Uma nova senha foi enviada para seu email.', 'sucesso');
                    redirect('usuarios/nova_senha');
                }else{
                    define_msg('msgerro', 'Não foi possível enviar uma nova senha, contate o administrador.', 'erro');
                    redirect('usuarios/nova_senha');
                }

            }else{
                define_msg('msgerro', 'Esse email não está cadastrado no sistema.', 'erro');
                redirect('usuarios/nova_senha');
            }
        }
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'nova_senha'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
}
