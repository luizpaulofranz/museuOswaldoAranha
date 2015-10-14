# museuOswaldoAranha
Códigos de um site institucional para museu.

Esse repositório contém todos os artefatos utilizados no desenvolvimento do site institucional do museu Oswaldo Aranha, localizado em Alegrete - RS Brasil.

A seguinte estrutura de diretórios foi utilizada:
-dev
   que contém todos os fontes do projeto
-dev
     -portal 
        fontes oficiais
        
-analise
   contém os artefatos relacionados as fases de análise e validações. Levantamento de requisitos, protótipos, etc.

-engineering
   Diagramas e modelos utilizados no procesos de desenvolvimento da solução.
   

GUIA DE INSTALAÇÃO
1º CLonar essa projeto, utilizar a última release.
2º Criar um banco de dados no MySQL, e importar o arquivo /engineering/museuOswaldoAranha.sql

3º Criar o arquivo config.php no diretório /dev/portal/application/config (basear-se no config_example.php)
   Esse é o arquivo de configuração do Codeigniter, basicamente o que precisa ser mudado é o parâmetro:
   $config['base_url'] = 'http://sua-url.aqui';
4º Criar o arquivo database.php dentro de /dev/portal/application/config (basear-se no database_example.php)
   Esse é o arquivo de configuração de acesso ao banco de dados usado pelo Codeigniter, edite seus dados de acesso.
   
5º Para acessar a área administrativa do site, basta colocar um "/admin" em sua URL, as credenciais padrão são:
   user: admin@gmail.com
   pass: abc123
   
PRONTO! JÁ PODE ACESSAR O SITE.
