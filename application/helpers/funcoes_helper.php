<?php defined('BASEPATH') OR exit('No direct script access allowed');

//carrega o módulo do sistema devolvendo a tela solicitada
function load_modulo($modulo=NULL, $tela=NULL, $diretorio='painel'){
    $CI =& get_instance();
    if ($modulo !=NULL) {
        return $CI->load->view("$diretorio/$modulo", array('tela'=>$tela), TRUE);
    }  else {
        return FALSE;
    }
}

//seta valores ao array $tema da classe sistema
    //esse utlimo parametro booliano fará com que
    // o valor anterior dessa propriedade seja substituido ou não
    // TRUE = substitui  FALSE = não substitui, junta as informações
function set_tema($prop, $valor, $replace=TRUE){
    $CI =& get_instance();
    $CI->load->library('sistema');
    if($replace){
        $CI->sistema->tema[$prop] = $valor;
    }else{
        if(!isset($CI->sistema->tema[$prop])){
            $CI->sistema->tema[$prop] = '';
        }
        $CI->sistema->tema[$prop] .= $valor;
    }
    
}

//retorna os valores do array $tema da classe sistema
function get_tema(){
    $CI =& get_instance();
    $CI->load->library('sistema');
    return $CI->sistema->tema;
}

//inicializa o painel adm carregando os recursos necessarios
function iniciar_painel(){
    $CI =& get_instance();
    $CI->load->library(array('sistema','session','form_validation'));
    $CI->load->helper(array('form', 'url', 'array', 'text'));
    //carregamento dos models 
    $CI->load->model('usuarios_model');
    
    set_tema('titulo_padrao', 'Painel ADM');
    set_tema('rodape', '<p>&copy; 2015 | Todos os direitos reservados para Alencar da Costa</p>');
    set_tema('template','painel_view');
    
    set_tema('headerinc', load_css('bootstrap.min','css/bootstrap'), FALSE);
    set_tema('headerinc', load_css('font-awesome.min', 'css/font-awesome/css'), FALSE);
    set_tema('headerinc', load_css(array('animate.min', 'style.min', 'style-responsive.min', 'default')), FALSE);
    set_tema('headerinc', load_js(array('jquery-1.9.1.min', 'jquery-migrate-1.1.0.min'),'js/jquery'), FALSE);
    set_tema('footerinc', load_js('jquery-ui.min', 'js/jquery-ui/ui/'), FALSE);
    set_tema('footerinc', load_js(array('bootstrap.min', 'jquery.slimscroll.min', 'apps.min')), FALSE);
    
}

//inicializa o TinyMCE para criação de textarea com editor html
function iniciar_editor(){
    $CI =& get_instance();
    
    set_tema('headerinc', load_js(base_url('htmleditor/tinymce.min.js'), NULL, TRUE), FALSE);
    set_tema('headerinc', load_js(base_url('htmleditor/init_editor.js'), NULL, TRUE), FALSE);
}

//retorna ou printa o conteudo de uma view
function incluir_arquivo($arquivo, $pasta='includes', $mostrar=TRUE){
    $CI =& get_instance();
    if($mostrar){
        echo $CI->load->view("$pasta/$arquivo", '', TRUE);
        return TRUE;
    }
    return $CI->load->view("$pasta/$arquivo", '', TRUE);
}
//carrega um template passando o array $tema como parametro
function load_template(){
    $CI =& get_instance();
    $CI->load->library('sistema');
    $CI->parser->parse($CI->sistema->tema['template'], get_tema());
}

//carrega um ou varios arquivos .css de uma pasta
function load_css($arquivo=NULL, $pasta='css', $midias='all'){
    if($arquivo != NULL){
        $CI =& get_instance();
        $CI->load->helper('url');
        $retorno = '';
        if(is_array($arquivo)){
            foreach ($arquivo as $css) {
                $retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$midias.'" /> '."\n"; 
            }
        }  else {
            $retorno = '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$midias.'" /> '."\n";
        }
    }
    return $retorno;
}


//carrega um ou varios arquivos .js de uma pasta ou servidor remoto
function load_js($arquivo=NULL, $pasta='js', $remoto=FALSE){
    if($arquivo != NULL){
        $CI =& get_instance();
        $CI->load->helper('url');
        $retorno = '';
        if(is_array($arquivo)){
            foreach ($arquivo as $js) {
                if($remoto){
                    $retorno .= '<script type="text/javascript" src="'.$js.'" ></script>'."\n";
                }  else {
                    $retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$js.js").'" ></script>'."\n";
                }
            }
        }  else {
            if($remoto){
                $retorno .= '<script type="text/javascript" src="'.$arquivo.'" ></script>'."\n";
            }  else {
                $retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'" ></script>'."\n";
            }
        }
    }
    return $retorno;
}

//mostra erros de validação nos forms
function validacao_erros(){
    if(validation_errors()){
        return validation_errors('<div class="alert alert-danger fade in m-b-15"><strong>Erro! </strong>','<span class="close" data-dismiss="alert">×</span></div>');
    }
}

//verifica se o usuario está logado no sistema
function esta_logado($redirecionar=TRUE) {
    $CI =& get_instance();
    $CI->load->library('session');
    $usuario_status = $CI->session->userdata('usuario_logado');
    if(!isset($usuario_status) OR $usuario_status!=TRUE){
        //$CI->session->sess_destroy();//o ricardo excluiu essa linha
        if($redirecionar){
            $CI->session->set_userdata(array('redirecionar'=>current_url()));
            define_msg('errologin', 'Acesso restrito, faça login para prosseguir.');
            redirect('usuarios/login');
        }else{
            return FALSE;
        }
    } else {
        return TRUE;
    }
}

//define uma mensagem para ser exibida na proxima tela carregada
function define_msg($id='msgerro', $msg=NULL, $tipo='erro'){
    $CI =& get_instance();
    switch ($tipo) {
        case 'erro':
            $CI->session->set_flashdata($id,'<div class="alert alert-danger fade in m-b-15"><strong>Erro! </strong>'.$msg.'<span class="close" data-dismiss="alert">×</span></div>');
            break;
        case 'sucesso':
            $CI->session->set_flashdata($id,'<div class="alert alert-success fade in m-b-15"><strong>Sucesso! </strong>'.$msg.'<span class="close" data-dismiss="alert">×</span></div>');
            break;
        default:
            $CI->session->set_flashdata($id,'<div class="alert alert-info fade in m-b-15"><strong>Informação! </strong>'.$msg.'<span class="close" data-dismiss="alert">×</span></div>');
            break;
    }
}

//verifica se há uma mensagem para ser exibida na tela atual
function verifica_msg($id,$printar=TRUE){
    $CI =& get_instance();
    if($CI->session->flashdata($id)){
        if($printar){
            echo $CI->session->flashdata($id);
            return TRUE;
        }else{
            return $CI->session->flashdata($id);
        }
    }
    return FALSE;
}

// verifica se o usuario atual é administrador
function verifica_adm($msg=FALSE){
    $CI =& get_instance();
    $usuario_adm = $CI->session->userdata('usuario_adm');
    if(!isset($usuario_adm) || $usuario_adm != TRUE){
        if($msg){
            define_msg('msgerro', 'Seu usuário não tem permissão para executar essa operação', 'erro');
        }
        return FALSE;
    }else{
        return TRUE;
    }
}

//gera um breadcrumb com base no controller atual
function breadcrumb(){
    $CI =& get_instance();
    $CI->load->helper('url');
    $classe = ucfirst($CI->router->class);
    if($classe == 'Painel'){
        $classe = '<li>'.anchor($CI->router->class, 'Início').'</li>';
    }else{
        $classe = '<li>'.anchor($CI->router->class, $classe).'</li>';
    }
    $metodo = ucwords(str_replace('_', ' ', $CI->router->method));
    if($metodo && $metodo != 'Index'){
        $metodo = '<li>'.$metodo.'</li>';
    }else{
        $metodo = '';
    }
    return '<ol class="breadcrumb pull-right"><li>'.anchor('painel', 'Início').'</li>'.$classe.$metodo.'</ol>';
}


//define um registro na tabela de auditoria
function auditoria($operacao, $observacao='', $query=TRUE){
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->model('auditoria_model');
    $usuario = 'Desconhecido';
    if(esta_logado(FALSE)){
        $usuario = $CI->session->userdata('usuario_login');//ele não tem o login do usuario na sessao, então ele fez pegando do banco... diferente
    }
    $ultima_operacao = 'Nulo';
    if($query){
        $ultima_operacao = $CI->db->last_query();
    }
    $dados = array(
            'usuario' => $usuario,
            'operacao' => $operacao,
            'query' => $ultima_operacao,
            'observacao' => $observacao,
    );
    $CI->auditoria_model->fazer_insert($dados);
}

//gera uma miniatura de uma imagem caso ela ainda nao exista
function miniatura($imagem=NULL, $largura=100, $altura=75, $gera_tag=TRUE){
    $CI =& get_instance();
    $CI->load->helper('file');
    $miniatura = $largura.'x'.$altura.'_'.$imagem;
    $miniatura_info = get_file_info('.uploads/thumbs'.$miniatura);
    if($miniatura_info!=FALSE){
        $retorno = base_url('uploads/thumbs/'.$miniatura);
    }else{
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2'; //servidor web tem q ter instalado gd2!
        $config['source_image'] = './uploads/'.$imagem;
        $config['new_image'] = './uploads/thumbs/'.$miniatura;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $largura;
        $config['height'] = $altura;
        $CI->image_lib->initialize($config);
        if($CI->image_lib->resize()){
            $CI->image_lib->clear();
            $retorno = base_url('uploads/thumbs/'.$miniatura);
        }else{
            $retorno = FALSE;
        }
    }
    if($gera_tag && $retorno!=FALSE){
        $retorno = '<img src="'.$retorno.'" alt="" />';
    }
    return $retorno;
}

//gera um slug baseado no titulo
function slug($texto=NULL){
    $texto = remove_acentos($texto); //remover acentos
    return url_title($texto, '-', TRUE);
}

//remove acentos e caracteres especiais de uma string
function remove_acentos($string=NULL){
    $procurar   = array('á','à','â','ã','ª','Á','À','Â','Ã', 'é','è','ê','É','È','Ê','í','ì','î','Í','Ì','Î','ò','ó','ô', 'õ','º','Ó','Ò','Ô','Õ','ú','ù','û','Ú','Ù','Û','ç','Ç','Ñ','ñ');
    $substituir = array('a','a','a','a','a','A','A','A','A','e','e','e','E','E','E','i','i','i','I','I','I','o','o','o','o','o','O','O','O','O','u','u','u','U','U','U','c','C','N','n');
    return str_replace($procurar, $substituir, $string);
}

//gera o resumo de uma página/string
function resumir($texto=NULL, $palavras=50, $decodificar=TRUE, $remover_tags=TRUE){
    if($texto != NULL){
       if($decodificar){
           $texto = html_entity_decode($texto);
        } 
       if($remover_tags){
           strip_tags($texto);
        }
        $retorno = word_limiter($texto, $palavras);
    }else{
        $retorno = FALSE;
    }
    return $retorno;
}