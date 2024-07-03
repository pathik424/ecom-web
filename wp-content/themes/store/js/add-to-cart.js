jQuery(document).ready(function($) {
    $('body').on('added_to_cart', function(event, fragments, cart_hash, $button) {
        var productID = $button.data('product_id');
        var giftCardMessage = $('#gift_card_message').val();
        
        if (giftCardMessage) {
            var message = '<p class="custom-add-to-cart-message">Gift Card Message: ' + giftCardMessage + '</p>';
            // Append the message below the product
            $button.closest('.product').append(message);
        }
        
        // Remove the message after a few seconds
        setTimeout(function() {
            $('.custom-add-to-cart-message').fadeOut();
        }, 3000); // Adjust the timeout duration as needed
    });
});
