<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('editoria/editoria_m');
        //$this->load->model('equipe/equipe_m');
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
        $ate = ($this->uri->segment(4, 1) - 1) * $n;
        //$ate = $this->uri->segment(4, 0);
        $editorias = $this->editoria_m->listar($n, $ate);
        $total = $this->editoria_m->listar();
        $this->template->write_view('conteudo', 'admin/listar', array('editorias' => $editorias));
        $this->template->write_view('conteudo', 'admin/pagination', array('total' => $total->num_rows()));
        $this->template->render();
    }

    public function cadastrar() {
        //var_dump($this->input->post());exit();
        $txt = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            //setamos regras de validacao
            //parametros, primeiro nome campo, o segundo é o nome para exibir no caso de erros, validacoes,
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]|max_length[150]');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //chamamos a funcao login do model usuario_m e passamos os campos que vieram do form como parametros
                if ($this->editoria_m->cadastrar($this->input->post())) {
                    $txt['mensagem'] = alert('Sucesso ao cadastrar a Editoria!', 'success');
                } else {
                    $txt['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                //aqui setamos os erros para exibir no form
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }
        //aki estamos escrecendo as views, conteudo eh a variavel conteudo que esta no arquivo admin_template
        //passamos tbm o array txt, q vai procurar no arquivo admin/login.php variáveis com as posicoes do array
        $this->template->write_view('conteudo', 'admin/form', $txt);
        $this->template->render();
    }

    public function alterar() {
        $txt = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('id', 'Id', 'required|trim|min_length[1]|max_length[150]');
            if ($this->form_validation->run()) {
                if ($this->editoria_m->alterar($this->input->post())) {
                    $txt['mensagem'] = alert('Sucesso ao alterar a Editoria!', 'success');
                } else {
                    $txt['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $txt['registro'] = $this->editoria_m->getDataById($this->uri->segment(4));

        $this->template->write_view('conteudo', 'admin/form', $txt);
        $this->template->render();
    }

    public function excluir() {
        $id = $this->uri->segment(4);
        $produto = $this->editoria_m->analizaProdutoByCategoria($id);
        if (!$produto) {
            $del = $this->editoria_m->excluir(array('id' => $id));
            if ($del) {
                $this->session->set_flashdata('msg', alert('Editoria excluida com sucesso!', 'success'));
            } else {
                $this->session->set_flashdata('msg', alert('Erro ao excluir categoria!', 'danger'));
            }
        } else {
            $this->session->set_flashdata('msg', alert('Impossível excluir editoria, há conteúdos cadastrados nela!', 'danger'));
        }
        redirect(site_url('admin/editoria'));
    }

}

?>