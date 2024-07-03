<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );


















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


// Display gift card message field on the product page
add_action( 'woocommerce_before_add_to_cart_button', 'display_gift_card_message_field' );
function display_gift_card_message_field() {
    echo '<div class="gift-card-message">';
    echo '<label for="gift_card_message">Gift Card Message</label>';
    echo '<textarea name="gift_card_message" id="gift_card_message" rows="4" placeholder="Enter your gift card message here"></textarea>';
    echo '</div>';
}

// Validate the custom field
add_filter( 'woocommerce_add_to_cart_validation', 'validate_gift_card_message', 10, 3 );
function validate_gift_card_message( $passed, $product_id, $quantity ) {
    if ( isset( $_POST['gift_card_message'] ) && empty( $_POST['gift_card_message'] ) ) {
        wc_add_notice( 'Please enter a gift card message.', 'error' );
        return false;
    }
    return $passed;
}

// Add the custom field value to the cart item
add_filter( 'woocommerce_add_cart_item_data', 'add_gift_card_message_to_cart_item', 10, 2 );
function add_gift_card_message_to_cart_item( $cart_item_data, $product_id ) {
    if ( isset( $_POST['gift_card_message'] ) ) {
        $cart_item_data['gift_card_message'] = sanitize_textarea_field( $_POST['gift_card_message'] );
    }
    return $cart_item_data;
}

// Display the custom field value in the cart
add_filter( 'woocommerce_get_item_data', 'display_gift_card_message_cart', 10, 2 );
function display_gift_card_message_cart( $item_data, $cart_item ) {
    if ( isset( $cart_item['gift_card_message'] ) ) {
        $item_data[] = array(
            'key'   => 'Gift Card Message',
            'value' => $cart_item['gift_card_message'],
        );
    }
    return $item_data;
}

// Save the custom field value to order meta
add_action( 'woocommerce_add_order_item_meta', 'save_gift_card_message_to_order', 10, 2 );
function save_gift_card_message_to_order( $item_id, $values ) {
    if ( ! empty( $values['gift_card_message'] ) ) {
        wc_add_order_item_meta( $item_id, 'Gift Card Message', $values['gift_card_message'] );
    }
}




