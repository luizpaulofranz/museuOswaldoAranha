<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe MY_Form_validation.
 *
 * Esta classe estende a biblioteca de validação nativa do CodeIgniter.
 *
 * @author Carlos Eduardo da Silva
 * @package libraries
 * @link http://blog.tetranet.com.br
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Usada para resetar os dados dos formularios, pois nos casos de sucesso dos form, 
     * estava repopulando o formulario novamente. Chamar esse metodo quando a validação passar.
     */

    public function clear_fields() {

        $this->_field_data = array();
        return $this;
    }

    /*
     * Usada para verificar se há alguma informação default.
     */

    public function has_default() {

        return !empty($this->_field_data);
    }

// --------------------------------------------------------------------

    /**
     * Set a default value for a form
     *
     * Permits you to pulate a form field with the default value.
     *
     * @access	public
     * @param	string	the field name or an array with key => fieldname and value => default value
     * @param	string value default
     * @return	void
     */
    public function set_default($fields = '', $value = '') {

        if (is_array($fields)) {
            foreach ($fields as $field => $value) {
                $this->_field_data[$field]['postdata'] = $value;
            }
        } else {
            $this->_field_data[$fields]['postdata'] = $value;
        }
    }
    
    /**
     * Verifica se a data informada está na estrutura correta do formato pt br
     *
     * @param String $date Uma string contendo a data no formato dd/mm/yyyy
     * @return boolean
     */
    public function valid_date_ptbr($date) {
        //$exp_regular = '#^([1-9]|0[1-9]|[1,2][0-9]|3[0,1])/([1-9]|1[0,1,2])/\d{4}$#';
        $exp_regular = '/^([1-9]|0[1-9]|[1,2][0-9]|3[0,1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/';
        if (preg_match($exp_regular,$date)) {
            $arr = explode('/', $date);

            $dd = $arr[0];
            $mm = $arr[1];
            $yyyy = $arr[2];
            return ( checkdate($mm, $dd, $yyyy) );
        } else {
            return FALSE;
        }
    }

    /**
     * Verifica se a data informada está na estrutura correta do calendário
     * gregoriano.
     *
     * @param String $date Uma string contendo a data no formato yyyy-mm-dd
     * @return boolean
     */
    public function valid_date($date) {

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $arr = explode('-', $date);

            $dd = $arr[2];
            $mm = $arr[1];
            $yyyy = $arr[0];
            return ( checkdate($mm, $dd, $yyyy) );
        } else {
            return FALSE;
        }
    }

    /**
     * Verifica se o CNPJ é valido
     * @param     string
     * @return     bool
     */
    function valid_cnpj($str) {
        if (strlen($str) <> 18)
            return FALSE;
        $soma1 = ($str[0] * 5) +
                ($str[1] * 4) +
                ($str[3] * 3) +
                ($str[4] * 2) +
                ($str[5] * 9) +
                ($str[7] * 8) +
                ($str[8] * 7) +
                ($str[9] * 6) +
                ($str[11] * 5) +
                ($str[12] * 4) +
                ($str[13] * 3) +
                ($str[14] * 2);
        $resto = $soma1 % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;
        $soma2 = ($str[0] * 6) +
                ($str[1] * 5) +
                ($str[3] * 4) +
                ($str[4] * 3) +
                ($str[5] * 2) +
                ($str[7] * 9) +
                ($str[8] * 8) +
                ($str[9] * 7) +
                ($str[11] * 6) +
                ($str[12] * 5) +
                ($str[13] * 4) +
                ($str[14] * 3) +
                ($str[16] * 2);
        $resto = $soma2 % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;
        return (($str[16] == $digito1) && ($str[17] == $digito2));
    }

    /**
     * valid_phone
     *
     * validação simples de telefone
     *
     * @access	public
     * @param	string (99) 9999-9999
     * @return	bool
     */
    function valid_phone($fone) {
        //$fone = '(44) 4444-4444';
        //var_dump($fone,preg_match('/^\(?\d{2}\)?[\s-]?\d{4}-?((\d{4})|(\d{5}))$/',$fone));exit();

        if (preg_match('/^\(?\d{2}\)?[\s-]?\d{4}-?((\d{4})|(\d{5}))$/', $fone)) {
            return TRUE;
        } else {
            return FALSE;
        }
        //$fone = (string) $fone;
    }

    public function valid_time($str) {
        //Assume $str SHOULD be entered as HH:MM

        list($hh, $mm) = explode(':', $str);

        if (!is_numeric($hh) || !is_numeric($mm)) {
            return FALSE;
        } else if ((int) $hh > 24 || (int) $mm > 59) {
            return FALSE;
        } else if (mktime((int) $hh, (int) $mm) === FALSE) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * valid_cep
     *
     * Verifica se CEP é válido
     * 
     * @access	public
     * @param	string
     * @return	bool
     */
    function valid_cep($cep) {
        $CI = & get_instance();
        $CI->form_validation->set_message('valid_cep', 'O campo %s não contém um CEP válido.');

        $cep = str_replace('.', '', $cep);
        $cep = str_replace('-', '', $cep);

        $url = 'http://republicavirtual.com.br/web_cep.php?cep=' . urlencode($cep) . '&formato=query_string';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 0);

        $resultado = curl_exec($ch);
        curl_close($ch);

        if (!$resultado)
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";

        $resultado = urldecode($resultado);
        $resultado = utf8_encode($resultado);
        parse_str($resultado, $retorno);

        if ($retorno['resultado'] == 1 || $retorno['resultado'] == 2)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * valid_tag
     *
     * Verifica se a tag é válida
     * 
     * @access	public
     * @param	string
     * @return	bool
     */
    function valid_tag($tag) {
        $CI = & get_instance();
        $CI->form_validation->set_message('valid_tag', 'O campo %s não contém uma tag válida.');
        if (is_array($tag)) {
            foreach ($tag as $ta) {
                if(!preg_match('/^[A-Za-zÀ-ú0-9.\s]+$/', $tag)){
                    return false;
                }
            }
        } else {
            if (preg_match('/^[A-Za-zÀ-ú0-9.\s]+$/', $tag))
                return TRUE;
            else
                return FALSE;
        }
    }

    /**
     *
     * valid_cpf
     *
     * Verifica CPF é válido
     * @access	public
     * @param	string
     * @return	bool
     */
    function valid_cpf($cpf) {
        $CI = & get_instance();

        $CI->form_validation->set_message('valid_cpf', 'O %s informado não é válido.');

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf)) {
            return false;
        }

        // 9 primeiros digitos do cpf
        $digit = substr($cpf, 0, 9);

        // calculo dos 2 digitos verificadores
        for ($j = 10; $j <= 11; $j++) {
            $sum = 0;
            for ($i = 0; $i < $j - 1; $i++) {
                $sum += ($j - $i) * ((int) $digit[$i]);
            }

            $summod11 = $sum % 11;
            $digit[$j - 1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }

        return $digit[9] == ((int) $cpf[9]) && $digit[10] == ((int) $cpf[10]);
    }

}
