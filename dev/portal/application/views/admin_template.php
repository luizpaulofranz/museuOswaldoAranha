<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Administração Museu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Layout para área administrativa">
        <meta name="author" content="Luiz Paulo Franz">
        <!-- CSS -->
        <link href="<?php echo site_url('assets/css/normalize.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/plugins/magnific-popup/magnific-popup.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assets/css/admin/custom.css'); ?>" rel="stylesheet">
        <!-- CSS adicionado para o icone destaque das imagens do conteudo -->
        <link href="<?php echo site_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" >
        <style type="text/css">
            body {
                padding-top: 10px;
            }
        </style>

        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo site_url(); ?>img/tools.ico">
    </head>

    <body>
        <div class="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- agrupa os botoes do menu quando for responsivo -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-admin">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo site_url('admin')?>">Museu</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="menu-admin">
                        <?php
                        echo isset($menu_superior) ? $menu_superior : NULL;
                        ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container -->
            </nav> 

            <div class="container">
                <!-- Mensagem de Javascript desabilitado -->
                <noscript>
                <div class="alert alert-danger">
                    <p><strong>Atenção!</strong><br>
                        Javascript está desativado ou não é suportado pelo seu navegador. Por favor <a href="http://browsehappy.com/" target="_blank">atualize seu Navegador</a> ou <a href="http://support.google.com/websearch/bin/answer.py?hl=pt-BR&answer=23852">ative o Javascript</a> para navegar pela interface adequadamente.</p>
                </div>
                </noscript>
                <!-- Conteúdo -->
                <?php
                echo isset($conteudo) ? $conteudo : NULL;
                ?>
            </div><!-- /container -->
        </div> 
        
        <div class="push"><!--//--></div>
        <footer>
            <div class="container">
                <a href="https://github.com/luizpaulofranz/museuOswaldoAranha/blob/master/LICENSE">Copyright</a> © 2015. Desdigned by Museu Oswaldo Aranha.
            </div>
        </footer>        
        <!-- javascript -->
        <script src="<?php echo site_url('assets/plugins/jquery/jquery.min.js')?>" type="text/javascript" ></script>
        <script src="<?php echo site_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>" type="text/javascript" ></script>
        <script src="<?php echo site_url('assets/plugins/magnific-popup/magnific-popup.js'); ?>" type="text/javascript" ></script>
        <script src="<?php echo site_url('assets/plugins/magnific-popup/magnific-popup-traducao.js'); ?>" type="text/javascript" ></script>
        <script src="<?php echo site_url('assets/js/plugins/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/admin/custom.js'); ?>" type="text/javascript" ></script>
    </body>
</html>
