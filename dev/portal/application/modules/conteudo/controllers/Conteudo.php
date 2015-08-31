<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conteudo extends Site_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conteudo/conteudo_m');
    }

    /**
     * Método responsável por recuperar as noticias de uma editoria.
     * (segmento 3 é a editoria e 4 a pagina)
     */
    public function listar() {

        //$limit = 10;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        //$offset = ($this->uri->segment(4, 1) - 1) * $limit;
        //$conteudos = $this->conteudo_m->listar($limit, $offset, true);
        //$total = $this->conteudo_m->listar(null, null, true);
        //$params = array('noticias' => $conteudos);
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->write_view('conteudo', 'conteudo/noticias');
        $this->template->render();
    }

    /**
     * Método responsável por recuperar as noticias.
     */
    public function noticias() {
        $limit = 12;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(3, 1) - 1) * $limit;
        $conteudos = $this->conteudo_m->listarNoticia($limit, $offset, true);
        $total = $this->conteudo_m->listarNoticia(null, null, true);
        
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->write_view('conteudo', 'conteudo/noticias', array('noticias' => $conteudos->result_array()));
        $this->template->write_view('paginacao', 'conteudo/paginationNoticias', array('total' => $total->num_rows()));
        $this->template->render();
    }
    
    /**
     * Método responsável por recuperar os eventos.
     */
    public function eventos() {
        $limit = 12;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(3, 1) - 1) * $limit;
        $conteudos = $this->conteudo_m->listarEvento($limit, $offset, true);
        $total = $this->conteudo_m->listarEvento(null, null, true);
        
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->write_view('conteudo', 'conteudo/eventos', array('eventos' => $conteudos->result_array()));
        $this->template->write_view('paginacao', 'conteudo/paginationEventos', array('total' => $total->num_rows()));
        $this->template->render();
    }

    /**
     * Método responsável por recuperar e exibir um único conteudo.
     */
    public function visualizar() {
        $slug = $this->uri->segment(3, 0);
        $noticia = $this->conteudo_m->getDataBySlug($slug);
        $params = array('noticia' => $noticia);
        $this->template->write_view('conteudo', 'visualizar', $params);
        //$this->template->write_view('conteudo', 'visualizar');
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->render();
    }

    /**
     * Método responsável por recuperar as noticias.
     */
    public function acervo_museu() {
        $limit = 15;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(3, 1) - 1) * $limit;
        $conteudos = $this->conteudo_m->listarAcervoMuseu($limit, $offset, true);
        $total = $this->conteudo_m->listarAcervoMuseu(null, null, true);
        
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->write_view('conteudo', 'conteudo/acervoMuseu', array('itens' => $conteudos->result_array()));
        $this->template->write_view('paginacao', 'conteudo/paginationAcervo', array('total' => $total->num_rows()));
        $this->template->render();
    }

}

?>
