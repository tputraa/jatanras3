<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Easy_Commerce
 */

?><?php
	/**
	 * Hook - easy_commerce_action_doctype.
	 *
	 * @hooked easy_commerce_doctype -  10
	 */
	do_action( 'easy_commerce_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - easy_commerce_action_head.
	 *
	 * @hooked easy_commerce_head -  10
	 */
	do_action( 'easy_commerce_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - easy_commerce_action_before.
	 *
	 * @hooked easy_commerce_page_start - 10
	 * @hooked easy_commerce_skip_to_content - 15
	 */
	do_action( 'easy_commerce_action_before' );
	?>

    <?php
	  /**
	   * Hook - easy_commerce_action_before_header.
	   *
	   * @hooked easy_commerce_header_start - 10
	   */
	  do_action( 'easy_commerce_action_before_header' );
	?>
		<?php
		/**
		 * Hook - easy_commerce_action_header.
		 *
		 * @hooked easy_commerce_site_branding - 10
		 */
		do_action( 'easy_commerce_action_header' );
		?>
    <?php
	  /**
	   * Hook - easy_commerce_action_after_header.
	   *
	   * @hooked easy_commerce_header_end - 10
	   * @hooked easy_commerce_add_primary_navigation - 20
	   * @hooked easy_commerce_add_featured_section - 30
	   */
	  do_action( 'easy_commerce_action_after_header' );
	?>

	<?php
	/**
	 * Hook - easy_commerce_action_before_content.
	 *
	 * @hooked easy_commerce_add_front_page_widget_area - 7
	 * @hooked easy_commerce_add_breadcrumb - 7
	 * @hooked easy_commerce_content_start - 10
	 */
	do_action( 'easy_commerce_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - easy_commerce_action_content.
	   */
	  do_action( 'easy_commerce_action_content' );
	?>
