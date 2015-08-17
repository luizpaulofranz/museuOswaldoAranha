<?php

class Conteudo_m extends CI_Model {

    private $tabela = 'conteudo';

    function __construct() {
        parent::__construct();
    }

    /**
     * Método responsável por recuperar os dados de conteúdo, fazendo a junção 
     * do conteúdo em questão com seu autor (administrador) e a editoria.
     * @param int $limit
     * @param int $offset
     * @param boolean $incluiRascunhos
     * @return result_set
     */
    public function listar($limit = NULL, $offset = NULL, $incluiRascunhos = true) {
        $this->db->select('conteudo.*, editoria.nome as editoria, administrador.nome as autor');

        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria', 'LEFT OUTER');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->order_by('conteudo.data', 'DESC');
        if ($incluiRascunhos) {
            return $this->db->get($this->tabela, $limit, $offset);
        } else {
            return $this->db->get_where($this->tabela, array('conteudo.rascunho' => 0), $limit, $offset);
        }
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
        $where.= ' AND media.destaque=1';//nunca havera mais de duas medias como destaque
        return $this->db->get_where($this->tabela, $where, $limit);
    }
    
    /**
     * Método responsável por recuperar os destaques do tipo carousel
     * @param int $limit
     * @return result_set
     */
    public function getDestaqueLateral($limit = 2) {
        $this->db->select('conteudo.titulo, conteudo.slug, media.urlPath, media.nome AS imagem, editoria.nome as editoria, editoria.slug as slug_editoria');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria', 'LEFT OUTER');
        $this->db->order_by('conteudo.data', 'DESC');
        $where = 'conteudo.rascunho = 0 AND conteudo.destaque = \'l\'';
        $where.= ' AND media.destaque=1';//nunca havera mais de duas medias como destaque
        return $this->db->get_where($this->tabela, $where, $limit);
    }

    /**
     * Retorna um array de conteudos de uma editoria, retorna os conteudos da editoria filho.
     * @param int $limit - Limite do select
     * @param int $offset - Offset do select
     * @param boolean $apenasAtivos - listar apenas ativos ou falsos
     * @param string $idSlugEditoria - id ou slug da editoria
     * @param boolean $telaInicial ne tela inicial, nao devem aparecer os conteudos do carousel
     * @return array
     */
    public function listarByEditoria($limit = NULL, $offset = NULL, $apenasAtivos = false, $idSlugEditoria = 'todos', $telaInicial = false) {
        $where = '';

        if ($apenasAtivos) {
            $where = 'conteudo.rascunho = 0 ';
        } else {
            $where = 'conteudo.rascunho = 1 ';
        }
        if($telaInicial){
            //$where.='AND (conteudo.destaque != \'c\' AND conteudo.destaque != \'l\')';
        }

        if ($idSlugEditoria != 'todos') {
            $idPai = $this->editoria_m->getId($idSlugEditoria);
            if (is_null($idPai)) {
                $idPai = '0';
            }
            //var_dump($idPai);exit();

            if (is_numeric($idSlugEditoria)) {
                $where .= 'AND (editoria.idEditoria =' . $idSlugEditoria . ' OR editoria.idPai=' . $idPai . ')';
            } else if (!is_numeric($idSlugEditoria)) {
                $where .= 'AND (editoria.slug="' . $idSlugEditoria . '" OR editoria.idPai = ' . $idPai . ')';
            }
            $where.= ' AND (media.destaque=1 OR media.idMedia IS NULL)';
        } else {
            $where.= ' AND (media.destaque=1 OR media.idMedia IS NULL)';
        }
        $this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, editoria.nome as editoria, administrador.nome as autor, editoria.slug as slug_editoria');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->order_by('conteudo.idConteudo', 'DESC');
        return $this->db->get($this->tabela, $limit, $offset);
        //echo $this->db->last_query();exit();
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
        if ($dados['idTipoConteudo'] != '11') {
            $dados['idEditoria'] = null;
        }
        if(!isset($dados['destaque'])){
            $dados['destaque'] = null;
        }
        $dados['data'] = date('Y-m-d H:i:s');
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
        $this->db->delete('tagsConteudo', $dados);
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
        $this->db->select('conteudo.*, editoria.nome AS editoria, administrador.nome AS autor, media.urlPath, media.nome AS imagem');
        $where = '(media.destaque=1 OR media.idMedia IS NULL) AND conteudo.slug = "' . $slug . '"';
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $query = $this->db->get_where($this->tabela, $where);
        //retorna uma unica linha
        return $query->row_array();
    }

    /**
     * Método responsável por recuperar as notícias mais acessadas de uma editoria.
     * @param int $limit
     * @param boolean $apenasAtivos
     * @param String $idSlugEditoria
     * @return array
     */
    public function listarTopNewsPorEditoria($limit = 5, $apenasAtivos = false, $idSlugEditoria = '') {

        $where = '';


        if ($apenasAtivos) {
            $where = 'conteudo.rascunho = 0 ';
        } else {
            $where = 'conteudo.rascunho = 1 ';
        }

        if ($idSlugEditoria != '') {
            $idPai = $this->editoria_m->getId($idSlugEditoria);
            if (is_null($idPai)) {
                $idPai = 0;
            }
            if (is_numeric($idSlugEditoria)) {
                $where .= 'AND (editoria.idEditoria =' . $idSlugEditoria . ' OR editoria.idPai=' . $idPai . ')';
            } else if (!is_numeric($idSlugEditoria)) {
                $where .= 'AND (editoria.slug="' . $idSlugEditoria . '" OR editoria.idPai = ' . $idPai . ')';
            }
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->select('conteudo.*, administrador.nome as autor');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->order_by('conteudo.numVisualizacoes', 'DESC');
        return $this->db->get($this->tabela, $limit)->result_array();
    }

    public function listarNews($limit = 5, $apenasAtivos = true, $idSlugEditoria = '') {

        $where = '';


        if ($apenasAtivos) {
            $where = 'conteudo.rascunho = 0 ';
        } else {
            $where = 'conteudo.rascunho = 1 ';
        }

        if ($idSlugEditoria != '') {
            $idPai = $this->editoria_m->getId($idSlugEditoria);
            if (is_null($idPai)) {
                $idPai = 0;
            }
            if (is_numeric($idSlugEditoria) && $apenasAtivos) {
                $where .= 'AND (editoria.idEditoria =' . $idSlugEditoria . ' OR editoria.idPai=' . $idPai . ')';
            } else if (!is_numeric($idSlugEditoria) && $apenasAtivos) {
                $where .= 'AND (editoria.slug="' . $idSlugEditoria . '" OR editoria.idPai = ' . $idPai . ')';
            }
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->select('conteudo.*, administrador.nome as autor');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->order_by('conteudo.idConteudo', 'DESC');
        return $this->db->get($this->tabela, $limit)->result_array();
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
     * Método responsável por buscar noticias associadas a uma tag específica.
     * @param int $limit
     * @param int $offset
     * @param boolean $apenasPublicados
     * @param string $slugTag
     * @return array
     */
    public function buscarByTag($limit = NULL, $offset = NULL, $apenasPublicados = false, $slugTag) {
        //$this->load->model('tag/tag_m');
        $where = '(media.destaque=1 OR media.idMedia IS NULL)';
        if ($apenasPublicados == TRUE) {
            $where .= ' AND conteudo.rascunho = 0';
        }
        //$idTag = $this->tag_m->getIdBySlug($slugTag);
        $where.= ' AND tag.slug="' . $slugTag . '"';

        $this->db->where($where);
        $this->db->select('conteudo.*, media.urlPath, media.nome AS imagem, editoria.nome as editoria, administrador.nome as autor');
        $this->db->join('editoria', 'editoria.idEditoria = conteudo.idEditoria');
        $this->db->join('administrador', 'administrador.idAdministrador = conteudo.idAdministrador', 'INNER OUTER');
        $this->db->join('media', 'media.idConteudo = conteudo.idConteudo', 'LEFT OUTER');
        $this->db->join('tagsConteudo', 'tagsConteudo.idConteudo = conteudo.idConteudo', 'INNER OUTER');
        $this->db->join('tag', 'tagsConteudo.idTag= tag.idTag', 'INNER OUTER');
        $this->db->order_by('conteudo.idConteudo', ' DESC');
        return $this->db->get_where($this->tabela, $where, $limit, $offset)->result_array();
    }

    /**
     * Método responsável por inserir ou alterar as avaliações dos usuários no banco.
     * @param type $dados
     * @return type
     */
    public function avaliar($dados) {
        $avaliacao = $this->db->get_where('avaliacao', array('idUsuario' => $dados['idUsuario'], 'idConteudo' => $dados['idConteudo']));
        //update
        if ($avaliacao->num_rows() > 0) {
            return $this->db->update('avaliacao', array('avaliacao' => $dados['avaliacao']), array('idConteudo' => $dados['idConteudo'], 'idUsuario' => $dados['idUsuario']));
            //insert
        } else {
            return $this->db->insert('avaliacao', $dados);
        }
    }

    /**
     * Retorna a avaliacao de um conteudo por um usuario.
     * @param int $idUsuario
     * @param int $idConteudo
     * @return array
     */
    public function getAvaliacaoUsuario($idUsuario, $idConteudo) {
        $data = $this->db->get_where('avaliacao', array('idUsuario' => $idUsuario, 'idConteudo' => $idConteudo))->row_array();
        if ($data) {
            return $data['avaliacao'];
        } else {
            return 0;
        }
    }

    /**
     * Retorna a média das avaliacoes de um conteudo.
     * @param int $idConteudo
     * @return array
     */
    public function getAvaliacaoMedia($idConteudo) {
        $this->db->select('AVG(avaliacao.avaliacao) as media');
        $this->db->group_by('avaliacao.idConteudo');
        $data = $this->db->get_where('avaliacao', array('idConteudo' => $idConteudo))->row_array();
        if ($data) {
            return $data['media'];
        } else {
            return 0;
        }
    }

}

?>
