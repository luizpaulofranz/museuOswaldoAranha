<?php
//var_dump($noticias);exit();
?>
<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content">

        <header class="content" style="background: #993333; height: 5px">
            <h2 class="fontsize25 font-vinho font-oswald-light al-center ds-inblock news_style">NOTÍCIAS</h2>;
        </header>
        <br><br><br>

        <?php
        if(empty($noticias)){
            echo '<h2>Não há notícias a exibir =/<h2>';
        }else{
            foreach ($noticias as $noticia) { 
                echo '<div>';
                echo '<div style="background-color: rgba(198, 198, 198, 0.0); border-radius: 2px; height: 230px; padding-top: 16px;">';
                echo '<a href="'.site_url('conteudo/visualizar/'.$noticia['slug']).'">';
                if($noticia['imagem']){
                    echo '<img alt="" src="'.site_url($noticia['urlPath'].'/'.$noticia['imagem']).'" class="ds-block grid-4">';
                }else{
                    echo '<img alt="" src="'.site_url('assets/images/img_nao_disponivel.png').'" class="ds-block grid-4">';
                }
                echo '</a>';
                echo '<div class="grid-12">';
                echo '<h2 class="ds-inblock">'.$noticia['titulo'].'</h2> <br>';
                echo '<p class="ds-inblock">'.date('d/m/Y', strtotime($noticia['data'])).'</p>';
                echo '<p>'.$noticia['resumo'].'</p>';
                echo '</div>';
                echo '<div style="margin-top: 110px;" class="fl-left grid-9 border-grey">';
                echo '<a href="'.site_url('conteudo/visualizar/'.$noticia['slug']).'" class="font-oswald-light font-bold fontsize1b" style="color: #993333">Leia mais...</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

    </div>
</section>