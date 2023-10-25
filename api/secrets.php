<?php
/**
 * The Top Secret Data for the API
 *
 * @package wcmtl-api/plugin
 */

namespace WCMTLAPI\plugin\API;

/**
 * Callback for the basic endpoint
 *
 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
 */
function get_secrets() {

	$data = [
		'secrets' => [
			[
				'name'        => 'Area 51',
				'description' => 'Aliens are real!',
			],
			[
				'name'        => 'JFK\'s Assassination',
				'description' => 'It was the CIA!',
			],
			[
				'name'        => 'The Moon Landing',
				'description' => 'It was faked!',
			],
			[
				'name'        => 'The Illuminati',
				'description' => 'They control everything!',
			],
		],
	];

	return rest_ensure_response( $data );
}
