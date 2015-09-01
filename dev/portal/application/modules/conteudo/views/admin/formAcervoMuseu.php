<?php
$class = '';
if (set_value('idConteudo', false) == false) {
    $class = 'disabled';
}
?>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<div>
    <div class="page-header">    
        <h1>Conteúdo <small>Cadastro de Item de Acervo</small></h1>
        <a class="btn btn-primary alteraFonte" href="<?php echo base_url('admin/conteudo/acervo-museu') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>&nbsp;&nbsp;

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
        <div class="form-group <?php if (form_error('titulo') != "") echo "has-error"; ?>">
            <label for="titulo" class="col-sm-2 control-label alteraFonte">Título</label>
            <div class="col-sm-10">
                <?php echo form_input(array('onkeyup' => 'limitaCaractere(\'titulo\', 80, \'exibeLimiteTitulo\')', 'id' => 'titulo', 'name' => 'titulo', 'class' => 'form-control', 'value' => set_value('titulo'), 'id' => 'titulo', 'placeholder' => 'Digite aqui')); ?>
                <p class="help-block" id="exibeLimiteTitulo">O título possui um limite máximo de 80 caracteres.</p>

            </div>
        </div>
        <div class="form-group <?php if (form_error('slug') != "") echo "has-error"; ?>">    
            <label for="slug" class="col-sm-2 control-label alteraFonte">Slug</label>
            <div class="col-sm-10">
                <?php echo form_input(array('name' => 'slug', 'class' => 'form-control', 'value' => set_value('slug'), 'id' => 'slug', 'placeholder' => 'minha-categoria', 'data-toggle' => 'tooltip')); ?>
                <p class="help-block">Ao deixar em branco, o slug será gerado de acordo com o título.</p>
            </div>
        </div>
        <div class="form-group <?php if (form_error('resumo') != "") echo "has-error"; ?>">    
            <label for="resumo" class="col-sm-2 control-label alteraFonte">Resumo</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="resumo" name="resumo" rows="5" onkeyup="limitaCaractere('resumo', 250, 'exibeLimiteResumo');"><?php echo set_value('resumo') ?></textarea>
                <p class="help-block" id="exibeLimiteResumo">O resumo possui um limite máximo de 250 caracteres.</p>
            </div>
        </div>
        <?php if (set_value('idConteudo', false) != false) { ?>
            <div class="form-group">
                <label for="arquivo" class="col-sm-2 control-label alteraFonte">Anexos</label>
                <div class="col-sm-10 popup-gallery">
                    <ul id="anexos" style="list-style: none"></ul>
                    <iframe id="form_upload" style="width: 100%;height: 30px" class="<?php echo $class ?>" src="<?php echo base_url('admin/media/anexarAoConteudo?conteudo=') . set_value('idConteudo') ?>" frameborder="0" scrolling="no"></iframe>
                    <p class="help-block">A imagem em destaque apresenta o ícone verde.</p>
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
                <?php echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'publicar', 'class' => 'btn btn-success alteraFonte', 'value' => 'Publicar'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar '); ?>
            </div>
        </div>
    </fieldset>
</form>
