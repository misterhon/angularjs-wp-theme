<?php
/**
 * WPA Mk.01 functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage wpa_thm_mk01
 * @since wpa_thm_mk01 1.0
 */

/**
 * ----------------------------------------------------------------------------------------
 * Define constants
 * ----------------------------------------------------------------------------------------
 */
 
	define( 'THEMEROOT', get_stylesheet_directory_uri() );
	define( 'STYLES', THEMEROOT . '/css' );
	define( 'IMAGES', THEMEROOT . '/img' );
	define( 'SCRIPTS', THEMEROOT . '/js' );
	define( 'PARTIALS', THEMEROOT . '/partials' );

/**
 * ----------------------------------------------------------------------------------------
 * WordPress Action Hooks
 * ----------------------------------------------------------------------------------------
 */
 
	if ( ! function_exists( 'wpa_scripts' ) ) {
	
		function wpa_scripts() {
			
			$in_footer = true;
			$not_in_footer = false;
			
			wp_register_script( 'angularjs', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js', false, '1.3.15',  $not_in_footer );
			wp_register_script( 'angularjs-route', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.min.js', array('angularjs'), '1.3.15', $not_in_footer );
			wp_register_script( 'angularjs-sanitize', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-sanitize.min.js', array('angularjs'), '1.3.15', $not_in_footer );
			wp_register_script( 'wpa',  SCRIPTS . '/app.js', array('angularjs', 'angularjs-route', 'angularjs-sanitize'), '1.0', $not_in_footer );
			
			wp_enqueue_style( 'wpa', get_stylesheet_uri() );
			wp_enqueue_script('wpa');
			
			wp_localize_script( 'wpa', 'localized', array( 'partials' => trailingslashit( PARTIALS ) ) );
	
		}
		
		add_action( 'wp_enqueue_scripts', 'wpa_scripts' );
		
	}