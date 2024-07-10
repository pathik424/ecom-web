<?php
// Template Name: My Custom ACF Page

get_header();
?>

<section id="acf-products">
    <h1>Section 5</h1>
    <h2>My Custom Products</h2>
    <!-- Divider Line -->
    <hr class="section-divider">
    <style>
        /* Include the CSS code here */
    </style>
    <?php
    function display_all_products() {
        // Query for all WooCommerce products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 2,
        );

        $query = new WP_Query($args);

        // Check if there are any products
        if ($query->have_posts()) {
            echo '<div class="acf-products-grid">';
            while ($query->have_posts()) : $query->the_post();

                global $product;

                // Display product details using ACF fields if available
                $title = get_field('product_title') ? get_field('product_title') : get_the_title();
                $image = get_field('image');
    
                
                $image_url = '';

                if ($image && is_array($image) && isset($image['url'])) {
                    $image_url = $image['url'];
                } elseif (has_post_thumbnail()) {
                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                } else {
                    // Fallback image URL if no ACF image or post thumbnail
                    $image_url = 'https://placehold.it/300x300'; // Replace with your fallback image URL
                }

                $price = get_field('price') ? get_field('price') : $product->get_price_html();
                $description = get_field('description') ? get_field('description') : get_the_excerpt();
                $short_description = get_field('description') ? get_field('description') : '';

                $add_to_cart_button = get_field('add_to_cart_button') ? get_field('add_to_cart_button') : 'Add to Cart';
                $view_product_button = get_field('view_product_button') ? get_field('view_product_button') : 'View Product';
                $wishlist_button = get_field('wishlist') ? get_field('wishlist') : 'Add to Wishlist';

             
           

                echo '<div class="acf-product">';
                echo '<a href="' . get_permalink() . '"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '"></a>';
                echo '<h2><a href="' . get_permalink() . '">' . esc_html($title) . '</a></h2>';
                echo '<p class="short-description">' . wp_trim_words($short_description, 10, '...') . '</p>'; // Display short description

                echo '<div class="price">' . $price . '</div>';
                echo '<p class="description">' . wp_trim_words($description, 20, '...') . '</p>';
                echo '<a href="' . get_permalink() . '" class="button view-product">' . esc_html($view_product_button) . '</a>';
                echo '<a href="' . do_shortcode('[add_to_cart_url id="' . get_the_ID() . '"]') . '" class="button add-to-cart">' . esc_html($add_to_cart_button) . '</a>';
                echo '<a href="#" class="button wishlist">' . esc_html($wishlist_button) . '</a>';
                echo '</div>';

            endwhile;
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No products found.</p>';
        }
    }

    display_all_products();
    ?>
    <style>
        /* Style for ACF Products Section */
#acf-products {
    padding: 40px 0;
    background-color: #f9f9f9;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

h1, h2 {
    text-align: center;
}

.section-divider {
    width: 100%;
    margin: 20px 0;
    border: 1px solid #ccc;
}

.acf-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    grid-gap: 20px;
}

.acf-product {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    text-align: center;
}

.acf-product img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.acf-product h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.acf-product .price {
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.acf-product .description {
    color: #666;
    margin-bottom: 15px;
}

.acf-product .button {
    display: inline-block;
    padding: 10px 20px;
}

    </style>
    
    </section>
<?php
get_footer();
?>
