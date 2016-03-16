<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'gerenciar':
        incluir_arquivo('config_gerenciar', 'includes/configuracoes');
        break;
    

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

