<div id="container">
    <div class="page-header">
        <h1>Editorias&nbsp;<small>Listagem</small></h1><br/>
        <a class="btn btn-success" href="<?php echo site_url('admin/editoria/cadastrar'); ?>"><span class="glyphicon glyphicon-plus"></span> Novo</a>
    </div>
    <?php
// Cabeçalho da tabela
    $this->table->set_heading('Editoria', 'Ações');
//var_dump($categorias);exit();
    foreach ($editorias->result() as $editoria) {
        $this->table->add_row($editoria->nome, opcoes2(
            site_url('admin/editoria/excluir/' . $editoria->id), site_url('admin/editoria/alterar/' . $editoria->id))
        );
    }

    echo $this->pagination->create_links();
// Carregar arquivo pagination em $autoload['libraries'] -- config/autoload.php
// Template de Tabela (config/cfg.php)
// Carregar arquivo cfg em $autoload['config'] -- config/autoload.php
// Carregar arquivo table em $autoload['libraries'] -- config/autoload.php 
    $this->table->set_template($this->config->item('tabela_lista'));

// Gerar a tabela
    if ($editorias->num_rows() > 0) {
        echo $this->table->generate();
    } else {
        echo alert("Não há registros, clique em novo para cadastrar." , 'success');
    }
    ?>
</div>