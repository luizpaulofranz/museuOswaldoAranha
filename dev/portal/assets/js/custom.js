$(document).ready(function () {

//avaliacao de conteudos
$('form.sky-form input[name="avaliacao"]').click(function (){
    $('form.sky-form').submit();
});

//popular combo de cidades
$("#estadosEndereco").change(function(){
      $.ajax({
         type: "GET",
         url: "../endereco/getCidadesByEstado",
         data: {estado: $("#estadosEndereco").val()},
         dataType: "json",
         success: function(json){
            var options = "";
            $.each(json, function(key, value){
               options += '<option value="' + key + '">' + value + '</option>';
            });
            $("#cidadeEndereco").html(options);
         }
      });
   });


//popular combo de cidades
$("#estadosNatal").change(function(){
      $.ajax({
         type: "GET",
         url: "../endereco/getCidadesByEstado",
         data: {estado: $("#estadosNatal").val()},
         dataType: "json",
         success: function(json){
            var options = "";
            $.each(json, function(key, value){
               options += '<option value="' + key + '">' + value + '</option>';
            });
            $("#cidadeNatal").html(options);
         }
      });
   });

});

function exibirModalLogin() {
        $('#modalLogin').modal('show');
        $('#modalLogin').on('shown', function () {
            $("#first").focus();
        })
    }

