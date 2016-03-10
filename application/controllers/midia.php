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
                        $("#arquivo").fileinput({\'showUpload\':false, \'previewFileType\':\'any\', \'language\':\'pt-BR\',\'allowedFileExtensions\' : [\'jpg\', \'png\',\'gif\'], \'maxFileSize\': 5000,

});
		});
	</script>', FALSE);
        set_tema('headerinc', load_css('fileinput', 'css/upload/css'), FALSE);
        set_tema('headerinc', load_js(array('fileinput.min', 'fileinput_locale_pt-BR'),'js/upload'), FALSE);
        set_tema('titulo', 'Upload de Imagens');
        set_tema('conteudo', load_modulo('midia', 'inserir'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
    public function gerenciar_midia(){
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
        set_tema('titulo', 'Listagem de Mídias');
        set_tema('conteudo', load_modulo('midia', 'gerenciar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
    
    public function editar(){
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|ucfirst');
        $this->form_validation->set_rules('descricao', 'DESCRIÇÃO', 'trim');
        if($this->form_validation->run()==TRUE){
            $dados = elements(array('nome', 'descricao'), $this->input->post());
            $this->midia_model->fazer_update($dados, array('id' => $this->input->post('idmidia')));
        }
        set_tema('footerinc', '<script>
            $(document).ready(function() {
                    App.init();
            });
	</script>', FALSE);
        set_tema('titulo', 'Alterar Mídias');
        set_tema('conteudo', load_modulo('midia', 'editar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
    }
   
    public function excluir(){
        if(verifica_adm(TRUE)){
            $idmidia = $this->uri->segment(3);
            if($idmidia != NULL){
                $consulta = $this->midia_model->pega_id($idmidia);
                if($consulta->num_rows()==1){
                    $consulta = $consulta->row();
                    echo $consulta->arquivo;
                    unlink("./uploads/$consulta->arquivo");
                    $miniaturas = glob("./uploads/thumbs/*_$consulta->arquivo");
                    foreach($miniaturas as $arquivo){
                        unlink($arquivo);
                    }
                    
                    $this->midia_model->fazer_delete(array('id'=>$consulta->id), FALSE);
                    
                }else{
                    define_msg('midiaerro', 'Mídia não encontrado para exclusão.', 'erro');
                }
            }else{
                define_msg('midiaerro', 'Escolha uma mídia para excluir.', 'erro');
            }
        }
        define_msg('midiaerro', 'Seu usuário não tem permissão para executar essa operação.', 'erro');
        redirect('midia/gerenciar_midia');
        
    }
    
    
    //deveria ser no model aquela parte do db
    public function buscar_imagens(){
        header('Content-Type: application/x-json; charset=utf-8');
        $this->db->like('nome', $this->input->post('pesquisarimg'));
        if($this->input->post('pesquisarimg')==''){
            $this->db->limit(10);
        }
        $this->db->order_by('id', 'DESC');
        $consulta = $this->midia_model->pega_midia();
        $retorno = 'Nenhum resultado encontrado.';
        if($consulta->num_rows()>0){
            $retorno = '';
            $consulta = $consulta->result();
            foreach ($consulta as $linha) {
                $retorno .= '<a href="javascript:;" onclick="$(\'#editor\').tinymce().execCommand(\'mceInsertContent\', false, \'<img src='.base_url("uploads/$linha->arquivo").' />\'); return false;">';
                $retorno .= '<img src="'.miniatura($linha->arquivo, 300,180, FALSE).'" class="retornoimg m-l-5 m-b-5" alt="'.$linha->nome.'" title="Clique para inserir" /></a>';
                 
            }
        }
        echo (json_encode($retorno));
    }
}
