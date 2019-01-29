<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Easy_Commerce
 */

if ( ! function_exists( 'easy_commerce_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_skip_to_content() {
	?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'easy-commerce' ); ?></a><?php
	}
endif;

add_action( 'easy_commerce_action_before', 'easy_commerce_skip_to_content', 15 );


if ( ! function_exists( 'easy_commerce_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_site_branding() {

		?>
		<div class="site-branding">

			<?php easy_commerce_the_custom_logo(); ?>

			<?php $show_title = easy_commerce_get_option( 'show_title' ); ?>
			<?php $show_tagline = easy_commerce_get_option( 'show_tagline' ); ?>
			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<div id="right-head">
			<?php if ( easy_commerce_is_woocommerce_active() ) : ?>
				<div id="cart-section">
					<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
						<?php $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>
						<?php if ( absint( $wishlist_page_id ) > 0 ) : ?>
							<a class="wishlist-icon" href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><i class="fa fa-heart" aria-hidden="true"></i><strong><?php echo absint( yith_wcwl_count_products() ); ?></strong></a>
						<?php endif; ?>
					<?php endif; ?>
					<a class="cart-icon" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i><strong><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></strong>
					</a>
				</div> <!-- .cart-section -->
			<?php endif; ?>

			<?php $search_in_header = easy_commerce_get_option( 'search_in_header' ); ?>

			<?php if ( true === $search_in_header ) : ?>
				<div class="header-search-wrapper">

					<?php if ( easy_commerce_is_woocommerce_active() ) : ?>

						<?php get_template_part( 'template-parts/product-search' ); ?>

					<?php else : ?>

						<?php get_search_form(); ?>

					<?php endif; ?>

				</div><!-- .header-search-wrapper -->

			<?php endif; ?>
		</div> <!-- #right-head -->

		<?php
	}

endif;

add_action( 'easy_commerce_action_header', 'easy_commerce_site_branding' );

if ( ! function_exists( 'easy_commerce_add_primary_navigation' ) ) :

	/**
	 * Primary navigation.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_add_primary_navigation() {
		?>
		<div id="main-nav" class="clear-fix">
			<div class="container">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="wrap-menu-content">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'fallback_cb'    => 'easy_commerce_primary_navigation_fallback',
							) );
							?>
					</div><!-- .menu-content -->
				</nav><!-- #site-navigation -->
			</div> <!-- .container -->
		</div> <!-- #main-nav -->
		<?php
	}

endif;

add_action( 'easy_commerce_action_after_header', 'easy_commerce_add_primary_navigation', 20 );

if ( ! function_exists( 'easy_commerce_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
			<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-bars"></i></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => '',
					'fallback_cb'    => 'easy_commerce_primary_navigation_fallback',
					) );
				?>
			</div><!-- #mob-menu -->
		</div><!-- .mobile-nav-wrap -->

		<?php

	}

endif;

add_action( 'easy_commerce_action_before', 'easy_commerce_mobile_navigation', 20 );

if ( ! function_exists( 'easy_commerce_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'easy_commerce_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer Menu.
		$footer_menu_content = wp_nav_menu( array(
			'theme_location' => 'footer',
			'container'      => 'div',
			'container_id'   => 'footer-navigation',
			'depth'          => 1,
			'fallback_cb'    => false,
			'echo'           => false,
		) );

		// Copyright content.
		$copyright_text = easy_commerce_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'easy_commerce_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( esc_html__( 'Easy Commerce by %s', 'easy-commerce' ), '<a target="_blank" rel="designer" href="http://wenthemes.com/">' . esc_html__( 'WEN Themes', 'easy-commerce' ) . '</a>' );

		$show_social_in_footer = easy_commerce_get_option( 'show_social_in_footer' );

		$column_count = 0;

		if ( $footer_menu_content ) {
			$column_count++;
		}
		if ( $copyright_text ) {
			$column_count++;
		}
		if ( $powered_by_text ) {
			$column_count++;
		}
		if ( true === $show_social_in_footer && has_nav_menu( 'social' ) ) {
			$column_count++;
		}

		?>

		<div class="colophon-inner colophon-grid-<?php echo esc_attr( $column_count ); ?>">


		    <?php if ( true === $show_social_in_footer && has_nav_menu( 'social' ) ) : ?>
		    	<div class="footer-social">
		    		<?php the_widget( 'Easy_Commerce_Social_Widget' ); ?>
		    	</div><!-- .footer-social -->
		    <?php endif; ?>

		    <?php if ( ! empty( $footer_menu_content ) ) : ?>
		    	<div class="footer-nav">
					<?php echo $footer_menu_content; ?>
		    	</div><!-- .colophon-column -->
		    <?php endif; ?>
		    
		    <?php if ( ! empty( $copyright_text ) ) : ?>
		    	<div class="copyright">
		    		<?php echo $copyright_text; ?>
		    	</div><!-- .copyright -->
		    <?php endif; ?>

		    <?php if ( ! empty( $powered_by_text ) ) : ?>
		    	<div class="site-info">
		    		<?php echo $powered_by_text; ?>
		    	</div><!-- .site-info -->
		    <?php endif; ?>

		</div><!-- .colophon-inner -->

	    <?php
	}

endif;

add_action( 'easy_commerce_action_footer', 'easy_commerce_footer_copyright', 10 );

if ( ! function_exists( 'easy_commerce_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_add_sidebar() {

		global $post;

		$global_layout = easy_commerce_get_option( 'global_layout' );
		$global_layout = apply_filters( 'easy_commerce_filter_theme_global_layout', $global_layout );

		// Check if single.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'easy_commerce_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
			get_sidebar( 'secondary' );
			break;

			default:
			break;
		}

	}

endif;

add_action( 'easy_commerce_action_sidebar', 'easy_commerce_add_sidebar' );

if ( ! function_exists( 'easy_commerce_custom_posts_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_custom_posts_navigation() {

		the_posts_pagination();

	}
endif;

add_action( 'easy_commerce_action_posts_navigation', 'easy_commerce_custom_posts_navigation' );

if ( ! function_exists( 'easy_commerce_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_add_image_in_single_display() {

		global $post;

		if ( has_post_thumbnail() ) {

			$values = get_post_meta( $post->ID, 'easy_commerce_theme_settings', true );
			$easy_commerce_theme_settings_single_image = isset( $values['single_image'] ) ? $values['single_image'] : '';

			if ( ! $easy_commerce_theme_settings_single_image ) {
				$easy_commerce_theme_settings_single_image = easy_commerce_get_option( 'single_image' );
			}

			if ( 'disable' !== $easy_commerce_theme_settings_single_image ) {
				$args = array(
					'class' => 'aligncenter',
				);

				the_post_thumbnail( esc_attr( $easy_commerce_theme_settings_single_image ), $args );
			}
		}

	}

endif;

add_action( 'easy_commerce_single_image', 'easy_commerce_add_image_in_single_display' );

if ( ! function_exists( 'easy_commerce_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_add_breadcrumb() {

		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';
		easy_commerce_simple_breadcrumb();
		echo '</div><!-- .container --></div><!-- #breadcrumb -->';

	}

endif;

add_action( 'easy_commerce_action_before_content', 'easy_commerce_add_breadcrumb' , 7 );

if ( ! function_exists( 'easy_commerce_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_footer_goto_top() {

		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';

	}

endif;

add_action( 'easy_commerce_action_after', 'easy_commerce_footer_goto_top', 20 );

if ( ! function_exists( 'easy_commerce_header_top_content' ) ) :

	/**
	 * Header Top.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_header_top_content() {
		$contact_number        = easy_commerce_get_option( 'contact_number' );
		$contact_email         = easy_commerce_get_option( 'contact_email' );
		$contact_address       = easy_commerce_get_option( 'contact_address' );
		$show_social_in_header = easy_commerce_get_option( 'show_social_in_header' );

		if ( empty( $contact_number ) && empty( $contact_email ) && empty( $contact_address ) ) {
			$contact_status = false;
		} else {
			$contact_status = true;
		}

		if ( false === $contact_status && ( false === $show_social_in_header || false === has_nav_menu( 'social' ) ) ) {
			return;
		}
		?>
		<div id="tophead">
			<div class="container">
				 <div id="quick-contact">
				   <ul>
				       <?php if ( ! empty( $contact_number ) ) : ?>
				       	<li class="quick-call">
				       		<a href="tel:<?php echo preg_replace( '/\D+/', '', esc_attr( $contact_number ) ); ?>"><?php echo esc_html( $contact_number ); ?></a>
				       	</li>
				       <?php endif; ?>
				       <?php if ( ! empty( $contact_email ) ) : ?>
				       	<li class="quick-email">
				       		<a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
				       	</li>
				       <?php endif; ?>
				       <?php if ( ! empty( $contact_address ) ) : ?>
				       	<li class="quick-address">
				       		<?php echo esc_html( $contact_address ); ?>
				       	</li>
				       <?php endif; ?>
				   </ul>
				</div> <!-- #quick-contact -->
				<?php if ( true === $show_social_in_header && has_nav_menu( 'social' ) ) : ?>
					<div class="header-social-wrapper">
						<?php the_widget( 'Easy_Commerce_Social_Widget' ); ?>
					</div><!-- .header-social-wrapper -->
				<?php endif; ?>
				<div id="right-tophead">
			    	<?php if ( easy_commerce_is_woocommerce_active() ) : ?>
				    	<div id="login-section">
				    		<ul>
				    			<li class="account-login">
					    			<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php echo is_user_logged_in() ? __( 'Login / Resister', 'easy-commerce' ) : __( 'Login / Register', 'easy-commerce' ) ; ?></a>
					    			</li>
			    			</ul>
			    		</div> <!-- .cart-section -->
			    	<?php endif; ?>
	    		</div> <!-- #right-tophead -->
			</div> <!-- .container -->
		</div><!--  #tophead -->

		<?php
	}

endif;

add_action( 'easy_commerce_action_before_header', 'easy_commerce_header_top_content', 5 );

if ( ! function_exists( 'easy_commerce_check_home_page_content' ) ) :

	/**
	 * Check home page content status.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function easy_commerce_check_home_page_content( $status ) {

		if ( is_front_page() ) {
			$home_content_status = easy_commerce_get_option( 'home_content_status' );
			if ( false === $home_content_status ) {
				$status = false;
			}
		}

		return $status;

	}

endif;

add_action( 'easy_commerce_filter_home_page_content', 'easy_commerce_check_home_page_content' );

if ( ! function_exists( 'easy_commerce_add_featured_section' ) ) :

	/**
	 * Add featured section.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_add_featured_section() {

		$featured_section_status = easy_commerce_get_option( 'featured_section_status' );

		if ( true !== $featured_section_status ) {
			return;
		}

		if ( is_front_page() && ! is_home() ) {

			get_template_part( 'template-parts/featured' );

		}

	}
endif;

add_action( 'easy_commerce_action_after_header', 'easy_commerce_add_featured_section', 30 );
