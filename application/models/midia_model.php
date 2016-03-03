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
    
}


