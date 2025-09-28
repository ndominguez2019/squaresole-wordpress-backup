<?php

define( 'MOKKO_THEME_DIRECTORY', esc_url( trailingslashit( get_template_directory_uri() ) ) );
define( 'MOKKO_REQUIRE_DIRECTORY', trailingslashit( get_template_directory() ) );
define( 'MOKKO_WOOCOMMERCE', class_exists( 'WooCommerce' ) ? true : false );
define( 'MOKKO_DEVELOPMENT', true );

/**
 * After Setup
 */

function mokko_setup() {

    add_action( 'after_setup_theme', function() {
        load_theme_textdomain( 'mokko', get_template_directory() . '/languages' );
    });

	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary Menu', 'mokko' )
	) );

	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array('link', 'image', 'gallery', 'video', 'audio', 'quote'));
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',	) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );

	add_image_size( 'mokko-default-post-thumb', 1290, 684, true );
	add_image_size( 'mokko-card-post-thumb', 400, 268, false );
	add_image_size( 'mokko-portfolio-thumb', 1120, 9999, false );
	add_image_size( 'mokko-portfolio-nav-thumb', 420, 420, true );
	add_image_size( 'mokko-recent-post-thumb', 90, 90, true );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style-editor.css' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support dark editor style
	add_theme_support( 'dark-editor-style' );

	// Editor color palette.
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Primary', 'mokko' ),
				'slug' => 'primary',
				'color' => '#1258ca',
			),
			array(
				'name'  => esc_html__( 'Accent', 'mokko' ),
				'slug' => 'accent',
				'color' => '#c70a1a',
			),
			array(
				'name'  => esc_html__( 'Success', 'mokko' ),
				'slug' => 'success',
				'color' => '#88c559',
			),
			array(
				'name'  => esc_html__( 'Black', 'mokko' ),
				'slug' => 'black',
				'color' => '#263654',
			),
			array(
				'name'  => esc_html__( 'Contrast', 'mokko' ),
				'slug' => 'contrast',
				'color' => '#292a2d',
			),
			array(
				'name'  => esc_html__( 'Contrast Medium', 'mokko' ),
				'slug' => 'contrast-medium',
				'color' => '#79797c',
			),
			array(
				'name'  => esc_html__( 'Contrast lower', 'mokko' ),
				'slug' => 'contrast lower',
				'color' => '#323639',
			),
			array(
				'name'  => esc_html__( 'White', 'mokko' ),
				'slug' => 'white',
				'color' => '#ffffff',
			)
		)
	);

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Small', 'mokko' ),
				'shortName' => __( 'S', 'mokko' ),
				'size'      => 14,
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'Normal', 'mokko' ),
				'shortName' => __( 'M', 'mokko' ),
				'size'      => 16,
				'slug'      => 'normal',
			),
			array(
				'name'      => __( 'Large', 'mokko' ),
				'shortName' => __( 'L', 'mokko' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => __( 'Huge', 'mokko' ),
				'shortName' => __( 'XL', 'mokko' ),
				'size'      => 28,
				'slug'      => 'huge',
			),
		)
	);

	// WooCommerce
	if ( MOKKO_WOOCOMMERCE ) {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-slider' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 700,
			'gallery_thumbnail_image_width' => 150,
			'single_image_width' => 700,
		) );
	}
	
}

add_action( 'after_setup_theme', 'mokko_setup' );

/**
 * Content Width
 */
function mokko_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mokko_content_width', 1340 );
}
add_action( 'after_setup_theme', 'mokko_content_width', 0 );


/**
 * Add Editor Styles
 */
function mokko_add_editor_styles() {
	add_editor_style( 'editor-styles.css' );
}
add_action( 'admin_init', 'mokko_add_editor_styles' );

/**
 * Include and IMPORT/EXPORT ACF fields via JSON
 */
if( false == MOKKO_DEVELOPMENT ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
	require_once MOKKO_REQUIRE_DIRECTORY . 'inc/helper/custom-fields/custom-fields.php';
}

function mokko_acf_save_json( $path ) {
	$path = MOKKO_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
	return $path;
}
add_filter( 'acf/settings/save_json', 'mokko_acf_save_json' );

function mokko_acf_load_json( $paths ) {
	unset( $paths[0] );
	$paths[] = MOKKO_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'mokko_acf_load_json' );

/**
 * Include required files
 */

// TGM
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/helper/class-tgm-plugin-activation.php';
// TGM register plugins
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-required-plugins.php';
// Style and scripts for theme
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-enqueue.php';
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-elementor.php';
// Theme Functions
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-functions.php';
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-actions.php';
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-filters.php';
require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-demo-import.php';

/**
 * Include WooComerce
 */
if ( MOKKO_WOOCOMMERCE ) {
	require_once MOKKO_REQUIRE_DIRECTORY . 'inc/theme-woocommerce.php';
}

/**
 * Include kirki fields
 */
add_action( 'init', function() {
    if ( class_exists( 'Kirki' ) ) {
        load_textdomain( 'kirki', WP_LANG_DIR . '/plugins/kirki-' . get_locale() . '.mo' );
        require_once MOKKO_REQUIRE_DIRECTORY . 'inc/framework/customizer.php';
    }
} );

function mokko_load_all_variants_and_subsets() {
    if ( class_exists( 'Kirki_Fonts_Google' ) ) {
        Kirki_Fonts_Google::$force_load_all_variants = true;
        Kirki_Fonts_Google::$force_load_all_subsets = true;
    }
}

add_action( 'after_setup_theme', 'mokko_load_all_variants_and_subsets' );