<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Midia extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('sistema');//ele colocou isso como autoload
        iniciar_painel();
        esta_logado();
        $this->load->model('midia_model');
    }
    
    public function index(){
        $this->gerenciar();
    }
    
    public function inserir(){
        esta_logado(TRUE);
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|ucfirst');
        $this->form_validation->set_rules('descricao', 'DESCRIÇÃO', 'trim');
        if($this->form_validation->run()==TRUE){
            $upload = $this->midia_model->fazer_upload('arquivo');
            if(is_array($upload) && $upload['file_name'] != ''){
                $dados = elements(array('nome', 'descricao'), $this->input->post());
                $dados['arquivo'] = $upload['file_name'];
                $this->midia_model->fazer_insert($dados);
            }else{
                define_msg('midiaerro', $upload, 'erro');
                redirect(current_url());
            }
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init(); 
		});
	</script>', FALSE);
        set_tema('titulo', 'Upload de Imagens');
        set_tema('conteudo', load_modulo('midia', 'inserir'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
    public function gerenciar(){
        $this->load->library('table');
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        set_tema('headerinc', load_css('dataTables.bootstrap.min'), FALSE);
        set_tema('headerinc', load_css('responsive.bootstrap.min'), FALSE);
        set_tema('headerinc', load_css('ionicons.min', 'css/ionicons/css'), FALSE);
        set_tema('footerinc', load_js('jquery.dataTables'), FALSE);
        set_tema('footerinc', load_js('dataTables.bootstrap.min'), FALSE);
        set_tema('footerinc', load_js('dataTables.responsive.min'), FALSE);
        set_tema('footerinc', load_js('table-manage-responsive-auditoria.min'), FALSE);
        set_tema('footerinc', load_js('tooltip'), FALSE);
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
                        $(\'[data-toggle="tooltip"]\').tooltip();   
		});
	</script>', FALSE);
        set_tema('titulo', 'Registros da Auditoria');
        set_tema('conteudo', load_modulo('auditoria', 'gerenciar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
}
