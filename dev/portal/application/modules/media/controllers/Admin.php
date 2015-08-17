<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('media/media_m');
        $this->load->model('conteudo/conteudo_m');
        $this->load->library('image_moo');
    }

    public function index() {
        //render carrega, renderiza o template
        //$this->pg();
        exit('opcao invalida');
    }

    /**
     * Método responsável por fazer o upload e cadastrar no banco uma imagem.
     */
    public function cadastrar() {
        $params = array();
        //o segmento 4 eh o id do conteudo
        if ($this->uri->segment(4)) {
            //$params['conteudo'] = $this->produto_m->getNomeById($this->uri->segment(4));
            $this->form_validation->set_default(array('idConteudo' => $this->uri->segment(4)));
        }
        if ($this->input->post()) {
            $dados_post = $this->input->post();
            //$params['conteudo'] = $this->produto_m->getNomeById($dados_post['idProduto']);
            $this->form_validation->set_default(array('idConteudo' => $dados_post['idConteudo']));
            $this->form_validation->set_rules('idProduto', 'Produto', 'required|integer');
            $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
            if ($this->form_validation->run()) {
                if ($nomeImg = $this->uploadImagem($dados_post['idProduto'])) {
                    $dados_post['nome'] = $nomeImg;
                    $dados_post['urlPath'] = 'assets/uploads/produto_' . $dados_post['idProduto'];
                    $this->media_m->cadastrar($dados_post);
                    $params['mensagem'] = alert('Sucesso ao carregar arquivo.', 'success');
                } else {
                    $params['mensagem'] = $this->image_moo->display_errors('', '');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }
        $this->template->write_view('conteudo', 'admin/form', $params);
        $this->template->render();
    }

    /**
     * Função utilizada para alterar a descrição de uma imagem.
     */
    public function alterar() {
        $params = array();
        //aqui so vai entrar quando clcar no form
        if ($this->input->post()) {
            $this->form_validation->set_rules('idProduto', 'Produto', 'required|integer');
            $this->form_validation->set_rules('idMedia', 'ID', 'required|integer');
            $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
            if ($this->form_validation->run()) {
                if ($this->media_m->alterar($this->input->post())) {
                    $params['mensagem'] = alert('Sucesso ao alterar a Mídia!', 'success');
                } else {
                    $params['mensagem'] = alert('Erro de banco de dados!', 'danger');
                }
            } else {
                $params['mensagem'] = alert(validation_errors(), 'danger');
            }
        }

        $registro = $this->media_m->getDataById($this->uri->segment(4));
        $this->form_validation->set_default($registro);
        $params['produto'] = $this->produto_m->getNomeById($registro['idProduto']);
        $this->template->write_view('conteudo', 'admin/form', $params);
        $this->template->render();
    }
    
    /**
     * Método responsável por fazer o anexo de imagens em um conteudo.
     */
    public function anexarAoConteudo() {
        //array que contem os anexos
        $arrayRetorno = array();
        $conteudo = '';
        if ($this->input->get()) {
            $conteudo = $this->input->get();
            $conteudo = $conteudo['conteudo'];
        }

        if ($this->input->post()) {
            $conteudo = $this->input->post();
            $conteudo = $conteudo['idConteudo'];
        }
        //fazemos o upload dos arquivos
        //so o arquivo for maior que upload_max_filesize no php.ini, o php ignora antes de poder manipular
        //inclusive eh impossivel exiber mensagem de erro.
        //var_dump($_FILES);exit();
        if (isset($_FILES['arquivo'])) {
            $arrayRetorno = $this->uploadImagem($conteudo);
        } else {
            $arrayRetorno = $this->media_m->listar($conteudo);
        }

        $params['arquivos'] = $arrayRetorno->result_array();
        
        $this->template->set_template('upload');
        $this->template->write_view('conteudo', 'admin/form_anexos', $params);
        $this->template->render();
    }
    
    /**
     * Método responsável por excluir um anexo de um conteúdo.
     */
    public function excluirAnexoConteudo() {
        $id_media = $this->uri->segment(4);
        $id_conteudo = $this->uri->segment(5);
        if ($id_media) {
            $this->media_m->excluir(array('idMedia' => $id_media));
        }
        $url = base_url('/admin/conteudo/alterar/' . $id_conteudo);
        redirect($url);
    }
    
    /**
     * Método responsável por excluir um anexo de um conteúdo.
     */
    public function destacarAnexoConteudo() {
        $id_media = $this->uri->segment(4);
        $id_conteudo = $this->uri->segment(5);
        if ($id_media) {
            $this->media_m->destacar(array('idMedia' => $id_media, 'idConteudo' => $id_conteudo));
        }
        $url = base_url('/admin/conteudo/alterar/' . $id_conteudo);
        redirect($url);
    }

    /**
     * Faz o upload e redimensionamento das imagens
     * @param type $conteudo = id do conteudo a receber a imagem.
     * @return false caso algum erro ou o nome do arquivo
     */
    public function uploadImagem($conteudo) {
        //$diretorio = './assets/uploads/produto_' . $idProduto;
        $diretorio = './assets/uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . 'conteudo_' . $conteudo;

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0775, true);
            //quando criamos recursivo temos de dar as permissoes assim
            //chmod('./assets/uploads' . DIRECTORY_SEPARATOR . date('Y'), 0775);
            //chmod('./assets/uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m'), 0775);
            chmod($diretorio, 0775);
            //mkdir($diretorio.'/min');
        }
        //configuracoes dos uploads
        $config['upload_path'] = $diretorio;
        $config['encrypt_name'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '999999999999999999999999999999999999999999999999999999999999'; //tamanho máximo em Kb setar 0 para ilimitada, nao funionou com zero...
        $config['max_width'] = '0'; //largura maxima 0 para ilimitada
        $config['max_height'] = '0'; //altura maxima 0 para ilimitada
        $config['multi'] = 'all'; //configuracao necessaria para o multiupload
        $this->load->library('upload', $config);

        //tratar as imagens
        $erro = isset($this->image_moo->error) ? $this->image_moo->error : false;
        if ($erro) {
            return false;
        }
        //faz o upload, passamos o nome do campo que vem por POST e o nome pro arquivo
        if (!$this->upload->do_upload('arquivo')) {
            //retornamos os erros
            $this->image_moo->set_error(alert($this->upload->display_errors(), 'danger'));
            return false;
        }

        //recuperamos os dados dos uploads
        $ups = $this->upload->data();
        //controle para fazer o upload tanto de uma imagem, como de multiplas imagens
        $uploads = array();
        if(!isset($ups[0])){
            $uploads[0] = $ups;
        }else{
            $uploads = $ups;
        }
        foreach ($uploads as $u) {
            //salvar a miniatura com o mesmo nome na pasta min
            $miniatura = $u['file_path'] . 'min_' . $u['file_name'];
            $media = $u['file_path'] . 'med_' . $u['file_name'];
            //$produto = $u['file_path'] . 'prod_' . $u['file_name'];
            $original = $u['file_path'] . 'original_' . $u['file_name'];
            //fazer a miniatura
            $this->image_moo
                    ->load($u['full_path'])
                    //guardar a original
                    ->save($original, true)
                    //fazer miniatura
                    ->resize_crop(110, 110)
                    ->save($miniatura, true)
                    //fazer a média
                    ->resize_crop(400, 320)
                    //o ultimo parametro eh para preencher o fundo
                    //->resize(400, 300, true)
                    //->round(5)
                    ->save($media, true)

                    //redimensionar para 1024 se for maior do que isso
                    ->resize(1024, 768)
                    ->save($u['file_path'] . $u['file_name'], true);
            $dado = array();
            $dado['urlPath'] = $diretorio = 'assets/uploads/'.date('Y') .'/'. date('m') . '/'. 'conteudo_' . $conteudo;
            $dado['nome'] = $u['file_name'];
            $dado['dataUpload'] = date('Y-m-d');
            $dado['idConteudo'] = $conteudo;
            if (!$this->media_m->cadastrar($dado)) {
                return false;
            }
        }
        $this->image_moo->clear();
        return $this->media_m->listar($conteudo);
    }

    public function excluir() {
        $id = $this->uri->segment(4);
        $del = $this->media_m->excluir(array('idMedia' => $id));
        if ($del) {
            $this->session->set_flashdata('msg', alert('Mídia Excluida com sucesso!', 'success'));
        } else {
            $this->session->set_flashdata('msg', alert('Erro ao excluir a Mídia!', 'danger'));
        }

        //id do produto
        if ($this->uri->segment(5)) {
            $conteudo = $this->uri->segment(5);
        }

        if (isset($conteudo)) {
            redirect(base_url('admin/conteudo/alterar/' . $conteudo . '#sectionB'));
        } else {
            redirect(base_url('admin/conteudo'));
        }
    }

}

?>