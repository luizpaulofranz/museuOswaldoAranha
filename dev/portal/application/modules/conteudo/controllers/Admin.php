<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conteudo/conteudo_m');
        $this->load->model('media/media_m');
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

    public function noticias() {
        //aqui escrevemos mensagens de erro ou sucesso nas listas
        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $n = 10;
        //segment sao as partes da url, primeiro parametro eh a parte e o segundo eh o default
        $ate = $this->uri->segment(4, 0);
        $conteudos = $this->conteudo_m->listar($n, $ate, true, 'noticias');
        $total = $this->conteudo_m->listar(null, null, true, 'noticias');
        $this->template->write_view('conteudo', 'admin/listarNoticias', array('conteudos' => $conteudos->result_array()));
        $this->template->write_view('conteudo', 'admin/paginationNoticias', array('total' => $total->num_rows()));
        $this->template->render();
    }

    public function eventos() {
        //aqui escrevemos mensagens de erro ou sucesso nas listas
        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $n = 10;
        //segment sao as partes da url, primeiro parametro eh a parte e o segundo eh o default
        $ate = $this->uri->segment(4, 0);
        $conteudos = $this->conteudo_m->listar($n, $ate, true, 'eventos');
        $total = $this->conteudo_m->listar(null, null, true, 'eventos');
        $this->template->write_view('conteudo', 'admin/listarEventos', array('conteudos' => $conteudos->result_array()));
        $this->template->write_view('conteudo', 'admin/paginationEventos', array('total' => $total->num_rows()));
        $this->template->render();
    }

    public function cadastrar_noticia() {
        $params = array();
        $this->form_validation->set_default('idTipoConteudo', 1);//tipo conteudo 1 sao as noticias
        //verificamos se tem algo no post
        if ($this->input->post()) {
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('resumo', 'Resumo', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');
            //executamos a validacao
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                //verificamos o slug
                if ($dados['slug'] == '') {
                    $dados['slug'] = $this->slug->create_uri($dados);
                } else {
                    $dados['slug'] = $this->slug->create_uri($dados['slug']);
                }
                $dados['data'] = date('Y-m-d H:i:s');
                if ($inserted_id = $this->conteudo_m->cadastrar($dados)) {
                    $params['mensagem'] = alert('Sucesso ao cadastrar o Conteudo!', 'success');
                    $url = base_url('/admin/conteudo/alterarNoticia/' . $inserted_id);
                    redirect($url);
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $this->template->write_view('conteudo', 'admin/formNoticias', $params);
        $this->template->render();
    }

    public function cadastrar_evento() {
        $params = array();
        $this->form_validation->set_default('idTipoConteudo', 2); //tipoConteudo 2 sao os eventos
        //verificamos se tem algo no post
        if ($this->input->post()) {
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('resumo', 'Resumo', 'trim|max_length[255]');
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');
            $this->form_validation->set_rules('data', 'Data', 'required|valid_date_ptbr');
            $this->form_validation->set_rules('hora', 'Hora', 'valid_time');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');
            //executamos a validacao
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                //verificamos o slug
                if ($dados['slug'] == '') {
                    $dados['slug'] = $this->slug->create_uri($dados);
                } else {
                    $dados['slug'] = $this->slug->create_uri($dados['slug']);
                }
                //transformamos a data para o formato do banco (jah foi validada);
                $myDateTime = DateTime::createFromFormat('d/m/Y H:i:s', $dados['data'] . ' ' . $dados['hora'] . ':00');
                $dados['data'] = $myDateTime->format('Y-m-d H:i:s');
                unset($dados['hora']);
                if ($inserted_id = $this->conteudo_m->cadastrar($dados)) {
                    $params['mensagem'] = alert('Sucesso ao cadastrar o Evento!', 'success');
                    $url = base_url('/admin/conteudo/alterarEvento/' . $inserted_id);
                    redirect($url);
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $this->template->write_view('conteudo', 'admin/formEventos', $params);
        $this->template->render();
    }

    public function alterarNoticia() {
        $params = array();
        $dados = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('resumo', 'Resumo', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');

            $this->form_validation->set_rules('idConteudo', 'Id', 'required|integer');
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
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
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        } else {
            $dados = $this->conteudo_m->getDataById($this->uri->segment(4));
        }
        $this->form_validation->set_default($dados);
        $params['medias'] = $this->media_m->listar($this->uri->segment(4));
        $params['tipoConteudo'] = $this->tipoConteudo_m->getCombo();

        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $this->template->write_view('conteudo', 'admin/formNoticias', $params);
        $this->template->render();
    }

    public function alterarEvento() {
        $params = array();
        $dados = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim|max_length[80]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|max_length[80]');
            $this->form_validation->set_rules('resumo', 'Resumo', 'trim|max_length[255]');
            $this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|trim');
            $this->form_validation->set_rules('rascunho', 'Rascunho', 'integer');
            $this->form_validation->set_rules('data', 'Data', 'required|valid_date_ptbr');
            $this->form_validation->set_rules('hora', 'Hora', 'valid_time');
            $this->form_validation->set_rules('idAdministrador', 'Autor', 'required|integer');
            $this->form_validation->set_rules('idTipoConteudo', 'Tipo de Conteúdo', 'required|integer');

            $this->form_validation->set_rules('idConteudo', 'Id', 'required|integer');
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                //verificamos o slug
                if ($dados['slug'] == '') {
                    $dados['slug'] = $this->slug->create_uri($dados, $dados['idConteudo']);
                } else {
                    $dados['slug'] = $this->slug->create_uri($dados['slug'], $dados['idConteudo']);
                }
                //transformamos a data para o formato do banco (jah foi validada);
                $myDateTime = DateTime::createFromFormat('d/m/Y H:i:s', $dados['data'] . ' ' . $dados['hora'] . ':00');
                $dados['data'] = $myDateTime->format('Y-m-d H:i:s');
                unset($dados['hora']);
                if ($this->conteudo_m->alterar($dados)) {
                    $params['mensagem'] = alert('Sucesso ao alterar o Evento!', 'success');
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }
        $dados = $this->conteudo_m->getDataById($this->uri->segment(4));
        $dados['hora'] = date('H:i', strtotime($dados['data']));
        $dados['data'] = date('d/m/Y', strtotime($dados['data']));
        $this->form_validation->set_default($dados);
        $params['medias'] = $this->media_m->listar($this->uri->segment(4));
        $params['tipoConteudo'] = $this->tipoConteudo_m->getCombo();

        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $this->template->write_view('conteudo', 'admin/formEventos', $params);
        $this->template->render();
    }

    public function excluirNoticia() {
        $id = $this->uri->segment(4);
        $del = $this->conteudo_m->excluir(array('idConteudo' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Notícia excluida com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir notícia!', 'danger'));
        }
        redirect(base_url('admin/conteudo/noticias'));
    }

    public function excluirEvento() {
        $id = $this->uri->segment(4);
        $del = $this->conteudo_m->excluir(array('idConteudo' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Evento excluida com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir Evento!', 'danger'));
        }
        redirect(base_url('admin/conteudo/eventos'));
    }

}

?>