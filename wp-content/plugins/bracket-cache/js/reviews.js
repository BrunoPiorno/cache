/* reviews.js */
jQuery.noConflict();
jQuery(document).ready(function($) {
    
    $('#tiptip_holder').remove();

    function set_vote_review($votetip, $comment_id, $parent)
    {
        jQuery.ajax({
            type:       'POST',
            url:        review_cache.ajax_url,
            dataType:   'JSON',
            data:       { action: 'vote_review', comment_id: $comment_id, votetip: $votetip, nonce: review_cache.nonce},
            success:    function(data){
                let vote_tip    =   ( $votetip == 'positive_votes' ) ? 'positive' : 'negative';

                if(data.status != 'err') $parent.find('.vote-count-'+vote_tip).html("("+data.points+")");
                $parent.find('.feedback').html(data.message);
                $parent.find('.feedback').fadeIn();

                setTimeout(function() { 
                    $parent.find('.feedback').fadeOut();
                }, 5000);

                console.log(data);
            }
        });
    }

    $('.vote').click(function()
    {

        let vote_tip        =   $(this).hasClass('vote-up') ? 'positive_votes' : 'negative_votes';
        let comment_id      =   $(this).attr('data-comment-id');
        set_vote_review(vote_tip, comment_id, $(this).parent());

    });  
    $('.woocommerce-review-link').click(function(e)
    {
        e.preventDefault();
        var aTag = $(this).attr('href');
        $('html,body').animate({scrollTop: $(aTag).offset().top},'slow');
        setTimeout(function() { 
            $(aTag).trigger('click');
        }, 500);
        

    });    
});