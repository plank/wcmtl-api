<?php
/**
 * Plugin Name: WordCamp Montreal API Demo
 * Plugin URI: https://github.com/plank/wcmtl-api
 * Description: A plugin demoing custom API endpoints.
 * Version: 0.1
 * Author: Christina Garofalo
 * Author URI: https://profiles.wordpress.org/cold-iron-chef/
 *
 * @package wcmtl-api/plugin
 **/

// Add the custom Post type
add_action( 'init', 'wcmtlapi_custom_post_type' );

// Add Taxonomies
add_action( 'init', 'wcmtlapi_taxonomy_colour' );
add_action( 'init', 'wcmtlapi_taxonomy_breed' );
add_action( 'init', 'wcmtlapi_taxonomy_pattern' );

// Load the API
require_once __DIR__ . '/api/_routes.php';
require_once __DIR__ . '/api/cats.php';
require_once __DIR__ . '/api/basic.php';

/**
 * Register Custom Post Type
 *
 * @return void
 */
function wcmtlapi_custom_post_type() {
	register_post_type(
		'wcmtlapi_cat',
		[
			'labels'              => [
				'name'          => __( 'Cats', 'wcmtlapi' ),
				'singular_name' => __( 'Cat', 'wcmtlapi' ),
			],
			'public'              => false,
			'show_ui'             => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'show_in_rest'        => false,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-buddicons-activity',
			'capability_type'     => 'post',
			'rewrite'             => [
				'slug' => 'cats',
			],
			'supports'            => [
				'title',
				'editor',
				'thumbnail',
			],
		]
	);
}

/**
 * Register Custom Taxonomy
 *
 * @return void
 */
function wcmtlapi_taxonomy_breed() {
	register_taxonomy(
		'cat_breed',
		'wcmtlapi_cat',
		[
			'labels'              => [
				'name'          => __( 'Breeds', 'wcmtlapi' ),
				'singular_name' => __( 'Breed', 'wcmtlapi' ),
			],
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => false,
			'exclude_from_search' => true,
			'hierarchical'        => false,
			'rewrite'             => [
				'slug' => 'breed',
			],
		]
	);
}

/**
 * Register Custom Taxonomy
 *
 * @return void
 */
function wcmtlapi_taxonomy_colour() {
	register_taxonomy(
		'cat_colour',
		'wcmtlapi_cat',
		[
			'labels'              => [
				'name'          => __( 'Colours', 'wcmtlapi' ),
				'singular_name' => __( 'Colour', 'wcmtlapi' ),
			],
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => false,
			'exclude_from_search' => true,
			'hierarchical'        => false,
			'rewrite'             => [
				'slug' => 'Colour',
			],
		]
	);
}

/**
 * Register Custom Taxonomy
 *
 * @return void
 */
function wcmtlapi_taxonomy_pattern() {
	register_taxonomy(
		'cat_pattern',
		'wcmtlapi_cat',
		[
			'labels'              => [
				'name'          => __( 'Patterns', 'wcmtlapi' ),
				'singular_name' => __( 'Pattern', 'wcmtlapi' ),
			],
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => false,
			'exclude_from_search' => true,
			'hierarchical'        => false,
			'rewrite'             => [
				'slug' => 'pattern',
			],
		]
	);
}
