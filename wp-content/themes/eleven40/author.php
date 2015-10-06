<?php 

/*

 * The template for displaying Author Archive pages. 
 * Displays user profile info & any posts, if the user is an author or contrbutor.
 *
 * @package WordPress
 * @subpackage wpaustin child theme
 * 
 * Extra User fields:
 * Twitter, Facebook, LinkedIn, Business/Site URL, Business/Site name
 * Gist, Pinterest

*/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop','wpatx_do_custom_loop' );
function wpatx_do_custom_loop() { ?>
	<div class="member-profile">
		<?php $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$user_more = $curauth->authormore;
		$user_twitter = $curauth->twitter;
		$user_bizname = $curauth->site_biz_name;
		$user_bizurl = $curauth->site_biz_url;
		$user_fburl = $curauth->facebook_url;
		$user_linkedin = $curauth->linkedin_profile_url; 
		$user_pint = $curauth->pinterest_url;
		$user_gist = $curauth->gist_url; 

		?>
		<?php if ($user_twitter) {
			echo '<img src="https://api.twitter.com/1/users/profile_image/'.$user_twitter.'?size=reasonably_small" width="128" height="128" class="alignleft avatar">';
		} else {
			echo get_avatar($curauth->ID, 128);
		} ?>
			<h1 class="memb_name"><?php __('WP Austin Member'); ?> <?php echo $curauth->first_name.' '.$curauth->last_name; ?></h1>
		<?php //if ( is_user_logged_in() ) { ?>
			<?php if ($user_twitter)  { echo '<h4 class="memb_places">Places you can find ' .$curauth->first_name. '</h4>'; } ?>
			<ul>
				<?php if ($user_bizname)  { echo '<li>' .$curauth->first_name. '\'s website: <a href="'. $user_bizurl .'">'. $user_bizname .'</a></li>'; }?>
				<?php if ($user_twitter)  { echo '<li><a href="http://twitter.com/'. $user_twitter .'">Twitter</a></li>'; }?>
				<?php if ($user_fburl)  { echo '<li><a href="'. $user_fburl .'">Facebook</a></li>'; }?>
				<?php if ($user_linkedin)  { echo '<li><a href="'. $user_linkedin .'">LinkedIn</a></li>'; }?>
				<?php if ($user_gist)  { echo '<li><a href="'. $user_gist .'">Gists</a></li>'; }?>
				<?php if ($user_pint)  { echo '<li><a href="'. $user_pint .'">Pinterest</a></li>'; }?>
			</ul>
			<p class="memb_descr"><?php echo $curauth->description; ?></p>
	</div>
	<?php 
	$member = $curauth->ID; 
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	/** Easter Egg */
	$query_args = array(
		'author' => $member,
		'showposts' => genesis_get_option( 'blog_cat_num' ),
		'paged' => $paged,
	);
	$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) :
		echo '<h2>'. __( 'Posts by ','wpaustin' ) . $curauth->first_name.' '.$curauth->last_name . '</h2>';
		while ( $query->have_posts() ) : $query->the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
		</div> <?php 
		endwhile; 
		else : ?>
		<?php 
		endif;
}


genesis();