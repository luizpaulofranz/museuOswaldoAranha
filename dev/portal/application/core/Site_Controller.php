<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //aqui estamos setando o template que o usuario comum ira  visualizar
        $this->template->set_template('frontend');   
    }
    
    public function logado(){
        return $this->session->userdata('clienteLogado');
    }

}