
<div class="jumbotron">
    <h1>Login</h1>
    <p>Efetue login para administrar seu site.</p>
    <?php
    echo isset($mensagem) ? $mensagem : NULL;
    ?>
    <form action="<?php echo current_url(); ?>" method="POST">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" name="email" id="email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="pass">Senha</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="pass" name="senha">
                </div>
            </div>
            <br/>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Login</button>
                <button class="btn" type="reset">Cancelar</button>
                <!--<button type="submit" class="btn btn-warning">Esqueci senha</button>-->
            </div>
        </fieldset>
    </form>

</div>
