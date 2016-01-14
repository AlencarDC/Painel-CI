<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    
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
}


