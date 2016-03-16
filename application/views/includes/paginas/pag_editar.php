<?php
$idpagina = $this->uri->segment(3);
if($idpagina == NULL){
    define_msg('paginaerro', 'Escolha uma página para alterar.', 'erro');
    redirect('paginas/gerenciar_paginas');
}
?>        
<div id="content" class="content">
    <?php echo breadcrumb(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Editar página</h4>
                </div>
                <div class="panel-body">
                <?php
                if(verifica_adm()){
                    $consulta = $this->paginas_model->pega_id($idpagina)->row();
                    verifica_msg('paginaok');
                    verifica_msg('paginaerro');
                    echo validacao_erros();
                    echo form_open(current_url());
                ?>
                    <div class="form-group">
                        <label>Título</label>
                        <?php echo form_input(array('name'=>'titulo', 'class'=>'form-control input-lg', 'placeholder'=>'Título da página'), set_value('titulo', $consulta->titulo), 'autofocus'); ?>
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <?php echo form_input(array('name'=>'slug', 'class'=>'form-control input-lg', 'placeholder'=>'Deixe em branco se não souber'), set_value('slug', $consulta->slug)); ?>
                    </div>
                    <div class="form-group">
                        <label>Contéudo</label>
                        <?php 
                        echo '<p>'.anchor('#', '<i class="fa fa-plus"></i> Inserir Imagem', 'class="btn btn-primary btn-md m-r-5" data-toggle="modal" data-target="#janela"'); 
                        echo anchor('midia/inserir', 'Upload de Imagens', 'class="btn btn-white btn-md m-r-5" target="_blank"').'</p>';
                        echo form_textarea(array('name'=>'conteudo', 'id'=>'editor'), transforma_html($consulta->conteudo));
                        ?>
                    </div>
                <?php
                    echo form_submit(array('name'=>'editar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Editar');
                    echo form_hidden('idpagina', $consulta->id);
                    echo anchor('paginas/gerenciar_paginas', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
                    echo form_close();
                }else{
                    define_msg('paginaerro', 'Seu usuário não tem permissão para executar essa operação.', 'erro');
                    redirect('paginas/gerenciar_paginas');
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
