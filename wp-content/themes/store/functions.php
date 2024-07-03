<?php
/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/framework//customizer/init.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load TGM.
 */
require get_template_directory() . '/framework/tgmpa.php';


// Ensure jQuery is loaded
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Register the AJAX actions for loading products
add_action('wp_ajax_load_products', 'load_products');
add_action('wp_ajax_nopriv_load_products', 'load_products');
add_action('wp_ajax_load_featured_products', 'load_featured_products');
add_action('wp_ajax_nopriv_load_featured_products', 'load_featured_products');

// AJAX handler for loading all products
function load_products() {
    // Check the order parameter
    $order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

    // Query WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => '_price',
        'order' => $order,
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            global $product;
            ?>
            <div class="product">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="product-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                <div class="product-details">
                    <h3><?php the_title(); ?></h3>
                    <p>Price: <?php echo $product->get_price_html(); ?></p>
                    <p>Description: <?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                    <p>Categories: <?php echo wc_get_product_category_list($product->get_id()); ?></p>
                    <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="add-to-cart button">Add to Cart</a>
                </div>
                <a href="<?php the_permalink(); ?>" class="view-product">View Product</a>
            </div>
            <?php
        endwhile;
    } else {
        echo '<p>No products found</p>';
    }
    wp_reset_postdata();
    die();
}

// AJAX handler for loading featured products
function load_featured_products() {
    // Query featured WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_key' => '_featured',
        'meta_value' => 'yes',
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            global $product;
            ?>
            <div class="product">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="product-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                <?php endif; ?>
                <div class="product-details">
                    <h3><?php the_title(); ?></h3>
                    <p>Price: <?php echo $product->get_price_html(); ?></p>
                    <p>Description: <?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                    <p>Categories: <?php echo wc_get_product_category_list($product->get_id()); ?></p>
                    <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="add-to-cart button">Add to Cart</a>
                </div>
                <a href="<?php the_permalink(); ?>" class="view-product">View Product</a>
            </div>
            <?php
        endwhile;
    } else {
        echo '<p>No featured products found</p>';
    }
    wp_reset_postdata();
    die();
}

// Save the gift card message when the product is added to the cart
add_filter('woocommerce_add_cart_item_data', 'save_gift_card_message_cart_item_data', 10, 2);

function save_gift_card_message_cart_item_data($cart_item_data, $product_id) {
    if (isset($_POST['gift_card_message'])) {
        $gift_card_message = sanitize_textarea_field($_POST['gift_card_message']);
        $cart_item_data['gift_card_message'] = $gift_card_message;
    }
    return $cart_item_data;
}

// Save gift card message to order item meta data
add_action('woocommerce_checkout_create_order_line_item', 'save_gift_card_message_order_item_meta', 10, 4);

function save_gift_card_message_order_item_meta($item, $cart_item_key, $values, $order) {
    if (isset($values['gift_card_message'])) {
        $item->add_meta_data('gift_card_message', $values['gift_card_message'], true);
    }
}

// Display the gift card message in the cart
add_filter('woocommerce_get_item_data', 'display_gift_card_message_cart_item_data', 10, 2);

function display_gift_card_message_cart_item_data($item_data, $cart_item) {
    if (isset($cart_item['gift_card_message'])) {
        $item_data[] = array(
            'key'   => 'Gift Card Message',
            'value' => wc_clean($cart_item['gift_card_message']),
        );
    }
    return $item_data;
}

// Add gift card message to order emails
add_action('woocommerce_email_order_meta', 'add_gift_card_message_to_emails', 20, 3);

function add_gift_card_message_to_emails($order, $sent_to_admin, $plain_text) {
    foreach ($order->get_items() as $item_id => $item) {
        $gift_card_message = $item->get_meta('gift_card_message');
        if ($gift_card_message) {
            if ($plain_text) {
                echo "Gift Card Message: " . $gift_card_message . "\n";
            } else {
                echo '<p><strong>Gift Card Message:</strong> ' . esc_html($gift_card_message) . '</p>';
            }
        }
    }
}


// Handle AJAX request for validating gift card message
add_action('wp_ajax_validate_gift_card_message', 'validate_gift_card_message');
add_action('wp_ajax_nopriv_validate_gift_card_message', 'validate_gift_card_message');

function validate_gift_card_message() {
    $message = isset($_POST['gift_card_message']) ? sanitize_textarea_field($_POST['gift_card_message']) : '';

    if (strlen($message) > 140) {
        wp_send_json_error(array('message' => 'You are exceeding the character limit!'));
    } else {
        wp_send_json_success();
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}

