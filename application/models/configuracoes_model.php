<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes_model extends CI_Model{
    //insere
    public function fazer_insert($dados=NULL, $redir=TRUE){
        if($dados != NULL){
            if($this->db->insert('configuracoes', $dados)){
                auditoria('Inserção de configuração', 'Nova configuração cadastrada no sistema');
                define_msg('configok', 'Inserção efetuada com sucesso', 'sucesso');
            }else{
                define_msg('configerro', 'Não foi possivel inserir no banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //
    public function fazer_update($dados=NULL,$condicao=NULL,$redirecionar=TRUE){
        if($dados != NULL && is_array($condicao)){
            if($this->db->update('configuracoes', $dados, $condicao)){
                auditoria('Alteração de configuração', 'A configuração para o campo "'.$condicao['nome_config'].'" foi alterada');
                define_msg('configok', 'Alteração efetuada com sucesso', 'sucesso');
            }else{
                define_msg('configerro', 'Não foi possivel atualizar o banco de dados', 'erro');
            }
            if($redirecionar){redirect(current_url());}
        }
    }
    
    public function fazer_delete($condicao=NULL, $redirecionar=TRUE){
        if($condicao!=NULL && is_array($condicao)){
            if($this->db->delete('configuracoes', $condicao)){
                auditoria('Exclusão de configurações', 'A configuração do campo '.$condicao['nome_config'].' foi excluída.');
                define_msg('configok', 'Exclusão efetuada com sucesso.', 'sucesso');
            }else{
                define_msg('configerro', 'Não foi possivel excluir os dados.', 'erro');
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
    public function pega_configuracao(){
        return $this->db->get('configuracoes');
    }
    
    //pega as informações de algum usuario através do id dele
    public function pega_nome_config($id=NULL){
        if ($id != NULL) {
            $this->db->where('nome_config', $id);
            $this->db->limit(1);
            return $this->db->get('configuracoes');
        } else {
            return FALSE;
        }
    }
}


