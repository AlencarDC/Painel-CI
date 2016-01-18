<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema{
    
    protected $CI;
    public $tema = array();
    
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->helper('funcoes');
    }
    
    public function enviar_email($para, $assunto, $mensagem){
        $this->CI->load->library('email');
                //configurações para o envio de emails
                $config['protocol']    = 'smtp';
                $config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'mreis2103@gmail.com';
                $config['smtp_pass']    = 'murilo210303';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = "html";
        $this->CI->email->initialize($config);
        $this->CI->email->from('mreis2103@gmail.com', 'Administração do Site');
        $this->CI->email->to($para);
        $this->CI->email->subject($assunto);
        $this->CI->email->message($mensagem);
        if($this->CI->email->send()){
            return TRUE;
        }else{
            return $this->CI->email->print_debugger();
        }
    }
}


