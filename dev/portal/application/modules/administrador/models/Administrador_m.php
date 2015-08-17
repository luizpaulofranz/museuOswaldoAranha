<?php
class Administrador_m extends CI_Model{
    private $tabela = 'administrador';
    
    function __construct() {
        parent::__construct();
    }
    
    function login(){
        $senha_cript = sha1($this->input->post('senha'));
        $query = $this->db->get_where($this->tabela, array('email' => $this->input->post('email'), 'senha' => $senha_cript, 'ativo' => 1));
        
        //echo $this->db->last_query();exit();
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $u) {}
                $this->session->set_userdata(array('logado'=>1, 'usuario' => $u->nome, 'idAdministrador'=>$u->idAdministrador));
                return true;
        }
        return false;
    }
    
    function cadastrar($dados = array()){
        unset($dados['idAdministrador'], $dados['button']);
        $dados['senha'] = sha1($dados['senha']);
        return $this->db->insert($this->tabela,$dados);
    }
    
    public function listar($limit = NULL, $offset = NULL){
        return $this->db->get($this->tabela,$limit,$offset);
    }
    
    public function excluir($dados) {
        return $this->db->delete($this->tabela, $dados);
    }
    //essa funcao vai apenas fazer o update
    public function alterar($dados) {
        $id = $dados['idAdministrador'];
        unset($dados['button'], $dados['idAdministrador']);
        if(isset($dados['ativo'])){
            $dados['ativo'] = 1;
        }else{
            $dados['ativo'] = null;
        }
        $dados['senha'] = sha1($dados['senha']);
        return $this->db->update($this->tabela,$dados, array('idAdministrador' => $id));
    }
    //aqui faz o select dos dados para editar
    public function getDataById($id){
        $query = $this->db->get_where($this->tabela, array('idAdministrador' => $id));
        return $query->row_array();
    }
    
}
?>
