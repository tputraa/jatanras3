<div class="advance-product-search">
	<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
			$terms = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'parent'     => 0,
			) );
		?>
		<?php if (  ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
			<div class="advance-search-wrap">
				<?php $current = ( isset( $_GET['product_category'] ) ) ? absint( $_GET['product_category'] ) : '' ; ?>
				<select class="select_products" name="product_category">
					<option value=""><?php esc_html_e( 'All Categories', 'easy-commerce' ); ?></option>
					<?php foreach ( $terms as $cat ) : ?>
						<option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $current, $cat->term_id ); ?> ><?php echo esc_html( $cat->name ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>

		<div class="advance-search-form">
			<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'easy-commerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="submit" value="&#xf002;" />
			<input type="hidden" name="post_type" value="product" />
		</div><!-- .advance-search-form -->

	</form><!-- .woocommerce-product-search -->
</div><!-- .advance-product-search -->
