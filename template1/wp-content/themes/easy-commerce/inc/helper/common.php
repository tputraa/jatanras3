<?php
/**
 * Common helper functions.
 *
 * @package Easy_Commerce
 */

if ( ! function_exists( 'easy_commerce_the_excerpt' ) ) :

	/**
	 * Generate excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length Excerpt length in words.
	 * @param WP_Post $post_obj WP_Post instance (Optional).
	 * @return string Excerpt.
	 */
	function easy_commerce_the_excerpt( $length = 40, $post_obj = null ) {

		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}
		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}
		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;

	}

endif;

if ( ! function_exists( 'easy_commerce_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;

if ( ! function_exists( 'easy_commerce_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function easy_commerce_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'easy-commerce' ) ) {
			$fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Heebo, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Heebo font: on or off', 'easy-commerce' ) ) {
			$fonts[] = 'Heebo:400italic,700italic,300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_sidebar_options' ) ) :

	/**
	 * Get sidebar options.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_get_sidebar_options() {

		global $wp_registered_sidebars;

		$output = array();

		if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
			foreach ( $wp_registered_sidebars as $key => $sidebar ) {
				$output[ $key ] = $sidebar['name'];
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'easy_commerce_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'easy-commerce' ) . '</a></li>';
		$args = array(
			'number'       => 5,
			'hierarchical' => false,
			);
		$pages = get_pages( $args );
		if ( is_array( $pages ) && ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
			}
		}
		echo '</ul>';
	}

endif;

if ( ! function_exists( 'easy_commerce_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_the_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

endif;

/**
 * Sanitize post ID.
 *
 * @since 1.0.0
 *
 * @param string $key Field key.
 * @param array  $field Field detail.
 * @param mixed  $value Raw value.
 * @return mixed Sanitized value.
 */
function easy_commerce_widget_sanitize_post_id( $key, $field, $value ) {

	$output = '';
	$value = absint( $value );
	if ( $value ) {
		$not_allowed = array( 'revision', 'attachment', 'nav_menu_item' );
		$post_type = get_post_type( $value );
		if ( ! in_array( $post_type, $not_allowed ) && 'publish' === get_post_status( $value ) ) {
			$output = $value;
		}
	}
	return $output;

}

if ( ! function_exists( 'easy_commerce_get_index_page_id' ) ) :

	/**
	 * Get front index page ID.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return int Corresponding Page ID.
	 */
	function easy_commerce_get_index_page_id( $type = 'front' ) {

		$page = '';

		switch ( $type ) {
			case 'front':
				$page = get_option( 'page_on_front' );
				break;

			case 'blog':
				$page = get_option( 'page_for_posts' );
				break;

			default:
				break;
		}
		$page = absint( $page );
		return $page;

	}
endif;

if ( ! function_exists( 'easy_commerce_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args     Main arguments.
	 * @param string $callback      Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function easy_commerce_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {

		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
			);

		$r = wp_parse_args( $main_args, $defaults );
		$output = '';
		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {

			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . __( 'Default', 'easy-commerce' ) . '</option>\n';
			}
			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}
			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output;
		}
		return $output;

	}

endif;

/**
 * Splice array preserving array keys.
 *
 * @param  array &$input      Input array.
 * @param  int   $offset      Offset.
 * @param  int   $length      Length.
 * @param  array $replacement Sub array.
 * @return array New array.
 */
function easy_commerce_array_splice_preserve_keys( &$input, $offset, $length = null, $replacement = array() ) {
	if ( empty( $replacement ) ) {
		return array_splice( $input, $offset, $length );
	}

	$part_before  = array_slice( $input, 0, $offset, $preserve_keys = true );
	$part_removed = array_slice( $input, $offset, $length, $preserve_keys = true );
	$part_after   = array_slice( $input, $offset + $length, null, $preserve_keys = true );

	$input = $part_before + $replacement + $part_after;

	return $part_removed;
}

if ( ! function_exists( 'easy_commerce_get_cart_icon_html' ) ) :

	/**
	 * Get cart icon html.
	 *
	 * @since 1.0.0
	 *
	 * @return string Cart icon HTML content.
	 */
	function easy_commerce_get_cart_icon_html() {

		$output = '';

		if ( function_exists( 'is_woocommerce' ) ) {
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			$output = '<a href="' . esc_url( $cart_url ) . '"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
		}

		return $output;

	}
endif;

if ( ! function_exists( 'easy_commerce_is_woocommerce_active' ) ) :

	/**
	 * Check if WooCommerce is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Active status.
	 */
	function easy_commerce_is_woocommerce_active() {
		$output = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$output = true;
		}

		return $output;
	}

endif;

if ( ! function_exists( 'easy_commerce_get_slider_details' ) ) :

	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @return array Slider details.
	 */
	function easy_commerce_get_slider_details() {

		$input = array();

		$featured_slider_type           = easy_commerce_get_option( 'featured_slider_type' );
		$featured_slider_number         = easy_commerce_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = easy_commerce_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'featured-category':

				$featured_slider_category = easy_commerce_get_option( 'featured_slider_category' );

				$qargs = array(
					'posts_per_page'      => absint( $featured_slider_number ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
					'post_type'           => 'post',
					'meta_query'          => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);
				if ( absint( $featured_slider_category ) > 0 ) {
					$qargs['cat'] = absint( $featured_slider_category );
				}

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'easy-commerce-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = easy_commerce_the_excerpt( apply_filters( 'easy_commerce_filter_slider_caption_length', 30 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			case 'featured-product-category':

				$featured_slider_product_category = easy_commerce_get_option( 'featured_slider_product_category' );

				$qargs = array(
					'posts_per_page'      => absint( $featured_slider_number ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
					'post_type'           => 'product',
					'meta_query'          => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				if ( absint( $featured_slider_product_category ) > 0 ) {
					$qargs['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => absint( $featured_slider_product_category ),
							),
						);
				}

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'easy-commerce-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = easy_commerce_the_excerpt( apply_filters( 'easy_commerce_filter_slider_caption_length', 30 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url'] = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

			break;

			default:
			break;
		}

		return $input;

	}
endif;

if ( ! function_exists( 'easy_commerce_render_featured_slider' ) ) :

	/**
	 * Render featured slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $slider_details Details of slider content.
	 */
	function easy_commerce_render_featured_slider( $slider_details = array() ) {

		if ( empty( $slider_details ) ) {
			return;
		}

		$featured_slider_transition_effect   = easy_commerce_get_option( 'featured_slider_transition_effect' );
		$featured_slider_enable_caption      = easy_commerce_get_option( 'featured_slider_enable_caption' );
		$featured_slider_enable_arrow        = easy_commerce_get_option( 'featured_slider_enable_arrow' );
		$featured_slider_enable_pager        = easy_commerce_get_option( 'featured_slider_enable_pager' );
		$featured_slider_enable_autoplay     = easy_commerce_get_option( 'featured_slider_enable_autoplay' );
		$featured_slider_enable_overlay      = easy_commerce_get_option( 'featured_slider_enable_overlay' );
		$featured_slider_transition_duration = easy_commerce_get_option( 'featured_slider_transition_duration' );
		$featured_slider_transition_delay    = easy_commerce_get_option( 'featured_slider_transition_delay' );

		// Cycle data.
		$slide_data = array(
			'fx'             => esc_attr( $featured_slider_transition_effect ),
			'speed'          => absint( $featured_slider_transition_duration ) * 1000,
			'pause-on-hover' => 'true',
			'loader'         => 'true',
			'log'            => 'false',
			'swipe'          => 'true',
			'auto-height'    => 'container',
			);

		if ( $featured_slider_enable_caption ) {
			$slide_data['caption-template'] = '';
		}

		if ( $featured_slider_enable_pager ) {
			$slide_data['pager-template'] = '<span class="pager-box"></span>';
		}
		if ( $featured_slider_enable_autoplay ) {
			$slide_data['timeout'] = absint( $featured_slider_transition_delay ) * 1000;
		} else {
			$slide_data['timeout'] = 0;
		}

		$slide_data['slides'] = 'article';

		$slide_attributes_text = '';
		foreach ( $slide_data as $key => $item ) {
			$slide_attributes_text .= ' ';
			$slide_attributes_text .= ' data-cycle-' . esc_attr( $key );
			$slide_attributes_text .= '="' . esc_attr( $item ) . '"';
		}

		$overlay_class = ( true === $featured_slider_enable_overlay ) ? 'overlay-enabled' : 'overlay-disabled';
		?>
		<div id="featured-slider">

			<div class="cycle-slideshow <?php echo esc_attr( $overlay_class ); ?>" id="main-slider" <?php echo $slide_attributes_text; ?>>

				<?php if ( $featured_slider_enable_arrow ) : ?>
					<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
					<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
				<?php endif; ?>

				<?php if ( $featured_slider_enable_caption ) : ?>
					<div class="cycle-caption"></div>
				<?php endif; ?>

				<?php $cnt = 1; ?>
				<?php foreach ( $slider_details as $key => $slide ) : ?>

					<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>
					<?php
					$target = '_self';
					if ( isset( $slide['new_window'] ) && 1 === $slide['new_window'] && ! empty( $slide['url'] ) ) {
						$target = '_blank';
					}
					$url = 'javascript:void(0);';
					if ( ! empty( $slide['url'] ) ) {
						$url = esc_url( $slide['url'] );
					}

					// Buttons stuff.
					$buttons_markup = '';
					$primary_button_text   = ! empty( $slide['primary_button_text'] ) ? $slide['primary_button_text'] : '';
					$primary_button_url    = ! empty( $slide['primary_button_url'] ) ? $slide['primary_button_url'] : '';
					$secondary_button_text = ! empty( $slide['secondary_button_text'] ) ? $slide['secondary_button_text'] : '';
					$secondary_button_url  = ! empty( $slide['secondary_button_url'] ) ? $slide['secondary_button_url'] : '';

					if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) {
						$buttons_markup .= '<div class="slider-buttons">';
						if ( ! empty( $primary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_text ) . '</a>';
						}
						if ( ! empty( $secondary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_text ) . '</a>';
						}
						$buttons_markup .= '</div>';
					}
					?>
					<article class="<?php echo esc_attr( $class_text ); ?>">

						<?php if ( ! empty( $slide['url'] ) ) : ?>
							<a href="<?php echo esc_url( $slide['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" >
						<?php endif; ?>

							<img src="<?php echo esc_url( $slide['images'][0] ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>" />
						<?php if ( ! empty( $slide['url'] ) ) : ?>
							</a>
						<?php endif; ?>

						<?php if ( true === $featured_slider_enable_caption ) : ?>
							<div class="slider-caption">
								<?php
									$caption_title = '';
									if ( ! empty( $slide['url'] ) ) {
										$caption_title = '<a href="' . esc_url( $slide['url'] ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $slide['title'] ) . '</a>';
									} else {
										$caption_title = esc_html( $slide['title'] );
									}
								?>
								<h3><?php echo $caption_title; ?></h3>
								<p><?php echo esc_attr( $slide['excerpt'] ); ?></p>
								<?php echo $buttons_markup; ?>
							</div><!-- .slider-caption -->
						<?php endif; ?>

					</article>

					<?php $cnt++; ?>

				<?php endforeach; ?>

				<?php if ( $featured_slider_enable_pager ) : ?>
					<div class="cycle-pager"></div>
				<?php endif; ?>

			</div><!-- #main-slider -->

		</div><!-- #featured-slider -->
		<?php
	}

endif;
