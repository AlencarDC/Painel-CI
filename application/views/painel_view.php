<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php if(isset($titulo)){ ?>{titulo} | <?php } ?>{titulo_padrao}</title>
        <link rel="stylesheet" href="../../css/foundation.css" />
        <link rel="stylesheet" href="../css/app.css" />
    </head>
    <body>
        {conteudo}
      
        
        {rodape}
        <script src="js/foundation.min.js"></script>
    </body>
</html>