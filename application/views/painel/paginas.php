<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'inserir':
        echo '<div id="content" class="content">
            '.breadcrumb().'
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Inserir novas páginas</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('paginaok');
        verifica_msg('paginaerro');
        echo validacao_erros();
        echo form_open('paginas/inserir');
        echo '          <div class="form-group">
                            <label>Títitulo da páginas</label>';
            echo form_input(array('name'=>'titulo', 'class'=>'form-control input-lg', 'placeholder'=>'Título da página'), set_value('titulo'), 'autofocus');
        echo '
                        </div>';
        echo '          <div class="form-group">
                            <label>Slug</label>';
            echo form_input(array('name'=>'slug', 'class'=>'form-control input-lg', 'placeholder'=>'Deixe em branco se não souber'), set_value('slug'));
        echo '
                        </div>';
        echo '          <div class="form-group">
                            <label>Contéudo</label>';
            echo form_textarea(array('name'=>'conteudo', 'id'=>'editor'), set_value('conteudo'));
        echo '</div>';
            echo form_submit(array('name'=>'publicar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Publicar');
            echo anchor('paginas/gerenciar_paginas', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
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
                            <h4 class="panel-title">Gerenciar Páginas</h4>
                        </div>
                    <div class="panel-body">';
        verifica_msg('paginaerro');
        verifica_msg('paginaok');
        $this->table->set_template(array('table_open'=>'<table id="data-table" class="table table-striped table-bordered table-td-valign-middle nowrap" width="100%">'));
        $this->table->set_heading('Título', 'Slug', 'Resumo', 'Ações');
        $consulta = $this->paginas_model->pega_pagina()->result();
        foreach ($consulta as $linha) {
            $conteudo = array(
                $linha->titulo,
                $linha->slug,
                resumir($linha->conteudo, 15),
                anchor("paginas/editar/$linha->id",'<i class="ion-edit fa-2x text-inverse"></i>', array('data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>"Editar")).' '.anchor("paginas/excluir/$linha->id",'<i class="ion-trash-a fa-2x text-inverse deletar"></i>', array('data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>"Excluir"))
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
        $idpagina = $this->uri->segment(3);
        if($idpagina == NULL){
            define_msg('paginaerro', 'Escolha uma mídia para alterar.', 'erro');
            redirect('paginas/gerenciar_paginas');
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
            $consulta = $this->paginas_model->pega_id($idpagina)->row();
            verifica_msg('paginaok');
            verifica_msg('paginaerro');
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
            echo form_hidden('idpagina', $consulta->id);
            echo anchor('paginas/gerenciar_paginas', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
        echo form_close();
        echo '</div>';
        echo '<div class="col-md-4 p-t-20 text-center ">'.miniatura($consulta->arquivo, 300, 180 ).'</div>';
        }else{
            define_msg('paginaerro', 'Seu usuário não tem permissão para executar essa operação.', 'erro');
            redirect('paginas/gerenciar_paginas');
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

