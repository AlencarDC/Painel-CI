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
        set_tema('footerinc', '<script>
            $(document).ready(function() {
                    App.init();
            });
	</script>', FALSE);
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
        set_tema('footerinc', '<script>
            $(document).ready(function() {
                    App.init();
            });
	</script>', FALSE);
        set_tema('titulo', 'Login');
        set_tema('conteudo', load_modulo('usuarios', 'nova_senha'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    public function cadastrar(){
        esta_logado(TRUE);
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema');
        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s');
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|ucwords');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|is_unique[usuarios.email]|strtolower');
        $this->form_validation->set_rules('login', 'LOGIN', 'trim|required|min_length[4]|is_unique[usuarios.login]|strtolower');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|matches[senha]');
        if($this->form_validation->run()==TRUE){
            $dados = elements(array('nome', 'email', 'login'), $this->input->post());
            $dados['senha'] = md5($this->input->post('senha'));
            if(verifica_adm()){
                $dados['adm'] = ($this->input->post('check')==1 ? 1 : 0);
            }
            if($this->input->post('check')==1 && $dados['adm']== 0){
                define_msg('msgerro', 'Seu usuário não tem permissão para executar essa operação', 'erro');
                redirect(current_url());
            }
            $this->usuarios_model->fazer_insert($dados);
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('footerinc', '<script>
            $(document).ready(function() {
                    App.init();
            });
	</script>', FALSE);
        set_tema('titulo', 'Cadastar Usuários');
        set_tema('conteudo', load_modulo('usuarios', 'cadastrar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
    public function gerenciar(){
        $this->load->library('table');
        esta_logado();
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('headerinc', load_css('dataTables.bootstrap.min'), FALSE);
        set_tema('headerinc', load_css('responsive.bootstrap.min'), FALSE);
        set_tema('headerinc', load_css('ionicons.min', 'css/ionicons/css'), FALSE);
        set_tema('footerinc', load_js('jquery.dataTables'), FALSE);
        set_tema('footerinc', load_js('dataTables.bootstrap.min'), FALSE);
        set_tema('footerinc', load_js('dataTables.responsive.min'), FALSE);
        set_tema('footerinc', load_js('table-manage-responsive.demo.min'), FALSE);
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>', FALSE);
        set_tema('titulo', 'Gerenciar Usuários');
        set_tema('conteudo', load_modulo('usuarios', 'gerenciar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
}
