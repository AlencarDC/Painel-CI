<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    case 'login':
        echo '<div id="page-loader" class="fade in"><span class="spinner"></span></div>
                <div id="page-container" class="fade">
                    <div class="login bg-black animated fadeInDown">
                        <!-- begin brand -->
                        <div class="login-header">
                            <div class="brand">
                                <span class="logo"></span> Painel ADM - Login
                                <small>painel de administração com Code Igniter</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-sign-in"></i>
                            </div>
                        </div>';
        echo '<div class="login-content" >';
        verifica_msg('logoffok');
        verifica_msg('errologin');
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
        echo '</div>
            </div>
        </div>';
        break;
    
    case 'nova_senha':
        echo '<div id="page-loader" class="fade in"><span class="spinner"></span></div>
                <div id="page-container" class="fade">
                    <div class="login bg-black animated fadeInDown">
                        <!-- begin brand -->
                        <div class="login-header">
                            <div class="brand">
                                <span class="logo"></span>Recuperação de Senha
                                <small>painel de administração com Code Igniter</small>
                            </div>
                            <div class="icon">
                                <i class="fa fa-sign-in"></i>
                            </div>
                        </div>';
        echo '<div class="login-content" >';
        verifica_msg('msgok');
        verifica_msg('msgerro');
        echo validacao_erros();
        
        //echo form_fieldset('Identifique-se');
        echo form_open('usuarios/nova_senha', array('class'=>'margin-bottom-0'));
        //echo form_label('Usuário', 'usuario');
        echo '<div class="form-group m-b-20">';
            echo form_input(array('name'=>'email', 'class'=>'form-control input-lg', 'placeholder'=>'Seu email'), set_value('email'), 'autofocus');
        echo '</div>';
        echo '<p>'.anchor('usuarios/login', 'Fazer Login').'</p>';
        echo '<div class="login-buttons">';
            echo form_submit(array('name'=>'novasenha', 'class'=>'btn btn-success btn-block btn-lg'), 'Recuperar senha');
        echo '</div>';
        echo form_close();
        //echo form_fieldset_close();
        echo '</div>
            </div>
        </div>';
        break;
    
    case 'cadastrar':
        echo '<div id="content" class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Cadastrar Usuário</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('msgok');
        verifica_msg('msgerro');
        echo validacao_erros();
        echo form_open('usuarios/cadastrar');
        echo '          <div class="form-group">
                            <label>Nome Completo</label>';
            echo form_input(array('name'=>'nome', 'class'=>'form-control input-lg', 'placeholder'=>'Nome completo'), set_value('nome'), 'autofocus');
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Email</label>';
            echo form_input(array('name'=>'email', 'class'=>'form-control input-lg', 'placeholder'=>'Email'), set_value('email'));
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Login</label>';
            echo form_input(array('name'=>'login', 'class'=>'form-control input-lg', 'placeholder'=>'Login'), set_value('login'));
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Senha</label>';
            echo form_password(array('name'=>'senha', 'class'=>'form-control input-lg', 'placeholder'=>'Senha'), set_value('senha'));
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Repita a senha</label>';
            echo form_password(array('name'=>'senha2', 'class'=>'form-control input-lg', 'placeholder'=>'Repita a senha'), set_value('senha2'));
        echo '               </label> 
                        </div>';
        echo '          <div class="checkbox">
                            <label>';
            echo form_checkbox(array('name'=>'check', 'class'=>''), '1').'Dar poderes administrativos a esse usuário';
        echo '              </label> 
                        </div>';
            echo form_submit(array('name'=>'cadastrar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Cadastrar');
            echo anchor('usuarios/gerenciar', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
        echo form_close();
        echo '          </div>
                    </div>
                </div>
            </div>
            </div>';
        break;

    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

