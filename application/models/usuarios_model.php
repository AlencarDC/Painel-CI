<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model{
    
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
}


