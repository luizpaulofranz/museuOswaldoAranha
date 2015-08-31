<?php

class Usuario_m extends CI_Model {

    private $tabela = 'usuario';

    function __construct() {
        parent::__construct();
    }

    function login() {
        $senha_cript = sha1($this->input->post('senha'));
        $query = $this->db->get_where($this->tabela, array('email' => $this->input->post('email'), 'senha' => $senha_cript));
        //echo $this->db->last_query();exit();
        if ($query->num_rows() > 0) {
            $u = $query->row_array();
            $this->session->set_userdata(array('clienteLogado' => 1, 'clienteNome' => $u['nome'], 'idUsuario' => $u['idUsuario']));
            return true;
        }
        return false;
    }

    function cadastrar($dados = array()) {
        unset($dados['idUsuario']);
        $dados['senha'] = sha1($dados['senha']);
        return $this->db->insert($this->tabela, $dados);
    }

    /**
     * Verifica se o usuário que está tentando se cadastrar já está cadastrado, usando o CPF e o Email.
     * @param type $dados - post do formulario
     * @return boolean - true se existe false caso contrario
     */
    public function existsByEmail($dados = array()) {
        $this->db->where('email', $dados['email']);
        //$this->db->or_where('cpf_cnpj', $dados['cpf_cnpj']);
        $cliente = $this->db->get($this->tabela)->result_array();
        if (count($cliente) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listar($n = NULL, $offset = NULL) {
        return $this->db->get($this->tabela, $n, $offset);
    }

    public function excluir($dados) {
        return $this->db->delete($this->tabela, $dados);
    }

    //essa funcao vai apenas fazer o update
    public function alterar($dados) {
        $id = $dados['idUsuario'];
        unset($dados['button'], $dados['idUsuario']);
        return $this->db->update($this->tabela, $dados, array('idUsuario' => $id));
    }

    //aqui faz o select dos dados para editar
    public function getDataById($id) {
        $query = $this->db->get_where($this->tabela, array('idUsuario' => $id));
        //$retorno = '';
        return $query->row_array();
    }

    /**
     * Verifica se um usuario (cliente) possui ou não pedidos em seu histórico.
     * @param int $idUsuario
     * @return boolean
     */
    public function analizaUsuarioByPedido($idUsuario) {
        $this->db->select('pedido.idPedido AS id');
        $this->db->group_by('pedido.idUsuario');
        $query = $this->db->get_where('pedido', array('pedido.idUsuario' => $idUsuario), 1)->result();
        $analizaPedido = $query[0];
        //var_dump($analiza_produto);exit();
        if (!is_null($analizaPedido->id)) {
            //retorna true se houver pedidos
            return true;
        } else {
            return false;
        }
    }

}

?>
