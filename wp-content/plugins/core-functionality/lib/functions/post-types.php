<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      ValentineHR
 * @author       Pat Ramsey <pat@slash25.com>
 * @copyright    Copyright (c) 2012, Pat Ramsey
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'init', 's25_cpt_init' );
/**
 * Create Testimonials post type
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 *
*/
function s25_cpt_init() {
/*	$labels = array(
		'name' => _x('Google Group', 'post type general name'),
		'singular_name' => _x('Google Group', 'post type singular name'),
		'add_new' => _x('Add New', 'Google Group Post'),
		'add_new_item' => __('Add New Google Group Post'),
		'edit_item' => __('Edit Google Group Post'),
		'new_item' => __('New Google Group Post'),
		'all_items' => __('All Google Group Posts'),
		'view_item' => __('View Google Group Post'),
		'search_items' => __('Search Google Group Posts'),
		'not_found' =>  __('No Google Group Posts found'),
		'not_found_in_trash' => __('No Google Group Posts found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Google Group'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 6,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	register_post_type('google_group',$args);*/


}
