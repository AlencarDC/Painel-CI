<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-BR">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php if(isset($titulo)){ ?>{titulo} | <?php } ?>{titulo_padrao}</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	{headerinc}
	<!-- ================== END BASE CSS STYLE ================== -->

</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="http://localhost/painelci/css/img/bg-8.jpg" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Instalação: Painel de Administração com Code Igniter</h4>
                    <p>
                        Instalar o Painel de Administração desenvolvido com Code Igniter é muito fácil. Preencha os campos ao lado.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    Instalar
                    <small>Preencha todos os campos corretamento e com muita atenção.</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">
                    {conteudo}
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
        
        {rodape}
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	{footerinc}
	<!-- ================== END BASE JS ================== -->
	
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/register_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 18:04:40 GMT -->
</html>