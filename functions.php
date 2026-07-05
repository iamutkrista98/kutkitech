<?php
/**
 * KutkiTech Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'KT_THEME_VERSION', '1.0.0' );
define( 'KT_THEME_DIR', get_template_directory() );
define( 'KT_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function kt_theme_setup() {
	load_theme_textdomain( 'kutkitech', KT_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kutkitech' ),
		'footer'  => __( 'Footer Menu', 'kutkitech' ),
	) );

	set_post_thumbnail_size( 1200, 675, true );
}
add_action( 'after_setup_theme', 'kt_theme_setup' );

/**
 * Enqueue styles & scripts
 */
function kt_scripts() {
	// Google Fonts: Space Grotesk (display/headings), Inter (body), JetBrains Mono (stats/labels)
	wp_enqueue_style( 'kt-fonts', 'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap', array(), null );

	wp_enqueue_style( 'kt-main', KT_THEME_URI . '/assets/css/main.css', array(), KT_THEME_VERSION );
	wp_enqueue_style( 'kutkitech-style', get_stylesheet_uri(), array(), KT_THEME_VERSION );

	wp_enqueue_script( 'kt-main', KT_THEME_URI . '/assets/js/main.js', array(), KT_THEME_VERSION, true );

	wp_localize_script( 'kt-main', 'ktData', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'kt_contact_nonce' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kt_scripts' );

/**
 * Register widget areas (footer columns)
 */
function kt_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Column', 'kutkitech' ),
		'id'            => 'footer-1',
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'kt_widgets_init' );

/**
 * Includes
 */
require KT_THEME_DIR . '/inc/custom-post-types.php';
require KT_THEME_DIR . '/inc/customizer.php';
require KT_THEME_DIR . '/inc/contact-form.php';
require KT_THEME_DIR . '/inc/default-content.php';
require KT_THEME_DIR . '/inc/template-helpers.php';

/**
 * Fallback menu if no menu assigned
 */
function kt_fallback_menu() {
	echo '<ul id="primary-menu" class="nav-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about-us' ) ) . '">About Us</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/services' ) ) . '">Services</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/our-team' ) ) . '">Our Team</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/careers' ) ) . '">Careers</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contact-us' ) ) . '">Contact Us</a></li>';
	echo '</ul>';
}

/**
 * Excerpt length / more
 */
add_filter( 'excerpt_length', function( $length ) { return 24; } );
add_filter( 'excerpt_more', function( $more ) { return '&hellip;'; } );

/**
 * Clean up <head>
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Body classes for styling hooks
 */
add_filter( 'body_class', function( $classes ) {
	if ( is_front_page() ) $classes[] = 'kt-home';
	return $classes;
});
