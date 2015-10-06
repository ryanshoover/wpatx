<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package      BE_Genesis_Child
 * @author       Ryan Hoover
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Relies on the CMB2 plugin
 */
add_action( 'cmb2_init', 'rsh_register_videos_metabox' );

/**
 * Generate an array of userid => friendly name
 */
function rsh_get_username_array() {
	$return = array(
		0 => '-- Pick a User --',
		);

	$users = get_users(  );

	foreach( $users as $user ) {
		$return[ $user->ID ] = $user->display_name;
	}

	return $return;
}

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function rsh_register_videos_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'rsh_videos_';

	$status_array = array(
		'unassigned'	=> 'Unassigned',
		'pending'		=> 'Pending',
		'inprocess'		=> 'In Process',
		'complete'		=> 'Complete',
		'problem'		=> 'Problem',
		);

	$users_array = rsh_get_username_array();

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Video Fields', 'cmb2' ),
		'object_types'  => array( 'video', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'       => __( 'Contributor', 'cmb2' ),
		'id'         => $prefix . 'contributor',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Speakers', 'cmb2' ),
		'id'         => $prefix . 'speakers',
		'type'       => 'wysiwyg',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Speaker Title / Company', 'cmb2' ),
		'id'         => $prefix . 'speaker_title',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Speaker Website', 'cmb2' ),
		'id'         => $prefix . 'speaker_website',
		'type'       => 'text_url',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Creator', 'cmb2' ),
		'id'         => $prefix . 'creator',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Description', 'cmb2' ),
		'id'         => $prefix . 'description',
		'type'       => 'wysiwyg',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Publisher', 'cmb2' ),
		'id'         => $prefix . 'publisher',
		'type'       => 'text',
		'default'	 => 'Austin WordPress Meetup',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Rights', 'cmb2' ),
		'id'         => $prefix . 'rights',
		'type'       => 'text',
		'default'	 => 'GPL',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Subject', 'cmb2' ),
		'id'         => $prefix . 'subject',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Date', 'cmb2' ),
		'id'         => $prefix . 'date',
		'type'       => 'text_date',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Frame Size and Aspect Ratio', 'cmb2' ),
		'id'         => $prefix . 'frame_size',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Frame Rate', 'cmb2' ),
		'id'         => $prefix . 'frame_rate',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Link to notes or slides', 'cmb2' ),
		'id'         => $prefix . 'link_notes',
		'type'       => 'text_url',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Scribe', 'cmb2' ),
		'id'         => $prefix . 'scribe',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'YouTube URL', 'cmb2' ),
		'id'         => $prefix . 'youtube',
		'type'       => 'text_url',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Location', 'cmb2' ),
		'id'         => $prefix . 'location',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Sponsors', 'cmb2' ),
		'id'         => $prefix . 'sponsors',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Special Thanks', 'cmb2' ),
		'id'         => $prefix . 'special_thanks',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Post Production Status', 'cmb2' ),
		'id'         => $prefix . 'post_production_status',
		'type'       => 'text',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title Sequence', 'cmb2' ),
		'id'         => $prefix . 'title_sequence',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Title Sequence Editor', 'cmb2' ),
		'id'         => $prefix . 'title_sequence_editor',
		'type'       => 'select',
		'options'	 => $users_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Lower Thirds', 'cmb2' ),
		'id'         => $prefix . 'lower_thirds',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Lower Thirds Editor', 'cmb2' ),
		'id'         => $prefix . 'lower_thirds_editor',
		'type'       => 'select',
		'options'	 => $users_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Credit Roll', 'cmb2' ),
		'id'         => $prefix . 'credit_roll',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Credit Roll Editor', 'cmb2' ),
		'id'         => $prefix . 'credit_roll_editor',
		'type'       => 'select',
		'options'	 => $users_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Trim or Edit List', 'cmb2' ),
		'id'         => $prefix . 'trim_list',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Audio Levels', 'cmb2' ),
		'id'         => $prefix . 'audio_levels',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Render Status', 'cmb2' ),
		'id'         => $prefix . 'credit_roll',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Render Status', 'cmb2' ),
		'id'         => $prefix . 'credit_roll',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Editor', 'cmb2' ),
		'id'         => $prefix . 'editor',
		'type'       => 'select',
		'options'	 => $users_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Uploaded to YouTube', 'cmb2' ),
		'id'         => $prefix . 'youtube_uploaded',
		'type'       => 'select',
		'options'	 => $status_array,
	) );
	$cmb->add_field( array(
		'name'       => __( 'Problems Noted', 'cmb2' ),
		'id'         => $prefix . 'problems_noted',
		'type'       => 'wysiwyg',
	) );
	$cmb->add_field( array(
		'name'       => __( 'Special Notes', 'cmb2' ),
		'id'         => $prefix . 'special_notes',
		'type'       => 'wysiwyg',
	) );
}
