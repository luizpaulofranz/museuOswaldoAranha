<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Controller extends MX_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->template->set_template('admin');
        
        $this->load->model('administrador/administrador_m');
        
        if((!$this->logado()) && ($this->uri->segment(2) != 'login')){
            redirect(base_url('admin/login'));
        }
        
        if($this->logado()){
            $this->template->write_view('menu_superior', 'admin/menu_superior');
        }
    }
    
    public function logado(){
        return $this->session->userdata('logado');
    }

}