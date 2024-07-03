<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart" id="giftCardForm" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <label for="gift_card_message">Gift Card Message:</label>
        <textarea id="gift_card_message" name="gift_card_message" rows="4" placeholder="Enter your gift card message here"></textarea>
        <div class="count">You have 140 characters of 140 left</div>
        
        <input type="checkbox" id="no_gift_message" name="no_gift_message">
        <label for="no_gift_message" id="no_gift_message_label">DO NOT add a gift tag message.</label>

        <?php
        do_action('woocommerce_before_add_to_cart_quantity');

        woocommerce_quantity_input(
            array(
                'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
            )
        );

        do_action('woocommerce_after_add_to_cart_quantity');
        ?>
        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>


        <style>
            /* Basic styles for the gift card message box */
            textarea#gift_card_message {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
                box-sizing: border-box;
                font-size: 16px;
                color: #333;
                margin-top: 10px;
                margin-bottom: 15px;
                background-color: #f9f9f9;
                resize: vertical; /* Allows vertical resizing */
            }

            textarea#gift_card_message:focus {
                border-color: #007cba; /* WooCommerce default blue */
                outline: none;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            label[for="gift_card_message"] {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #555;
                font-size: 16px;
            }

            /* Style for character count display */
            .count {
                font-size: 14px;
                color: gray;
                margin-bottom: 15px;
            }

            /* Style for the error message */
            .error {
                color: red;
                display: none;
                margin-bottom: 10px;
            }

            /* Style for the submit button */
            button.single_add_to_cart_button {
                background-color: #007cba; /* WooCommerce default button color */
                color: #fff;
                border: none;
                padding: 12px 20px;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                margin-top: 10px;
            }

            button.single_add_to_cart_button:hover {
                background-color: #005a8b; /* Darker shade for hover */
            }

            button.single_add_to_cart_button:disabled {
                background-color: #aaa; /* Disabled state */
                cursor: not-allowed;
            }
        </style>

        <script>
            jQuery(document).ready(function($) {
                const giftCardMessageTextarea = $('#gift_card_message');
                const messageCount = $('.count');
                const form = $('#giftCardForm');
                const noGiftMessageCheckbox = $('#no_gift_message');
                const noGiftMessageLabel = $('#no_gift_message_label');

                // Function to update character count
                const updateCharacterCount = () => {
                    const maxChars = 140;
                    const message = giftCardMessageTextarea.val();
                    const remainingChars = maxChars - message.length;

                    messageCount.text(`You have ${remainingChars} characters of ${maxChars} left`);
                    messageCount.css('color', remainingChars < 0 ? 'red' : 'gray');
                };

                // Initial character count update
                updateCharacterCount();

                // Update character count on input
                giftCardMessageTextarea.on('input', function() {
                    updateCharacterCount();
                    if ($(this).val().length > 0) {
                        noGiftMessageCheckbox.hide();
                        noGiftMessageLabel.hide();
                    } else {
                        noGiftMessageCheckbox.show();
                        noGiftMessageLabel.show();
                    }
                });

                // Handle form submission
                form.on('submit', function(event) {
                    if (giftCardMessageTextarea.val().length > 140) {
                        alert('You are exceeding the character limit!');
                        return false;
                    }
                });

                // Handle checkbox change
                noGiftMessageCheckbox.on('change', function() {
                    if (this.checked) {
                        giftCardMessageTextarea.hide();
                        messageCount.hide();
                    } else {
                        giftCardMessageTextarea.show();
                        messageCount.show();
                    }
                });
            });
        </script>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>