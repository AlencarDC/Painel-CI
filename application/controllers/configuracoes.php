<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('sistema');//ele colocou isso como autoload
        iniciar_painel();
        esta_logado();
        $this->load->model('midia_model');
    }
    
    public function index(){
        $this->gerenciar_configuracoes();
    }
    
    
    public function gerenciar_configuracoes(){
        esta_logado(TRUE);
        if($this->input->post('salvar')){
            if(verifica_adm(TRUE)){
                $upload = $this->midia_model->fazer_upload('arquivo');
                $configuracoes = elements(array('nome_site', 'url_logomarca', 'email_adm'), $this->input->post());
                foreach($configuracoes as $nome_config => $valor_config){
                   define_config($nome_config, $valor_config);
                }
                define_msg('configok', 'Configurações atualizadas com sucesso.', 'sucesso');
                redirect('configuracoes/gerenciar_configuracoes');
            }else{
                redirect('configuracoes/gerenciar_configuracoes');
            }
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
		});
	</script>', FALSE);
        set_tema('titulo', 'Configuração do Sistema');
        set_tema('conteudo', load_modulo('configuracoes', 'gerenciar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    
}
