<?php namespace Genesis_Archive_Options;

/**
 * Genesis Archive Options
 *
 * @package   Genesis_Archive_Options
 * @author    Brad Potter
 * @license   GPL-2.0+
 * @link      http://www.bradpotter.com/plugins/genesis-archive-options
 * @copyright Copyright (c) 2015, Brad Potter
 */

add_action( 'pre_get_posts', __NAMESPACE__ . '\\archive_query', 99 );
/**
 * Control post output on taxonomy archives.
 *
 * @since 0.9.0
 *
 * @param WP_Query  $query
 * @return null
 */
function archive_query( $query ) {
	$term = qualify_pre_get_posts( $query );

	// Bail out if term is not returned.
	if ( false === $term || ! is_object( $term ) ) {
		return;
	}

	// Use Genesis Theme Options plugin settings if Genesis Archive Options
	// plugin settings are not used
	$meta_keys = array(
		'posts_per_page'    => 'gao_post_amount',
		'orderby'           => 'gao_post_orderby',
		'order'             => 'gao_post_order',
	);

	foreach ( $meta_keys as $property => $meta_key ) {

		// Initialize the meta key and value if not present
		$term->meta[ $meta_key ] = array_key_exists( $meta_key, $term->meta )
			? $term->meta[ $meta_key ]
			: '';

		if ( ! $term->meta[ $meta_key ] ) {
			$gto_post_amount            = genesis_get_option( $meta_key );
			$term->meta[ $meta_key ]    = $gto_post_amount ?: '';
		}

		$query->set( $property, $term->meta[ $meta_key ] );
	}
}

add_action( 'pre_get_posts', __NAMESPACE__ . '\\archive_query_content', 100 );
/**
 * Control post content and image display on taxonomy archives.
 *
 * @since 0.9.0
 */
function archive_query_content( $query ) {
	$term = qualify_pre_get_posts( $query );
	// Bail out if term is not returned.
	if ( false === $term || ! is_object( $term ) ) {
		return;
	}

	if ( 'default' !== $term->meta['gao_post_content_archive'] ) {

		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
		remove_action( 'genesis_post_content',  'genesis_do_post_content' );
		add_action( 'genesis_entry_content',    __NAMESPACE__ . '\\do_post_content' );
		add_action( 'genesis_post_content',     __NAMESPACE__ . '\\do_post_content' );
	}

	if ( 'yes' === $term->meta['gao_post_image_include'] ) {

		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		remove_action( 'genesis_post_content',  'genesis_do_post_image' );
		add_action( 'genesis_entry_content',    __NAMESPACE__ . '\\do_post_image', 8 );
		add_action( 'genesis_post_content',     __NAMESPACE__ . '\\do_post_image' );

	} elseif ( 'no' === $term->meta['gao_post_image_include'] ) {

		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		remove_action( 'genesis_post_content',  'genesis_do_post_image' );
	}

	if ( 'default' !== $term->meta['gao_post_image_align'] ) {

		add_filter( 'genesis_attr_entry-image', __NAMESPACE__ . '\\set_attributes_entry_image' );
	}
}

/**
 * Display content on archive pages.
 *
 * @since 0.9.0
 *
 * @return null
 */
function do_post_content() {

	$term = check_conditionals_and_get_term();
	if ( false === $term || ! is_object( $term ) ) {
		return;
	}

	if ( 'excerpts' === $term->meta['gao_post_content_archive'] ) {

		the_excerpt();

	} elseif ( 'full' === $term->meta['gao_post_content_archive'] ) {

		if ( $term->meta['gao_post_content_limit'] ) {

			the_content_limit(
				intval( $term->meta['gao_post_content_limit'] ),
				__( '[Read more...]', 'genesis' )
			);

		} else {

			the_content( __( '[Read more...]', 'genesis' ) );
		}
	}
}

/**
 * Display post image on archive pages.
 *
 * @since 0.9.0
 *
 * @return null
 */
function do_post_image() {

	$term = check_conditionals_and_get_term();
	if ( false === $term || ! is_object( $term ) ) {
		return;
	}

	$img = genesis_get_image( array(
		'format'  => 'html',
		'size'    => $term->meta['gao_post_image_size'],
		'context' => 'archive',
		'attr'    => genesis_parse_attr( 'entry-image' ),
	) );

	if ( ! empty( $img ) ) {
		$view   = GAO_PLUGIN_DIR . 'lib/views/thumbnail.php';

		if ( is_readable( $view ) ) {
			include( $view );
		}
	}
}

/**
 * Determine alignment attributes for entry image element.
 *
 * @since 0.9.0
 *
 * @param array     $attributes
 * @return array    Returns the amended attributes
 */
function set_attributes_entry_image( $attributes ) {

	$term = check_conditionals_and_get_term();
	if ( false === $term ) {
		return $attributes;
	}

	if ( 'default' === $term->meta['gao_post_image_align'] ) {

		return;
	}

	$attributes['itemprop'] = 'image';
	$attributes['class']    =  'post-image entry-image';

	if ( 'alignnone' === $term->meta['gao_post_image_align'] ) {

		$attributes['class'] .=  ' alignnone';

	} elseif ( 'alignleft' === $term->meta['gao_post_image_align'] ) {

		$attributes['class'] .=  ' alignleft';
	} elseif ( 'alignright' === $term->meta['gao_post_image_align'] ) {

		$attributes['class'] .=  ' alignright';
	}

	return $attributes;
}

/**
 * Conditions to determine if pre_get_posts customization should run.
 *
 * @since 0.9.0
 *
 * @param WP_Query  $query
 * @return null
 */
function qualify_pre_get_posts( $query ) {
	if ( ! is_admin() && $query->is_main_query() &&
	     ( is_tax() || is_tag() || is_category() ) &&
	     ( $query->is_tax() || $query->is_tag() || $query->is_category() )
	) {
		global $wp_query;

		return $wp_query->get_queried_object();
	}

	return false;
}

/**
 * Check if this page is a tax, tag, or category.
 * If yes, return the $term; else return false.
 *
 * Refactored to move redundant code into one location
 *
 * @since 0.9.1
 *
 * @return bool
 */
function check_conditionals_and_get_term() {
	global $wp_query;

	return is_tax() || is_tag() || is_category()
		? $wp_query->get_queried_object()
		: false;
}