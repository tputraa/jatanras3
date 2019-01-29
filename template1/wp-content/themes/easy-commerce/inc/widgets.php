<?php
/**
 * Theme widgets.
 *
 * @package Easy_Commerce
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'easy_commerce_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function easy_commerce_load_widgets() {

		// Social widget.
		register_widget( 'Easy_Commerce_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Easy_Commerce_Featured_Page_Widget' );

		// Recent Posts widget.
		register_widget( 'Easy_Commerce_Recent_Posts_Widget' );

	}

endif;

add_action( 'widgets_init', 'easy_commerce_load_widgets' );

if ( ! class_exists( 'Easy_Commerce_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Easy_Commerce_Social_Widget extends Easy_Commerce_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'easy_commerce_widget_social',
				'description'                 => esc_html__( 'Displays social icons.', 'easy-commerce' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => esc_html__( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'easy-commerce' ),
					'type'  => 'message',
					'class' => 'widefat',
					);
			}

			parent::__construct( 'easy-commerce-social', esc_html__( 'EC: Social', 'easy-commerce' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Easy_Commerce_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 1.0.0
	 */
	class Easy_Commerce_Featured_Page_Widget extends Easy_Commerce_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'easy_commerce_widget_featured_page',
				'description'                 => esc_html__( 'Displays single featured Page or Post.', 'easy-commerce' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'use_page_title' => array(
					'label'   => esc_html__( 'Use Page/Post Title as Widget Title', 'easy-commerce' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'featured_page' => array(
					'label'            => esc_html__( 'Select Page:', 'easy-commerce' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'easy-commerce' ),
					),
				'id_message' => array(
					'label'            => '<strong>' . _x( 'OR', 'Featured Page Widget', 'easy-commerce' ) . '</strong>',
					'type'             => 'message',
					),
				'featured_post' => array(
					'label'             => esc_html__( 'Post ID:', 'easy-commerce' ),
					'placeholder'       => esc_html__( 'Eg: 1234', 'easy-commerce' ),
					'type'              => 'text',
					'sanitize_callback' => 'easy_commerce_widget_sanitize_post_id',
					),
				'content_type' => array(
					'label'   => esc_html__( 'Show Content:', 'easy-commerce' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => esc_html__( 'Excerpt', 'easy-commerce' ),
						'full'    => esc_html__( 'Full', 'easy-commerce' ),
						),
					),
				'excerpt_length' => array(
					'label'       => esc_html__( 'Excerpt Length:', 'easy-commerce' ),
					'description' => esc_html__( 'Applies when Excerpt is selected in Content option.', 'easy-commerce' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
					),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'easy-commerce' ),
					'type'    => 'select',
					'options' => easy_commerce_get_image_sizes_options(),
					),
				'featured_image_alignment' => array(
					'label'   => esc_html__( 'Image Alignment:', 'easy-commerce' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => easy_commerce_get_image_alignment_options(),
					),
				);

			parent::__construct( 'easy-commerce-featured-page', esc_html__( 'EC: Featured Page', 'easy-commerce' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			$our_id = '';

			if ( absint( $params['featured_post'] ) > 0 ) {
				$our_id = absint( $params['featured_post'] );
			}

			if ( absint( $params['featured_page'] ) > 0 ) {
				$our_id = absint( $params['featured_page'] );
			}

			if ( absint( $our_id ) > 0 ) {
				$qargs = array(
					'p'             => absint( $our_id ),
					'post_type'     => 'any',
					'no_found_rows' => true,
				);

				$the_query = new WP_Query( $qargs );

				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						echo '<div class="featured-page-widget entry-content">';

						if ( 'disable' != $params['featured_image'] && has_post_thumbnail() ) {
							the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) );
						}

						echo '<div class="featured-page-content">';

						if ( true === $params['use_page_title'] ) {
							the_title( $args['before_title'], $args['after_title'] );
						} else {
							if ( $params['title'] ) {
								echo $args['before_title'] . $params['title'] . $args['after_title'];
							}
						}

						if ( ! empty( $params['subtitle'] ) ) {
							echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
						}

						if ( 'excerpt' === $params['content_type'] && absint( $params['excerpt_length'] ) > 0 ) {
							$excerpt = easy_commerce_the_excerpt( absint( $params['excerpt_length'] ) );
							echo wp_kses_post( wpautop( $excerpt ) );
							echo '<a href="' . esc_url( get_permalink() ) . '" class="more-link">' . esc_html__( 'Read more', 'easy-commerce' ) . '</a>';
						} else {
							the_content();
						}

						echo '</div><!-- .featured-page-content -->';
						echo '</div><!-- .featured-page-widget -->';
					}

					wp_reset_postdata();
				}

			}

			echo $args['after_widget'];
		}

	}
endif;

if ( ! class_exists( 'Easy_Commerce_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 1.0.0
	 */
	class Easy_Commerce_Recent_Posts_Widget extends Easy_Commerce_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'easy_commerce_widget_recent_posts',
				'description'                 => esc_html__( 'Displays recent posts.', 'easy-commerce' ),
				'customize_selective_refresh' => true,
				);
			$fields = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'subtitle' => array(
					'label' => esc_html__( 'Subtitle:', 'easy-commerce' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'easy-commerce' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'easy-commerce' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'easy-commerce' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
					),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'easy-commerce' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => easy_commerce_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
					),
				'image_width' => array(
					'label'       => esc_html__( 'Image Width:', 'easy-commerce' ),
					'type'        => 'number',
					'description' => esc_html__( 'px', 'easy-commerce' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 65,
					'min'         => 1,
					'max'         => 150,
					),
				'disable_date' => array(
					'label'   => esc_html__( 'Disable Date', 'easy-commerce' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::__construct( 'easy-commerce-recent-posts', esc_html__( 'EC: Recent Posts', 'easy-commerce' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( ! empty( $params['subtitle'] ) ) {
				echo '<p class="widget-subtitle">' . esc_html( $params['subtitle'] ) . '</p>';
			}

			$qargs = array(
				'posts_per_page' => esc_attr( $params['post_number'] ),
				'no_found_rows'  => true,
				);
			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $params['post_category'] );
			}
			$all_posts = get_posts( $qargs );

			?>
			<?php if ( ! empty( $all_posts ) ) :  ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php foreach ( $all_posts as $key => $post ) :  ?>
						<?php setup_postdata( $post ); ?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) :  ?>
								<div class="recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $params['image_width'] ). 'px;',
											);
										the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
										?>
									</a>
								</div><!-- .recent-posts-thumb -->
							<?php endif ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) :  ?>
									<div class="recent-posts-meta">

										<?php if ( false === $params['disable_date'] ) :  ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span><!-- .recent-posts-date -->
										<?php endif; ?>

									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endforeach; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;
