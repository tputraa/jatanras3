<?php
/**
 * Theme Options related to featured section.
 *
 * @package Easy_Commerce
 */

$default = easy_commerce_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_featured_section_panel',
	array(
	'title'      => __( 'Featured Section', 'easy-commerce' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Featured content type section.
$wp_customize->add_section( 'section_theme_featured_basic_settings',
	array(
	'title'      => __( 'Basic Settings', 'easy-commerce' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_featured_section_panel',
	)
);

// Setting featured_section_status.
$wp_customize->add_setting( 'theme_options[featured_section_status]',
	array(
	'default'           => $default['featured_section_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_section_status]',
	array(
	'label'       => __( 'Enable Featured Section', 'easy-commerce' ),
	'description' => __( 'This will be displayed in static front page.', 'easy-commerce' ),
	'section'     => 'section_theme_featured_basic_settings',
	'type'        => 'checkbox',
	'priority'    => 100,
	)
);

// Setting featured_left_heading.
$wp_customize->add_setting( 'theme_options[featured_left_heading]',
	array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Heading_Control( $wp_customize, 'theme_options[featured_left_heading]',
		array(
			'label'           => __( 'Left Section', 'easy-commerce' ),
			'section'         => 'section_theme_featured_basic_settings',
			'settings'        => 'theme_options[featured_left_heading]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_section_active',
		)
	)
);

// Setting featured_left_message.
$wp_customize->add_setting( 'theme_options[featured_left_message]',
	array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Message_Control( $wp_customize, 'theme_options[featured_left_message]',
		array(
			'description'     => __( 'Slider will be displayed in the left section', 'easy-commerce' ),
			'section'         => 'section_theme_featured_basic_settings',
			'settings'        => 'theme_options[featured_left_message]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_section_active',
		)
	)
);

// Setting featured_right_heading.
$wp_customize->add_setting( 'theme_options[featured_right_heading]',
	array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Heading_Control( $wp_customize, 'theme_options[featured_right_heading]',
		array(
			'label'           => __( 'Right Section', 'easy-commerce' ),
			'section'         => 'section_theme_featured_basic_settings',
			'settings'        => 'theme_options[featured_right_heading]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_section_active',
		)
	)
);

// Setting featured_right_message.
$wp_customize->add_setting( 'theme_options[featured_right_message]',
	array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Message_Control( $wp_customize, 'theme_options[featured_right_message]',
		array(
			'description'     => sprintf( __( 'This section will display widgets in %s widget area.', 'easy-commerce' ), '<a href="javascript:wp.customize.panel( \'widgets\' ).focus();"><em>Featured Section Right</em></a>' ),
			'section'         => 'section_theme_featured_basic_settings',
			'settings'        => 'theme_options[featured_right_message]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_section_active',
		)
	)
);

// Slider Type Section.
$wp_customize->add_section( 'section_theme_slider_type',
	array(
	'title'      => __( 'Slider Type', 'easy-commerce' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_featured_section_panel',
	)
);

// Setting featured_slider_type.
$wp_customize->add_setting( 'theme_options[featured_slider_type]',
	array(
	'default'           => $default['featured_slider_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_type]',
	array(
	'label'    => __( 'Select Slider Type', 'easy-commerce' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => easy_commerce_get_featured_slider_type(),
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting( 'theme_options[featured_slider_number]',
	array(
	'default'           => $default['featured_slider_number'],
	'capability'        => 'edit_theme_options',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'easy_commerce_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_number]',
	array(
	'label'       => __( 'No of Slides', 'easy-commerce' ),
	'description' => __( 'Enter number between 1 and 5. Save and refresh the page if No of Slides is changed.', 'easy-commerce' ),
	'section'     => 'section_theme_slider_type',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);

// Setting featured_slider_category.
$wp_customize->add_setting( 'theme_options[featured_slider_category]',
	array(
		'default'           => $default['featured_slider_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[featured_slider_category]',
		array(
			'label'           => __( 'Select Category', 'easy-commerce' ),
			'section'         => 'section_theme_slider_type',
			'settings'        => 'theme_options[featured_slider_category]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_category_slider_active',
		)
	)
);

// Setting featured_slider_product_category.
$wp_customize->add_setting( 'theme_options[featured_slider_product_category]',
	array(
		'default'           => $default['featured_slider_product_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Easy_Commerce_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[featured_slider_product_category]',
		array(
			'label'           => __( 'Select Product Category', 'easy-commerce' ),
			'section'         => 'section_theme_slider_type',
			'settings'        => 'theme_options[featured_slider_product_category]',
			'priority'        => 100,
			'active_callback' => 'easy_commerce_is_featured_product_category_slider_active',
			'taxonomy'        => 'product_cat',
		)
	)
);

// Setting featured_slider_read_more_text.
$wp_customize->add_setting( 'theme_options[featured_slider_read_more_text]',
	array(
	'default'           => $default['featured_slider_read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_read_more_text]',
	array(
	'label'    => __( 'Read More Text', 'easy-commerce' ),
	'section'  => 'section_theme_slider_type',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Slider Options Section.
$wp_customize->add_section( 'section_theme_slider_options',
	array(
	'title'      => __( 'Slider Options', 'easy-commerce' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_featured_section_panel',
	)
);

// Setting featured_slider_transition_effect.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_effect]',
	array(
	'default'           => $default['featured_slider_transition_effect'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_select_liberal',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_effect]',
	array(
	'label'    => __( 'Transition Effect', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => easy_commerce_get_featured_slider_transition_effects(),
	)
);
// Setting featured_slider_transition_delay.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_delay]',
	array(
	'default'           => $default['featured_slider_transition_delay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_delay]',
	array(
	'label'       => __( 'Transition Delay', 'easy-commerce' ),
	'description' => __( 'in seconds', 'easy-commerce' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_transition_duration.
$wp_customize->add_setting( 'theme_options[featured_slider_transition_duration]',
	array(
	'default'           => $default['featured_slider_transition_duration'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_transition_duration]',
	array(
	'label'       => __( 'Transition Duration', 'easy-commerce' ),
	'description' => __( 'in seconds', 'easy-commerce' ),
	'section'     => 'section_theme_slider_options',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
	)
);
// Setting featured_slider_enable_caption.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_caption]',
	array(
	'default'           => $default['featured_slider_enable_caption'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_caption]',
	array(
	'label'    => __( 'Enable Caption', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_arrow.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_arrow]',
	array(
	'default'           => $default['featured_slider_enable_arrow'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_arrow]',
	array(
	'label'    => __( 'Enable Arrow', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_pager.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_pager]',
	array(
	'default'           => $default['featured_slider_enable_pager'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_pager]',
	array(
	'label'    => __( 'Enable Pager', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'default'           => $default['featured_slider_enable_autoplay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_autoplay]',
	array(
	'label'    => __( 'Enable Autoplay', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Setting featured_slider_enable_overlay.
$wp_customize->add_setting( 'theme_options[featured_slider_enable_overlay]',
	array(
	'default'           => $default['featured_slider_enable_overlay'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'easy_commerce_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[featured_slider_enable_overlay]',
	array(
	'label'    => __( 'Enable Overlay', 'easy-commerce' ),
	'section'  => 'section_theme_slider_options',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
