<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Instalar extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('sistema');//ele colocou isso como autoload
    }
    
    public function index(){
        iniciar_painel();
        $this->form_validation->set_rules('url_base', 'URL', 'trim|required|strtolower');
        $this->form_validation->set_rules('chave_seg', 'CHAVE DE SEGURANÇA', 'trim|required|strtolower');
        $this->form_validation->set_rules('tempo_sessao', 'TEMPO DA SESSÃO', 'trim|required|numeric');
        $this->form_validation->set_rules('hostname', 'SERVIDOR', 'trim|required');
        $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|required');
        $this->form_validation->set_rules('password', 'SENHA', 'trim');
        $this->form_validation->set_rules('database', 'NOME BANCO DE DADOS', 'trim|required');
        $this->form_validation->set_rules('user_nome', 'NOME COMPLETO', 'trim|required|ucwords');
        $this->form_validation->set_rules('user_email', 'EMAIL', 'trim|required|strtolower|valid_email');
        $this->form_validation->set_rules('user_login', 'LOGIN', 'trim|required|strtolower|min_length[4]');
        $this->form_validation->set_rules('user_senha', 'SENHA', 'trim|required|strtolower|min_length[4]');
        if($this->form_validation->run()==TRUE){
            //criar os arquivos
            $this->load->helper('file');
            $arquivo_config = '<?php defined("BASEPATH") OR exit("No direct script access allowed");
                $config["base_url"] = "'.$this->input->post('url_base').'";
                $config["index_page"] = "";
                $config["url_suffix"] = "";
                $config["language"]	= "portuguese-brazilian";
                $config["charset"] = "UTF-8";
                $config["enable_hooks"] = FALSE;
                $config["subclass_prefix"] = "MY_";
                $config["composer_autoload"] = FALSE;
                $config["permitted_uri_chars"] = "a-z 0-9~%.:_\-";
                $config["allow_get_array"] = TRUE;
                $config["enable_query_strings"] = FALSE;
                $config["controller_trigger"] = "c";
                $config["function_trigger"] = "m";
                $config["directory_trigger"] = "d";
                $config["log_threshold"] = 0;
                $config["log_path"] = "";
                $config["log_file_extension"] = "";
                $config["log_file_permissions"] = 0644;
                $config["log_date_format"] = "Y-m-d H:i:s";
                $config["error_views_path"] = "";
                $config["cache_path"] = "";
                $config["cache_query_string"] = FALSE;
                $config["encryption_key"] = "'.$this->input->post('chave_seg').'";
                $config["sess_driver"] = "files";
                $config["sess_cookie_name"] = "ci_session";
                $config["sess_expiration"] = '.$this->input->post('tempo_sessao').';
                $config["sess_save_path"] = NULL;
                $config["sess_match_ip"] = TRUE;
                $config["sess_time_to_update"] = 300;
                $config["sess_regenerate_destroy"] = FALSE;
                $config["cookie_prefix"]	= "";
                $config["cookie_domain"]	= "";
                $config["cookie_path"]		= "/";
                $config["cookie_secure"]	= FALSE;
                $config["cookie_httponly"] 	= FALSE;
                $config["standardize_newlines"] = FALSE;
                $config["global_xss_filtering"] = FALSE;
                $config["csrf_protection"] = FALSE;
                $config["csrf_token_name"] = "csrf_test_name";
                $config["csrf_cookie_name"] = "csrf_cookie_name";
                $config["csrf_expire"] = 7200;
                $config["csrf_regenerate"] = TRUE;
                $config["csrf_exclude_uris"] = array();
                $config["compress_output"] = FALSE;
                $config["time_reference"] = "local";
                $config["rewrite_short_tags"] = FALSE;
                $config["proxy_ips"] = "";
                ';
            write_file('./application/config/config.php', trim($arquivo_config));
            
            $arquivo_bd = '<?php
                defined("BASEPATH") OR exit("No direct script access allowed");
                $active_group = "default";
                $query_builder = TRUE;

                $db["default"] = array(
                        "dsn"	=> "",
                        "hostname" => "'.$this->input->post('hostname').'",
                        "username" => "'.$this->input->post('username').'",
                        "password" => "'.$this->input->post('password').'",
                        "database" => "'.$this->input->post('database').'",
                        "dbdriver" => "mysqli",
                        "dbprefix" => "",
                        "pconnect" => FALSE,
                        "db_debug" => (ENVIRONMENT !== "production"),
                        "cache_on" => FALSE,
                        "cachedir" => "",
                        "char_set" => "utf8",
                        "dbcollat" => "utf8_general_ci",
                        "swap_pre" => "",
                        "encrypt" => FALSE,
                        "compress" => FALSE,
                        "stricton" => FALSE,
                        "failover" => array(),
                        "save_queries" => TRUE
                );
                ';
            write_file('./application/config/database.php', trim($arquivo_bd));  
            
            //conectar o banco de dados
            $this->load->database();
            $this->db->reconnect();
            
            //criar as tabelas
            $sql_db = "CREATE TABLE IF NOT EXISTS `auditoria` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usuario` varchar(45) NOT NULL,
                    `data_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `operacao` varchar(45) NOT NULL,
                    `query` text NOT NULL,
                    `observacao` text NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";
            $this->db->query($sql_db);
            $sql_db = "CREATE TABLE IF NOT EXISTS `configuracoes` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nome_config` varchar(255) NOT NULL,
                    `valor_config` text NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";
            $this->db->query($sql_db);
            $sql_db = "CREATE TABLE IF NOT EXISTS `midia` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nome` varchar(45) NOT NULL,
                    `descricao` varchar(255) NOT NULL,
                    `arquivo` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
                  ";
            $this->db->query($sql_db);
            $sql_db = "CREATE TABLE IF NOT EXISTS `paginas` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `titulo` varchar(255) NOT NULL,
                    `slug` varchar(255) NOT NULL,
                    `conteudo` longtext NOT NULL,
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";
            $this->db->query($sql_db);
            $sql_db = "CREATE TABLE IF NOT EXISTS `usuarios` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nome` varchar(100) NOT NULL,
                    `email` varchar(100) NOT NULL,
                    `login` varchar(45) NOT NULL,
                    `senha` varchar(32) NOT NULL,
                    `ativo` tinyint(1) NOT NULL DEFAULT '1',
                    `adm` tinyint(1) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;";
            $criacao_db = $this->db->query($sql_db);
            //criar o primeiro usuário
            if($criacao_db){
                $info['nome'] = $this->input->post('user_nome');
                $info['email'] = $this->input->post('user_email');
                $info['login'] = $this->input->post('user_login');
                $info['senha'] = md5($this->input->post('user_senha'));
                $info['adm'] = 1;
                $usuario = $this->db->insert('usuarios', $info);
                if($usuario = TRUE){
                    redirect('instalar/sucesso');
                }
            }
        }
        set_tema('template','instalar_view');
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
		});
	</script>', FALSE);
        set_tema('titulo', 'Instalação do Sistema');
        set_tema('conteudo', load_modulo('instalar', 'instalar'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
    public function sucesso(){
        iniciar_painel();
        set_tema('template','instalar_view');
        set_tema('footerinc', '<script>
		$(document).ready(function() {
			App.init();
		});
	</script>', FALSE);
        set_tema('template', 'sucesso_view');
        set_tema('titulo', 'Instalação Concluída');
        set_tema('conteudo', load_modulo('instalar', 'sucesso'));
        set_tema('rodape', '');//vai substituir o rodape padrao
        load_template();
        
    }
    
}
