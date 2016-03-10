<?php defined('BASEPATH') OR exit('No direct script access allowed');

 switch ($tela) {
    
    case 'gerenciar_auditoria':
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
        $modo = $this->uri->segment(3);
        $limite = 50;
        if($modo== 'tudo'){
            $limite = 0;
        }
        $this->table->set_template(array('table_open'=>'<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">'));
        $this->table->set_heading('Usuário', 'Data e Hora', 'Operação', 'Observação');
        $consulta = $this->auditoria_model->pega_auditoria($limite)->result();
        foreach ($consulta as $linha) {
            $conteudo = array(
                $linha->usuario,
                date('d/m/Y H:i:s', strtotime($linha->data_hora)),
                '<span data-toggle="tooltip" data-placement="top" title="'.$linha->query.'">'.$linha->operacao.'</span>',
                $linha->observacao,
                
                );
            $this->table->add_row($conteudo);
        }
        echo $this->table->generate();
        if($modo == 'tudo'){
            echo anchor('auditoria/gerenciar_auditoria', 'Voltar', array('class'=>'btn btn-inverse btn-sm m-r-5 m-b-5'));
        }else{
            echo anchor('auditoria/gerenciar_auditoria/tudo', 'Ver tudo', array('class'=>'btn btn-inverse btn-sm m-r-5 m-b-5')); 
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

