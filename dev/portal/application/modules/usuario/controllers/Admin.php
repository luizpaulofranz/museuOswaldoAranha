<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario/usuario_m');
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
        $usuarios = $this->usuario_m->listar($n, $ate);
        $total = $this->usuario_m->listar();
        $this->template->write_view('conteudo', 'admin/listar', array('usuarios' => $usuarios));
        $this->template->write_view('conteudo', 'admin/pagination', array('total' => $total->num_rows()));
        $this->template->render();
    }
    
    public function excluir() {
        $id = $this->uri->segment(4);
        $pedido = $this->usuario_m->analizaUsuarioByPedido($id);
        if (!$pedido) {
            $del = $this->usuario_m->excluir(array('idUsuario' => $id));
            if ($del) {
                $this->session->set_flashdata('msg', alert('Cliente excluído com sucesso!', 'success'));
            } else {
                $this->session->set_flashdata('msg', alert('Erro ao excluir cliente!', 'danger'));
            }
        } else {
            $this->session->set_flashdata('msg', alert('Impossível excluir o cliente, há pedidos cadastrados em seu histórico!', 'danger'));
        }
        redirect(site_url('admin/usuario'));
    }

    //essa funcao eh chama ao clicar no link alterar
    public function alterar() {
        $txt = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('cpf_cnpj', 'CPF', 'valid_cpf|required|trim|min_length[11]|max_length[14]');
            $this->form_validation->set_rules('nome', 'Nome Completo', 'required|trim|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('apelido', 'Apelido', 'trim|min_length[1]|max_length[40]');
            $this->form_validation->set_rules('endereco', 'Endereço', 'required|trim|min_length[5]|max_length[254]');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('estado', 'Estado', 'required|trim|min_length[2]|max_length[2]');
            $this->form_validation->set_rules('telefone', 'Telefone', 'valid_phone|trim|min_length[8]|max_length[17]');
            $this->form_validation->set_rules('celular', 'Celular', 'valid_phone|trim|min_length[8]|max_length[17]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|unique|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('senha', 'Senha', 'trim|max_length[120]');
            $this->form_validation->set_rules('senha2', 'Repita Senha', 'trim|max_length[120]');

            $this->form_validation->set_rules('idUsuario', 'Id', 'required|trim|min_length[1]|max_length[150]');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //verificamos se as senhas digitadas conferem
                if ($this->input->post('senha') == $this->input->post('senha2')) {
                    $dados = $this->input->post();
                    if ($dados['senha'] == '' && $dados['senha2'] == '') {
                        unset($dados['senha'], $dados['senha2']);
                    }
                    //verificamos se o usuario ja existe
                    if ($this->usuario_m->alterar($dados)) {
                        $txt['mensagem'] = alert('Sucesso ao alterar o cliente!', 'success');
                        //limpar o form nos casos de sucesso
                        $this->form_validation->clear_fields();
                    } else {
                        $txt['mensagem'] = alert('Erro de banco de dados!', 'danger');
                    }
                } else {
                    $txt['mensagem'] = alert('As senhas digitadas não conferem!', 'danger');
                }
            } else {
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }
        if (!$this->form_validation->has_default()) {
            $this->form_validation->set_default($this->usuario_m->getDataById($this->uri->segment(4)));
        }
        $this->template->write_view('conteudo', 'admin/form', $txt);
        $this->template->render();
    }

    public function cadastrar() {
        $txt = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            //setamos regras de validacao
            //parametros, primeiro nome campo, o segundo é o nome para exibir no caso de erros, validacoes,
            $this->form_validation->set_rules('cpf_cnpj', 'CPF', 'valid_cpf|required|trim|min_length[11]|max_length[14]');
            $this->form_validation->set_rules('nome', 'Nome Completo', 'required|trim|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('apelido', 'Apelido', 'trim|min_length[1]|max_length[40]');
            $this->form_validation->set_rules('endereco', 'Endereço', 'required|trim|min_length[5]|max_length[254]');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required|trim|min_length[3]|max_length[80]');
            $this->form_validation->set_rules('estado', 'Estado', 'required|trim|min_length[2]|max_length[2]');
            $this->form_validation->set_rules('telefone', 'Telefone', 'trim|min_length[8]|max_length[17]|valid_phone');
            $this->form_validation->set_rules('celular', 'Celular', 'trim|min_length[8]|max_length[17]|valid_phone');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|unique|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim|max_length[120]');
            $this->form_validation->set_rules('senha2', 'Repita Senha', 'required|trim|max_length[120]');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //verificamos se as senhas digitadas conferem
                if ($this->input->post('senha') == $this->input->post('senha2')) {
                    //verificamos se o usuario ja existe
                    if (!$this->usuario_m->existsByCpfAndEmail($this->input->post())) {
                        if ($this->usuario_m->cadastrar($this->input->post())) {
                            $txt['mensagem'] = alert('Sucesso ao cadastrar o usuário!', 'success');
                            //limpar o form nos casos de sucesso
                            $this->form_validation->clear_fields();
                        } else {
                            $txt['mensagem'] = alert('Erro de banco de dados!', 'danger');
                        }
                    } else {
                        $txt['mensagem'] = alert('Já existe uma conta associada a esse e-mail/CPF!', 'danger');
                    }
                } else {
                    $txt['mensagem'] = alert('As senhas digitadas não conferem!', 'danger');
                }
            } else {
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $this->template->write_view('conteudo', 'admin/form', $txt);
        $this->template->render();
    }

}

?>