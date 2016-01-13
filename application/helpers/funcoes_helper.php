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
    
    set_tema('titulo_padrao', 'Painel ADM');
    set_tema('rodape', '<p>&copy; 2015 | Todos os direitos reservados para Alencar da Costa</p>').
    set_tema('template','painel_view');
}

//carrega um template passando o array $tema como parametro
function load_template(){
    $CI =& get_instance();
    $CI->load->library('sistema');
    $CI->parser->parse($CI->sistema->tema['template'], get_tema());
}