<?php
$idmidia = $this->uri->segment(3);
if($idmidia == NULL){
    define_msg('midiaerro', 'Escolha uma mídia para alterar.', 'erro');
    redirect('midia/gerenciar_midia');
}
?>        
<div id="content" class="content">
<?php echo breadcrumb(); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Alterar Mídias</h4>
                </div>
                <div class="panel-body">
                    <?php
                    if(verifica_adm()){
                        $consulta = $this->midia_model->pega_id($idmidia)->row();
                        verifica_msg('midiaok');
                        verifica_msg('midiaerro');
                        echo validacao_erros();
                        echo form_open(current_url());
                    ?>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nome</label>
                                <?php echo form_input(array('name'=>'nome', 'class'=>'form-control input-lg', 'placeholder'=>'Nome'), set_value('nome', $consulta->nome), 'autofocus'); ?>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <?php echo form_input(array('name'=>'descricao', 'class'=>'form-control input-lg', 'placeholder'=>'Descrição'), set_value('descricao', $consulta->descricao)); ?>
                            </div>
                            <?php
                                echo form_submit(array('name'=>'editar', 'class'=>'btn btn-sm btn-success m-r-5'), 'Editar');
                                echo form_hidden('idmidia', $consulta->id);
                                echo anchor('midia/gerenciar_midia', 'Cancelar', array('class'=>'btn btn-sm btn-default'));
                            echo form_close();
                            ?>
                        </div>
                        <div class="col-md-4 p-t-20 text-center ">
                            <?php echo miniatura($consulta->arquivo, 300, 180 ); ?>
                        </div>
                    <?php
                    }else{
                        define_msg('midiaerro', 'Seu usuário não tem permissão para executar essa operação.', 'erro');
                        redirect('midia/gerenciar_midia');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

