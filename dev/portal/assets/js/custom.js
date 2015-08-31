$(document).ready(function() {
    $("#inputtelefone").mask("(00) 0000-0000");
    
    //lightbox
    $('.image-link').magnificPopup({type: 'image'});
    $('.gallery-item').magnificPopup({
      type: 'image',
         gallery: {
         enabled: true
        }
    });

});


