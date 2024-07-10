jQuery(document).ready(function($) {
    $('#delete-button').on('click', function(e) {
        e.preventDefault();
        
        var itemId = $(this).data('ID');
        alert('s');
                if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'delete_my_item',
                    item_id: itemId,
                    nonce: my_ajax_object.nonce
                },
                success: function(response) {
                    if(response.success) {
                        alert('Item deleted successfully!');
                        // Optionally, remove the item from the DOM
                        $('#item-' + itemId).remove();
                    } else {
                        alert('Failed to delete item: ' + response.data);
                    }
                }
            });
        }
    });


    });