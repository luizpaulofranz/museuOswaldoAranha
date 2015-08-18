<?php
//var_dump($arquivos->result());exit();
$conteudo = '';
$pedido = '';
if (isset($_GET['conteudo'])) {
    $conteudo = $_GET['conteudo'];
}
//var_dump($arquivos->result());exit();
?>
<script src="<?php echo site_url('assets/plugins/jquery/jquery.min.js')?>" type="text/javascript" ></script>
<script type="text/javascript">
    //$(document).ready(function() {
    $(function($) {
        // Definindo página pai
        var pai = window.parent.document;
        //limpamos os arquivos
        $('#anexos', pai).empty();
<?php
foreach ($arquivos as $value) {
    ?>
            // Adicionamos um item na lista (ul) que tem ID igual a "anexos"
            //verificamos se o form esta disabled
            if ($('#form_upload', pai).prop('class') == 'disabled') {
                $('#arquivo').prop('disabled', 'disabled');
            }else{
                $('#anexos', pai).append('<li><a title="Destacar" href="<?php echo site_url('admin/media/destacarAnexoConteudo/' . $value['idMedia'] . '/' . $conteudo) ?>"><?php echo ($value['destaque'])? '<i class="fa fa-check-circle-o" style="color:green"></i>':'<i class="fa fa-check-circle-o"></i>'; ?></a>\
                <a href="<?php echo site_url('admin/media/excluirAnexoConteudo/' . $value['idMedia'] . '/' . $conteudo) ?>" title="Remover"><img src="<?php echo site_url('assets/images/trash.png') ?>" alt="Remover" onclick="return confirma()" \/></a>\
                <a class="gallery-item" href="<?php echo site_url($value['urlPath'].'/'.$value['nome']) ?>"><img class="img-responsive resize" src="<?php echo site_url($value['urlPath'].'/'.$value['nome']) ?>"/></a></li>');
            }

<?php } ?>

        // Quando enviado o arquivo
        $("#arquivo").change(function() {
            // Se o arquivo foi selecionado
            if (this.value != "")
            {
                // Exibimos o loder
                $("#status").show();
                // Enviamos o formulário
                $("#upload").submit();
            }
        });
        
    });
</script>
<form id="upload" action="<?php echo site_url('admin/media/anexarAoConteudo?conteudo=' . $conteudo); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="form-group">
        <span id="status" style="display: none;">
            <img src="<?php echo site_url('assets/images/loader.gif') ?>" alt="Enviando..." />
        </span>
        <input type="hidden" name="idConteudo" value="<?php echo $conteudo ?>" />
        <input type="file" name="arquivo[]" multiple="multiple" id="arquivo" />
    </div>
</form>
