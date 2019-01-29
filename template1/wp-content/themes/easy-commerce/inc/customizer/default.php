<?php
/**
 * Default theme options.
 *
 * @package Easy_Commerce
 */

if ( ! function_exists( 'easy_commerce_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function easy_commerce_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['contact_number']        = '';
		$defaults['contact_email']         = '';
		$defaults['contact_address']       = '';
		$defaults['show_social_in_header'] = false;
		$defaults['search_in_header']      = true;

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'easy-commerce' );
		$defaults['show_social_in_footer'] = false;

		// Blog.
		$defaults['excerpt_length'] = 40;
		$defaults['read_more_text'] = esc_html__( 'READ MORE', 'easy-commerce' );
		$defaults['exclude_categories'] = '';

		// Featured Section.
		$defaults['featured_section_status']             = true;
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_enable_overlay']      = true;
		$defaults['featured_slider_type']                = 'featured-category';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_category']            = '';
		$defaults['featured_slider_product_category']    = '';
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'easy-commerce' );

		// Pass through filter.
		$defaults = apply_filters( 'easy_commerce_filter_default_theme_options', $defaults );

		return $defaults;
	}

endif;
