<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'gerenciar_auditoria':
        incluir_arquivo('audit_gerenciar', 'includes/auditoria');
        break;
      

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

