<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package Easy_Commerce
 */

if ( ! function_exists( 'easy_commerce_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function easy_commerce_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'easy-commerce' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'easy-commerce' ),
			'three-columns' => esc_html__( 'Three Columns', 'easy-commerce' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'easy-commerce' ),
		);

		$output = apply_filters( 'easy_commerce_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function easy_commerce_get_featured_slider_type() {

		$choices = array(
			'featured-category'         => esc_html__( 'Featured Category', 'easy-commerce' ),
			'featured-product-category' => esc_html__( 'Featured Product Category', 'easy-commerce' ),
		);

		$output = apply_filters( 'easy_commerce_filter_featured_slider_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function easy_commerce_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'Transition Effect', 'easy-commerce' ),
			'fadeout'    => _x( 'fadeout', 'Transition Effect', 'easy-commerce' ),
			'none'       => _x( 'none', 'Transition Effect', 'easy-commerce' ),
			'scrollHorz' => _x( 'scrollHorz', 'Transition Effect', 'easy-commerce' ),
		);

		$output = apply_filters( 'easy_commerce_filter_featured_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function easy_commerce_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'easy-commerce' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'easy-commerce' ),
		);
		$output = apply_filters( 'easy_commerce_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function easy_commerce_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'easy-commerce' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'easy-commerce' );
		$choices['medium']    = esc_html__( 'Medium', 'easy-commerce' );
		$choices['large']     = esc_html__( 'Large', 'easy-commerce' );
		$choices['full']      = esc_html__( 'Full (original)', 'easy-commerce' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ){
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function easy_commerce_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'Alignment', 'easy-commerce' ),
			'left'   => _x( 'Left', 'Alignment', 'easy-commerce' ),
			'center' => _x( 'Center', 'Alignment', 'easy-commerce' ),
			'right'  => _x( 'Right', 'Alignment', 'easy-commerce' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $min    Min.
	 * @param int    $max    Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 * @return array Options array.
	 */
	function easy_commerce_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;

	}

endif;
