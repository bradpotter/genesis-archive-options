<?php namespace Genesis_Archive_Options\Admin;

/**
 * Genesis Archive Options
 *
 * @package   Genesis_Archive_Options\Admin
 * @author    Brad Potter
 * @license   GPL-2.0+
 * @link      http://www.bradpotter.com/plugins/genesis-archive-options
 * @copyright Copyright (c) 2015, Brad Potter
 */

add_action( 'admin_init', __NAMESPACE__ . '\\add_archive_options' );
/**
 * Adds archive options to each custom taxonomy edit screen.
 *
 * @since 0.9.0
 *
 * @return null
 */
function add_archive_options() {

	$taxonomies = get_taxonomies( array( 'public' => true ) );

	foreach ( $taxonomies as $tax_name ) {
		add_action( $tax_name . '_edit_form', __NAMESPACE__ . '\\archive_options', 11, 2 );
	}
}

/**
 * Echo fields on the taxonomy term edit form.
 *
 * @since 0.9.0
 *
 * @param $tag
 * @param string    $taxonomy
 * @return null
 */
function archive_options( $tag, $taxonomy ) {

	$tax    = get_taxonomy( $taxonomy );
	$view   = GAO_PLUGIN_DIR . 'lib/views/admin-options.php';

	if ( is_readable( $view ) ) {
		include( $view );
	}
}

add_filter( 'genesis_term_meta_defaults', __NAMESPACE__ . '\\add_term_meta_defaults' );
/**
 * Controls post display on taxonomy archives.
 *
 * @since 0.9.0
 *
 * @param array $term_meta
 * @return array
 */
function add_term_meta_defaults( $term_meta ) {

	$term_meta['gao_post_amount']           = '';
	$term_meta['gao_post_orderby']          = '';
	$term_meta['gao_post_order']            = '';
	$term_meta['gao_post_content_archive']  = '';
	$term_meta['gao_post_content_limit']    = '';
	$term_meta['gao_post_image_include']    = '';
	$term_meta['gao_post_image_size']       = '';
	$term_meta['gao_post_image_align']      = '';

    return $term_meta;
}
