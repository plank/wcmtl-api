<?php
/**
 * The Basic Cats Data for the API
 *
 * @package wcmtl-api/plugin
 */

namespace WCMTLAPI\plugin\API;

/**
 * Callback for the basic endpoint
 *
 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
 */
function get_basic() {

	$data = [
		'cats' => [
			[
				'name'    => 'Pekoe',
				'colour'  => 'orange',
				'breed'   => 'domestic shorthair',
				'pattern' => 'tabby',
			],
			[
				'name'    => 'Milo',
				'colour'  => 'grey',
				'breed'   => 'domestic shorthair',
				'pattern' => 'solid',
			],
			[
				'name'    => 'Poppy',
				'colour'  => 'cream',
				'breed'   => 'siamese',
				'pattern' => 'pointed',
			],
		],
	];

	return rest_ensure_response( $data );
}
