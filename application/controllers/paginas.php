<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Paginas extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('sistema');//ele colocou isso como autoload
        iniciar_painel();
        esta_logado();
        $this->load->model('paginas_model');
    }
    
    public function index(){
        $this->gerenciar_paginas();
    }
    
    public function inserir(){
        esta_logado(TRUE);
        $this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required|ucfirst');
        $this->form_validation->set_rules('slug', 'SLUG', 'trim');
        $this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required|htmlentities');
        if($this->form_validation->run()==TRUE){
            $dados = elements(array('titulo', 'slug', 'conteudo'), $this->input->post());
            ($dados['slug'] != '') ? $dados['slug'] = slug($dados['slug']) : $dados['slug'] = slug($dados['titulo']);
            $this->paginas_model->fazer_insert($dados);
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        iniciar_editor();
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init(); 
		});
	</script>', FALSE);
        set_tema('titulo', 'Inserir novas páginas');
        set_tema('conteudo', load_modulo('paginas', 'inserir'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
    public function gerenciar_paginas(){
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
        set_tema('titulo', 'Gerenciar páginas');
        set_tema('conteudo', load_modulo('paginas', 'gerenciar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    public function editar(){
        esta_logado(TRUE);
        $this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required|ucfirst');
        $this->form_validation->set_rules('slug', 'SLUG', 'trim');
        $this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required|htmlentities');
        if($this->form_validation->run()==TRUE){
            $dados = elements(array('titulo', 'slug', 'conteudo'), $this->input->post());
            ($dados['slug'] != '') ? $dados['slug'] = slug($dados['slug']) : $dados['slug'] = slug($dados['titulo']);
            $this->paginas_model->fazer_update($dados, array('id' => $this->input->post('idpagina')));
        }
        
        //vai carregar o modulo usuarios e mostrar a tela de recuperação de senha
        iniciar_editor();
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init(); 
		});
	</script>', FALSE);
        set_tema('titulo', 'Editar página');
        set_tema('conteudo', load_modulo('paginas', 'editar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    public function excluir(){
        if(verifica_adm(TRUE)){
            $idpagina = $this->uri->segment(3);
            if($idpagina != NULL){
                $consulta = $this->paginas_model->pega_id($idpagina);
                if($consulta->num_rows()==1){
                    $consulta = $consulta->row();
                    $this->paginas_model->fazer_delete(array('id'=>$consulta->id), FALSE);
                }else{
                    define_msg('msgerro', 'Página não encontrada para exclusão.', 'erro');
                }
            }else{
                define_msg('paginaerro', 'Escolha uma página para excluir.', 'erro');
            }
        }
        redirect('paginas/gerenciar_paginas');
    }
}
