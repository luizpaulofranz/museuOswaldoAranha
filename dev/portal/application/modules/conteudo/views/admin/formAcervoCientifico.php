<?php
$class = '';
if (set_value('idConteudo', false) == false) {
    $class = 'disabled';
}
?>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<div>
    <div class="page-header">    
        <h1>Conteúdo <small>Acervo Científico</small></h1>
    </div>
</div>
<?php echo isset($mensagem) ? $mensagem : NULL; ?>

<form action="<?php echo current_url() ?>" class="form-horizontal" accept-charset="utf-8" role="form" method="POST">
    <?php
    echo form_hidden('idConteudo', set_value('idConteudo'));
    echo form_hidden('idAdministrador', $this->session->userdata['idAdministrador']);
    echo form_hidden('idTipoConteudo', set_value('idTipoConteudo'));
    ?>
    <fieldset>
        <div class="form-group <?php if (form_error('conteudo') != "") echo "has-error"; ?>">
            <label for="conteudo" class="col-sm-12 alteraFonte" style="text-align: center">Conteúdo</label>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <textarea class="ckeditor" name="conteudo" rows="40"><?php echo set_value('conteudo') ?></textarea><br/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <?php echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'publicar', 'class' => 'btn btn-success alteraFonte', 'value' => 'Publicar'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar'); ?>
            </div>
        </div>
    </fieldset>
</form>
