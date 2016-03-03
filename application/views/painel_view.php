<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php if(isset($titulo)){ ?>{titulo} | <?php } ?>{titulo_padrao}</title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        {headerinc}
    </head>
    <body class="pace-top">
       <?php if(esta_logado(FALSE)): ?>
        <!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
            <!-- begin #header -->
            <div id="header" class="header navbar navbar-default navbar-fixed-top">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    <!-- begin mobile sidebar expand / collapse button -->
                    <div class="navbar-header">
                        <a href="<?php echo base_url('painel'); ?>" class="navbar-brand"><span class="navbar-logo"></span>Painel Admin</a>
                        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- end mobile sidebar expand / collapse button -->

                    <!-- begin header navigation right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown navbar-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                                <span class="hidden-xs"><?php echo $this->session->userdata('usuario_nome'); ?></span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu animated fadeInLeft">
                                <li class="arrow"></li>
                                <li><?php echo anchor('usuarios/alterar_senha/'.$this->session->userdata('usuario_id'), 'Alterar senha'); ?></li>
                                <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                                <li class="divider"></li>
                                <li><?php echo anchor('usuarios/logoff', 'Sair'); ?></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end header navigation right -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end #header -->
            
            <!-- begin #sidebar -->
            <div id="sidebar" class="sidebar">
                <!-- begin sidebar scrollbar -->
                <div data-scrollbar="true" data-height="100%">
                    <!-- begin sidebar user -->
                    <ul class="nav">
                        <li class="nav-profile">
                            <div class="info">
                                <?php echo $this->session->userdata('usuario_nome'); ?>
                                <small><?php echo $this->session->userdata('usuario_login').' | '.$this->session->userdata('usuario_email'); ?></small>
                            </div>
                        </li>
                    </ul>
                        <!-- end sidebar user -->
                        <!-- begin sidebar nav -->
                        <ul class="nav">
                                <li class="nav-header">Menu</li>
                                <li class="has-sub <?php echo (ucfirst($this->router->class) == 'Usuarios') ? 'active': ''; ?>">
                                        <a href="javascript:;">
                                            <b class="caret pull-right"></b>
                                            <i class="fa fa-users"></i>
                                            <span>Usuários</span>
                                    </a>
                                        <ul class="sub-menu">
                                            <li <?php echo ($this->router->method == 'gerenciar') ? 'class="active"': ''; ?> > <?php echo anchor('usuarios/gerenciar', 'Gerenciar'); ?></li>
                                            <li <?php echo ($this->router->method == 'cadastrar') ? 'class="active"': ''; ?> > <?php echo anchor('usuarios/cadastrar', 'Cadastrar'); ?></li>
                                        </ul>
                                </li>
                                <li class="has-sub <?php echo (ucfirst($this->router->class) == 'Midia') ? 'active': ''; ?>">
                                        <a href="javascript:;">
                                            <b class="caret pull-right"></b>
                                            <i class="fa fa-cogs"></i>
                                            <span>Mídia</span>
                                    </a>
                                        <ul class="sub-menu">
                                            <li <?php echo ($this->router->method == 'gerenciar') ? 'class="active"': ''; ?> > <?php echo anchor('midia/gerenciar', 'Gerenciar'); ?></li>
                                            <li <?php echo ($this->router->method == 'inserir') ? 'class="active"': ''; ?> > <?php echo anchor('midia/inserir', 'Inserir Mídias'); ?></li>
                                        </ul>
                                </li>
                                <li class="has-sub <?php echo (ucfirst($this->router->class) == 'Auditoria') ? 'active': ''; ?>">
                                        <a href="javascript:;">
                                            <b class="caret pull-right"></b>
                                            <i class="fa fa-cogs"></i>
                                            <span>Administração</span>
                                    </a>
                                        <ul class="sub-menu">
                                            <li <?php echo ($this->router->method == 'gerenciar') ? 'class="active"': ''; ?> > <?php echo anchor('auditoria/gerenciar', 'Auditoria'); ?></li>
                                        </ul>
                                </li>
                                <li class="has-sub">
                                        <a href="javascript:;">
                                                <span class="badge pull-right">10</span>
                                                <i class="fa fa-inbox"></i> 
                                                <span>Email</span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="email_inbox.html">Inbox v1</a></li>
                                        </ul>
                                </li>
                                <li class="has-sub">
                                        <a href="javascript:;">
                                            <b class="caret pull-right"></b>
                                            <i class="fa fa-suitcase"></i>
                                            <span>UI Elements</span> 
                                        </a>
                                        <ul class="sub-menu">
                                                <li><a href="ui_general.html">General</a></li>
                                        </ul>
                                </li>
                                <li class="has-sub">
                                        <a href="javascript:;">
                                            <b class="caret pull-right"></b>
                                            <i class="fa fa-file-o"></i>
                                            <span>Form Stuff</span> 
                                        </a>
                                        <ul class="sub-menu">
                                                <li><a href="form_elements.html">Form Elements</a></li>
                                        </ul>
                                </li>
                        <!-- begin sidebar minify button -->
                                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                        <!-- end sidebar minify button -->
                        </ul>
                        <!-- end sidebar nav -->
                </div>
                <!-- end sidebar scrollbar -->
            </div>
            <div class="sidebar-bg"></div>
            <!-- end #sidebar -->

        
       <?php endif; ?>
        {conteudo}
            
        {rodape}
       <?php if(esta_logado(FALSE)): ?>
        </div>
        <?php endif; ?>
        {footerinc}
        
    </body>
</html>