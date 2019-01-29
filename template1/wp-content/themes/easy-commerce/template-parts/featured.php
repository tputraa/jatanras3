<?php
/**
 * Featured section.
 *
 * @package Easy_Commerce
 */

// Right featured status.
$right_featured_status = is_active_sidebar( 'sidebar-featured-right' );
$status_class = ( true === $right_featured_status ) ? 'featured-right-enabled' : '';
?>

<div id="featured-section">
	<div class="container">
		<div class="inner-wrapper">
			<div class="featured-section-left widget-area <?php echo esc_attr( $status_class) ?>">
				<?php
				$slider_details = easy_commerce_get_slider_details();
				if ( ! empty( $slider_details ) ) {
					easy_commerce_render_featured_slider( $slider_details );
				}
				?>
			</div><!-- .featured-section-left -->

			<?php if ( true === $right_featured_status ) : ?>
				<div class="featured-section-right widget-area">
					<?php dynamic_sidebar( 'sidebar-featured-right' ); ?>
				</div><!-- .featured-section-right -->
			<?php endif; ?>
		</div><!-- .inner-wrapper -->
	</div><!-- .container -->
</div><!-- #featured-section -->
