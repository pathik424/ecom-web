<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.


if ( $product->is_in_stock() ) : ?>

{{--SELECT * FROM wp_woocommerce_order_itemmeta WHERE meta_key = 'gift_card_message';--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gift Card Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .count {
            font-size: 14px;
            color: gray;
        }
        .error {
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <form id="giftCardForm">
        <label for="giftCardMessage">Gift Card Message:</label>
        <textarea id="giftCardMessage" name="message" rows="4" cols="50" placeholder="Don't forget to also include how you'd like your name or business to appear after the message!" required></textarea>
        <div class="count">You have 140 characters of 140 left</div>
    </form>
    <script src="script.js"></script>
</body>
</html>

	
	<script>
		$(document).ready(function() {
    $('#giftCardMessage').on('input', function() {
        var maxChars = 140;
        var message = $(this).val();
        var remainingChars = maxChars - message.length;

        if (remainingChars < 0) {
            $('.count').text('You have 0 characters of ' + maxChars + ' left');
            alert('You are exceeding the word limit!');
        } else {
            $('.count').text('You have ' + remainingChars + ' characters of ' + maxChars + ' left');
        }
    });

    $('#giftCardForm').on('submit', function(e) {
        e.preventDefault();
        var message = $('#giftCardMessage').val();

        if (message.length <= 140) {
            $.ajax({
                type: "POST",
                url: "save_gift_card.php",
                data: { message: message },
                success: function(response) {
                    alert('Gift card details saved successfully!');
                },
                error: function(error) {
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            alert('You are exceeding the word limit!');
        }
    });
});




</script>


	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
