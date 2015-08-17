<?php
// Paginação

$pg['base_url'] = site_url('admin/administrador/pg/');
$pg['total_rows'] = $total;
$pg['per_page'] = 10; 
$pg['uri_segment'] = 4;
$pg['num_links'] = 3;//numero de links antes e depois da pagina atual na paginacao
$pg['use_page_numbers'] = TRUE;
$pg['page_query_string'] = FALSE;//trabalhar com o get, ?pg=5

$pg['full_tag_open'] = '<ul class="pagination">';//abertura da div paginacao
$pg['full_tag_close'] = '</ul><!--pagination-->';//fechamento

$pg['first_link'] = '&laquo; Primeiro';//primeiro link
$pg['first_tag_open'] = '<li class="prev page">';
$pg['first_tag_close'] = '</li>';

$pg['last_link'] = 'Último &raquo;';
$pg['last_tag_open'] = '<li class="next page">';
$pg['last_tag_close'] = '</li>';

$pg['next_link'] = 'Prox &rarr;';//proximo link
$pg['next_tag_open'] = '<li class="next page">';
$pg['next_tag_close'] = '</li>';

$pg['prev_link'] = '&larr; Ante';
$pg['prev_tag_open'] = '<li class="prev page">';
$pg['prev_tag_close'] = '</li>';

$pg['cur_tag_open'] = '<li class="active"><a href="">';//current, pagina atual
$pg['cur_tag_close'] = '</a></li>';

$pg['num_tag_open'] = '<li class="page">';//tag numero de pagina normal
$pg['num_tag_close'] = '</li>';

 
// $config['display_pages'] = FALSE;
// 
$config['anchor_class'] = 'follow_link';
 
// --------------------------------------------------------------------------
 
/* End of file pagination.php */
/* Location: ./bookymark/application/config/pagination.php */

$this->pagination->initialize($pg); 

echo $this->pagination->create_links();
?>
