<?php
//Template Name: My Custome Page


get_header();
?>

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <?php echo do_shortcode('[custom_breadcrumb]'); ?>
</div>



<style>
    .breadcrumb {
    font-size: 14px;
    margin: 20px 0;
}

.breadcrumb a {
    color: #0073aa;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.breadcrumb &raquo; {
    margin: 0 5px;
}

</style>



</div><!-- .content-wrapper -->

<!-- Sidebar -->
<aside class="custom-sidebar">

<!-- Custom Slider -->
<div class="custom-slider">
        <h2>Custom Slider</h2>
        <!-- Add your custom slider content here -->
        <div class="slider-wrapper">
            <!-- Slider content -->
        </div>
    </div>

    <?php if ( is_active_sidebar( 'custom-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'custom-sidebar' ); ?>
    <?php endif; ?>
</aside>

<style>
   .custom-sidebar {
       position: absolute;
       right: 100px;
       width: 250px; /* Set the width */
       height: 500px; /* Set the height */
       box-sizing: border-box;
       border: 2px solid;

   }
</style>

  

<!-- Divider Line -->
<hr class="section-divider">

<!-- Section 1: Featured Products -->
<section id="featured-products">
    <h1>Section 1</h1>
    <h2>My Featured Products</h2>
    <!-- Divider Line -->
<hr class="section-divider">
    <?php
    function display_featured_product() {
        // Query WooCommerce for featured products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                ),
            ),
        );

        $featured_query = new WP_Query($args);

        // Check if there are any featured products
        if ($featured_query->have_posts()) {
            echo '<div class="featured-products-grid">';
            while ($featured_query->have_posts()) : $featured_query->the_post();
                global $product;

                 // Get the checkout URL with the product added
                //  $checkout_url = wc_get_checkout_url() . '?add-to-cart=' . $product->get_id();

                // Display product details
                echo '<div class="featured-product">';
                echo '<a href="' . get_permalink() . '">' . woocommerce_get_product_thumbnail() . '</a>';
                echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                echo '<div class="price">' . $product->get_price_html() . '</div>';
                echo '<p class="description">' . wp_trim_words(get_the_excerpt(), 20, '...') . '</p>';
                echo '<a href="' . get_permalink() . '" class="button view-product">View Product</a>';
                echo '<a href="' . do_shortcode('[add_to_cart_url id="' . $product->get_id() . '"]') . '" class="button add-to-cart">Add to Cart</a>';

                // echo '<a href="' . $checkout_url . '" class="button buy-now">Buy Now</a>';







                echo '</div>';
            endwhile;
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No featured product found</p>';
        }
    }

    // Directly call the function to display the featured product
    display_featured_product();
    ?>
</section>

<!-- Divider Line -->
<hr class="section-divider">

<!-- Section 2: All Products -->
<section id="all-products">
    <h1>Section 2</h1>
    <h2>All Products</h2>
        <!-- Divider Line -->
<hr class="section-divider">
    <div class="sort-order">
        <label for="sort-order">Sort by:</label>
        <select id="sort-order">
            <option value="asc">Price: Low to High</option>
            <option value="desc">Price: High to Low</option>
        </select>
    </div>
    <div class="product-list" id="product-list">
        <!-- Products will be loaded here via AJAX -->
    </div>
</section>

<!-- Divider Line -->
<hr class="section-divider">

<!-- Section 3: Best Selling Products -->
<section id="best-selling-products">
    <h1>Section 3</h1>
    <h2>My Best Selling Products</h2>
        <!-- Divider Line -->
<hr class="section-divider">
    <?php
    function display_best_selling_products() {
        // Query WooCommerce for best-selling products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6, // Number of products to display for the slider
            'meta_key' => 'total_sales', // Sort by total sales
            'orderby' => 'meta_value_num', // Order by total sales (numeric)
            'order' => 'DESC', // Descending order to get best sellers
            'meta_query' => array(
                array(
                    'key' => '_price', // Ensure only products with a price are included
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'NUMERIC',
                ),
            ),
        );

        $best_selling_query = new WP_Query($args);

        // Check if there are any best-selling products
        if ($best_selling_query->have_posts()) {
            echo '<div class="best-selling-products-slider">';
            echo '<div class="slider-wrapper">';
            while ($best_selling_query->have_posts()) : $best_selling_query->the_post();
                global $product;

                // Get the product categories
                $product_categories = wp_get_post_terms(get_the_ID(), 'product_cat');
                $categories_list = array();
                foreach ($product_categories as $prod_cat) {
                    $categories_list[] = $prod_cat->name;
                }
                $categories_string = implode(', ', $categories_list);

                // Display product details
                echo '<div class="best-selling-product">';
                echo '<a href="' . get_permalink() . '">' . woocommerce_get_product_thumbnail() . '</a>';
                echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                echo '<p class="product-categories">' . $categories_string . '</p>'; // Display product categories
                echo '<div class="price">' . $product->get_price_html() . '</div>';
                echo '<p class="description">' . wp_trim_words(get_the_excerpt(), 20, '...') . '</p>'; // Display trimmed description
                echo '<a href="' . get_permalink() . '" class="button view-product">View Product</a>';
                echo '<a href="' . do_shortcode('[add_to_cart_url id="' . $product->get_id() . '"]') . '" class="button add-to-cart">Add to Cart</a>';
                echo '</div>';
            endwhile;
            echo '</div>';
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No best-selling products found.</p>';
        }
    }

    // Directly call the function to display the best-selling products
    display_best_selling_products();
    ?>
</section>



<!-- Include Slick Slider CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

<style>
/* Section Styles */
section {
    padding: 40px 0;
    background-color: white;
}

/* Divider Styles */
.section-divider {
    margin: 5px auto;
    width: 100%;
    border: 0;
    border-top: 4px solid #333; /* Increase thickness to 4px and change color to a darker shade for bold effect */
    /* Optional: Add a box shadow for more emphasis */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
}



section h1 {
    font-size: 2em;
    text-align: center;
    margin-bottom: 10px;
}

section h2 {
    font-size: 1.5em;
    text-align: center;
    margin-bottom: 20px;
}

.featured-product .button.buy-now {
    background-color: #f5a623;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-align: center;
    display: inline-block;
    margin-top: 10px;
}


/* Featured Products Grid */
.featured-products-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Style for individual product boxes */
.featured-product {
    flex: 1 1 calc(33.333% - 20px); /* Show 3 products per row */
    box-sizing: border-box;
    text-align: center;
    border: 1px solid #ddd;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Image styles */
.featured-product img {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

/* Title styles */
.featured-product h2 {
    font-size: 1.2em;
    margin: 10px 0;
}

/* Price styles */
.featured-product .price {
    font-size: 1em;
    color: #333;
    margin: 10px 0;
}

/* Button styles */
.featured-product .button {
    display: inline-block;
    margin: 5px 0;
    padding: 10px 20px;
    background-color: #0071a1;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.featured-product .button:hover {
    background-color: #005f86;
}

/* Responsive styles */
@media (max-width: 768px) {
    .featured-product {
        flex: 1 1 calc(50% - 20px); /* Two products per row */
    }
}

@media (max-width: 480px) {
    .featured-product {
        flex: 1 1 100%; /* One product per row */
    }
}

/* All Products Section */
#all-products .sort-order {
    text-align: center;
    margin-bottom: 20px;
}

#all-products .sort-order label {
    font-size: 1em;
}

#all-products .sort-order select {
    padding: 10px;
    font-size: 1em;
    border-radius: 5px;
}

/* Product List */
.product-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

/* Style for individual product boxes */
.product {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    width: calc(33.333% - 20px); /* Adjust the width to fit three items per row with gaps */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-sizing: border-box; /* Ensures padding and border are included in width */
}

.product h3 {
    margin-top: 0;
}

.product-image {
    text-align: center;
}

.product-image img {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

.product-details {
    flex-grow: 1;
}

.product a.add-to-cart,
.product a.view-product {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #0071a1;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.product a.add-to-cart:hover,
.product a.view-product:hover {
    background-color: #005f86;
}

/* Responsive styles */
@media (max-width: 768px) {
    .product {
        width: calc(50% - 20px); /* Two items per row on medium screens */
    }
}

@media (max-width: 480px) {
    .product {
        width: 100%; /* One item per row on small screens */
    }
}

/* Best Selling Products Slider */
.best-selling-products-slider {
    margin: 0 auto;
    padding: 20px;
    max-width: 1200px; /* Adjust to your desired max width */
    position: relative; /* Ensure arrows are positioned relative to the slider */
}

/* Style for individual product boxes */
.best-selling-product {
    text-align: center;
    border: 1px solid #ddd;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Image styles */
.best-selling-product img {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

/* Title styles */
.best-selling-product h3 {
    font-size: 1.2em;
    margin: 10px 0;
}

/* Product Categories styles */
.best-selling-product .product-categories {
    font-size: 0.9em;
    color: #777;
    margin-bottom: 10px;
}

/* Price styles */
.best-selling-product .price {
    font-size: 1em;
    color: #333;
    margin: 10px 0;
}

/* Description styles */
.best-selling-product .description {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 15px;
}

/* Button styles */
.best-selling-product .button {
    display: inline-block;
    margin: 5px 0;
    padding: 10px 20px;
    background-color: #0071a1;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.best-selling-product .button:hover {
    background-color: #005f86;
}

/* Centered Navigation Arrows */
.slick-prev, .slick-next {
    width: 30px;
    height: 30px;
    background-color: #0071a1;
    color: #fff;
    border-radius: 50%;
    line-height: 30px;
    text-align: center;
    z-index: 1;
    opacity: 0.75;
}

.slick-prev:hover, .slick-next:hover {
    background-color: #005f86;
    opacity: 1;
}

.slick-prev {
    left: 10px; /* Distance from the left edge */
}

.slick-next {
    right: 10px; /* Distance from the right edge */
}

.slick-prev:before, .slick-next:before {
    font-size: 18px;
    color: #fff;
}

.slick-prev:before {
    content: '←';
}

.slick-next:before {
    content: '→';
}

/* Responsive styles */
@media (max-width: 768px) {
    .best-selling-product {
        flex: 1 1 100%; /* Single item per row on medium screens */
    }
}

@media (max-width: 480px) {
    .best-selling-product {
        flex: 1 1 100%; /* Single item per row on small screens */
    }
}
</style>

<!-- Include jQuery (required for Slick Slider) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Slick Slider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
jQuery(document).ready(function($) {
    $('.slider-wrapper').slick({
        slidesToShow: 3, // Show 3 products per slide
        slidesToScroll: 3, // Scroll 1 product per click
        dots: true, // Show dots for pagination
        arrows: true, // Show next/prev arrows
        infinite: true, // Infinite loop
        autoplay: true, // Auto-slide
        autoplaySpeed: 10000, // Auto-slide speed (in milliseconds)
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2, // Show 2 products per slide on medium screens
                    slidesToScroll: 1, // Scroll 1 product per click
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1, // Show 1 product per slide on small screens
                    slidesToScroll: 1, // Scroll 1 product per click
                }
            }
        ]
    });

    const sortOrder = document.getElementById('sort-order');
    const productList = document.getElementById('product-list');

    function loadProducts(order = 'asc') {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo admin_url('admin-ajax.php?action=load_products&order='); ?>' + order, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                productList.innerHTML = xhr.responseText;
            } else {
                productList.innerHTML = '<p>Failed to load products.</p>';
            }
        };
        xhr.send();
    }

    sortOrder.addEventListener('change', function() {
        loadProducts(this.value);
    });

    // Initial load
    loadProducts();
});
</script>


<section id="featured-products">
    <h1>Section 4</h1>
    <h2>My Watch Products</h2>
    <!-- Divider Line -->
    <hr class="section-divider">
    <?php
    function display_cat_product() {
        // Query WooCommerce for products in the "Watch" category
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'name',
                    'terms' => 'Watch', // Category name
                ),
            ),
        );

        $query = new WP_Query($args);

        // Check if there are any products in the "Watch" category
        if ($query->have_posts()) {
            echo '<div class="featured-products-grid">';
            while ($query->have_posts()) : $query->the_post();
                global $product;

                // Display product details
                echo '<div class="featured-product">';
                echo '<a href="' . get_permalink() . '">' . woocommerce_get_product_thumbnail() . '</a>';
                echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                echo '<div class="price">' . $product->get_price_html() . '</div>';
                echo '<p class="description">' . wp_trim_words(get_the_excerpt(), 20, '...') . '</p>';
                echo '<a href="' . get_permalink() . '" class="button view-product">View Product</a>';
                echo '<a href="' . do_shortcode('[add_to_cart_url id="' . $product->get_id() . '"]') . '" class="button add-to-cart">Add to Cart</a>';
                // echo '<a href="' . $checkout_url . '" class="button buy-now">Buy Now</a>';
                echo '</div>';
            endwhile;
            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No products found in the "Watch" category.</p>';
        }
    }

    display_cat_product();
    ?>
</section>




<?php
get_footer();
?>






