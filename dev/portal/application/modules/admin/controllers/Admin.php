<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $usuario = $this->session->userdata;
        $this->template->write('conteudo', alert("Bem Vindo ".$usuario['usuario']."! Esse é o painel de administração do seu site." , 'success'));
        $this->template->render();
    }

    public function login() {
        //var_dump('aki');exit();
        if ($this->logado()) {
            redirect(base_url('admin'));
        }

        $txt = array();
        //$txt['teste'] = 'teste';
        //verificamos se tem algo no post
        if ($this->input->post()) {
            //setamos regras de validacao
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //chamamos a funcao login do model usuario_m e passamos os campos que vieram do form como parametros
                if ($this->administrador_m->login($this->input->post())) {
                    redirect(base_url('admin'));
                    $txt['mensagem'] = alert('Login Efetuado com Sucesso', 'success');
                } else {
                    $txt['mensagem'] = alert('Erro ao efetuar login', 'danger');
                }
            }else{
                //var_dump(validation_errors());exit();
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }
        //aki estamos escrecendo as views, conteudo eh a variavel conteudo que esta no arquivo admin_template
        //passamos tbm o array txt, q vai procurar no arquivo admin/login.php variáveis com as posicoes do array
        $this->template->write_view('conteudo', 'admin/login', $txt);
        $this->template->render();
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
    }

}

