<?php
$class = '';
if (set_value('idConteudo', false) == false) {
    $class = 'disabled';
}
?>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>

<div>
    <div class="page-header">    
        <h1>Conteúdo <small>Cadastro de Conteúdos</small></h1>
        <a class="btn btn-primary" href="<?php echo base_url('admin/conteudo/pg') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>&nbsp;&nbsp;

    </div>
</div>
<?php echo isset($mensagem) ? $mensagem : NULL; ?>

<form action="<?php echo current_url() ?>" class="form-horizontal" accept-charset="utf-8" role="form" method="POST">
    <?php
    echo form_hidden('idConteudo', set_value('idConteudo'));
    echo form_hidden('idAdministrador', $this->session->userdata['idAdministrador']);
    ?>
    <fieldset>
        <div class="form-group <?php if (form_error('idTipoConteudo') != "") echo "has-error"; ?>">
            <label for="idTipoConteudo" class="col-sm-2 control-label">Tipo de Conteúdo</label>
            <div class="col-sm-10">
                <?php echo form_dropdown('idTipoConteudo', $tipoConteudo, set_value('idTipoConteudo'), array('id' => 'idTipoConteudo')); ?>
            </div>
        </div>
        <div class="form-group <?php if (form_error('idEditoria') != "") echo "has-error"; ?>" style="display: none" id="selectEditoria">
            <label for="idEditoria" class="col-sm-2 control-label">Editoria</label>
            <div class="col-sm-10">
                <?php echo form_dropdown('idEditoria', $editorias, set_value('idEditoria'), array('id' => 'idEditoria')) ?>
            </div>
        </div>
        <div class="form-group <?php if (form_error('titulo') != "") echo "has-error"; ?>">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <?php echo form_input(array('onkeyup' => 'limitaCaractere(\'titulo\', 80, \'exibeLimiteTitulo\')', 'id' => 'titulo', 'name' => 'titulo', 'class' => 'form-control', 'value' => set_value('titulo'), 'id' => 'titulo', 'placeholder' => 'Digite aqui')); ?>
                <p class="help-block" id="exibeLimiteTitulo">O título possui um limite máximo de 80 caracteres.</p>

            </div>
        </div>
        <div class="form-group <?php if (form_error('slug') != "") echo "has-error"; ?>">    
            <label for="slug" class="col-sm-2 control-label">Slug</label>
            <div class="col-sm-10">
                <?php echo form_input(array('name' => 'slug', 'class' => 'form-control', 'value' => set_value('slug'), 'id' => 'slug', 'placeholder' => 'minha-categoria', 'data-toggle' => 'tooltip')); ?>
                <p class="help-block">Ao deixar em branco, o slug será gerado de acordo com o título.</p>
            </div>
        </div>
        <div class="form-group <?php if (form_error('resumo') != "") echo "has-error"; ?>">    
            <label for="resumo" class="col-sm-2 control-label">Resumo</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="resumo" name="resumo" rows="5" onkeyup="limitaCaractere('resumo', 250, 'exibeLimiteResumo');"><?php echo set_value('resumo') ?></textarea>
                <p class="help-block" id="exibeLimiteResumo">O resumo possui um limite máximo de 250 caracteres.</p>
            </div>
        </div>
        <div class="form-group <?php if (form_error('destaque') != "") echo "has-error"; ?>">    
            <label for="destaque" class="col-sm-2 control-label">Destaque</label>
            <div class="col-sm-10">
                <?php echo form_dropdown('destaque', array(null => null, 'c' => 'Carousel', 'l' => 'Lateral'), set_value('destaque'), 'id="destaque"'); ?>
            </div>
        </div>
        <?php if (set_value('idConteudo', false) != false) { ?>
            <div class="form-group">
                <label for="arquivo" class="col-sm-2 control-label">Anexos</label>
                <div class="col-sm-10 popup-gallery">
                    <ul id="anexos"></ul>
                    <iframe id="form_upload" style="width: 100%;height: 30px" class="<?php echo $class ?>" src="<?php echo base_url('admin/media/anexarAoConteudo?conteudo=') . set_value('idConteudo') ?>" frameborder="0" scrolling="no"></iframe>
                    <p class="help-block">A imagem em destaque apresenta o ícone verde.</p>
                </div>
            </div>
        <?php } ?>
        <div class="form-group <?php if (form_error('conteudo') != "") echo "has-error"; ?>">
            <label for="conteudo" class="col-sm-12" style="text-align: center">Conteudo</label>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <textarea class="ckeditor" name="conteudo" rows="40"><?php echo set_value('conteudo') ?></textarea><br/>
            </div>
        </div>
        <div class="form-group <?php if (form_error('tags') != "") echo "has-error"; ?>">
            <div class="col-sm-12">
                <ul id="myTags">
                    <?php
                    if (isset($tags)) {
                        foreach ($tags as $tag) {
                            echo '<li>' . $tag['nome'] . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <?php echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'publicar', 'class' => 'btn btn-success', 'value' => 'Publicar'), '<span class="glyphicon glyphicon glyphicon-globe"></span> Publicar'); ?>
                <?php echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'rascunho', 'class' => 'btn btn-success', 'value' => 'Rascunho'), '<span class="glyphicon glyphicon-floppy-disk"></span> Salvar como Rascunho'); ?>
            </div>
        </div>
    </fieldset>
</form>
