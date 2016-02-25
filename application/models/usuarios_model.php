<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    //insere
    public function fazer_insert($dados=NULL, $redir=TRUE){
        if($dados != NULL){
            if($this->db->insert('usuarios', $dados)){
                define_msg('msgok', 'Inserção efetuada com sucesso', 'sucesso');
            }else{
                define_msg('msgerro', 'Não foi possivel inserir no banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //verifica se os dados de login estão corretos e retorna Sim ou Nao
    public function fazer_login($usuario=NULL,$senha=NULL){
        if($usuario && $senha){
            $this->db->where('login', $usuario);
            $this->db->where('senha', $senha);
            $this->db->where('ativo', 1);
            $consulta = $this->db->get('usuarios');
            if($consulta->num_rows() == 1){
                return TRUE;
            }  else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    //
    public function fazer_update($dados=NULL,$condicao=NULL,$redirecionar=TRUE){
        if($dados != NULL && is_array($condicao)){
            if($this->db->update('usuarios', $dados, $condicao)){
                define_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
            }else{
                define_msg('msgerro', 'Não foi possivel atualizar o banco de dados', 'erro');
            }
            if($redir){redirect(current_url());}
        }
    }
    
    //pega as informações do usuario que logou através do seu usuario(login)
    public function pega_login($login=NULL){
        if ($login!=NULL) {
            $this->db->where('login', $login);
            $this->db->limit(1);
            return $this->db->get('usuarios');
        } else {
            return FALSE;
        }
    }
    
    //pega as informações do usuario que logou através do seu email para recuperação de senha
    public function pega_email($email=NULL){
        if ($email!=NULL) {
            $this->db->where('email', $email);
            $this->db->limit(1);
            return $this->db->get('usuarios');
        } else {
            return FALSE;
        }
    }
    
    //pega todos registros da tabela usuarios
    public function pega_usuarios(){
        return $this->db->get('usuarios');
    }
}


