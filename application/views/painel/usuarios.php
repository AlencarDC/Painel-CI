<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    case 'login':
        echo '<div class="login-content" >';
        echo validacao_erros();
        //echo form_fieldset('Identifique-se');
        echo form_open('usuarios/login', array('class'=>'margin-bottom-0'));
        //echo form_label('Usuário', 'usuario');
        echo '<div class="form-group m-b-20">';
            echo form_input(array('name'=>'usuario', 'class'=>'form-control input-lg', 'placeholder'=>'Usuário'), set_value('usuario'), 'autofocus');
        echo '</div>';
        //echo form_label('Senha', 'senha');
        echo '<div class="form-group m-b-20">';
            echo form_password(array('name'=>'senha', 'class'=>'form-control input-lg', 'placeholder'=>'Senha'), set_value('senha'));
        echo '</div>';
        echo '<p>'.anchor('usuarios/nova_senha', 'Esqueci minha senha').'</p>';
        echo '<div class="login-buttons">';
            echo form_submit(array('name'=>'logar', 'class'=>'btn btn-success btn-block btn-lg'), 'Login');
        echo '</div>';
        echo form_close();
        //echo form_fieldset_close();
        echo '</div>';
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

