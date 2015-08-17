<?php
echo '<div>';
echo '<div class="page-header">';
echo heading('Administrador <small>Cadastro de Administradores</small>');
echo '<br/><a class="btn btn-primary" href="' . base_url('admin/administrador/pg') . '"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>';
echo '</div></div>';
echo isset($mensagem) ? $mensagem : NULL;


echo form_open(current_url(), array('class' => 'form-horizontal', 'accept-charset' => 'utf-8', 'role' => 'form'));
echo form_hidden('idAdministrador', set_value('idAdministrador'));
echo form_fieldset();
/* Input = Nome */
echo '<div class="form-group">';
echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label', 'for' => 'nome'));
echo '<div class="col-sm-10">';
echo form_input(array('name' => 'nome', 'class' => 'form-control', 'value' => set_value('nome'), 'id' => 'nome', 'placeholder' => 'Mario Nascimento'));
echo '</div></div>';
/* Input = Email */
echo '<div class="form-group">';
echo form_label('Email', 'email', array('class' => 'col-sm-2 control-label', 'for' => 'email'));
echo '<div class="col-sm-10">';
echo form_input(array('name' => 'email', 'class' => 'form-control', 'value' => set_value('email'), 'id' => 'email', 'placeholder' => 'mario_nasc@gmail.com', 'type' => 'email'));
echo '</div></div>';
/* Input = Senha */
echo '<div class="form-group">';
echo form_label('Senha', 'senha', array('class' => 'col-sm-2 control-label', 'for' => 'senha'));
echo '<div class="col-sm-10">';
echo form_input(array('name' => 'senha', 'class' => 'form-control', 'id' => 'senha', 'type' => 'password', 'placeholder' => 'Gb5@1c4'));
echo '</div></div>';
?>
<div class="form-group">
    <label for="ativo" class="col-sm-2 control-label">Ativo</label>
    <div class="col-sm-10">
        <div class="checkbox">
            <label style="display: inherit">
                <?php
                if (set_value('ativo') == 1 || set_value('ativo') == '') {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                ?>
                <input type="checkbox" name="ativo" id="ativo" value="1" <?php echo $checked ?>/>
            </label>
        </div>
    </div>
</div>
<?php
echo form_fieldset_close();
echo '<div class="form-group">';
echo '<div class="col-sm-offset-2 col-sm-10">';
echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'enviar', 'class' => 'btn btn-success', 'value' => 'Cadastrar'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar');
echo '</div></div>';
echo form_close();
?>