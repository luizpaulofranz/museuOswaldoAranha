<?php
//var_dump($noticias);exit();
?>
<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content">

        <header class="content" style="background: #993333; height: 5px">
            <h2 class="fontsize25 font-vinho font-oswald-light al-center ds-inblock news_style">ACERVO DO MUSEU</h2>;
        </header>
        <br><br><br>

        <?php
        if(empty($itens)){
            echo '<h2>Não há itens a exibir =/<h2>';
        }else{
            foreach ($itens as $item) { 
                echo '<div>';
                echo '<div style="background-color: rgba(198, 198, 198, 0.0); border-radius: 2px; height: 230px; padding-top: 16px;">';
                //echo '<a href="'.site_url('conteudo/visualizar/'.$item['slug']).'">';
                if($item['imagem']){
                    echo '<a class="gallery-item" href="'.site_url($item['urlPath'].'/'.$item['imagem']).'">';
                    echo '<img alt="" src="'.site_url($item['urlPath'].'/med_'.$item['imagem']).'" class="ds-block grid-4">';
                    echo '</a>';
                }else{
                    echo '<img alt="" src="'.site_url('assets/images/img_nao_disponivel.png').'" class="ds-block grid-4">';
                }
                //echo '</a>';
                echo '<div class="grid-12">';
                echo '<h2 class="ds-inblock">'.$item['titulo'].'</h2> <br>';
                echo '<p class="ds-inblock">'.date('d/m/Y', strtotime($item['data'])).'</p>';
                echo '<p>'.$item['resumo'].'</p>';
                echo '</div>';
                echo '<div style="margin-top: 110px;" class="fl-left grid-9 border-grey">';
                echo '<div class="font-oswald-light font-bold fontsize1b" style="color: #993333">&nbsp;</div>';
                //echo '<a href="'.site_url('conteudo/visualizar/'.$item['slug']).'" class="font-oswald-light font-bold fontsize1b" style="color: #993333">Leia mais...</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

    </div>
</section>