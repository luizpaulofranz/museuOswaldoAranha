<?php
//nossa tabela de lista personalizada para utilizarmos com o helper table, devemos carrega-la no config/autoload.php
$config['tabela_lista'] = array (
  'table_open'          => '<table class="table table-hover table-striped">',

  'heading_row_start'   => '<tr>',
  'heading_row_end'     => '</tr>',
  'heading_cell_start'  => '<th>',
  'heading_cell_end'    => '</th>',

  'row_start'           => '<tr>',
  'row_end'             => '</tr>',
  'cell_start'          => '<td>',
  'cell_end'            => '</td>',

  'row_alt_start'       => '<tr>',
  'row_alt_end'         => '</tr>',
  'cell_alt_start'      => '<td>',
  'cell_alt_end'        => '</td>',

  'table_close'         => '</table>'
);
?>
