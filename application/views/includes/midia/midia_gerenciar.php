<script type="text/javascript">
$(function(){
    $(".deletar").click(function(){
        if(confirm("Tem certeza de que deseja excluir esse registro?\nEsta operação não poderá ser desfeita.")) return true; else return false;
    });
    $("input").click(function(){
        (this).select();
    });
});
</script>
<div id="content" class="content">
    <?php echo breadcrumb(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Gerenciar Mídias</h4>
                </div>
                <div class="panel-body">
                    <?php 
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
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

