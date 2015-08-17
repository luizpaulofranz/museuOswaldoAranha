<?php

class Media_m extends CI_Model {

    private $tabela = 'media';

    function __construct() {
        parent::__construct();
    }

    function cadastrar($dados) {
        //unset($dados['button'], $dados['idMedia']);
        return $this->db->insert($this->tabela, $dados);
    }

    //essa funcao vai apenas fazer o update
    public function alterar($dados) {
        if (!isset($dados['ativo'])) {
            $dados['ativo'] = 0;
        } else {
            $dados['ativo'] = 1;
        }
        $id = $dados['idMedia'];
        unset($dados['idMedia'], $dados['button']);
        return $this->db->update($this->tabela, $dados, array('idMedia' => $id));
    }
    
    public function destacar($where) {
        $dados = array('destaque' => 0);
        $this->db->update($this->tabela, $dados, array('idConteudo' => $where['idConteudo']));
        $dados = array('destaque' => 1);
        return $this->db->update($this->tabela, $dados, $where);
    }

    public function listar($idConteudo = NULL, $limit = NULL, $offset = NULL) {
        $this->db->select('media.*');
        $where = array();
        if(!is_null($idConteudo)){
            $this->db->join('conteudo', 'conteudo.idConteudo = media.idConteudo');
            $where['conteudo.idConteudo'] = $idConteudo;
        }
        $this->db->order_by('media.idMedia', 'desc');
        return $this->db->get_where($this->tabela, $where, $limit, $offset);
    }

    //aqui faz o select dos dados para editar
    public function getDataById($id) {
        $query = $this->db->get_where($this->tabela, array('idMedia' => $id));
        return $query->row_array();
    }

    /**
     * Método responsável por deletar uma media, tanto do banco quanto o arquivo.
     * Recebendo como parametro um array contendo o where do comando SQL.
     * @param array $dados
     * @return boolean
     */
    public function excluir($dados) {
        //remover a foto
        $local_arquivo = $this->db->select('idConteudo, nome, dataUpload')->get_where($this->tabela, $dados)->row();
        //o select retorna um array de objetos
        //Analisamos se o diretorio existe, caso nao exista, podemos seguir adiante e deletar do banco
        //FCPATH eh uma constante definida no arquivo index.php
        $diretorio = FCPATH . 'assets'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.date('Y', strtotime($local_arquivo->dataUpload)).DIRECTORY_SEPARATOR.date('m', strtotime($local_arquivo->dataUpload)).DIRECTORY_SEPARATOR.'conteudo_' . $local_arquivo->idConteudo;
        if (is_dir($diretorio)) {
            //analizamos se tem alguma imagem para deletar
            if (is_file($diretorio . DIRECTORY_SEPARATOR . $local_arquivo->nome)) {
                if (!unlink($diretorio . DIRECTORY_SEPARATOR . $local_arquivo->nome)) {
                    return false;
                }
            }
            if (is_file($diretorio . DIRECTORY_SEPARATOR . 'min_' . $local_arquivo->nome)) {
                if (!unlink($diretorio . DIRECTORY_SEPARATOR . 'min_' . $local_arquivo->nome)) {
                    return false;
                }
            }
            if (is_file($diretorio . DIRECTORY_SEPARATOR . 'med_' . $local_arquivo->nome)) {
                if (!unlink($diretorio . DIRECTORY_SEPARATOR . 'med_' . $local_arquivo->nome)) {
                    return false;
                }
            }
            if (is_file($diretorio . DIRECTORY_SEPARATOR . 'prod_' . $local_arquivo->nome)) {
                if (!unlink($diretorio . DIRECTORY_SEPARATOR . 'prod_' . $local_arquivo->nome)) {
                    return false;
                }
            }
            if (is_file($diretorio . DIRECTORY_SEPARATOR . 'original_' . $local_arquivo->nome)) {
                if (!unlink($diretorio . DIRECTORY_SEPARATOR . 'original_' . $local_arquivo->nome)) {
                    return false;
                }
            }
            //excluir banners
            //ainda nao estamos utilizando
        }elseif(is_dir(FCPATH . 'assets/uploads/banners')){
            $diretorio = FCPATH . 'assets/uploads/banners';
            //analizamos se tem alguma imagem para deletar
            //deletamos primeiro a normal
            if (is_file($diretorio. DIRECTORY_SEPARATOR . $local_arquivo->nome)) {
                if (!unlink(FCPATH . 'assets/uploads/banners'. DIRECTORY_SEPARATOR . $local_arquivo->nome)) {
                    return false;
                }
            }
            //deletamos a miniatura
            if (is_file($diretorio. DIRECTORY_SEPARATOR . 'min_'.$local_arquivo->nome)) {
                if (!unlink(FCPATH . 'assets/uploads/banners'. DIRECTORY_SEPARATOR . 'min_'.$local_arquivo->nome)) {
                    return false;
                }
            }
            //deletamos a original
            if (is_file($diretorio. DIRECTORY_SEPARATOR . 'original_'.$local_arquivo->nome)) {
                if (!unlink(FCPATH . 'assets/uploads/banners'. DIRECTORY_SEPARATOR . 'original_'.$local_arquivo->nome)) {
                    return false;
                }
            }
        }
        //analizar se há fotos no diretorio, se não houver deletar o diretorio tbm
        $analiza = 0;
        $ponteiro = opendir($diretorio);
        // pega o ultimo contador do nome do arquivo
        while ($nome_itens = readdir($ponteiro)) {
            if ($nome_itens != "." && $nome_itens != "..") {
                //var_dump($nome_itens);
                $analiza++;
            }
        }
        //se nao tiver nenhum arquivo deletamos o diretorio
        if ($analiza == 0) {
            $this->exclui_dir($diretorio);
        }

        return $this->db->delete($this->tabela, $dados);
    }

    public function exclui_dir($Dir) { // -------------------------------------------------------------------
        //  Exclui o Diretório dado com todos seus sub-diretórios e arquivos:
        //  Obs.:   - Função recursiva;
        //          - Montada para Linux (Separador "/").
        // -------------------------------------------------------------------   
        if ($dd = opendir($Dir)) {
            while (false !== ($Arq = readdir($dd))) {
                if ($Arq != "." && $Arq != "..") {
                    $Path = "$Dir/$Arq";
                    if (is_dir($Path)) {
                        $this->exclui_dir($Path);
                    } elseif (is_file($Path)) {
                        unlink($Path);
                    }
                }
            }
            closedir($dd);
        }
        rmdir($Dir);
    }

}

?>
