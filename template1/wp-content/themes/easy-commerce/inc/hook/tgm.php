<?php
/**
 * Recommended plugins.
 *
 * @package Easy_Commerce
 */

add_action( 'tgmpa_register', 'easy_commerce_activate_recommended_plugins' );

/**
 * Register recommended plugins.
 *
 * @since 1.0.0
 */
function easy_commerce_activate_recommended_plugins() {

	$plugins = array(
		array(
			'name'     => esc_html__( 'WooCommerce', 'easy-commerce' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'easy-commerce' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),
	);

	$config = array();

	tgmpa( $plugins, $config );

}
