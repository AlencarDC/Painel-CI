<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->library('sistema');
        iniciar_painel();
    }
    
    public function index(){
        $this->inicio();
    }
    
    public function inicio(){
        if(esta_logado(FALSE)){
            set_tema('titulo', 'Home');
            set_tema('conteudo', '');
            set_tema('rodape', '');
            set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>', FALSE);
            load_template();
        } else {
            redirect('usuarios/login');
        }
    }
}

