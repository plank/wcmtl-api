<?php
/**
 * API for the plugin
 *
 * @package wcmtlapi/plugin
 */

namespace WCMTLAPI\plugin\API;

add_action( 'rest_api_init', __NAMESPACE__ . '\\register_routes' );

/**
 * Register the routes for the plugin.
 *
 * @return void
 */
function register_routes() {
	$version   = '1';
	$namespace = 'wcmtl/v' . $version;

	// Register Routes

	// wp-json/wcmtl/v1/cats
	register_rest_route(
		$namespace,
		'/cats',
		[
			'methods'             => 'GET',
			'callback'            => __NAMESPACE__ . '\\get_cats',
			'permission_callback' => '__return_true',
		]
	);

	// wp-json/wcmtl/v1/basic
	register_rest_route(
		$namespace,
		'/basic',
		[
			'methods'             => 'GET',
			'callback'            => __NAMESPACE__ . '\\get_basic',
			'permission_callback' => '__return_true',
		]
	);

	// wp-json/wcmtl/v1/secrets
	// Authenticate with Application Passwords
	// https://make.wordpress.org/core/2020/11/05/application-passwords-integration-guide/
	register_rest_route(
		$namespace,
		'/secrets',
		[
			'methods'             => 'GET',
			'callback'            => __NAMESPACE__ . '\\get_secrets',
			'permission_callback' => function () {
				return current_user_can( 'update_plugins' );
			},
		]
	);
}
