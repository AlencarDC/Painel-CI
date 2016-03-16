
<div id="content" class="content">
    <?php echo breadcrumb(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Configuração do Sistema</h4>
                </div>
                <div class="panel-body">
                    <?php 
                    verifica_msg('configok');
                    verifica_msg('configerro');
                    echo validacao_erros();
                    echo form_open('configuracoes/gerenciar_configuracoes');
                    ?>
                        <div class="form-group">
                            <label>Nome do Site</label>
                            <?php echo form_input(array('name'=>'nome_site', 'class'=>'form-control input-lg', 'placeholder'=>'Nome do Site'), set_value('nome_site',retorna_config('nome_site')), 'autofocus'); ?>
                        </div>
                         <div class="form-group">
                            <label>URL da Logomarca</label>
                            <?php echo form_input(array('name'=>'url_logomarca', 'class'=>'form-control input-lg', 'placeholder'=>'URL da Logomarca'), set_value('url_logomarca', retorna_config('url_logomarca'))); ?>
                        </div>
                        <div class="form-group">
                            <label>Email do Administrador</label>
                            <?php echo form_input(array('name'=>'email_adm', 'class'=>'form-control input-lg', 'placeholder'=>'Email do Administrador'), set_value('email_adm', retorna_config('email_adm'))); ?>
                        </div>
                        <?php    echo form_submit(array('name'=>'salvar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Salvar Configurações');
                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

