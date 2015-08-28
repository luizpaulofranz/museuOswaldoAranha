<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content">
        <div>
            <header class="content" style="background: #993333; height: 5px; text-align: center;">
                <h2 class="fontsize30 font-vinho font-oswald-light al-center ds-inblock news_style">ENTRE EM CONTATO</h2>;
            </header>
            <br><br>
            <div>
                <section class=" grid-12 font-oswald-light news_description fontsize18 ds-block border-grey" style="margin-right: 20%">                                
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                            <div class="col-sm-6" style="margin-left: 10%; margin-top: -2.9%">                                      
                                <input class="form-control" id="inputNome" placeholder="ex: João Pablo" type="text" required value="" pattern="[a-z\s]+$">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputIdade" class="col-sm-2 control-label">Idade:</label>
                            <div class="col-sm-2" style="margin-left: 3.5%; margin-top: 1%">
                                <input type="number" class="form-control" style="margin-left: 7%; margin-top: -8%" id="inputIdade" placeholder="ex: 28"max="100" min="1" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEscolaridade" class="col-sm-2 control-label">Escolaridade:</label>
                            <div class="col-sm-6" style="margin-left: 14.5%; margin-top: -2.9%">
                                <input type="escolaridade" class="form-control" id="inputEscolaridade" placeholder="ex: Ensino Médio">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputProfissao" class="col-sm-2 control-label">Profissão:</label>
                            <div class="col-sm-6" style="margin-left: 12%; margin-top: -2.9%">
                                <input type="text" class="form-control" id="inputProfissao" placeholder="ex: Professor" pattern="[a-z\s]+$">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputSexo" class="col-sm-2 control-label">Sexo:</label>                                    
                            <div class="radio" style="margin-left: 12%; margin-top: -2.9%">
                                <label><input type="radio" name="optradio">Feminino</label>
                                <label><input type="radio" name="optradio">Masculino</label>  
                            </div>                                   
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputCor" class="col-sm-2 control-label">Cor/Raça:</label>
                            <div class="col-sm-3" style="margin-left: 12%; margin-top: -2.9%">
                                <select class="form-control">
                                    <option>Branco</option>
                                    <option>Negro</option>
                                    <option>Indígena</option>
                                    <option>Amarelo</option>
                                    <option>Pardo</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputEstado" class="col-sm-2 control-label">Estado:</label>
                            <div class="col-sm-3" style="margin-left: 12%; margin-top: -2.9%">
                                <select class="form-control">
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option>MG</option>
                                    <option>PA</option
                                    <option>PB</option>
                                    <option>PR</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SP</option>
                                    <option>SE</option>
                                    <option>TO</option> 
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputCidade" class="col-sm-2 control-label">Cidade:</label>
                            <div class="col-sm-6" style="margin-left: 12%; margin-top: -2.9%">
                                <input type="text" class="form-control" id="inputcidade" placeholder="ex: Alegrete" pattern="[a-z\s]+$">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputTelefone" class="col-sm-2 control-label">Telefone:</label>
                            <div class="col-sm-6" style="margin-left: 12%; margin-top: -2.9%">
                                <input onclick="telefone();" type="telefone" class="form-control" id="inputtelefone" placeholder="ex: (XX) xxxx-xxxx"  pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}">
                            </div>
                        </div>
                        <script>
                            function telefone() {
                                $("#inputtelefone").mask("(99) 9999-9999");
                            }
                        </script>
                        <br>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-6" style="margin-left: 12%; margin-top: -2.9%">
                                <input class="form-control" id="inputEmail" placeholder="ex: pessoa@endereco.com" type="email" required name=email>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputOpiniao" class="col-sm-2 control-label">Deixe sua Opinião:</label>
                            <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
                                <textarea class="form-control" rows="6" style="width: 60%" placeholder="ex: mensagem/opinião/sugestão/reclamação/ avaliar o museu. Obrigada, sua opinião é importante!" required value=""></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div  class="col-sm-offset-2 col-sm-10">
                                <button input type="submit" value="Submit" class="btn btn-default btn-lg fontsize25">Enviar</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            </body>
        </div>
    </div>
</section>