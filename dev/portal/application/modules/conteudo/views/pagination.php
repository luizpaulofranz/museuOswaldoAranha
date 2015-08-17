<?php
// Paginação

$pg['base_url'] = site_url('noticia/todas/');
$pg['total_rows'] = $total;
$pg['per_page'] = 9; 
$pg['uri_segment'] = 3;
$pg['num_links'] = 3;//numero de links antes e depois da pagina atual na paginacao
$pg['use_page_numbers'] = TRUE;
$pg['page_query_string'] = FALSE;//trabalhar com o get, ?pg=5

$pg['full_tag_open'] = '<ul class="pagination">';//abertura da div paginacao
$pg['full_tag_close'] = '</ul><!--pagination-->';//fechamento

$pg['first_link'] = '<i class="fa fa-angle-double-left"></i>';//primeiro link
$pg['first_tag_open'] = '<li>';
$pg['first_tag_close'] = '</li>';

$pg['last_link'] = '<i class="fa fa-angle-double-right"></i>';
$pg['last_tag_open'] = '<li>';
$pg['last_tag_close'] = '</li>';

$pg['next_link'] = '<i class="fa fa-angle-right"></i>';//proximo link
$pg['next_tag_open'] = '<li>';
$pg['next_tag_close'] = '</li>';

$pg['prev_link'] = '<i class="fa fa-angle-left"></i>';
$pg['prev_tag_open'] = '<li>';
$pg['prev_tag_close'] = '</li>';

$pg['cur_tag_open'] = '<li class="active"><a href="">';//current, pagina atual
$pg['cur_tag_close'] = '</a></li>';

$pg['num_tag_open'] = '<li>';//tag numero de pagina normal
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
