<?php
//var_dump($eventos);exit();
?>
<section class="container container-padding-60 al-center" style="background: #ffffff;">
    <div class="content">
        <header class="content" style="background: #993333; height: 5px">
            <h2 class="fontsize25 font-vinho font-oswald-light al-center ds-inblock news_style">EVENTOS</h2>;
        </header>

        <div style="margin-top: 40px; width: 100%">
            <?php 
            foreach ($eventos as $evento) {
                echo '<article class="grid-1-3">';
                echo '<a href="'.site_url('conteudo/visualizar/'.$evento['slug']).'">';
                if($evento['imagem']){
                    echo '<div class="box-news border-vinho" style="background: url('.site_url($evento['urlPath'].'/'.'med_'.$evento['imagem']).') no-repeat center; background-size: cover;"></div>';
                }else{
                    echo '<div class="box-news border-vinho" style="background: url('.site_url('assets/images/img_nao_disponivel.png').') no-repeat center; background-size: cover;"></div>';
                }
                echo '<p class="al-left font-oswald-light font-vinho news_description fontsize18 ds-block border-grey">'.substr($evento['titulo'], 0, 38).'<br>';
                echo date('d/m/Y - H:s', strtotime($evento['data']));
                echo '</p>';
                echo '</a>';
                echo '</article>';
            }
            ?>
            
        </div>

    </div>
</section>