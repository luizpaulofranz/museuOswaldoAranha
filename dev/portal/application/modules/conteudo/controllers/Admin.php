<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('conteudo/conteudo_m');
        $this->load->model('media/media_m');
        $this->load->model('editoria/editoria_m');
        $this->load->model('tipoConteudo/tipoConteudo_m');
        //https://github.com/ericbarnes/CodeIgniter-Slug-Library
        $config = array(
            'table' => 'conteudo',
            'id' => 'idConteudo',
            'field' => 'slug', //campo que recebe o slug
            'title' => 'titulo', //campo para gerar o slug
            'replacement' => 'dash' // pode ser underline
        );
        $this->load->library('slug', $config);
        ############# IMPORTANTE ################
        //carregamos a model de tags depois da biblioteca de slug
        $this->load->model('tag/tag_m');
    }

    public function index() {
        //render carrega, renderiza o template
        $this->pg();
    }

    public function pg() {
        //aqui escrevemos mensagens de erro ou sucesso nas listas
        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $n = 10;
        //segment sao as partes da url, primeiro parametro eh a parte e o segundo eh o default
        $ate = $this->uri->segment(4, 0);
        $conteudos = $this->conteudo_m->listar($n, $ate);
        $total = $this->conteudo_m->listar();
        $this->template->write_view('conteudo', 'admin/listar', array('conteudos' => $conteudos->result_array()));
        $this->template->write_view('conteudo', 'admin/pagination', array('total' => $total->num_rows()));
        $this->template->render();
    }

    public function cadastrar() {
        $params = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('resumo', 'Resumo', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('destaque', 'Destaque', 'alpha|max_length[1]');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idEditoria', 'Editoria', 'integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');
            //$this->form_validation->set_rules('tags', 'Tags', 'trim|valid_tag');
            //executamos a validacao
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                //editoria soh pode ser setada se o tipo for conteudo
                //precisamos adicionar outro modulo, somente para noticia e evitar isso
                if($dados['idTipoConteudo'] != 11){
                    unset($dados['idEditoria']);
                }
                //verificar as tags
                $erroTags = false;
                $tags = $dados['tags'];
                unset($dados['tags']);
                //verificamos o slug
                if ($dados['slug'] == '') {
                    $dados['slug'] = $this->slug->create_uri($dados);
                } else {
                    $dados['slug'] = $this->slug->create_uri($dados['slug']);
                }
                if ($inserted_id = $this->conteudo_m->cadastrar($dados)) {
                    //tratar as tags
                    if ($tags) {
                        //limpamos todas as tags desse conteudo
                        $this->tag_m->limparTagsConteudo($inserted_id);
                        foreach ($tags as $tag) {
                            if (!$this->tag_m->cadastrarByConteudo($tag, $inserted_id)) {
                                $erroTags = true;
                            }
                        }
                    }
                    if($erroTags){
                        $params['mensagem'] = alert('Erro ao inserir as tags!', 'danger');
                    }
                    $params['mensagem'] = alert('Sucesso ao cadastrar o Conteudo!', 'success');
                    $url = base_url('/admin/conteudo/alterar/' . $inserted_id);
                    redirect($url);
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $params['tipoConteudo'] = $this->tipoConteudo_m->getCombo();
        $params['editorias'] = $this->editoria_m->getCombo();
        $this->template->write_view('conteudo', 'admin/form', $params);
        $this->template->render();
    }

    public function alterar() {
        $params = array();
        $dados = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('resumo', 'Resumo', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('destaque', 'Destaque', 'alpha|max_length[1]');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idEditoria', 'Editoria', 'integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');

            $this->form_validation->set_rules('idConteudo', 'Id', 'required|integer');
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                //editoria soh pode ser setada se o tipo for conteudo
                //precisamos adicionar outro modulo, somente para noticia e evitar isso
                if($dados['idTipoConteudo'] != 11){
                    unset($dados['idEditoria']);
                }
                $erroTags = false;
                if (isset($dados['tags'])) {
                    //limpamos todas as tags desse conteudo
                    $this->tag_m->limparTagsConteudo($dados['idConteudo']);
                    foreach ($dados['tags'] as $tag) {
                        if (!$this->tag_m->cadastrarByConteudo($tag, $dados['idConteudo'])) {
                            $erroTags = true;
                        }
                    }
                }
                if ($erroTags) {
                    $params['mensagem'] = alert('Erro ao inserir as tags!', 'danger');
                } else {
                    unset($dados['tags']);
                    //verificamos o slug
                    if ($dados['slug'] == '') {
                        $dados['slug'] = $this->slug->create_uri($dados, $dados['idConteudo']);
                    } else {
                        $dados['slug'] = $this->slug->create_uri($dados['slug'], $dados['idConteudo']);
                    }
                    if ($this->conteudo_m->alterar($dados)) {
                        $params['mensagem'] = alert('Sucesso ao alterar o Conteudo!', 'success');
                    } else {
                        $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                    }
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        } else {
            $dados = $this->conteudo_m->getDataById($this->uri->segment(4));
        }
        $this->form_validation->set_default($dados);
        $params['tags'] = $this->tag_m->getTagsByConteudo($this->uri->segment(4));
        $params['medias'] = $this->media_m->listar($this->uri->segment(4));
        $params['tipoConteudo'] = $this->tipoConteudo_m->getCombo();
        $params['editorias'] = $this->editoria_m->getCombo();

        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $this->template->write_view('conteudo', 'admin/form', $params);
        $this->template->render();
    }

    public function excluir() {
        $id = $this->uri->segment(4);
        $del = $this->conteudo_m->excluir(array('idConteudo' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Conteúdo excluido com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir conteúdo!', 'danger'));
        }
        redirect(base_url('admin/conteudo'));
    }

    public function getTags() {
        $this->db->select('nome');
        //$this->db->from('tag');
        $query = $this->db->get('tag')->result_array();
        $retorno = '';
        $count = count($query) - 1;
        foreach ($query as $key => $value) {
            if ($count == $key) {
                $retorno .= $value['nome'];
            } else {
                $retorno .= $value['nome'] . ',';
            }
        }
        echo $retorno;
    }

}

?>