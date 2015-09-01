<div id="container">
    <div class="page-header">
        <h1>Acervo&nbsp;<small>Listagem</small></h1><br/>
        <a class="btn btn-success alteraFonte" href="<?php echo base_url('admin/conteudo/cadastrar-acervo'); ?>"><span class="glyphicon glyphicon-plus"></span> Novo</a>
    </div>
    <?php
// Cabeçalho da tabela
    $this->table->set_heading('<b>Título</b>', '<b>Autor</b>', '<b>Data</b>', '<b>Ações</b>');
//var_dump($categorias);exit();
    foreach ($conteudos as $conteudo) {
        if($conteudo['rascunho']){$rascunho = img('assets/images/ok.png');}else{$rascunho = '';}
        $this->table->add_row(substr($conteudo['titulo'], 0, 65), $conteudo['autor'], date('d/m/Y',strtotime($conteudo['data'])), 
        opcoes2(
            base_url('admin/conteudo/excluirAcervo/' . $conteudo['idConteudo']), base_url('admin/conteudo/alterarAcervo/' . $conteudo['idConteudo']))
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