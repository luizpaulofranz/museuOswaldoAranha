var Masking = function () {

    return {
        
        //Masking
        initMasking: function () {
	        $("#dataNascimento").mask('99/99/9999', {placeholder:'X'});
	        $("#celular").mask('(99) 9999-9999', {placeholder:'X'});
	        $("#telefone").mask('(99) 9999-9999', {placeholder:'X'});
	        $("#card").mask('9999-9999-9999-9999', {placeholder:'X'});
	        $("#serial").mask('***-***-***-***-***-***', {placeholder:'_'});
	        $("#tax").mask('99-9999999', {placeholder:'X'});
	        $("#cep").mask('99999-999', {placeholder:'X'});
        }

    };
    
}();