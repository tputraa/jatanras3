<?php
/**
 * Core functions.
 *
 * @package Easy_Commerce
 */

if ( ! function_exists( 'easy_commerce_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function easy_commerce_get_option( $key ) {

		$default_options = easy_commerce_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;

if ( ! function_exists( 'easy_commerce_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
	function easy_commerce_get_options() {

		$value = array();
		$value = get_theme_mod( 'theme_options' );
		return $value;

	}

endif;

if( ! function_exists( 'easy_commerce_exclude_category_in_blog_page' ) ) :

	/**
	 * Exclude category in blog page.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_exclude_category_in_blog_page( $query ) {

		if ( $query->is_home() && $query->is_main_query() ) {
			$exclude_categories = easy_commerce_get_option( 'exclude_categories' );
			if ( ! empty( $exclude_categories ) ) {
				$cats_exploded = explode( ',', $exclude_categories );
				$cats = array();
				if ( ! empty( $cats_exploded ) ) {
					foreach ( $cats_exploded as $c ) {
						if ( absint( $c ) > 0 ) {
							$cats[] = absint( $c );
						}
					}
					if ( ! empty( $cats ) ) {
						$string_exclude = '';
						$string_exclude = '-' . implode( ',-', $cats );
						$query->set( 'cat', $string_exclude );
					}
				}
			}
		}

		return $query;
	}

endif;

add_filter( 'pre_get_posts', 'easy_commerce_exclude_category_in_blog_page' );
