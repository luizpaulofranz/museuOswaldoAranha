<div>
    <div class="page-header">
        <h1>Clientes <small>Cadastro de Clientes</small></h1>
        <br/><a class="btn btn-primary" href="<?php echo base_url('admin/usuario/pg'); ?>"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
    </div>
</div>
<?php echo isset($mensagem) ? $mensagem : NULL; ?>
<form id="form_cadastrar" action="<?php echo current_url()?>" method="post" class="form-horizontal">
    <?php echo form_hidden('idUsuario', set_value('idUsuario'));?>
    <div class="form-group <?php if (form_error('cpf_cnpj') != "") echo "has-error"; ?>">
        <label class="control-label col-sm-2" for="cpf_cnpj">CPF: </label>
        <div class="col-sm-10">
            <input class="form-control cpf" type="text" name="cpf_cnpj" id="cpf_cnpj" required value="<?php echo set_value('cpf_cnpj') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('nome') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="nome">Nome Completo: </label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nome" id="nome" required value="<?php echo set_value('nome') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('apelido') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="apelido">Apelido? </label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="apelido" id="apelido" value="<?php echo set_value('apelido') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('endereco') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="endereco">Endereço (inclui bairro): </label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="endereco" id="endereco" required value="<?php echo set_value('endereco') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('cidade') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="cidade">Cidade: </label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="cidade" id="cidade" required value="<?php echo set_value('cidade') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('estado') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="estado">Estado: </label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="estado" id="estado" required max="2" value="<?php echo set_value('estado') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('telefone') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="telefone">Telefone: </label>
        <div class="col-sm-10">
            <input class="form-control telefone" name="telefone" id="telefone" value="<?php echo set_value('telefone') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('celular') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="celular">Celular: </label>
        <div class="col-sm-10">
            <input class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular') ?>"/>
        </div>
    </div>
    <hr>
    <div class="form-group <?php if (form_error('email') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="email">Email: </label>
        <div class="col-sm-10">
            <input class="form-control" type="email" name="email" id="email" required value="<?php echo set_value('email') ?>"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('senha') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="senha">Senha: </label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="senha" id="senha"/>
        </div>
    </div>
    <div class="form-group <?php if (form_error('senha2') != "") echo "has-error"; ?>">
        <label class="col-sm-2 control-label" for="senha2">Repita a Senha: </label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="senha2" id="senha2" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <?php echo form_button(array('type' => 'submit', 'name' => 'button', 'id' => 'salvar', 'class' => 'btn btn-success', 'value' => 'Salvar'), 'Salvar'); ?>
    </div>
    </div>
</form>