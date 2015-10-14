# Museu Oswaldo Aranha
Códigos de um site institucional para museu.

<p>Esse repositório contém todos os artefatos utilizados no desenvolvimento do site institucional do museu Oswaldo Aranha, localizado em Alegrete - RS Brasil.</p>
<br>
<b>INFORMAÇÕES ÚTEIS E PRÉ-REQUISITOS</b><br>
<p>O Site foi desenvolvido com o <b>Framework Codeigniter</b> (versão 3.0, com HMVC). Conhecimentos em codeigniter são recomendados.</p>
<p>O site usa mod_rewrite para montar as URLs amigáveis, para tal o mesmo deve estar habilitado em seu servidor, para habilitar no linux use: "sudo a2enmod rewrite"</p>
<p>PHP 5.3 +</p>
<p>MySQL 5 +</p>
<br>
<br>
A seguinte estrutura de diretórios foi utilizada:<br>
<b>-dev</b><br>
&nbsp;&nbsp;que contém todos os fontes do projeto<br>
<b>-dev</b><br>
&nbsp;&nbsp;<b>-portal</b> <br>
&nbsp;&nbsp;&nbsp;&nbsp;fontes oficiais<br>
<br>  
<b>-analise</b>
&nbsp;&nbsp;contém os artefatos relacionados as fases de análise e validações. Levantamento de requisitos, protótipos, etc.<br>
<br>
<b>-engineering</b><br>
&nbsp;&nbsp;Diagramas e modelos utilizados no procesos de desenvolvimento da solução.<br>
<br>
<br>
<b>GUIA DE INSTALAÇÃO</b>
<br>
<b>1º</b> CLonar essa projeto, utilizar a última release.<br>
<b>2º</b> Criar um banco de dados no MySQL, e importar o arquivo /engineering/museuOswaldoAranha.sql<br>
<br>
<b>3º</b> Criar o arquivo config.php no diretório /dev/portal/application/config (basear-se no config_example.php)<br>
&nbsp;&nbsp;Esse é o arquivo de configuração do Codeigniter, basicamente o que precisa ser mudado é o parâmetro:<br>
&nbsp;&nbsp;$config['base_url'] = 'http://sua-url.aqui';<br>
<b>4º</b> Criar o arquivo database.php dentro de /dev/portal/application/config (basear-se no database_example.php)<br>
&nbsp;&nbsp;Esse é o arquivo de configuração de acesso ao banco de dados usado pelo Codeigniter, edite seus dados de acesso.<br>
<br>
<b>5º</b> Para acessar a área administrativa do site, basta colocar um "/admin" em sua URL, as credenciais padrão são:<br>
&nbsp;&nbsp;user: admin@gmail.com<br>
&nbsp;&nbsp;pass: abc123<br>
<br>
PRONTO! JÁ PODE ACESSAR O SITE.
