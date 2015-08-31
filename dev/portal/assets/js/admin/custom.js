$(document).ready(function () {
    //lightbox
    //$('.image-link').magnificPopup({type: 'image'});
    //$('.gallery-item').magnificPopup({
    //  type: 'image',
    //     gallery: {
    //     enabled: true
    //    }
    //});
    //galeria de imagens inseridas dinamicamente
    $('.popup-gallery').magnificPopup({
        delegate: 'a.gallery-item',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        }
    });

    //submit dos forms
    $('#submit').click(function () {
        $("select").each(function () {
            $(this).attr('disabled', false);
        })
    });

    //btn excluir
    $('.btn.btn-danger.confirm').click(function () {
        if (confirm('Atenção! Deseja realmente excluir?')) {
            return true;
        } else {
            return false;
        }
    });

    //deixar a ultima tab aberta
    if (window.location.hash == '#sectionB') {
        $('#sectionATab').attr('class', '');
        $('#sectionBTab').attr('class', 'active');
        $('#sectionA').attr('class', 'tab-pane fade');
        $('#sectionB').attr('class', 'tab-pane fade in active');
    }

    //tooltips
    $('input[type=text][data-toggle=tooltip]').tooltip({/*or use any other selector, class, ID*/
        placement: "bottom",
        trigger: "focus"
    });

    //mascaras
    //$(".cpf").mask("000.000.000-00");
    //$(".telefone").mask("(00) 0000-00000");

    //data picker
    $(".date").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });

    //galeria para os anexos do conteudo
    $('#anexos').on('click', '.gallery-item', function (event) {
        //alert($(this).find('img-responsive').toString());
        $(this).find('img-responsive').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    //exibir ou esconder as editorias no cadastro de noticias/conteudo.
    $('#idTipoConteudo').change(function () {
        //id das noticias
        if (this.value == 11) {
            $('#selectEditoria').css('display', 'block');
        } else {
            $('#selectEditoria').css('display', 'none');
        }
    });

});

//confimacao para excluir imagem de anexos dos conteudos
function confirma() {
    if (confirm('Atenção! Deseja realmente excluir?')) {
        return true;
    } else {
        return false;
    }
}

function limitaCaractere(textareaId, limite, exibeRestante) {
    var caracterDigitado = document.getElementById(textareaId).value;
    var caracterRestante = limite - caracterDigitado.length;
    document.getElementById(exibeRestante).innerHTML = "Você ainda pode digitar " + caracterRestante + " caracteres.";
    if (caracterDigitado.length === limite - 1)
        document.getElementById(exibeRestante).innerHTML = "Você ainda pode digitar " + caracterRestante + " caractere.";
    if (caracterDigitado.length >= limite) {
        document.getElementById(textareaId).value = document.getElementById(textareaId).value.substr(0, limite);
        document.getElementById(exibeRestante).innerHTML = "<span style='color:red;'>Você já atingiu o limite de caracteres permitido!</span>";
    }
}
