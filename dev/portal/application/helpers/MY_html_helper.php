<?php

//helper htm eh do proprio Codei, para acrescentar ou alterar funcoes desse helper, devemos por nesta pasta com o prefixo MY_
function alert($msg, $tipo = 'warning', $titulo = NULL, $fechar = TRUE) {

    $retorno = '<div class="alert alert-' . $tipo . ' alert-dismissable">';
    $retorno .= (!is_null($titulo)) ? '<strong>' . $titulo . '</strong>' : '';
    $retorno .= ($fechar) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : NULL;
    $retorno .= '<p>' . $msg . '</p>';
    $retorno .= '</div>';

    return $retorno;
}

function opcoes($excluir_url = NULL, $alterar_url = NULL) {
    $a = '<div class="btn-group">
          <button class="btn">Ações</button>
          <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="' . $alterar_url . '"><span class="glyphicon glyphicon-edit"></span> Alterar</a></li>
            <li><a href="' . $excluir_url . '"><span class="glyphicon glyphicon-remove"></span> Excluir</a></li>
          </ul>
        </div>';
    return $a;
}

function opcoes2($excluir_url = NULL, $alterar_url = NULL) {
    if (is_null($excluir_url)) {
        $a = '<div class="btn-group">
    <a class="btn btn-default" alt="Alterar" title="Alterar" href="' . $alterar_url . '"><span class="glyphicon glyphicon-edit"></span></a>
    </div>';
    } else {
        $a = '<div class="btn-group">
    <a class="btn btn-default" alt="Alterar" title="Alterar" href="' . $alterar_url . '"><span class="glyphicon glyphicon-edit"></span></a>
    <a class="btn btn-danger confirm" alt="Excluir" title="Excluir" href="' . $excluir_url . '"><span class="glyphicon glyphicon-remove"></span></a>
    </div>';
    }
    return $a;
}

?>
