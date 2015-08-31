<?php

class Tipoconteudo_m extends CI_Model {

    private $tabela = 'tipoConteudo';

    function __construct() {
        parent::__construct();
    }

    public function listar($n = NULL, $offset = NULL) {
        return $this->db->get($this->tabela, $n, $offset);
    }

    public function cadastrar($dados = array()) {
        unset($dados['id'], $dados['button']);
        return $this->db->insert($this->tabela, $dados);
    }

    //essa funcao vai apenas fazer o update
    public function alterar($dados) {
        $id = $dados['idTipoConteudo'];
        unset($dados['button'], $dados['idTipoConteudo']);
        return $this->db->update($this->tabela, $dados, array('idTipoConteudo' => $id));
    }

    public function excluir($dados) {
        return $this->db->delete($this->tabela, $dados);
    }

    //aqui faz o select dos dados para editar
    public function getDataById($id) {
        $query = $this->db->get_where($this->tabela, array('idTipoConteudo' => $id));
        //$retorno = '';
        foreach ($query->result() as $value) {
            return $value;
        }
    }

    /**
     * Retorna os tipos de conteudo em um array contendo chave(id) e valor (descrição).
     * @return array
     */
    public function getCombo() {
        $chave = array('' => '');
        $valor = array('' => '');
        $this->db->order_by("descricao", "asc");
        $query = $this->db->get($this->tabela);
        foreach ($query->result() as $value) {
            $chave[] = $value->idTipoConteudo;
            $valor[] = $value->descricao;
        }

        $retorno = array_combine($chave, $valor);
        return $retorno;
    }
    

}

?>
