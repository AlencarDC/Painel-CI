<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'inserir':
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Upload de Mídias</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('midiaok');
        verifica_msg('midiaerro');
        echo validacao_erros();
        echo form_open_multipart('midia/inserir');
        echo '          <div class="form-group">
                            <label>Nome</label>';
            echo form_input(array('name'=>'nome', 'class'=>'form-control input-lg', 'placeholder'=>'Nome'), set_value('nome'), 'autofocus');
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Descrição</label>';
            echo form_input(array('name'=>'descricao', 'class'=>'form-control input-lg', 'placeholder'=>'Descrição'), set_value('descricao'));
        echo '              </label> 
                        </div>';
            echo form_upload(array('name'=>'arquivo'), set_value('arquivo'));
            echo form_submit(array('name'=>'inserir', 'class'=>'btn btn-sm btn-success m-r-5'), 'Inserir');
            echo anchor('midia/gerenciar', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
        echo form_close();
        echo '          </div>
                    </div>
                </div>
            </div>
            </div>';
        break;
    
    case 'gerenciar':
        echo '<script type="text/javascript">
                $(function(){
                    $(".deletar").click(function(){
                        if(confirm("Tem certeza de que deseja excluir esse registro?\nEsta operação não poderá ser desfeita.")) return true; else return false;
                    });
                });
              </script>';
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Gerenciar Usuário</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('msgerro');
        verifica_msg('msgok');
        $this->table->set_template(array('table_open'=>'<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">'));
        $this->table->set_heading('Nome', 'Login', 'Email', 'Ativo', 'Adm', 'Ações');
        $consulta = $this->usuarios_model->pega_usuarios()->result();
        foreach ($consulta as $linha) {
            $conteudo = array(
                $linha->nome,
                $linha->login,
                $linha->email,
                ($linha->ativo==0) ? '<i class="ion-close fa-2x text-danger"></i>Não' : '<i class="ion-checkmark fa-2x text-success"></i>Sim',
                ($linha->adm==0) ? '<i class="ion-close fa-2x text-danger"></i>Não' : '<i class="ion-checkmark fa-2x text-success"></i>Sim',
                anchor("usuarios/excluir/$linha->id", '<i class="ion-trash-a fa-2x text-inverse deletar"></i>', 'Deletar').' '.anchor("usuarios/editar/$linha->id",'<i class="ion-edit fa-2x text-inverse"></i>', 'Editar').' '.anchor("usuarios/alterar_senha/$linha->id",'<i class="ion-locked fa-2x text-inverse"></i>', 'Alterar Senha')
                );
            $this->table->add_row($conteudo);
        }
        echo $this->table->generate();
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
