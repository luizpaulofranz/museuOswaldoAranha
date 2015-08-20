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
     * Método responsável por recuperar as noticias de uma editoria.
     * (segmento 3 é a editoria e 4 a pagina)
     */
    public function noticias() {
        $limit = 12;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(3, 1) - 1) * $limit;
        $conteudos = $this->conteudo_m->listarNoticia($limit, $offset, true);
        $total = $this->conteudo_m->listarNoticia(null, null, true);
        
        $this->template->write_view('capa', 'conteudo/capa');
        $this->template->write_view('conteudo', 'conteudo/noticias', array('noticias' => $conteudos->result_array()));
        $this->template->write_view('paginacao', 'conteudo/pagination', array('total' => $total->num_rows()));
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

    public function buscar() {
        $busca = $this->input->post('busca');
        $limit = 12;
        $limitTopNews = 5;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(4, 1) - 1) * $limit;
        //quando nao passamos a categoria


        $conteudosTopNews = $this->conteudo_m->listarTopNewsPorEditoria($limitTopNews, true);
        $conteudos = $this->conteudo_m->buscarNoticia($limit, $offset, true, $busca);
        $this->template->write_view('capa', 'frontend/capaBusca', array('busca' => $busca));
        $this->template->write_view('conteudo', 'conteudo/noticias', array('noticias' => $conteudos, 'topNews' => $conteudosTopNews, 'usuarioLogado' => $this->logado()));
        $this->template->render();
    }

    /**
     * Método responsável por fazer a exibição das noticias por tag.
     */
    public function tag() {
        $slugTag = $this->uri->segment(3, false);
        $limit = 12;
        $limitTopNews = 5;
        //para a paginacao funcionar assim, o parametro $pg['use_page_numbers'] = TRUE no arquivo pagination
        $offset = ($this->uri->segment(4, 1) - 1) * $limit;
        //quando nao passamos a categoria

        if ($slugTag) {
            $conteudos = $this->conteudo_m->buscarByTag($limit, $offset, true, $slugTag);
            $tag = $this->tag_m->getDataByIdOrSlug($slugTag);
        } else {
            $conteudos = array();
            $tag['nome'] = 'Sem tag =/';
        }
        $conteudosTopNews = $this->conteudo_m->listarTopNewsPorEditoria($limitTopNews, true);
        //$conteudos = $this->conteudo_m->buscarNoticia($limit, $offset, true, $busca);
        $this->template->write_view('capa', 'frontend/capaBuscaTag', array('tag' => $tag['nome']));
        $this->template->write_view('conteudo', 'conteudo/noticias', array('noticias' => $conteudos, 'topNews' => $conteudosTopNews, 'usuarioLogado' => $this->logado()));
        $this->template->render();
    }

    /**
     * Método responsável por guardar as avaliações dos usuários.
     */
    public function avaliar() {
        $slug = $this->input->post('slug');
        $idConteudo = $this->conteudo_m->getIdBySlug($slug);
        $idUsuario = $this->session->userdata('idUsuario');
        $this->conteudo_m->avaliar(array('avaliacao' => $this->input->post('avaliacao'), 'idUsuario' => $idUsuario, 'idConteudo' => $idConteudo));
        redirect(base_url('conteudo/visualizar/' . $slug));
    }

}

?>
