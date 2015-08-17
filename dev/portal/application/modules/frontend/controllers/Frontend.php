<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend extends Site_Controller {

    public $agendaEventos;


    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p>', '</p></div>');
    }

    function index() {
        $this->template->write_view('capa', 'capaInicial');
        $this->template->write_view('conteudo', 'conteudoInicial');
        $this->template->render();
    }
    
    function sobre() {
        $this->template->write_view('capa', 'capaSobre');
        $this->template->write_view('conteudo', 'conteudoSobre');
        $this->template->render();
    }
    
    function eventos() {
        $this->template->write_view('capa', 'capaEventos');
        $this->template->write_view('conteudo', 'conteudoEventos');
        $this->template->render();
    }
    
    function aprenda() {
        $this->template->write_view('capa', 'capaAprenda');
        $this->template->write_view('conteudo', 'conteudoAprenda');
        $this->template->render();
    }
    
    function amigosDoMuseu() {
        $this->template->write_view('capa', 'capaAmigos');
        $this->template->write_view('conteudo', 'conteudoAmigos');
        $this->template->render();
    }
    
    function visite() {
        $this->template->write_view('capa', 'capaVisite');
        $this->template->write_view('conteudo', 'conteudoVisite');
        $this->template->render();
    }

    function contato($tipo = null) {
        $data['mensagem'] = '';
        if ($this->input->post()) {
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

            $this->form_validation->set_rules('nome', 'Nome', 'trim|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('assunto', 'Assunto', 'trim|max_length[150]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|unique|min_length[6]|max_length[100]');
            $this->form_validation->set_rules('mensagem', 'Mensagem', 'required|trim');
            $this->form_validation->set_rules('telefone', 'Telefone', 'integer');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', TRUE);
                $nome = $this->input->post('nome', TRUE);
                $telefone = $this->input->post('telefone', TRUE);
                $mensagem = $this->input->post('mensagem', TRUE);
                $assunto = $this->input->post('assunto', TRUE);

                $ci->email->from($email, $nome);
                $ci->email->to('cea@feitiodoalegrete.com.br');

                $ci->email->subject($assunto);
                $ci->email->message('<html><head></head><body>
                Nome:       ' . $nome . ' <br />
                E-mail:     ' . $email . ' <br />
                Telefone:   ' . $telefone . ' <br />
                Assunto:    ' . $assunto . ' <br />
                Mensagem:   ' . $mensagem . ' <br />
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
            //$data['action'] = site_url('contato/enviaEmail');
            //$this->load->view('contato', $data);
        }

        $this->template->write_view('capa', 'capaContato');
        $this->template->write_view('conteudo', 'frontend/conteudoContato', $data);
        $this->template->render();
    }

}
