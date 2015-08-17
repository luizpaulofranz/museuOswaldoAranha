<section class="container container-padding-60 font-oswald-light font-light">
    <div class="content">
        <div>
            <h2 class="font-oswald-light fontsize30 " style="text-align: center; padding-bottom: 3em" >ENTRE EM CONTATO</h2> 
            <section class=" al-left font-oswald-light news_description fontsize18 ds-block border-grey">                                
                <form name="meu_form" class="">
                    <p class="nome">
                        <label for="nome">Nome: </label> 
                        <input type="text" id="nomeid" placeholder="Tiago Vale" required="required" name="nome" />
                    </p>
                    <p class="idade"> <label for="idade">Idade: </label>
                        <input type="text" id="idade" placeholder="18" name="idade" /> 
                    </p> 
                    <p class="escolaridade"> 
                        <label for="escolaridade">Escolaridade: </label>
                        <input type="text" id="escolaridade" placeholder="Ensio Médio" name="escolaridade" /> 
                    </p>
                    <p> <label for="profissao">Profissão: </label>
                        <input type="text" id="profissao" placeholder="Professor" name="Profissao" /> 
                    </p>
                    <p> <label for="genero">Gênero: </label>
                        <input type="radio" id="genero"  name="sexo" value="masculino" /> Masculino
                        <input type="radio" id="genero"  name="sexo" value="feminino" /> Feminino
                    </p>
                    <p> <label for="raca">Raça: </label>
                        <select name="raca">
                            <option value="branca">Branca</option>
                            <option value="negro">Negro</option>
                            <option value="amarela">Amarela</option>
                            <option value="pardo">Pardo</option>
                        </select>
                    </p>
                    <p class="estado"> 
                        <label for="estado">Estado: </label>
                        <select name="estado">
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="NA">NA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RM">RM</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </p> 
                    <p class="cidade"> 
                        <label for="cidade">Cidade: </label> 
                        <input type="text" id="cidade" placeholder="Alegrete" name="alegrete" /> 
                    </p> 
                    <p class="fone"> 
                        <label for="fone">Telefone: </label> 
                        <input type="text" id="foneid" placeholder="(xx)xx-xx-xx-xx" name="fone" /> 
                    </p> 
                    <p class="email"> <label for="email">Email: </label>
                        <input type="text" id="emailid" placeholder="fulano@mail.com" name="email" /> 
                    </p>
                    <p> <label for="opiniao">Deixei sua opinião: </label>
                        <textarea placeholder="Deixe sua opnião">
                                    
                        </textarea> </p>
                    <p class="submit"> <input type="submit" onclick="Enviar();" value="Enviar" /> 
                    </p> 
                </form>
            </section>
            </body>
        </div>
    </div>
</section>