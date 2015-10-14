<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //render carrega, renderiza o template
        $this->pg();
    }

    public function pg() {
        //aqui escrevemos mensagens de erro ou sucesso nas listas
        $this->template->write('conteudo', $this->session->flashdata('msg'));
        $limit = 10;
        //para usar dessa forma, devemos ativar page_numbers no arquivo pagination
        $offset = ($this->uri->segment(4, 1) - 1) * $limit;
        $administradores = $this->administrador_m->listar($limit, $offset);
        $total = $this->administrador_m->listar();
        $this->template->write_view('conteudo', 'admin/listar', array('administradores' => $administradores));
        $this->template->write_view('conteudo', 'admin/pagination', array('total' => $total->num_rows()));
        $this->template->render();
    }

    public function cadastrar() {
        //var_dump($this->input->post());exit();
        $txt = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[5]|max_length[80]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
            $this->form_validation->set_rules('ativo', 'Ativo', 'integer');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //chamamos a funcao login do model usuario_m e passamos os campos que vieram do form como parametros
                if ($this->administrador_m->cadastrar($this->input->post())) {
                    $txt['mensagem'] = alert('Sucesso ao cadastrar o administrador!', 'success');
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

    //essa funcao eh chama ao clicar no link alterar
    public function alterar() {
        $params = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[5]|max_length[80]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
            $this->form_validation->set_rules('ativo', 'Ativo', 'integer');
            $this->form_validation->set_rules('idAdministrador', 'Id', 'required|integer');
            if ($this->form_validation->run()) {
                if ($this->administrador_m->alterar($this->input->post())) {
                    $params['mensagem'] = alert('Sucesso ao alterar o Administrador!', 'success');
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        //var_dump($this->administrador_m->getDataById($this->uri->segment(4)));exit();
        $this->form_validation->set_default($this->administrador_m->getDataById($this->uri->segment(4)));

        $this->template->write_view('conteudo', 'admin/form', $params);
        $this->template->render();
    }

    public function excluir() {
        $id = $this->uri->segment(4);
        $del = $this->administrador_m->excluir(array('idAdministrador' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Administrador Excluido com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir Administrador!', 'danger'));
        }
        redirect(base_url('admin/administrador'));
    }

}

?>