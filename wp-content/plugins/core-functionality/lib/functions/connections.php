<?php

add_action( 'wp_loaded', 'my_posts_to_pages' );
function my_posts_to_pages() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'post',
		'to' => 'page'
	) );

	p2p_register_connection_type( array(
		'name' => 'posts_to_posts',
	) );

}
