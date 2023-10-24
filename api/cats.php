<?php
/**
 * The Cats Data for the API
 *
 * @package wcmtl-api/plugin
 */

namespace WCMTLAPI\plugin\API;

/**
 * @param object $request Additional parameters passed to the endpoint.
 *
 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
 */
function get_cats( object $request ) {

	// Setup the query arguments.
	$query    = $request['q'];
	$colours  = $request['colours'];
	$breeds   = $request['breeds'];
	$patterns = $request['patterns'];
	$page     = $request['page'] ?? 1;

	// Build the query.
	$posts_per_page = 12;
	$status         = 'publish';

	$args = [
		'post_type'      => 'wcmtlapi_cat',
		'posts_per_page' => $posts_per_page,
		'post_status'    => $status,
		'paged'          => $page,
	];

	// If there's a search term, search for it.
	if ( $query ) {
		$args['s'] = sanitize_text_field( $query );
	}

	// If filters are specified, build taxonomy query
	if ( $breeds || $colours || $patterns ) {
		$args['tax_query'] = [
			'relation' => 'AND',
		];
	}

	if ( $breeds ) {
		$breed_query =
			[
				'taxonomy'         => 'cat_breed',
				'field'            => 'slug',
				'operator'         => 'AND',
				'include_children' => false,
				'terms'            => explode( ',', $breeds ),
			];

		$args['tax_query'][] = $breed_query;
	}

	if ( $colours ) {
		$colour_query =
			[
				'taxonomy'         => 'cat_colour',
				'field'            => 'slug',
				'operator'         => 'AND',
				'include_children' => false,
				'terms'            => explode( ',', $colours ),
			];

		$args['tax_query'][] = $colour_query;
	}

	if ( $patterns ) {
		$pattern_query =
			[
				'taxonomy'         => 'cat_pattern',
				'field'            => 'slug',
				'operator'         => 'AND',
				'include_children' => false,
				'terms'            => explode( ',', $patterns ),
			];

		$args['tax_query'][] = $pattern_query;
	}

	$cats = new \WP_Query( $args ); // WordPress Query Object
	$data = null; // Setup data array

	if ( $cats->have_posts() ) {
		// Needed to build paginated results
		$data['postCount'] = $cats->found_posts;

		while ( $cats->have_posts() ) {
			$cats->the_post();

			// Prepare the data for the endpoint
			$breed_taxonomies = wp_get_object_terms( get_the_ID(), [ 'cat_breed' ] );
			$breeds           = [];
			foreach ( $breed_taxonomies as $breed_taxonomy ) {
				$breeds[] = [
					'slug' => esc_html( $breed_taxonomy->slug ),
					'name' => esc_html( $breed_taxonomy->name ),
				];
			}

			$colour_taxonomies = wp_get_object_terms( get_the_ID(), [ 'cat_colour' ] );
			$colours           = [];
			foreach ( $colour_taxonomies as $colour_taxonomy ) {
				$colours[] = [
					'slug' => esc_html( $colour_taxonomy->slug ),
					'name' => esc_html( $colour_taxonomy->name ),
				];
			}

			$pattern_taxonomies = wp_get_object_terms( get_the_ID(), [ 'cat_pattern' ] );
			$patterns           = [];
			foreach ( $pattern_taxonomies as $pattern_taxonomy ) {
				$patterns[] = [
					'slug' => esc_html( $pattern_taxonomy->slug ),
					'name' => esc_html( $pattern_taxonomy->name ),
				];
			}

			$featured_image_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : '';

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$alt_text     = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
			}
			$alt_text = $alt_text ?? '';

			// Build your data how you want it
			$data['cats'][] = [
				'id'       => (int) get_the_ID(),
				'title'    => esc_html( html_entity_decode( wp_strip_all_tags( get_the_title() ) ) ),
				'excerpt'  => get_the_excerpt(),
				'image'    => esc_url( $featured_image_url ),
				'alt_text' => esc_html( $alt_text ),
				'breeds'   => $breeds,
				'colours'  => $colours,
				'patterns' => $patterns,
			];
		}
	}

	// Throw an error if no cats are found.
	if ( empty( $data ) ) {
		return new \WP_Error(
			'no_cats_found',
			'No cats found',
			[ 'status' => 200 ]
		);
	}

	return rest_ensure_response( $data );
}
