<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_model extends CI_Model{
    //insere
    public function fazer_insert($dados=NULL, $redir=FALSE){
        if($dados != NULL){
            if($this->db->insert('auditoria', $dados)){
                define_msg('auditoriaok', 'Inserção efetuada com sucesso', 'sucesso');
            }else{
                define_msg('auditoriaerro', 'Não foi possivel inserir no banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //pega as informações de algum usuario através do id dele
    public function pega_id($id=NULL){
        if ($id != NULL) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('auditoria');
        } else {
            return FALSE;
        }
    }
    
    //pega todos registros da tabela usuarios
    public function pega_usuarios(){
        return $this->db->get('auditoria');
    }
    
}


