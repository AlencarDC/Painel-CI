<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'inserir':
        incluir_arquivo('midia_inserir', 'includes/midia');
        break;
    
    case 'gerenciar':
        incluir_arquivo('midia_gerenciar', 'includes/midia');
        break;
        
    case 'editar':
        incluir_arquivo('midia_editar', 'includes/midia');
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

