<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends Site_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario/usuario_m');
        $this->load->model('endereco/endereco_m');
    }

    public function index() {
        //render carrega, renderiza o template
        $this->pg();
    }

    public function cadastrar() {
        $params = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            //######### DADOS PESSOAIS #######
            $this->form_validation->set_rules('nome', 'Nome Completo', 'required|trim|min_length[3]|max_length[145]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[6]|max_length[145]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim|max_length[120]');
            $this->form_validation->set_rules('senha2', 'Repita Senha', 'required|trim|max_length[120]');
            
            $this->form_validation->set_rules('celular', 'Celular', 'valid_phone|trim|min_length[8]|max_length[17]');
            $this->form_validation->set_rules('telefone', 'Telefone', 'valid_phone|trim|min_length[8]|max_length[17]');
            $this->form_validation->set_rules('dataNascimento', 'Data de Nascimento', 'valid_date_ptbr');
            $this->form_validation->set_rules('sexo', 'Sexo', 'trim|max_length[1]|min_length[1]');
            $this->form_validation->set_rules('formacao', 'Formação', 'trim|max_length[80]');
            $this->form_validation->set_rules('profissao', 'Profissao', 'trim|max_length[80]');
            $this->form_validation->set_rules('empresaAtual', 'Empresa', 'trim|max_length[80]');
            $this->form_validation->set_rules('setorEmpresaAtual', 'Área de Atuação', 'trim|max_length[80]');
            $this->form_validation->set_rules('cargoEmpresaAtual', 'Cargo', 'trim|max_length[80]');

            //############# ENDERECO ##############
            if ($_POST['endereco']['numero'] == '') {
                $_POST['endereco']['numero'] = NULL;
            }
            //Se o camarada decidiu preencher o endereco, alguns dados são obrigatorios, caso contrario nao.
            if ($_POST['endereco']['logradouro'] || $_POST['endereco']['numero'] || $_POST['endereco']['bairro'] || $_POST['endereco']['idEstado']) {
                $this->form_validation->set_rules('endereco[idCidade]', 'Cidade', 'required|integer');
                $this->form_validation->set_rules('endereco[logradouro]', 'Logradouro', 'required|trim|min_length[1]|max_length[145]');
                $this->form_validation->set_rules('endereco[bairro]', 'Bairro', 'required|trim|min_length[2]|max_length[75]');
                $this->form_validation->set_rules('endereco[numero]', 'Número', 'required|integer');
            } else {
                $this->form_validation->set_rules('endereco[idCidade]', 'Cidade', 'integer');
                $this->form_validation->set_rules('endereco[logradouro]', 'Logradouro', 'trim|max_length[145]');
                $this->form_validation->set_rules('endereco[bairro]', 'Bairro', 'trim|max_length[75]');
                $this->form_validation->set_rules('endereco[numero]', 'Número', 'integer');
            }
            $this->form_validation->set_rules('endereco[idEstado]', 'Estado', 'trim|integer');
            $this->form_validation->set_rules('endereco[complemento]', 'Complemento', 'trim|max_length[100]');
            $this->form_validation->set_rules('endereco[cep]', 'CEP', 'trim|max_length[9]');

            //##########CIDADE NATAL ###########
            //se usuario escolhe o estado natal, precisa escolher a cidade natal tambem
            $this->form_validation->set_rules('idEstadoNatal', 'Estado Natal', 'integer');
            if ($this->input->post('idEstadoNatal')) {
                $this->form_validation->set_rules('idCidadeNatal', 'Cidade Natal', 'required|integer');
            } else {
                $this->form_validation->set_rules('idCidadeNatal', 'Cidade Natal', 'integer');
            }
            
            //var_dump($this->form_validation->run(), validation_errors());exit();

            //############## VALIDACAO ################
            if ($this->form_validation->run()) {
                //verificamos se as senhas digitadas conferem
                if ($this->input->post('senha') == $this->input->post('senha2')) {
                    //verificamos se o usuario ja existe
                    if (!$this->usuario_m->existsByEmail($this->input->post())) {
                        $dados = $this->input->post();
                        //verificamos se o usuario preencheu o endereco
                        if (isset($dados['endereco']['idCidade'])) {
                            unset($dados['endereco']['idEstado']);
                            $idEndereco = $this->endereco_m->cadastrar($dados['endereco']);
                            $dados['idEndereco'] = $idEndereco;
                        }
                        //retiramos os campos que nao existem na base
                        unset($dados['endereco'], $dados['idEstadoNatal'], $dados['senha2']);
                        //tratar a data de nascimento
                        if (!$dados['dataNascimento']) {
                            unset($dados['dataNascimento']);
                        } else {
                            //transformamos a data para o formato do banco (jah foi validada);
                            $myDateTime = DateTime::createFromFormat('d/m/Y', $dados['dataNascimento']);
                            $dados['dataNascimento'] = $myDateTime->format('Y-m-d');
                        }
                        if ($this->usuario_m->cadastrar($dados)) {
                            $params['mensagem'] = alert('Sucesso ao cadastrar o usuário!', 'success');
                            //limpar o form nos casos de sucesso
                            $this->sendMail($dados);
                            $this->form_validation->clear_fields();
                        } else {
                            $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                        }
                    } else {
                        $params['mensagem'] = alert('Já existe uma conta associada a esse e-mail!', 'danger');
                    }
                } else {
                    $params['mensagem'] = alert('As senhas digitadas não conferem!', 'danger');
                }
            } else {
                $params['mensagem'] = alert('Erro ao cadastrar!', 'danger');
            }
        }

        $params['estados'] = $this->endereco_m->getComboEstados();
        $this->template->write_view('capa', 'capa');
        $this->template->write_view('conteudo', 'form', $params);
        $this->template->render();
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

    public function login() {

        $params = array();
        //verificamos se tem algo no post
        if ($this->input->post()) {
            //setamos regras de validacao
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
            //executamos a validacao
            if ($this->form_validation->run()) {
                //chamamos a funcao login do model usuario_m e passamos os campos que vieram do form como parametros
                if ($this->usuario_m->login($this->input->post())) {
                    //direciona para  apagina que gerou a requisicao
                    $ref = $this->input->server('HTTP_REFERER', TRUE);
                    redirect($ref, 'location');
                    $params['mensagem'] = alert('Login Efetuado com Sucesso.', 'success');
                } else {
                    $params['mensagem'] = alert('Usuário/Senha não conferem.', 'danger');
                }
            } else {
                //var_dump(validation_errors());exit();
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $params['estados'] = $this->endereco_m->getComboEstados();
        $this->template->write_view('capa', 'capa');
        $this->template->write_view('conteudo', 'form', $params);
        $this->template->render();
    }

    function logout() {
        //$this->session->sess_destroy();
        $this->session->set_userdata(array('clienteLogado' => 0, 'clienteNome' => null, 'idUsuario' => null));
        //redirect(base_url());
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        redirect($ref, 'location');
    }

    public function excluir() {
        $id = $this->uri->segment(4);
        $del = $this->usuario_m->excluir(array('usuario_id' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Usuário Excluido com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir Usuário!', 'danger'));
        }
        redirect(site_url('admin/usuario'));
    }

    //essa funcao eh chama ao clicar no link alterar
    public function alterar() {
        $txt = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('usuario_nome', 'Nome', 'trim|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('usuario_email', 'Email', 'required|trim|valid_email|unique|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('usuario_pass', 'Senha', 'required|trim|max_length[20]');
            $this->form_validation->set_rules('usuario_id', 'Id', 'required|trim|min_length[1]|max_length[150]');
            if ($this->form_validation->run()) {
                if ($this->usuario_m->alterar($this->input->post())) {
                    $txt['mensagem'] = alert('Sucesso ao alterar o Usuário!', 'success');
                } else {
                    $txt['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $txt['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $txt['registro'] = $this->usuario_m->getDataById($this->uri->segment(4));

        $this->template->write_view('conteudo', 'admin/form', $txt);
        $this->template->render();
    }

    /**
     * Método responsável por enviar e-mails de confirmações.
     * (Como a confirmação do cadastro de usuário por exemplo).
     */
    private function sendMail($dados) {
        $data['mensagem'] = '';

        //aki configuramos para o endereco de e-mail deles
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "luizpaulofranz.sites@gmail.com";
        $config['smtp_pass'] = "mPass2014";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $email = $dados['email'];
        $nome = $dados['nome'];
        $telefone = $dados['celular'];
        $assunto = 'Confirmação de Ativação de Conta';

        $ci->email->from('no-reply@smartpampa.com', 'Equipe Smartpampa');
        $ci->email->to($email);

        $ci->email->subject($assunto);
        $ci->email->message('<html><head></head><body>
            <h1>Smartpampa - Confirmação!</h1>
            <p>A equipe smartpampa agradece seu apoio!</p>
            <p>Esse email é uma confirmação de ativação da sua conta smartpampa, abaixo estão os dados do titular da conta:</p>
            <br/>
            <br/>
            <b>
                Nome:       ' . $nome . ' <br/>
                E-mail:     ' . $email . ' <br/>
                Celular:   ' . $telefone . ' <br/>
            </b>
            <br/>
            <br/>
            Sua senha é: <b>'.$dados['senha'].'</b>
            <br/>
            <br/>
            <b>A equipe smartpampa agradece sua atenção!</b>
                </body></html>');

        $em = $ci->email->send();
        if ($em) {
            $data['mensagem'] = alert('E-mail enviado com sucesso. Aguarde contato.', 'success');
            //limpamos os campos do form, para nao repopular nos casos de sucesso
            //essa funcao esta no MY_Form_validation
            $this->form_validation->clear_fields();
        } else {
            $data['mensagem'] = alert('Erro ao enviar o email. Favor enviar um e-mail para cea@feitiodoalegrete.com.br', 'danger');
        }
    }

}

?>