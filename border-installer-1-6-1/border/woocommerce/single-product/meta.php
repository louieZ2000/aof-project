<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta  entry__meta  entry__meta--single">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>

<!-- 	<div class="entry__meta-box meta-box--categories">
		<?php echo $product->get_categories( ', ', '<span class="meta-box__title">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
	</div>

		<?php echo $product->get_tags( ', ', '<span class="meta-box__title">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
	</div> -->

	<div class="entry__meta-box meta-box--categories">
	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ' ', _n( '<span class="meta-box__title">Category</span>', '<span class="meta-box__title">Categories</span>', $size, 'border_txtd' ) . ' ', '' );
	?>
	</div>

	<div class="entry__meta-box meta-box--tags">
	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ' ', _n( '<span class="meta-box__title">Tag</span>', '<span class="meta-box__title">Tags</span>', $size, 'border_txtd' ) . ' ', '' );
	?>
	</div>	

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>