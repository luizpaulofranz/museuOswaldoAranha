<?php

class Conteudo_m extends CI_Model {

    private $tabela = 'conteudo';

    function __construct() {
        parent::__construct();
    }

    /**
     * Método responsável por recuperar os dados de conteúdo, fazendo a junção 
     * do conteúdo em questão com seu autor (administrador) e tipo de conteudo.
     * @param int $limit
     * @param int $offset
     * @param boolean $incluiRascunhos
     * @param string $slugTipoConteudo
     * @return result_set
     */
    public function listar($limit = NULL, $offset = NULL, $incluiRascunhos = true, $slugTipoConteudo = null) {
        $where = array();
        $this->db->select('conteudo.*, administrador.nome as autor');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        if ($slugTipoConteudo) {
            $this->db->join('tipoConteudo', 'tipoConteudo.idTipoConteudo = conteudo.idTipoConteudo', 'INNER OUTER');
            $where['tipoConteudo.slug'] = $slugTipoConteudo;
        }
        $this->db->order_by('conteudo.data', 'DESC');

        if (!$incluiRascunhos) {
            $where['conteudo.rascunho'] = 0;
            return $this->db->get($this->tabela, $limit, $offset);
        }

        return $this->db->get_where($this->tabela, $where, $limit, $offset);
    }

    /**
     * Método responsável por recuperar os destaques do tipo carousel
     * @param int $limit
     * @return result_set
     */
    public function getCarousel($limit = 3) {
        $this->db->select('conteudo.titulo, conteudo.slug, media.urlPath, media.nome AS imagem,');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.data', 'DESC');
        $where = 'conteudo.rascunho = 0 AND conteudo.destaque = \'c\'';
        $where.= ' AND media.destaque=1'; //nunca havera mais de duas medias como destaque
        return $this->db->get_where($this->tabela, $where, $limit);
    }

    /**
     * Método responsável por inserir dados na tabela "conteudo"
     * @param array $dados
     * @return boolean
     */
    public function cadastrar($dados = array()) {
        //var_dump($this->session->userdata['id_usuario']);exit();
        if ($dados['button'] == 'Rascunho') {
            $dados['rascunho'] = 1;
        } else {
            $dados['rascunho'] = 0;
        }
        unset($dados['idConteudo'], $dados['button']);
        if ($this->db->insert($this->tabela, $dados)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Método responsável por fazer os updates na tabela "conteudo".
     * @param array $dados
     * @return boolean
     */
    public function alterar($dados) {
        $id = $dados['idConteudo'];
        if ($dados['button'] == 'Rascunho') {
            $dados['rascunho'] = 1;
        } else {
            $dados['rascunho'] = 0;
        }
        unset($dados['button'], $dados['idConteudo']);
        return $this->db->update($this->tabela, $dados, array('idConteudo' => $id));
    }

    /**
     * Método responsável por deletar um conteúdo. Exclui também todas as imagens
     * anexadas ao conteúdo em questão, recebendo como parametro um array no formato:
     * array('idConteudo' => 2);
     * @param array $dados
     * @return boolean
     */
    public function excluir($dados) {
        $this->load->model('media/media_m');
        //select para pegar as imgs do produto
        $imgs = $this->db->get_where('media', $dados)->result_array();
        //aki deletamos todas as imgs
        foreach ($imgs as $img) {
            $this->media_m->excluir(array('idMedia' => $img['idMedia']));
        }
        return $this->db->delete($this->tabela, $dados);
    }

    /**
     * Retorna um registro da tabela conteudo, recebendo seu Id como parametro.
     * @param int $idConteudo
     * @return array
     */
    public function getDataById($idConteudo) {
        $query = $this->db->get_where($this->tabela, array('idConteudo' => $idConteudo));
        return $query->row_array();
    }

    /**
     * Retorna o id de um conteudo, dado seu slug
     * @param type $slug
     * @return type
     */
    public function getIdBySlug($slug) {
        $query = $this->db->get_where($this->tabela, array('conteudo.slug' => $slug))->row_array();
        //retorna uma unica linha
        return $query['idConteudo'];
    }

    /**
     * Retorna um registro da tabela conteudo, recebendo seu slug como parametro.
     * @param string $slug
     * @return array
     */
    public function getDataBySlug($slug) {
        $this->db->select('conteudo.*, administrador.nome AS autor, media.urlPath, media.nome AS imagem');
        $where = '(media.destaque=1 OR media.idMedia IS NULL) AND conteudo.slug = "' . $slug . '"';
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $query = $this->db->get_where($this->tabela, $where);
        //retorna uma unica linha
        return $query->row_array();
    }

    /**
     * Método responsável por recuperar as noticias.
     * @param int $limit
     * @param int $offset
     * @param boolean $apenasAtivos
     * @return array
     */
    public function listarNoticia($limit = NULL, $offset = NULL, $apenasAtivos = false) {

        $slugTipoConteudo = 'noticias';

        $where = ' (media.destaque=1 OR media.idMedia IS NULL) AND tipoConteudo.slug = "' . $slugTipoConteudo . '"';
        if ($apenasAtivos == TRUE) {
            $where .= ' AND conteudo.rascunho = 0';
        }

        $this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, administrador.nome as autor');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('tipoConteudo', 'conteudo.idTipoConteudo = tipoConteudo.idTipoConteudo', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.idConteudo', ' DESC');
        return $this->db->get_where($this->tabela, $where, $limit, $offset);
    }

    /**
     * Método responsável por recuperar os eventos.
     * @param int $limit
     * @param int $offset
     * @param boolean $apenasAtivos
     * @return array
     */
    public function listarEvento($limit = NULL, $offset = NULL, $apenasAtivos = false) {

        $slugTipoConteudo = 'eventos';

        $where = ' (media.destaque=1 OR media.idMedia IS NULL) AND tipoConteudo.slug = "' . $slugTipoConteudo . '"';
        if ($apenasAtivos == TRUE) {
            $where .= ' AND conteudo.rascunho = 0';
        }

        $this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, administrador.nome as autor');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('tipoConteudo', 'conteudo.idTipoConteudo = tipoConteudo.idTipoConteudo', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.idConteudo', ' DESC');
        return $this->db->get_where($this->tabela, $where, $limit, $offset);
    }
    
    /**
     * Método responsável por recuperar as noticias.
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function listarAcervoMuseu($limit = NULL, $offset = NULL) {

        $slugTipoConteudo = 'acervo-do-museu';

        $where = ' (media.destaque=1 OR media.idMedia IS NULL) AND tipoConteudo.slug = "' . $slugTipoConteudo . '"';

        //$this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, administrador.nome as autor');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('tipoConteudo', 'conteudo.idTipoConteudo = tipoConteudo.idTipoConteudo', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.idConteudo', ' DESC');
        return $this->db->get_where($this->tabela, $where, $limit, $offset);
    }

    /**
     * Método responsável por fazer as buscas digitadas pelo usuário.
     * @param int $limit
     * @param int $offset
     * @param boolean $apenasAtivos
     * @param string $busca
     * @return array
     */
    public function buscarNoticia($limit = NULL, $offset = NULL, $apenasAtivos = false, $busca) {
        $where = '(conteudo.titulo LIKE \'%' . $busca . '%\' OR editoria.nome LIKE \'%' . $busca . '%\')';
        if ($apenasAtivos == TRUE) {
            $where .= ' AND conteudo.rascunho = 0';
        }
        $where.= ' AND (media.destaque=1 OR media.idMedia IS NULL)';

        $this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, editoria.nome as editoria, administrador.nome as autor');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.idConteudo', ' DESC');
        return $this->db->get_where($this->tabela, $where, $limit, $offset)->result_array();
    }

    /**
     * Método responsável por inserir e alterar dados da pagina de acervo cientifico.
     * @param array $dados
     */
    public function salvarAcervoCientifico($dados = array()) {
        if ($dados['button'] == 'Rascunho') {
            $dados['rascunho'] = 1;
        } else {
            $dados['rascunho'] = 0;
        }
        $row = $this->getDataBySlug($dados['slug']);
        unset($dados['idConteudo'], $dados['button']);
        if ($row) {
            return $this->db->update($this->tabela, $dados, array('slug' => $dados['slug']));
        } else {
            return $this->db->insert($this->tabela, $dados);
        }
    }
    
    /**
     * Retorna um array contendo o tipo conteudo deste objeto;
     * @param int $id_conteudo
     */
    public function getTipoConteudo($id_conteudo){
        $this->db->select('tipoConteudo.*');
        $this->db->join('tipoConteudo', 'tipoConteudo.idTipoConteudo = conteudo.idTipoConteudo', 'INNER OUTER');
        
        return $this->db->get_where($this->tabela, array('conteudo.idConteudo' => $id_conteudo))->row_array();
    }

}

?>
