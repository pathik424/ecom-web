<?php
// Template Name: My Custom ACF Page

get_header();
?>



<div class="custom-products-container">
    <?php
    $args = array(
        'post_type' => 'acf_product',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();

        // Get ACF fields
        $product_image = get_field('product_image');
        $product_title = get_field('product_title');
        $product_description = get_field('product_description');
        $product_price = get_field('product_price');
        $product_short_description = wp_trim_words($product_description, 20, '...');
    ?>

    <div class="custom-product-item">
        <?php if ($product_image) : ?>
            <div class="product-image">
                <img src="<?php echo esc_url($product_image['url']); ?>" alt="<?php echo esc_attr($product_image['alt']); ?>" />
            </div>
        <?php endif; ?>

        <?php if ($product_title) : ?>
            <h2 class="product-title"><?php echo esc_html($product_title); ?></h2>
        <?php endif; ?>

        <?php if ($product_short_description) : ?>
            <div class="product-description">
                <?php echo wp_kses_post($product_short_description); ?>
            </div>
        <?php endif; ?>

        <?php if ($product_price) : ?>
            <div class="product-price">
                <span><?php echo esc_html($product_price); ?></span>
            </div>
        <?php endif; ?>

        <div class="product-actions">
            <a href="?add-to-cart=<?php the_ID(); ?>" class="button add-to-cart-button">Add to Cart</a>
            <a href="#" class="button add-to-wishlist-button">Add to Wishlist</a>
        </div>
    </div>

    <?php endwhile; wp_reset_postdata(); ?>
</div>



<style>
    .custom-products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.custom-product-item {
    border: 1px solid #ddd;
    padding: 20px;
    width: 300px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.custom-product-item .product-image img {
    max-width: 100%;
    height: auto;
}

.custom-product-item .product-title {
    font-size: 24px;
    margin: 10px 0;
}

.custom-product-item .product-description {
    margin: 10px 0;
}

.custom-product-item .product-price {
    font-size: 20px;
    color: #0073aa;
    font-weight: bold;
}

</style>

<?php
get_footer();
?>
