<div id="container">
  <div class="page-header">
    <h1>Clientes <small>Listagem</small></h1><br/>
    <a class="btn btn-success" href="<?php echo base_url('admin/usuario/cadastrar');?>"><span class="glyphicon glyphicon-plus"></span> Novo</a>
  </div>
<?php
// Cabeçalho da tabela
$this->table->set_heading('Nome','CPF', 'Email', 'Ações');

foreach($usuarios->result() as $u)
{
  //aki mandamos os campos que queremos exibir
  $this->table->add_row($u->nome,$u->cpf_cnpj, $u->email, opcoes2(
    base_url('admin/usuario/excluir/'.$u->idUsuario),
    base_url('admin/usuario/alterar/'.$u->idUsuario))
  );
}

echo $this->pagination->create_links();
// Template de Tabela (config/cfg.php)
// Carregar arquivo cfg em $autoload['config'] -- config/autoload.php
// Carregar arquivo table em $autoload['libraries'] -- config/autoload.php 
$this->table->set_template($this->config->item('tabela_lista'));

// Gerar a tabela
if ($usuarios->num_rows() > 0) {
        echo $this->table->generate();
    } else {
        echo alert("Não há registros, clique em novo para cadastrar." , 'success');
    }
?>
</div>