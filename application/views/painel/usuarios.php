<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    case 'login':
        echo 'Tela de Login';
         break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

