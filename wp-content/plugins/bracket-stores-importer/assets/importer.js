jQuery.noConflict();

jQuery(document).ready(function($){

    $('#importer-button').click(function(e){

        console.log('FIRED!');
        $.ajax({
            type:       'POST',
            url:        CACHE.ajax_url,
            dataType:   'JSON',
            data:       { action: 'import_stores', nonce: CACHE.nonce},
            success:    function(data){
                console.log(data.status);
                console.log(data.msg);
                if ( data.status == 'ok' ){
                    $('.importer-results').append('<div class="new_stores">'+data.new_stores+'</div>');
                }
                $('.importer-results').append(data.msg);
            }
        });


    });

})