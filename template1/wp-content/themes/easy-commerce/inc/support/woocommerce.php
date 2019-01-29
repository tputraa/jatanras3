<?php
/**
 * WooCommerce support class.
 *
 * @package Easy_Commerce
 */

/**
 * Woocommerce support class.
 *
 * @since 1.0.0
 */
class Easy_Commerce_Woocommerce {

	/**
	 * Construcor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$this->setup();
		$this->init();

	}

	/**
	 * Initial setup.
	 *
	 * @since 1.0.0
	 */
	function setup() {
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	function init() {

		// Wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( $this, 'woo_wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'woo_wrapper_end' ), 10 );

		// Breadcrumb.
		add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'custom_woocommerce_breadcrumbs_defaults' ) );
		add_action( 'wp', array( $this, 'hooking_woo' ) );

		// Sidebar.
		add_action( 'woocommerce_sidebar', array( $this, 'add_secondary_sidebar' ), 11 );

		// Loop columns.
		add_filter( 'loop_shop_columns', array( $this, 'woo_loop_columns' ) );

		// Loop columns.
		add_filter( 'woocommerce_related_products_columns', array( $this, 'woo_related_products_columns' ) );

	}

	/**
	 * Hooking Woocommerce.
	 *
	 * @since 1.0.0
	 */
	function hooking_woo() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		if ( is_woocommerce() ) {
			if ( ! is_shop() ) {
				add_action( 'easy_commerce_action_before_content', 'woocommerce_breadcrumb', 7 );
			}
			remove_action( 'easy_commerce_action_before_content', 'easy_commerce_add_breadcrumb', 7 );
		}

		// Fixing primary sidebar.
		$global_layout = easy_commerce_get_option( 'global_layout' );
		$global_layout = apply_filters( 'easy_commerce_filter_theme_global_layout', $global_layout );
		if ( in_array( $global_layout, array( 'no-sidebar', 'no-sidebar-centered' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

		// Hide page title.
		if ( is_shop() ) {
			add_filter( 'woocommerce_show_page_title', '__return_false' );
		}

	}

	/**
	 * Modify loop columns.
	 *
	 * @since 1.0.0
	 */
	function woo_loop_columns( $column ) {

		$column = 3;
		return $column;

	}

	/**
	 * Add secondary sidebar in Woocommerce.
	 *
	 * @since 1.0.0
	 */
	function add_secondary_sidebar() {

		$global_layout = easy_commerce_get_option( 'global_layout' );
		$global_layout = apply_filters( 'easy_commerce_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

	}

	/**
	 * Woocommerce content wrapper start.
	 *
	 * @since 1.0.0
	 */
	function woo_wrapper_start() {
		echo '<div id="primary">';
		echo '<main role="main" class="site-main" id="main">';
	}

	/**
	 * Woocommerce content wrapper end.
	 *
	 * @since 1.0.0
	 */
	function woo_wrapper_end() {
		echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
	}

	/**
	 * Woocommerce breadcrumb defaults.
	 *
	 * @since 1.0.0
	 *
	 * @param array $defaults Breadcrumb defaults.
	 * @return array Modified breadcrumb defaults.
	 */
	function custom_woocommerce_breadcrumbs_defaults( $defaults ) {
		$defaults['delimiter']   = '';
		$defaults['wrap_before'] = '<div id="breadcrumb" itemprop="breadcrumb"><div class="container"><ul id="crumbs">';
		$defaults['wrap_after']  = '</ul></div></div>';
		$defaults['before']      = '<li>';
		$defaults['after']       = '</li>';
		$defaults['home']        = get_bloginfo( 'name', 'display' );

		return $defaults;
	}

	/**
	 * Columns in related products.
	 *
	 * @since 1.0.6
	 *
	 * @param string $input Number.
	 * @return string Modified number.
	 */
	function woo_related_products_columns( $input ) {

		return 3;
	}

} // End class.


// Initialize.
$easy_commerce_woocommerce = new Easy_Commerce_Woocommerce();
