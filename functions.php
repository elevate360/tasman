<?php
/**
 * Tasman functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tasman
 */

/**
 * Tasman only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'tasman_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tasman_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tasman, use a find and replace
	 * to change 'tasman' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tasman' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Set the default content width.
	$GLOBALS['content_width'] = 720;

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 1280, 1280, false );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'audio',
		'quote',
		'link'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'tasman' ),
		'menu-2' => esc_html__( 'Secondary', 'tasman' ),
		'menu-3' => esc_html__( 'Social Link', 'tasman' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tasman_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/** Enable support for custom logo */
	add_theme_support( 'custom-logo', array(
		'width'       => 600,
		'height'      => 600,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( tasman_fonts_url(), 'assets/css/editor-style.min.css' ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Gutenberg
	add_theme_support( 'align-wide' );

	// Remove default style for Contact Form 7 plugin
	add_filter( 'wpcf7_load_css', '__return_false' );

	// Default block styles
	add_theme_support( 'wp-block-styles' );

	// Block color Palettes
	add_theme_support( 'editor-color-palette', array(
		array(
				'name'  => esc_attr__( 'strong magenta', 'tasman' ),
				'slug'  => 'strong-magenta',
				'color' => '#a156b4',
		),
		array(
				'name'  => esc_attr__( 'light grayish magenta', 'tasman' ),
				'slug'  => 'light-grayish-magenta',
				'color' => '#d0a5db',
		),
		array(
				'name'  => esc_attr__( 'very light gray', 'tasman' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
		),
		array(
				'name'  => esc_attr__( 'very dark gray', 'tasman' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
		),
	));

	// Block gradient presets
	add_theme_support(
    'editor-gradient-presets',
    array(
        array(
            'name'     => esc_attr__( 'Vivid cyan blue to vivid purple', 'tasman' ),
            'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
            'slug'     => 'vivid-cyan-blue-to-vivid-purple'
        ),
        array(
            'name'     => esc_attr__( 'Vivid green cyan to vivid cyan blue', 'tasman' ),
            'gradient' => 'linear-gradient(135deg,rgba(0,208,132,1) 0%,rgba(6,147,227,1) 100%)',
            'slug'     =>  'vivid-green-cyan-to-vivid-cyan-blue',
        ),
        array(
            'name'     => esc_attr__( 'Light green cyan to vivid green cyan', 'tasman' ),
            'gradient' => 'linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%)',
            'slug'     => 'light-green-cyan-to-vivid-green-cyan',
        ),
        array(
            'name'     => esc_attr__( 'Luminous vivid amber to luminous vivid orange', 'tasman' ),
            'gradient' => 'linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)',
            'slug'     => 'luminous-vivid-amber-to-luminous-vivid-orange',
        ),
        array(
            'name'     => esc_attr__( 'Luminous vivid orange to vivid red', 'tasman' ),
            'gradient' => 'linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%)',
            'slug'     => 'luminous-vivid-orange-to-vivid-red',
        ),
    )
	);

	// Block font sizes
	add_theme_support( 'editor-font-sizes', array(
    array(
        'name' => esc_attr__( 'Small', 'tasman' ),
        'size' => 12,
        'slug' => 'small'
    ),
    array(
        'name' => esc_attr__( 'Regular', 'tasman' ),
        'size' => 16,
        'slug' => 'regular'
    ),
    array(
        'name' => esc_attr__( 'Large', 'tasman' ),
        'size' => 36,
        'slug' => 'large'
    ),
    array(
        'name' => esc_attr__( 'Huge', 'tasman' ),
        'size' => 50,
        'slug' => 'huge'
    )
) );

	// Block based template parts
	add_theme_support( 'block-template-parts' );

	// register_block_style 
	register_block_style(
		'core/quote',
		array(
			'name'         => 'blue-quote',
			'label'        => __( 'Blue Quote', 'tasman' ),
			'is_default'   => true,
			'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
		)
	);

	// register_block_pattern
	register_block_pattern(
		'wpdocs/my-example',
		array(
			'title'         => __( 'My First Block Pattern', 'tasman' ),
			'description'   => _x( 'This is my first block pattern', 'Block pattern description', 'tasman' ),
			'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
			'categories'    => array( 'text' ),
			'keywords'      => array( 'cta', 'demo', 'example' ),
			'viewportWidth' => 800,
		)
	);

	add_theme_support( "responsive-embeds" );
	add_theme_support( "align-wide" );
}
endif;
add_action( 'after_setup_theme', 'tasman_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tasman_content_width() {
	$content_width = $GLOBALS['content_width'];

	/**
	 * Filter Tasman content width of the theme.
	 *
	 * @since Tasman 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'tasman_content_width', $content_width );
}
add_action( 'template_redirect', 'tasman_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tasman_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'tasman' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tasman' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'tasman_widgets_init' );

/**
 * Register custom fonts.
 */
function tasman_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Zilla Slab, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$montserrat = _x( 'on', 'Zilla Slab font: on or off', 'tasman' );

	if ( 'off' !== $montserrat ) {
		$font_families = array();

		$font_families[] = 'Zilla Slab:400,400i,700,700i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function tasman_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'tasman-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'tasman_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function tasman_scripts() {

	// Add custom fonts, used in the main stylesheet.
	if ( ! class_exists( 'Easy_Google_Fonts' ) ) {
		wp_enqueue_style( 'tasman-fonts', tasman_fonts_url(), array(), null );
	}

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$rtl = ( is_rtl() ) ? '-rtl' : '';

	/** Styles */
	wp_enqueue_style( "tasman-style{$rtl}", get_theme_file_uri( "/style{$rtl}{$suffix}.css" ) );

	/** lt IE 9 script */
	wp_enqueue_script( 'html5shiv', get_theme_file_uri( "/assets/js/ie/html5shiv$suffix.js" ), array(), '3.7.3' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'respond', get_theme_file_uri( "/assets/js/ie/respond$suffix.js" ), array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'nwmatcher', get_theme_file_uri( "/assets/js/ie/nwmatcher$suffix.js" ), array(), '1.4.2' );
	wp_script_add_data( 'nwmatcher', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'selectivizr', get_theme_file_uri( "/assets/js/ie/selectivizr$suffix.js" ), array(), '1.0.2' );
	wp_script_add_data( 'selectivizr', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/fitvids/jquery.fitvids.min.js', array( 'jquery' ), '1.2.0', true );
	wp_enqueue_script( 'jquery-stickit', get_template_directory_uri() . '/assets/js/stickit/jquery.stickit.min.js', array( 'jquery' ), '0.2.13', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_script( 'jquery-justified-gallery', get_template_directory_uri() . '/assets/js/justified-gallery/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.6.3', true );
	wp_enqueue_script( 'tasman-script', get_template_directory_uri() . '/assets/js/frontend.min.js', array( 'jquery', 'jquery-masonry' ), '20151215', true );

	$output = array(
		'expandMenu' 	=> tasman_get_svg( array( 'icon' => 'expand' ) ),
		'collapseMenu' 	=> tasman_get_svg( array( 'icon' => 'collapse' ) ),
		'subNav' 		=> '<span class="screen-reader-text">' . esc_html__( 'Sub Navigation', 'tasman' ) . '</span>',
		'imageSrc'		=> esc_html__( 'Image Source &rarr;', 'tasman' )
	);
	wp_localize_script( 'tasman-script', 'Tasmanl10n', $output );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'tasman_scripts' );

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function tasman_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'tasman_javascript_detection', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/utility.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/vendor/vendor.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
