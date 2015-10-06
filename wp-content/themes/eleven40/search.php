<?php 
/*
search results
*/

?>


<?php 

/*global $post;
var_export ($post);
var_export ($post->link);
var_export ($post->post_type);
*/
add_filter ( 'genesis_post_title_output','wpatx_user_title' );
function wpatx_user_title ($title) {
	global $post;
	if ( 'user' == $post->post_type) {
		$title = '<h2 class="entry-title"><a href="'.$post->link.'">'.get_the_title().'</a></h2>';
		return $title;
	} else {
		$title = '<h2 class="entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
		return $title;
	}
}

genesis();
