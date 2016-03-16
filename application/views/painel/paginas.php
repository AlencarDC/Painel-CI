<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'inserir':
        incluir_arquivo('pag_inserir', 'includes/paginas');
        incluir_arquivo('inseririmg');
        break;
    
    case 'gerenciar':
        incluir_arquivo('pag_gerenciar', 'includes/paginas');
        break;
        
    case 'editar':
        incluir_arquivo('pag_editar', 'includes/paginas');
        incluir_arquivo('inseririmg');
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

