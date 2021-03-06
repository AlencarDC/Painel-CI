<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Midia_model extends CI_Model{
    //insere
    public function fazer_insert($dados=NULL, $redir=TRUE){
        if($dados != NULL){
            if($this->db->insert('midia', $dados)){
                auditoria('Inserção de mídia', 'Nova mídia cadastrada no sistema');
                define_msg('midiaok', 'Inserção efetuada com sucesso', 'sucesso');
            }else{
                define_msg('midiaerro', 'Não foi possivel inserir no banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //
    public function fazer_update($dados=NULL,$condicao=NULL,$redirecionar=TRUE){
        if($dados != NULL && is_array($condicao)){
            if($this->db->update('midia', $dados, $condicao)){
                auditoria('Alteração de mídia', 'A mídia com o id"'.$condicao['id'].'" foi alterada');
                define_msg('midiaok', 'Alteração efetuada com sucesso', 'sucesso');
            }else{
                define_msg('midiaerro', 'Não foi possivel atualizar o banco de dados', 'erro');
            }
            if($redirecionar){redirect(current_url());}
        }
    }
    
    public function fazer_delete($condicao=NULL, $redirecionar=TRUE){
        if($condicao!=NULL && is_array($condicao)){
            if($this->db->delete('midia', $condicao)){
                auditoria('Exclusão de mídia', 'A mídia com o id '.$condicao['id'].' foi excluída.');
                define_msg('midiaok', 'Exclusão efetuada com sucesso.', 'sucesso');
            }else{
                define_msg('midiaerro', 'Não foi possivel excluir os dados.', 'erro');
            }
            if($redirecionar){redirect(current_url());}
        }
    }
    
    
    public function fazer_upload($campo){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload($campo)){
            return $this->upload->data();
        }else{
            return $this->upload->display_errors('','');
        }
    }
    
    //pega todos registros da tabela usuarios
    public function pega_midia(){
        return $this->db->get('midia');
    }
    
    //pega as informações de algum usuario através do id dele
    public function pega_id($id=NULL){
        if ($id != NULL) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('midia');
        } else {
            return FALSE;
        }
    }
}


