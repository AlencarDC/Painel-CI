
<!DOCTYPE html>

<html lang="pt-BR">
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
<body class="bg-white p-t-0 pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin coming-soon -->
        <div class="coming-soon">
            <div class="coming-soon-header" style="background:url(http://localhost/painelci/css/img/coming-soon.jpg)" >
                <div class="bg-cover"></div>
                <div class="brand">
                   {conteudo}
                </div>
                <div class="timer">
                    <div id="timer"></div>
                </div>
                <div class="desc">
                    O Painel de Administração foi instalado com sucesso. Agora você já pode fazer o login e começar a utilizá-lo.
                </div>
            </div>
            <div class="coming-soon-content">
                <div class="desc">
                    Faça o <b>login</b> para prosseguir!<br />
                </div>
                <div class="input-group">
                    <?php echo anchor(base_url('usuarios/login'), 'Fazer Login', array('class'=>'btn m-b-15 btn-lg btn-success')); ?>
                </div>
                <p>
                    Siga-nos no
                    <a href="#"><i class="fa fa-twitter fa-fw"></i> Twitter</a> e
                    <a href="#"><i class="fa fa-facebook fa-fw"></i> Facebook</a>
                </p>
            </div>
        </div>
        <!-- end coming-soon -->

	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	{footerinc}
	
	
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.9/admin/html/extra_coming_soon.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Dec 2015 18:03:12 GMT -->
</html>



