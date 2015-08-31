<?php
echo '<div>';
echo '<div class="page-header">';
echo heading('Produto <small>Cadastrar Imagem</small>');
echo '<br/><a class="btn btn-primary" href="' . base_url('admin/produto/alterar' . '/' . set_value('idProduto') . '#sectionB') . '"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>';
echo '</div></div>';
echo isset($mensagem) ? $mensagem : NULL;

echo form_open_multipart(current_url(), array('class' => 'form-horizontal', 'accept-charset' => 'utf-8', 'role' => 'form'));
echo form_hidden('idMedia', set_value('idMedia'));
echo form_hidden('idProduto', set_value('idProduto'));
echo form_fieldset();

/* Input = Produto */
echo '<div class="form-group">';
echo form_label('Produto', 'produto', array('class' => 'col-sm-2 control-label'));
echo '<div class="col-sm-10">';
echo '<p class="form-control-static">' . $produto . '</p>';
//echo form_input(array('name'=>'media_descricao', 'class'=>'form-control', 'value'=>isset($registro->media_descricao) ? $registro->media_descricao : NULL, 'id'=>'media_descricao', 'placeholder'=>'Digite aqui'));
echo '</div></div>';

/* Input = Descricao */
echo '<div class="form-group">';
echo form_label('Descrição', 'descricao', array('class' => 'col-sm-2 control-label', 'for' => 'descricao'));
echo '<div class="col-sm-10">';
echo form_input(array('name' => 'descricao', 'class' => 'form-control', 'value' => set_value('descricao'), 'id' => 'descricao', 'placeholder' => 'Digite aqui'));
echo '</div></div>';

/* Input = Arquivo */
if (!set_value('idMedia')) {
    echo '<div class="form-group">';
    echo form_label('Arquivo', 'arquivo', array('class' => 'col-sm-2 control-label', 'for' => 'arquivo'));
    echo '<div class="col-sm-10">';
    echo form_upload(array('name' => 'arquivo', 'id' => 'arquivo', 'accept' => 'jpg|jpeg|png|gif'));
    echo '</div></div>';
}

echo form_fieldset_close();
echo '<div class="form-group">';
echo '<div class="col-sm-offset-2 col-sm-10">';
echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'enviar', 'class' => 'btn btn-success', 'value' => 'Cadastrar'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar');
echo '</div></div>';
echo form_close();
?>