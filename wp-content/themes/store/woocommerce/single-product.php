<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			
			<div class="woocommerce-product-details__acf-fields">
				<?php
		// Display ACF fields here
		// global $product;
		
		$product_description = get_field('product_description');
		$product_image = get_field('product_image');
		
		$product_price = get_field('product_price');
		$product_title = get_field('product_title');
		// var_dump($product_image);
		
		echo '<div class="custom-product">';
		echo '<h2>' . $product_title . '</h2>';
		if ($product_image) {
			echo '<img src="' . $product_image['url'] . '" alt="' . $product_image['alt'] . '">';
		} else {
			// Handle case where no image is set
			echo '<img src="' . get_template_directory_uri() . '/images/default-image.jpg" alt="Default Image">';
		}
		echo '<p>' . $product_description . '</p>';
		echo '<p>Price: $' . $product_price . '</p>';
		echo '</div>';
		
		?>
	</div>
	<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>
			



	<?php

		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	<?php
     /**
      * woocommerce_sidebar hook.
      *
      * We will conditionally display our custom sidebar here.
      */
   
         do_action( 'woocommerce_sidebar' );
     
 ?>
<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
