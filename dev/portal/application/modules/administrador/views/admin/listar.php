<div id="container">
  <div class="page-header">
    <h1>Administradores <small>Listagem</small></h1><br/>
    <a class="btn btn-success" href="<?php echo base_url('admin/administrador/cadastrar');?>"><span class="glyphicon glyphicon-plus"></span> Novo</a>
  </div>
<?php
// Cabeçalho da tabela
$this->table->set_heading('Nome','Usuario', 'Ativo','Ações');

foreach($administradores->result() as $u)
{
  if($u->ativo){$ativo = img('assets/img/ok.png');}else{$ativo = '';}
  $this->table->add_row($u->nome,$u->email, $ativo, opcoes2(
    base_url('admin/administrador/excluir/'.$u->idAdministrador),
    base_url('admin/administrador/alterar/'.$u->idAdministrador))
  );
}

echo $this->pagination->create_links();
// Carregar arquivo pagination em $autoload['libraries'] -- config/autoload.php

// Template de Tabela (config/cfg.php)
// Carregar arquivo cfg em $autoload['config'] -- config/autoload.php
// Carregar arquivo table em $autoload['libraries'] -- config/autoload.php 
$this->table->set_template($this->config->item('tabela_lista'));

// Gerar a tabela
if ($administradores->num_rows() > 0) {
        echo $this->table->generate();
    } else {
        echo alert("Não há registros, clique em novo para cadastrar." , 'success');
    }
?>
</div>