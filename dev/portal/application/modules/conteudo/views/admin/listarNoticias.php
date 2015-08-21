<div id="container">
    <div class="page-header">
        <h1>Notícias&nbsp;<small>Listagem</small></h1><br/>
        <a class="btn btn-success" href="<?php echo base_url('admin/conteudo/cadastrar-noticia'); ?>"><span class="glyphicon glyphicon-plus"></span> Novo</a>
    </div>
    <?php
// Cabeçalho da tabela
    $this->table->set_heading('<b>Título</b>', '<b>Autor</b>', '<b>Data</b>', '<b>Rascunho</b>', '<b>Ações</b>');
//var_dump($categorias);exit();
    foreach ($conteudos as $conteudo) {
        if($conteudo['rascunho']){$rascunho = img('assets/images/ok.png');}else{$rascunho = '';}
        $this->table->add_row(substr($conteudo['titulo'], 0, 65), $conteudo['autor'], date('d/m/Y',strtotime($conteudo['data'])), $rascunho, 
        opcoes2(
            base_url('admin/conteudo/excluirNoticia/' . $conteudo['idConteudo']), base_url('admin/conteudo/alterarNoticia/' . $conteudo['idConteudo']))
        );
    }

    echo $this->pagination->create_links();
    $this->table->set_template($this->config->item('tabela_lista'));
    // Gerar a tabela
    if (count($conteudos) > 0) {
        echo $this->table->generate();
    } else {
        echo alert("Não há registros, clique em novo para cadastrar." , 'success');
    }
    ?>
</div>