<div>
    <?php echo isset($mensagem) ? $mensagem : NULL; ?>
    <div class="col-md-12">
        <!-- Reg-Form -->
        <form action="<?php echo current_url() ?>" id="sky-form4" class="sky-form" novalidate="novalidate" method="POST">
            <header>Formulário de Cadastro</header>
            <?php echo form_hidden('idUsuario', set_value('idUsuario'));?>
            <fieldset>
                <header>Dados Pessoais</header>
                <section>
                    <label class="input <?php if (form_error('nome') != "") echo "state-error"; ?>">
                        <i class="icon-prepend fa fa-user"></i>
                        <i class="icon-append fa fa-asterisk"></i>
                        <input type="text" name="nome" placeholder="Nome Completo" id="nome" required value="<?php echo set_value('nome')?>">
                        <b class="tooltip tooltip-bottom-left">Informe seu nome completo.</b>
                    </label>
                    <?php if (form_error('nome') != "") echo '<div class="note note-error">'.form_error('nome').'</div>'; ?>
                </section>

                <section>
                    <label class="input <?php if (form_error('email') != "") echo "state-error"; ?>">
                        <i class="icon-prepend fa fa-envelope"></i>
                        <i class="icon-append fa fa-asterisk"></i>
                        <input type="email" name="email" placeholder="Email" id="email" required value="<?php echo set_value('email')?>">
                        <b class="tooltip tooltip-bottom-left">Necessário para verificar sua conta.</b>
                    </label>
                    <?php if (form_error('email') != "") echo '<div class="note note-error">'.form_error('email').'</div>'; ?>
                </section>
                <div class="row">

                    <section class="col col-6">
                        <label class="input <?php if (form_error('senha') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-lock"></i>
                            <i class="icon-append fa fa-asterisk"></i>
                            <input type="password" name="senha" placeholder="Senha" id="senha" required>
                            <b class="tooltip tooltip-bottom-left">Não esqueça sua senha.</b>
                        </label>
                        <?php if (form_error('senha') != "") echo '<div class="note note-error">'.form_error('senha').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="input <?php if (form_error('senha2') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-lock"></i>
                            <i class="icon-append fa fa-asterisk"></i>
                            <input type="password" name="senha2" placeholder="Confirmar senha" id="senha2" required>
                            <b class="tooltip tooltip-bottom-left">Verificação da senha.</b>
                        </label>
                        <?php if (form_error('senha2') != "") echo '<div class="note note-error">'.form_error('senha2').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="input <?php if (form_error('celular') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-phone"></i>
                            <input type="tel" name="celular" id="celular" placeholder="Celular" required value="<?php echo set_value('celular')?>">
                        </label>
                        <?php if (form_error('celular') != "") echo '<div class="note note-error">'.form_error('celular').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="input <?php if (form_error('telefone') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-phone"></i>
                            <input type="tel" name="telefone" id="telefone" placeholder="Telefone Fixo" value="<?php echo set_value('telefone')?>">
                        </label>
                        <?php if (form_error('telefone') != "") echo '<div class="note note-error">'.form_error('telefone').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="input <?php if (form_error('dataNascimento') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-calendar"></i>
                            <input type="text" class="hasDatepicker" name="dataNascimento" id="dataNascimento" placeholder="Data de Nascimento" value="<?php echo set_value('dataNascimento')?>">
                        </label>
                        <?php if (form_error('dataNascimento') != "") echo '<div class="note note-error">'.form_error('dataNascimento').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="select <?php if (form_error('sexo') != "") echo "state-error"; ?>">
                            <select name="sexo" id="sexo">
                                <option value="0" selected="" disabled="">Sexo</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outro</option>
                            </select>
                            <i></i>
                        </label>
                        <?php if (form_error('sexo') != "") echo '<div class="note note-error">'.form_error('sexo').'</div>'; ?>
                    </section>
                </div>

                <div class="row">
                    <section class="col col-4">
                        <label class="input <?php if (form_error('formacao') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="formacao" placeholder="Formação" id="formacao" value="<?php echo set_value('formacao')?>">
                            <b class="tooltip tooltip-bottom-left">Informe sua formação.</b>
                        </label>
                        <?php if (form_error('formacao') != "") echo '<div class="note note-error">'.form_error('formacao').'</div>'; ?>
                    </section>

                    <section class="col col-4">
                        <label class="input <?php if (form_error('profissao') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="profissao" placeholder="Profissão" id="profissao" value="<?php echo set_value('profissao')?>">
                            <b class="tooltip tooltip-bottom-left">Informe sua profissão.</b>
                        </label>
                        <?php if (form_error('profissao') != "") echo '<div class="note note-error">'.form_error('profissao').'</div>'; ?>
                    </section>

                    <section class="col col-4">
                        <label class="input <?php if (form_error('empresaAtual') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="empresaAtual" placeholder="Empresa" id="empresaAtual" value="<?php echo set_value('empresaAtual')?>">
                            <b class="tooltip tooltip-bottom-left">Informe a empresa em que trabalha.</b>
                        </label>
                        <?php if (form_error('empresaAtual') != "") echo '<div class="note note-error">'.form_error('empresaAtual').'</div>'; ?>
                    </section>
                </div>

                <div class="row">
                    <section class="col col-6">
                        <label class="input <?php if (form_error('setorEmpresaAtual') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="setorEmpresaAtual" placeholder="Área de atuação" id="setorEmpresaAtual" value="<?php echo set_value('setorEmpresaAtual')?>">
                            <b class="tooltip tooltip-bottom-left">Informe a área de atuação desta empresa.</b>
                        </label>
                        <?php if (form_error('setorEmpresaAtual') != "") echo '<div class="note note-error">'.form_error('setorEmpresaAtual').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="input <?php if (form_error('cargo') != "") echo "state-error"; ?>">
                            <i class="icon-prepend fa fa-user"></i>
                            <input type="text" name="cargoEmpresaAtual" placeholder="Cargo" id="cargo" value="<?php echo set_value('cargoEmpresaAtual')?>">
                            <b class="tooltip tooltip-bottom-left">Informe seu cargo nesta empresa.</b>
                        </label>
                        <?php if (form_error('cargoEmpresaAtual') != "") echo '<div class="note note-error">'.form_error('cargoEmpresaAtual').'</div>'; ?>
                    </section>
                </div>
            </fieldset>
            <fieldset>
                <header>Endereço</header>
                <div class="row">
                    <section class="col col-6">
                        <label class="select <?php if (form_error('endereco[idEstado]') != "") echo "state-error"; ?>">
                            <?php echo form_dropdown('endereco[idEstado]', $estados, set_value('idEstado', 0), 'id = "estadosEndereco"'); ?>
                            <i></i>
                        </label>
                        <?php if (form_error('endereco[idEstado]') != "") echo '<div class="note note-error">'.form_error('endereco[idEstado]').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="select <?php if (form_error('endereco[idCidade]') != "") echo "state-error"; ?>">
                            <select name="endereco[idCidade]" id="cidadeEndereco">
                                <option value="" selected="" disabled="">Cidade</option>
                            </select>
                            <?php if (form_error('endereco[idCidade]') != "") echo '<div class="note note-error">'.form_error('endereco[idCidade]').'</div>'; ?>
                            <i></i>
                        </label>
                    </section>
                </div>
                <div class="row">
                    <section class="col col-9">
                        <label class="input <?php if (form_error('endereco[logradouro]') != "") echo "state-error"; ?>">
                            <input type="text" name="endereco[logradouro]" placeholder="Logradouro" id="logradouro" value="<?php echo set_value('endereco[logradouro]')?>">
                            <b class="tooltip tooltip-bottom-left">Informe sua Rua.</b>
                        </label>
                        <?php if (form_error('endereco[logradouro]') != "") echo '<div class="note note-error">'.form_error('endereco[logradouro]').'</div>'; ?>
                    </section>

                    <section class="col col-3">
                        <label class="input <?php if (form_error('endereco[numero]') != "") echo "state-error"; ?>">
                            <input type="number" name="endereco[numero]" placeholder="Número" id="numero" value="<?php echo set_value('endereco[numero]')?>">
                            <b class="tooltip tooltip-bottom-left">Informe seu número.</b>
                        </label>
                        <?php if (form_error('endereco[numero]') != "") echo '<div class="note note-error">'.form_error('endereco[numero]').'</div>'; ?>
                    </section>
                </div>
                <div class="row">
                    <section class="col col-6">
                        <label class="input <?php if (form_error('endereco[bairro]') != "") echo "state-error"; ?>">
                            <input type="text" name="endereco[bairro]" placeholder="Bairro" id="bairro" value="<?php echo set_value('endereco[bairro]')?>">
                            <b class="tooltip tooltip-bottom-left">Informe seu bairro.</b>
                        </label>
                        <?php if (form_error('endereco[bairro]') != "") echo '<div class="note note-error">'.form_error('endereco[bairro]').'</div>'; ?>
                    </section>

                    <section class="col col-3">
                        <label class="input <?php if (form_error('endereco[cep]') != "") echo "state-error"; ?>">
                            <input type="text" name="endereco[cep]" placeholder="CEP" id="cep" value="<?php echo set_value('endereco[cep]')?>">
                            <b class="tooltip tooltip-bottom-left">Informe o seu CEP.</b>
                        </label>
                        <?php if (form_error('endereco[cep]') != "") echo '<div class="note note-error">'.form_error('endereco[cep]').'</div>'; ?>
                    </section>

                    <section class="col col-3">
                        <label class="input <?php if (form_error('endereco[complemento]') != "") echo "state-error"; ?>">
                            <input type="text" name="endereco[complemento]" placeholder="Complemento" id="complemento" value="<?php echo set_value('endereco[complemento]')?>">
                            <b class="tooltip tooltip-bottom-left">Informe o complemento de seu endereço.</b>
                        </label>
                        <?php if (form_error('endereco[complemento]') != "") echo '<div class="note note-error">'.form_error('endereco[complemento]').'</div>'; ?>
                    </section>
                </div>
            </fieldset>
            <fieldset>
                <header>Cidade Natal</header>
                <div class="row">
                    <section class="col col-6">
                        <label class="select <?php if (form_error('idEstadoNatal') != "") echo "state-error"; ?>">
                            <?php echo form_dropdown('idEstadoNatal', $estados, set_value('idEstado', 0), 'id = "estadosNatal"'); ?>
                            <i></i>
                        </label>
                        <?php if (form_error('idEstadoNatal') != "") echo '<div class="note note-error">'.form_error('idEstadoNatal').'</div>'; ?>
                    </section>

                    <section class="col col-6">
                        <label class="select <?php if (form_error('idCidadeNatal') != "") echo "state-error"; ?>">
                            <select name="idCidadeNatal" id="cidadeNatal">
                                <option value="" selected="" disabled="">Cidade</option>
                            </select>
                            <i></i>
                        </label>
                        <?php if (form_error('idCidadeNatal') != "") echo '<div class="note note-error">'.form_error('idCidadeNatal').'</div>'; ?>
                    </section>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button type="submit" class="btn-u btn-u-green">Cadastrar</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
