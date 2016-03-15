<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'gerenciar':
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Configuração do Sistema</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('configok');
        verifica_msg('configerro');
        echo validacao_erros();
        echo form_open('configuracoes/gerenciar_configuracoes');
        echo '          <div class="form-group">
                            <label>Nome do Site</label>';
            echo form_input(array('name'=>'nome_site', 'class'=>'form-control input-lg', 'placeholder'=>'Nome do Site'), set_value('nome_site',retorna_config('nome_site')), 'autofocus');
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>URL da Logomarca</label>';
            echo form_input(array('name'=>'url_logomarca', 'class'=>'form-control input-lg', 'placeholder'=>'URL da Logomarca'), set_value('url_logomarca', retorna_config('url_logomarca')));
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Email do Administrador</label>';
            echo form_input(array('name'=>'email_adm', 'class'=>'form-control input-lg', 'placeholder'=>'Email do Administrador'), set_value('email_adm', retorna_config('email_adm')));
        echo '              </label> 
                        </div>';
            echo form_submit(array('name'=>'salvar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Salvar Configurações');
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

