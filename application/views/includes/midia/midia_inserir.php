<div id="content" class="content">
    <?php echo breadcrumb(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Upload de Mídias</h4>
                </div>
                <div class="panel-body">
                    <?php
                    verifica_msg('midiaok');
                    verifica_msg('midiaerro');
                    echo validacao_erros();
                    echo form_open_multipart('midia/inserir');
                    ?>
                        <div class="form-group">
                            <label>Nome</label>
                            <?php echo form_input(array('name'=>'nome', 'class'=>'form-control input-lg', 'placeholder'=>'Nome'), set_value('nome'), 'autofocus'); ?>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <?php echo form_input(array('name'=>'descricao', 'class'=>'form-control input-lg', 'placeholder'=>'Descrição'), set_value('descricao')); ?>
                        </div>
                    <?php
                        echo form_upload(array('name'=>'arquivo', 'id'=>'arquivo', 'class'=>''), set_value('arquivo'));
                        echo form_submit(array('name'=>'inserir', 'class'=>'btn btn-sm btn-success m-r-5'), 'Inserir');
                        echo anchor('midia/gerenciar_midia', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
                    echo form_close(); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

