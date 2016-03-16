<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'instalar':
        verifica_msg('msgok');
        verifica_msg('msgerro');
        echo validacao_erros();
        echo form_open('instalar', 'class="margin-bottom-0"');
        echo '          <label>URL de Instalação</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'url_base', 'class'=>'form-control', 'placeholder'=>'URL de Instalação (com uma / no final)'), set_value('url_base', str_replace('instalar','', current_url() ) ), 'autofocus');
        echo '                 </div>
                            </div>';
        echo '          <label>Chave de Segurança</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'chave_seg', 'class'=>'form-control', 'placeholder'=>'Chave de Segurança'), set_value('chave_seg', md5(time()) ));
        echo '                 </div>
                            </div>';
         echo '          <label>Tempo da Sessão</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'tempo_sessao', 'class'=>'form-control', 'placeholder'=>'Tempo da Sessão'), set_value('tempo_sessao', 3600));
        echo '                 </div>
                            </div>';
         echo '          <hr /><label>Servidor</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'hostname', 'class'=>'form-control', 'placeholder'=>'Servidor'), set_value('servidor', 'localhost'));
        echo '                 </div>
                            </div>';
        echo '          <label>Usuário</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'username', 'class'=>'form-control', 'placeholder'=>'Usuário'), set_value('username'));
        echo '                 </div>
                            </div>';
        echo '          <label>Senha</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'password', 'class'=>'form-control', 'placeholder'=>'Senha'), set_value('password'));
        echo '                 </div>
                            </div>';
        echo '          <label>Nome do Banco de Dados</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'database', 'class'=>'form-control', 'placeholder'=>'Nome do Banco de Dados'), set_value('database'));
        echo '                 </div>
                            </div>';
        echo '          <hr /><label>Nome Completo</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'user_nome', 'class'=>'form-control', 'placeholder'=>'Nome Completo'), set_value('user_nome'));
        echo '                 </div>
                            </div>';
        echo '          <label>Email</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'user_email', 'class'=>'form-control', 'placeholder'=>'Email'), set_value('user_email'));
        echo '                 </div>
                            </div>';
        echo '          <label>Login</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'user_login', 'class'=>'form-control', 'placeholder'=>'Login'), set_value('user_login', 'admin'));
        echo '                 </div>
                            </div>';
        echo '          <label>Senha de acesso</label>
                            <div class="row row-space-10">
                               <div class="col-md-12 m-b-15">';
            echo form_input(array('name'=>'user_senha', 'class'=>'form-control', 'placeholder'=>'Senha de acesso'), set_value('user_senha'));
        echo '                 </div>
                            </div>';
            echo form_submit(array('name'=>'instalar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Instalar');
        echo form_close();
        break;
    
    case 'sucesso':
        echo 'Sucesso!';
        
        break;


    default:
        echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
        break;
}

