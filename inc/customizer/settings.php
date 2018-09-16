<?php
/**
 * Setting general
 *
 * @package Tasman
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tasman_customize_register( $wp_customize ) {

	$setting = tasman_setting_default();

	// Arctic Theme Setting Panel
	$wp_customize->add_panel( 'theme_settings', array(
		'title' 		=> esc_html__( 'Theme Settings', 'tasman' ),
		'priority' 		=> 199,
	) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/** WP */
	$wp_customize->get_section( 'header_image' )->panel 				= 'theme_settings';
	$wp_customize->get_section( 'background_image' )->panel 			= 'theme_settings';
	$wp_customize->get_section( 'colors' )->panel 						= 'theme_settings';

	/** Theme Colors */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => $setting['primary_color'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'primary_color',
		array(
			'label'       	=> esc_html__( 'Link Color', 'tasman' ),
			'description'	=> esc_html__( 'Used for link, button, selection.', 'tasman' ),
			'section'     	=> 'colors',
			'setting'		=> 'primary_color',
			'priority'		=> 99
	) ) );

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'           => $setting['secondary_color'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'secondary_color',
		array(
			'label'       	=> esc_html__( 'Hover Color', 'tasman' ),
			'description'	=> esc_html__( 'Used for link:hover, button:hover.', 'tasman' ),
			'section'     	=> 'colors',
			'setting'		=> 'secondary_color',
			'priority'		=> 99
	) ) );

	// Archive Setting
	$wp_customize->add_section(
		'blog_section' ,
		array(
			'title' 			=> esc_html__( 'Blog Setting', 'tasman' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'post_date' ,
		 array(
		    'default' 			=> $setting['post_date'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'post_date',
		array(
			'label'    => esc_html__( 'Display Post Date', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'post_date',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'post_author' ,
		 array(
		    'default' 			=> $setting['post_author'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'post_author',
		array(
			'label'    => esc_html__( 'Display Post Author', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'post_author',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'post_cat' ,
		 array(
		    'default' 			=> $setting['post_cat'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'post_cat',
		array(
			'label'    => esc_html__( 'Display Post Category', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'post_cat',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'post_tag' ,
		 array(
		    'default' 			=> $setting['post_tag'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'post_tag',
		array(
			'label'    => esc_html__( 'Display Post Tag', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'post_tag',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'post_comments' ,
		 array(
		    'default' 			=> $setting['post_comments'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'post_comments',
		array(
			'label'    => esc_html__( 'Display comments count', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'post_comments',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'author_display' ,
		 array(
		    'default' 			=> $setting['author_display'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'author_display',
		array(
			'label'    => esc_html__( 'Display Author biography at single post', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'author_display',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'excerpt_length' ,
		 array(
		    'default' 			=> $setting['excerpt_length'],
		    'sanitize_callback' => 'tasman_sanitize_number_absint',
	) );

	$wp_customize->add_control(
		'excerpt_length',
		array(
			'label'    => esc_html__( 'Excerpt length', 'tasman' ),
			'section'  => 'blog_section',
			'settings' => 'excerpt_length',
			'type'     => 'number',
		    'input_attrs' => array(
		        'min'   => 1,
		        'max'   => 9999,
		    )
		)
	);

	$wp_customize->add_setting(
		'posts_navigation',
		array(
			'default'           => $setting['posts_navigation'],
			'sanitize_callback' => 'tasman_sanitize_select',
	) );

	$wp_customize->add_control(
		'posts_navigation',
		array(
			'label'    => esc_html__( 'Posts Navigation', 'tasman' ),
			'section'  => 'blog_section',
			'setting'  => 'posts_navigation',
			'type'     => 'select',
			'choices'  => array(
				'posts_navigation' 	=> esc_attr__( 'Prev / Next', 'tasman' ),
				'posts_pagination' 	=> esc_attr__( 'Numeric', 'tasman' ),
			),
	) );

	// Footer Widgets
	$wp_customize->add_section(
		'footer_area' ,
		array(
			'title' 			=> esc_html__( 'Footer', 'tasman' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'theme_designer' ,
		 array(
		    'default' 			=> $setting['theme_designer'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'arctic_black_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'theme_designer',
		array(
			'label'    => esc_html__( 'Display theme designer at footer?', 'tasman' ),
			'section'  => 'footer_area',
			'settings' => 'theme_designer',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'return_top' ,
		 array(
		    'default' 			=> $setting['return_to_top'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'tasman_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'return_top',
		array(
			'label'    => esc_html__( 'Enable return to top link', 'tasman' ),
			'section'  => 'footer_area',
			'settings' => 'return_top',
			'type'     => 'checkbox'
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'tasman_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'tasman_customize_partial_blogdescription',
		) );

	}

}
add_action( 'customize_register', 'tasman_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function tasman_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function tasman_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
