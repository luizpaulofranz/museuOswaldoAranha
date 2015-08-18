<?php

echo '<div>';
echo '<div class="page-header">';
echo heading('Editoria <small>Cadastro de Editorias</small>');
echo '<br/><a class="btn btn-primary" href="'.site_url('admin/editoria/pg').'"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>';
echo '</div></div>';
echo isset($mensagem) ? $mensagem : NULL;

echo form_open(current_url(), array('class'=>'form-horizontal', 'accept-charset'=>'utf-8', 'role'=>'form'));
echo form_hidden('id', isset($registro->id) ? $registro->id : NULL);
echo form_fieldset();
/* Input = Descricao */
echo '<div class="form-group">';
echo form_label('Nome', 'nome', array('class'=>'col-sm-2 control-label', 'for'=>'nome'));
echo '<div class="col-sm-10">';
echo form_input(array('name'=>'nome', 'class'=>'form-control', 'value'=>isset($registro->nome) ? $registro->nome : NULL, 'id'=>'nome', 'placeholder'=>'Digite aqui'));
echo '</div></div>';
/* submit */
echo form_fieldset_close();
echo '<div class="form-group">';
echo '<div class="col-sm-offset-2 col-sm-10">';
echo form_button(array('type'=>'submit', 'name'=>'button','id'=>'enviar','class'=>'btn btn-success', 'value'=>'Salvar'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar');
echo '</div></div>';
echo form_close();
?>