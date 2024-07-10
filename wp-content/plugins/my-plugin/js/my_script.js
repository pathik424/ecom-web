jQuery( document ).ready( function($) {
    $(document).on( 'click', '.delete-post', function() {
        var id = $(this).data('ID');
        var nonce = $(this).data('nonce');
        var post = $(this).parents('.post:first');
        $.ajax({
            type: 'post',
            url: MyAjax2.ajaxurl,
            data: {
                action: 'my_delete_post',
                nonce: nonce,
                id: id
            },
            success: function( result ) {
                if( result == 'success7' ) {
                    post.fadeOut( function(){
                        post.remove();
                    });
                }
            }
        })
        return false;
    })
})