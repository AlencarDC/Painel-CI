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
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <div id="page-container" class="fade">
            <div class="login bg-black animated fadeInDown">
                <!-- begin brand -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> Painel ADM - Login
                        <small>painel de administração com Code Igniter</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                {conteudo}
            </div>
        </div>
        {rodape}
        {footerinc}
        <script>
		$(document).ready(function() {
			App.init();
		});
	</script>
    </body>
</html>