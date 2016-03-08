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
            echo form_upload(array('name'=>'arquivo', 'id'=>'arquivo', 'class'=>''), set_value('arquivo'));
            echo form_submit(array('name'=>'inserir', 'class'=>'btn btn-sm btn-success m-r-5'), 'Inserir');
            echo anchor('midia/gerenciar_midia', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
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
                    $("input").click(function(){
                        (this).select();
                    });
                });
              </script>';
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Gerenciar Mídias</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('midiaerro');
        verifica_msg('midiaok');
        $this->table->set_template(array('table_open'=>'<table id="data-table" class="table table-striped table-bordered table-td-valign-middle text-center nowrap" width="100%">'));
        $this->table->set_heading('Nome', 'Link', 'Miniatura', 'Ações');
        $consulta = $this->midia_model->pega_midia()->result();
        foreach ($consulta as $linha) {
            $conteudo = array(
                $linha->nome,
                form_input(array('class'=>'form-control width-full'), base_url("uploads/$linha->arquivo")),
                miniatura($linha->arquivo),
                anchor("uploads/$linha->arquivo", '<i class="ion-search fa-2x text-inverse"></i>', array('data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>"Visualizar", 'target'=>'_blank')).' '.anchor("midia/editar/$linha->id",'<i class="ion-edit fa-2x text-inverse"></i>', array('data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>"Editar")).' '.anchor("midia/excluir/$linha->id",'<i class="ion-trash-a fa-2x text-inverse deletar"></i>', array('data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>"Excluir"))
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
        
    case 'editar':
        $idmidia = $this->uri->segment(3);
        if($idmidia == NULL){
            define_msg('midiaerro', 'Escolha uma mídia para alterar.', 'erro');
            redirect('midia/gerenciar_midia');
        }
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Alterar Mídias</h4>
                        </div>
                    <div class="panel-body">';
        if(verifica_adm()){
            $consulta = $this->midia_model->pega_id($idmidia)->row();
            verifica_msg('midiaok');
            verifica_msg('midiaerro');
            echo validacao_erros();
            echo form_open(current_url());
        echo '          <div class="col-md-8"><div class="form-group">
                            <label>Nome</label>';
            echo form_input(array('name'=>'nome', 'class'=>'form-control input-lg', 'placeholder'=>'Nome'), set_value('nome', $consulta->nome), 'autofocus');
        echo '              </label> 
                        </div>';
        echo '          <div class="form-group">
                            <label>Descrição</label>';
            echo form_input(array('name'=>'descricao', 'class'=>'form-control input-lg', 'placeholder'=>'Descrição'), set_value('descricao', $consulta->descricao));
        echo '              </label> 
                        </div>';
            echo form_submit(array('name'=>'editar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Editar');
            echo form_hidden('idmidia', $consulta->id);
            echo anchor('midia/gerenciar_midia', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
        echo form_close();
        echo '</div>';
        echo '<div class="col-md-4 p-t-20 text-center ">'.miniatura($consulta->arquivo, 300, 180 ).'</div>';
        }else{
            define_msg('midiaerro', 'Seu usuário não tem permissão para executar essa operação.', 'erro');
            redirect('midia/gerenciar_midia');
        }
        
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

