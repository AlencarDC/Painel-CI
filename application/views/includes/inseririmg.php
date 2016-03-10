<script type="text/javascript">
    $(function(){
        $(".buscarimg").click(function(){
            var destino = "<?php echo base_url('midia/buscar_imagens'); ?>";
            var dados   = $(".buscartxt").serialize();
            $.ajax({
                type: "POST",
                url: destino,
                data: dados,
                success: function(retorno){
                    $(".retorno").html(retorno);
                }
            });
        });
        $(".limparimg").click(function(){
            $(".buscartxt").val('');
            $(".retorno").html('');
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="janela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inserir imagem do Banco de Dados</h4>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <?php echo form_input(array('name'=>'pesquisarimg', 'class'=>'buscartxt form-control', 'placeholder'=>'Procurar imagem...')); ?>
                <span class="input-group-btn">
                  <?php echo form_button('', 'Buscar', 'class="buscarimg btn btn-default"'); ?>
                  <?php echo form_button('', 'Limpar', 'class="limparimg btn btn-default"'); ?>
                </span>
              </div><!-- /input-group -->
              <div class="retorno m-t-10">&nbsp</div>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Inserir</button>
      </div>
    </div>
  </div>
</div>