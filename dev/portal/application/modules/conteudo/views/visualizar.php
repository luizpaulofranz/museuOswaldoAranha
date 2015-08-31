<?php
//var_dump($noticia);exit();
?>
<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content">

        <header class="content" style="background: #993333; height: 5px">
            <h2 class="fontsize25 font-vinho font-oswald-light al-center ds-inblock news_style"><?php echo $noticia['titulo'];?></h2>;
        </header>
        <br><br><br>

        <div class="noticias">
            <?php echo $noticia['conteudo'];?>
        </div>
</section>