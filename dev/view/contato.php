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
                    <li class="list-info"><a src="" alt=""><img src="../resources/images/home/telefone-icon.png" class="fl-left img-micro" alt="Icone Telefone" title="Telefone para Contato">(55) 3422 xxxx</a></li>
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
                    <li class="menu-item"><a href="../view/contato.php" alt="" title="Fale Conosco">CONTATO</a></li>
                    <li class="menu-item"><a href="../view/noticias.php" alt="" title="Notícias">NOTÍCIAS</a></li>
                    <li class="menu-item"><a href="../view/aprendaMenu.php" alt=""title="Aprenda">APRENDA</a></li>
                    <li class="menu-item"><a href="../view/amigosDoMuseu.php" alt=""title="Amigos do Museu">AMIGOS DO MUSEU</a></li>
                    <li class="menu-item"><a href="../view/visite.php" alt="" title="Visite o Museu">VISITE</a></li>
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
                    <div>
                        <h2 class="font-oswald-light fontsize30 " style="text-align: center; padding-bottom: 3em" >ENTRE EM CONTATO</h2> 
                        <section class=" grid-12 font-oswald-light news_description fontsize18 ds-block border-grey" style="margin-right: 20%">                                
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                                    <div class="col-sm-6">                                      
                                        <input class="form-control" id="inputNome" placeholder="ex: João Pablo" type="text" required value="" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputIdade" class="col-sm-2 control-label">Idade</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="inputIdade" placeholder="ex: 28"max="100" min="1" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEscolaridade" class="col-sm-2 control-label">Escolaridade:</label>
                                    <div class="col-sm-6">
                                        <input type="escolaridade" class="form-control" id="inputEscolaridade" placeholder="ex: Ensino Médio">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputProfissao" class="col-sm-2 control-label">Profissão:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="inputProfissao" placeholder="ex: Professor" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSexo" class="col-sm-2 control-label">Sexo:</label>                                    
                                    <div class="radio">
                                        <label><input type="radio" name="optradio">Feminino</label>
                                        <label><input type="radio" name="optradio">Masculino</label>  
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <label for="inputCor" class="col-sm-2 control-label">Cor/Raça/Etnia:</label>
                                    <div class="col-sm-3">
                                        <select class="form-control">
                                            <option>Branco</option>
                                            <option>Negro</option>
                                            <option>Indigena</option>
                                            <option>Amarelo</option>
                                            <option>Pardo</option>
                                            <option>Outro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEstado" class="col-sm-2 control-label">Estado:</label>
                                    <div class="col-sm-3">
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
                                            <option>NA</option>
                                            <option>MT</option>
                                            <option>MS</option>
                                            <option>MG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCidade" class="col-sm-2 control-label">Cidade:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="inputcidade" placeholder="ex: Alegrete" pattern="[a-z\s]+$">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTelefone" class="col-sm-2 control-label">Telefone:</label>
                                    <div class="col-sm-6">
                                        <input onclick="telefone();" type="telefone" class="form-control" id="inputtelefone" placeholder="ex: (XX) xxxx-xxxx"  pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}">
                                    </div>
                                </div>
                                <script>
                                    function telefone() {
                                        $("#inputtelefone").mask("(99) 9999-9999");
                                    }
                                </script>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="inputEmail" placeholder="ex: pessoa@endereco.com" type="email" required name=email>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputOpiniao" class="col-sm-2 control-label">Deixe sua Opinião:</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" rows="3" required value=""></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div  class="col-sm-offset-2 col-sm-10">
                                        <button input type="submit" value="Submit" class="btn btn-default btn-lg">Enviar</button>
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
                        <h2 class="fontsize25 font-oswald-light al-center ds-inblock shadow_parceiros" style="margin-top: 0.2%;font-weight: bolder">PARCEIROS</h2>;
                    </header>

                    <div style="margin-top: 40px;">
                        <div class="grid-8 al-center" style="height: 180px;">
                            <div class="border-red" style="height: 180px; background: #ffffff;">
                                <img class="ds-inline fl-none" style="margin-top: 20px;" src="../resources/images/home/unipampa.png" alt="Logotipo Unipampa">
                            </div>
                        </div>
                        <div class="grid-8 al-center" style="height: 180px;">
                            <div class="border-red" style="height: 180px; background: #ffffff;">
                                <img class="ds-inline fl-none" style="margin-top: 40px;" src="../resources/images/home/prefeitura.png" alt="Logotipo Unipampa">
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
