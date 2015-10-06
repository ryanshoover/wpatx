<?php
/**
 * Template for single video posts
 */

add_action( 'genesis_post_content', 'rsh_show_video_meta' );

function rsh_show_video_meta() {

	$has_options = array( 'select', 'radio', 'checkbox' );

	$prefix = 'rsh_videos_';
	$fields_to_show = array(
		$prefix . 'contributor',
		$prefix . 'speakers',
		$prefix . 'speaker_title',
		$prefix . 'speaker_website',
		$prefix . 'creator',
		$prefix . 'description',
		$prefix . 'publisher',
		$prefix . 'rights',
		$prefix . 'subject',
		$prefix . 'title',
		$prefix . 'date',
		$prefix . 'link_notes',
		$prefix . 'scribe',
		$prefix . 'youtube',
		);

	$not_logged_in = ! is_user_logged_in();

	$meta = get_post_meta( get_the_ID() );

	$object_id = get_the_ID();
	$video_meta_box = 'rsh_videos_metabox';

	$form = cmb2_get_metabox( $video_meta_box, $object_id );

	echo '<h2>Video Meta</h2>';

	foreach( $meta as $key=>$values ) {

		if( $not_logged_in && ! in_array( $key, $fields_to_show ) ) {
			continue;
		}

		if( 0 !== strpos( $key, $prefix ) || empty( $values ) ) {
			continue;
		}

		$field = $form->meta_box['fields'][ $key ];

		echo '<h3 class="label">' . $field['name'] . '</h3>';

		$values = (array) $values;

		foreach( $values as $value ) {

			if( in_array( $field['type'], $has_options ) ) {
				$value = $field['options'][ $value ];
			}

			if( 'text_url' == $field['type'] && $prefix . 'youtube' != $key ) {
				$value = '<a href="' . $value . '">' . $value . '</a>';
			}

			echo '<div class="value">' . apply_filters( 'the_content', $value ) . '</div>';
		}
	}
}

add_action( 'genesis_post_content', 'rsh_maybe_add_edit_button', 100 );

function rsh_maybe_add_edit_button() {
	if ( ! is_user_logged_in() || ( isset( $_GET['edit'] ) && $_GET['edit'] ) ) {
		return false;
	}

	echo '<a href="' . get_permalink() . '?edit=1">Edit this video</a>';
}

add_action( 'get_header', 'rsh_maybe_show_edit_form' );

function rsh_maybe_show_edit_form() {
	if( ! isset( $_GET['edit'] ) || ! $_GET['edit'] || ! is_user_logged_in() ) {
		return false;
	}

	wp_enqueue_style( 'cmb2', site_url() . '/wp-content/plugins/cmb2/css/cmb2-front.css' );

	remove_action( 'genesis_post_content', 'rsh_show_video_meta' );
	remove_action( 'genesis_post_content', 'genesis_do_post_content' );

	add_action( 'genesis_post_content', 'rsh_show_edit_form', 1 );
}

function rsh_show_edit_form() {

	$video_meta_box = 'rsh_videos_metabox';

	cmb2_print_metabox_form( $video_meta_box );
}

genesis();