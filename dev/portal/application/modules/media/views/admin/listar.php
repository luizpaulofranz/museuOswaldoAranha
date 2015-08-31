<div id="container">
  <div class="page-header">
    <h1>Multimídia <small>Listagem</small></h1><br/>
    <a class="btn btn-success" href="<?php echo site_url('admin/multimidia/cadastrar');?>"><i class="icon-plus icon-white"></i> Nova</a>
  </div>
<?php
// Cabeçalho da tabela
$this->table->set_heading('Evento', 'Descrição', 'Mídia', 'Destaque', 'Ações');

foreach($midias->result() as $m)
{
  //analizar se esta no slider
  if($m->slider){$slider = img('assets/img/ok.png');}else{$slider = '';}
  $this->table->add_row($m->nome_evento, $m->descricao, img(array('src'=>'up/evento_'.$m->id_evento.'/min_'.$m->nome_arquivo)), $slider, opcoes2(
    base_url('admin/multimidia/excluir/'.$m->id_multimidia),
    base_url('admin/multimidia/alterar/'.$m->id_multimidia))
  );
}

// Adicionando linhas
/*
$this->table->add_row('Fred', opcoes2());
$this->table->add_row('Fred', opcoes());
$this->table->add_row('Fred', opcoes2());
$this->table->add_row('Fred', opcoes());
$this->table->add_row('Fred', opcoes2());
*/

echo $this->pagination->create_links();
// Carregar arquivo pagination em $autoload['libraries'] -- config/autoload.php

// Template de Tabela (config/cfg.php)
// Carregar arquivo cfg em $autoload['config'] -- config/autoload.php
// Carregar arquivo table em $autoload['libraries'] -- config/autoload.php 
$this->table->set_template($this->config->item('tabela_lista'));

// Gerar a tabela
echo $this->table->generate();
?>
</div>
