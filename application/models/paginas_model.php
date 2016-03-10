<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas_model extends CI_Model{
    //insere
    public function fazer_insert($dados=NULL, $redir=TRUE){
        if($dados != NULL){
            if($this->db->insert('paginas', $dados)){
                auditoria('Inserção de página', 'Nova página cadastrada no sistema');
                define_msg('paginaok', 'Inserção efetuada com sucesso', 'sucesso');
            }else{
                define_msg('paginaerro', 'Não foi possivel inserir no banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //
    public function fazer_update($dados=NULL,$condicao=NULL,$redirecionar=TRUE){
        if($dados != NULL && is_array($condicao)){
            if($this->db->update('paginas', $dados, $condicao)){
                auditoria('Alteração do conteúdo de página', 'A página com o id"'.$condicao['id'].'" foi alterada');
                define_msg('paginaok', 'Alteração efetuada com sucesso', 'sucesso');
            }else{
                define_msg('paginaerro', 'Não foi possivel atualizar o banco de dados', 'erro');
            }
            if($redirecionar){redirect(current_url());}
        }
    }
    
    public function fazer_delete($condicao=NULL, $redirecionar=TRUE){
        if($condicao!=NULL && is_array($condicao)){
            if($this->db->delete('paginas', $condicao)){
                auditoria('Exclusão de página', 'A página com o id '.$condicao['id'].' foi excluída.');
                define_msg('paginaok', 'Exclusão efetuada com sucesso.', 'sucesso');
            }else{
                define_msg('paginaerro', 'Não foi possivel excluir os dados.', 'erro');
            }
            if($redirecionar){redirect(current_url());}
        }
    }
    
    
    //pega todos registros da tabela usuarios
    public function pega_pagina(){
        return $this->db->get('paginas');
    }
    
    //pega as informações de algum usuario através do id dele
    public function pega_id($id=NULL){
        if ($id != NULL) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('paginas');
        } else {
            return FALSE;
        }
    }
}


