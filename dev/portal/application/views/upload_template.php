<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Administração Smartpampa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Layout para área administrativa">
        <meta name="author" content="Luiz Paulo Franz, luizpaulofranz@gmail.com">
        <!-- CSS -->
        <link href="<?php echo base_url('assets/css/reset.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/admin/custom.css'); ?>" rel="stylesheet">

        <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>" type="text/javascript" ></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>" type="text/javascript" ></script>
        <script src="<?php echo base_url('assets/js/admin/custom.js'); ?>" type="text/javascript" ></script>
    </head>

    <body>
        <?php
        //esse template, sem nada eh utilizado para escrever apenas o botão de upload de arquivos.
        echo isset($conteudo) ? $conteudo : NULL;
        ?>
    </body>
</html>
