<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Contato</title>

        <link rel="stylesheet" href="../resources/css/normalize.css">
        <link rel="stylesheet" href="../resources/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/css/boot.css">
        <link rel="stylesheet" href="../resources/css/grid.css">

        <link rel="shortcut icon" href="../resources/images/favicon.png"/>
    </head>
    <body>

        <div class="container bg-white-grey menu-height2">
            <div class="content">
                <ul class="font-oswald-light font-bold fontsize090 fl-right text-uppercase">
                    <li class="list-info"><a src="" alt=""><img src="../resources/images/home/endereco-icon.png" class="fl-left img-micro" alt="Icone Encereço" title="Endereço do Museu">Praça Getúlio Vargas nº 585 - centro - Alegrete RS</a></li>
                    <li class="list-info"><a src="" alt=""><img src="../resources/images/home/telefone-icon.png" class="fl-left img-micro" alt="Icone Telefone" title="Telefone para Contato">(55) 3961-1132</a></li>
                    <li class="list-info"><a src="" alt=""><img src="../resources/images/home/facebook-icon.png" alt="Nossa Página no Facebook" title="Facebook"></a></li>
                </ul>
            </div>
        </div>
        <header class="container bg-black menu-height section-header transparence-85">
            <div class="content">
                <h1 class="fontzero">
                    Portal Museu Oswaldo Aranha
                    <img src="../resources/images/home/logo-museu.png" alt="Museu Oswaldo Aranha logo" class="ds-block fl-left grid-2">                        
                </h1>
                <ul class="font-oswald-light font-light fontsize1b fl-right">
                    <li class="menu-item"><a href="../view/home.php" title="Página Inícial">INÍCIO</a></li>
                    <li class="menu-item"><a href="../view/sobre.php" alt="" title="Sobre o Museu">SOBRE</a></li>
                    <li class="menu-item"><a href="../view/eventos.php" alt="" title="Eventos do Museu">EVENTOS</a></li>
                    <li class="menu-item"><a href="../view/noticias.php" alt="" title="Notícias">NOTÍCIAS</a></li>
                    <li class="menu-item"><a href="../view/aprendaMenu.php" alt=""title="Aprenda">APRENDA</a></li>
                    <li class="menu-item"><a href="../view/amigosDoMuseu.php" alt=""title="Amigos do Museu">AMIGOS DO MUSEU</a></li>
                    <li class="menu-item"><a href="../view/visite.php" alt="" title="Visite o Museu">VISITE</a></li>
                    <li class="menu-item"><a href="../view/contato.php" alt="" title="Fale Conosco">CONTATO</a></li>
                </ul>
            </div>
        </header>
        <section>
            <div class="container section-Contato-1">
                <div class="content">

                </div>
            </div>
            <div class="container al-center bg-brown-white position_image_text_info transparence-70 font-georgia fontsize1">
                <div class="content">
                    <p class="grid-16">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                        The point of using Lorem Ipsum  is that it has a more-or-less normal distribution of letters, as opposed to using.
                    </p>
                </div>
            </div>
        </section>      
        <div class="regulates_position">
            <section class="container container-padding-60 font-oswald-light font-light">
                <div class="content">

                    <header class="content" style="background: #993333; height: 5px; text-align: center;">
                        <h2 class="fontsize30 font-vinho font-oswald-light al-center ds-inblock news_style">ENTRE EM CONTATO</h2>;
                    </header>
                    <br><br>

                    <div>
                        <!--<h2 class="font-oswald-light fontsize30 " style="text-align: center; padding-bottom: 3em" >ENTRE EM CONTATO</h2> -->
                        <section class=" grid-12 font-oswald-light news_description fontsize18 ds-block border-grey" style="margin-right: 20%">                                
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">                                      
                                        <input class="form-control" id="inputNome" placeholder="ex: João Pablo" type="text" required value="" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputIdade" class="col-sm-2 control-label">Idade:</label>
                                    <div class="col-sm-2" style="margin-left: 13%; margin-top: 1%">
                                        <input type="number" class="form-control" style="margin-left: 7%; margin-top: -8%" id="inputIdade" placeholder="ex: 28"max="100" min="1" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEscolaridade" class="col-sm-2 control-label">Escolaridade:</label>
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
                                        <input type="escolaridade" class="form-control" id="inputEscolaridade" placeholder="ex: Ensino Médio">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputProfissao" class="col-sm-2 control-label">Profissão:</label>
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
                                        <input type="text" class="form-control" id="inputProfissao" placeholder="ex: Professor" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputSexo" class="col-sm-2 control-label">Sexo:</label>                                    
                                    <div class="radio" style="margin-left: 19%; margin-top: -2.9%">
                                        <label><input type="radio" name="optradio">Feminino</label>
                                        <label><input type="radio" name="optradio">Masculino</label>  
                                    </div>                                   
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputCor" class="col-sm-2 control-label">Cor/Raça:</label>
                                    <div class="col-sm-3" style="margin-left: 19%; margin-top: -2.9%">
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
                                    <div class="col-sm-3" style="margin-left: 19%; margin-top: -2.9%">
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
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
                                        <input type="text" class="form-control" id="inputcidade" placeholder="ex: Alegrete" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputTelefone" class="col-sm-2 control-label">Telefone:</label>
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
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
                                    <div class="col-sm-6" style="margin-left: 19%; margin-top: -2.9%">
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
                </div>
            </section>

            <section class="container container-padding-60 bg-pink-white">
                <div class="content al-center">
                    <header style="background: #ffffff; height: 5px">
                        <h2 class="fontsize25 font-oswald-light al-center ds-inblock shadow_parceiros">PARCEIROS</h2>;
                    </header>

                    <div style="margin-top: 40px;">
                        <div class="grid-5 al-center" style="height: 180px;">
                            <div class="border-red" style="height: 180px; background: #ffffff;">
                                <img class="ds-inline fl-none" style="margin-top: 20px;" src="../resources/images/home/unipampa.png" alt="Logotipo Unipampa">
                            </div>
                        </div>
                        <div class="grid-6 al-center" style="height: 180px;">
                            <div class="border-red" style="height: 180px; background: #ffffff;">
                                <img class="ds-inline fl-none" style="margin-top: 40px;" src="../resources/images/home/prefeitura.png" alt="Logotipo Unipampa">
                            </div>
                        </div>
                        <div class="grid-5 al-center" style="height: 180px;">
                            <div class="border-red" style="height: 180px; background: #ffffff;">
                                <img class="ds-inline fl-none" style="margin-top: 29px;" src="../resources/images/home/Instituto Histórico e Geográfico de Alegrete.jpg" alt="Logotipo IHGA">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="container container-padding-60 bg-black">
                <div class="content">
                    <ul class="font-oswald-light font-light fontsize1b grid-16 al-center">
                        <li class="menu-item2 fontsize18"><a src="" alt="">INÍCIO</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">SOBRE</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">EVENTOS</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">CONTATO</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">NOTÍCIAS</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">APRENDA</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">AMIGOS DO MUSEU</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">VISITE</a></li>
                        <li class="menu-separador fontsize1">/</li>
                        <li class="menu-item2 fontsize18"><a src="" alt="">MAPA DO SITE</a></li>
                    </ul>
                </div>
            </footer>

            <div class="container" style="padding-top: 15px; padding-bottom: 15px;">
                <div class="content al-center">
                    <p class="font-georgia fontsize1">MOA - Museu Oswaldo Aranha - 2015</p>
                </div>
            </div>
        </div>
        <script src="../resources/jquery/jquery-2.1.4.min.js"></script>
        <script src="../resources/bootstrap/bootstrap.min.js"></script>
    </body>
</html>
