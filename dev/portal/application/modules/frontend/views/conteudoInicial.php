<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content inicial">
        <article class="grid-4">
            <h2 class="header_box bg-pink-white fontsize45 al-center font-oswald-light font-thin2 header_box_shadow">VISITE</h2>
            <ul class="menu_section">
                <li><a href="<?php echo site_url('visite')?>" a><img src="" alt=""><img src="../assets/images/home/visite/map-icon.png" alt="Ícone Como Chegar"><p>SAIBA COMO </p><p>CHEGAR</p></a></li>
                <li><a href="<?php echo site_url('visite')?>" a><img src="" alt=""><img src="../assets/images/home/visite/horarios-icon.png" alt="Ícone Como Horários"><p>VEJA OS</p><p> HORÁRIOS</p></a></li>
                <li><a href="<?php echo site_url('visite')?>" a><img src="" alt=""><img src="../assets/images/home/visite/regras-icon.png" alt="Ícone Regras"><p>REGRAS </p><p>DO MUSEU</p></a></li>
                <li><a href="<?php echo site_url('visite')?>" a><img src="" alt=""><img src="../assets/images/home/visite/agende-icon.png" alt="Ícone Agende Sua Visita"><p>AGENDE SUA</p><p> VISITA</p></a></li>
            </ul>
        </article>
        <article class="grid-4">
            <h2 class="header_box bg-pink-white fontsize45 al-center font-oswald-light font-thin2 header_box_shadow">APRENDA</h2>
            <ul class="menu_section">
                <li><a href="<?php echo site_url('aprenda')?>" a><img src="" alt=""><img src="../assets/images/home/aprenda/history-icon.png" alt="Ícone História de Oswaldo Aranha"><p>HISTÓRIA DE </p><p>OSWALDO A.</p></a></li>
                <li><a href="<?php echo site_url('aprenda')?>" a><img src="" alt=""><img src="../assets/images/home/aprenda/acervo-icon.png" alt="Ícone Acervo do Museu"><p>ACERVO DO</p><p> MUSEU</p></a></li>
                <li><a href="<?php echo site_url('aprenda')?>" a><img src="" alt=""><img src="../assets/images/home/aprenda/article-icon.png" alt="Ícone Acervo Científico"><p>ACERVO </p><p>CIENTÍFICO</p></a></li>
            </ul>
        </article>
        <article class="grid-4">
            <h2 class="header_box bg-pink-white fontsize45 al-center font-oswald-light font-thin2 header_box_shadow">NOTÍCIAS</h2>
            <ul class="menu_section">
                <li><a href="<?php echo site_url('conteudo/noticias')?>" a><img src="" alt=""><img src="../assets/images/home/noticias/noticias-icon.png" alt="Ícone Noticias"><p>VEJA NOSSAS </p><p>NOTÍCIAS</p></a></li>
                <li><a href="<?php echo site_url('conteudo/eventos')?>" a><img src="" alt=""><img src="../assets/images/home/eventos/events-icon.png" alt="Ícone Eventos"><p>PRÓXIMOS </p><p> EVENTOS</p></a></li>
            </ul>
        </article>
        <article class="grid-4 game_box">
            <h2 class="al-center fontsize60"><p>JOGO DO MUSEU</p></h2>
            <p class="al-center fontsize1b" style="margin-top: 30px;">Confira o jogo feito em homenagem ao museu Oswaldo Aranha.</p>
            <a href="aprenda_jogo_museu.php" class="btn_game bg-pink-white header_box_shadow ds-block al-center fontsize30 font-bold">JOGUE AGORA</a>
        </article>
    </div>
</section>

<section class="container container-padding-60 section-2">
    <div class="content al-center">
        <blockquote class="font-georgia" style="color: #ffffff;">
            <p class="fontsize1b" style="margin-bottom: 20px;">"A tradição é a experiência dos povos consagrada pelo tempo."</p>
            <cite>Oswaldo Aranha</cite>
        </blockquote>
    </div>
</section>

<section class="container container-padding-60 al-center" style="background: #ffffff;">
    <div class="content">
        <header class="content" style="background: #ff6666; height: 5px">
            <h2 class="fontsize25 font-pink font-oswald-light al-center ds-inblock news_style">NOVIDADES</h2>;
        </header>

        <div style="margin-top: 40px; width: 100%">
            <?php
            //var_dump($noticias);exit();
            foreach ($noticias as $noticia) {
                echo '<article class="grid-1-3">';
                echo '<a href="'.site_url('conteudo/visualizar/'.$noticia['slug']).'">';
                if($noticia['imagem']){
                    echo '<div class="box-news border-pink" style="background: url('.site_url($noticia['urlPath'].'/'.'med_'.$noticia['imagem']).') no-repeat center; background-size: cover;"></div>';
                }else{
                    echo '<div class="box-news border-pink" style="background: url('.site_url('assets/images/img_nao_disponivel.png').') no-repeat center; background-size: cover;"></div>';
                }
                echo '<p class="al-left font-oswald-light font-pink news_description fontsize18 ds-block border-grey" style="min-height:58px;">'.substr($noticia['titulo'], 0, 70).'</p>';
                echo '</a>';
                echo '</article>';
            }
            ?>
        </div>
        
    </div>
</section>