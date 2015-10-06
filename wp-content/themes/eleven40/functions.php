<?php
/**
 * Functions
 *
 * @package      s25_Genesis_Child Invodo
 * @since        1.0.0
 * @link         https://slash25.com
 * @author       Pat Ramsey <pat@slash25.com>
 * @copyright    Copyright (c) 2012, Pat Ramsey
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {

	// ** Backend **

	include_once( get_stylesheet_directory() . '/lib/functions/member-list.php');


	/** Add new image sizes */
	add_image_size( 'grid-thumbnail', 270, 100, TRUE );

	add_action( 'admin_menu', 'crm_change_post_menu_label' );

	/** Add footer widgets */
	add_theme_support( 'genesis-footer-widgets', 1 );

	/** Register widget areas */
	genesis_register_sidebar( array(
		'id'			=> 'page-title',
		'name'			=> __( 'Page Title', 'eleven40' ),
		'description'	=> __( 'This is the page title section.', 'eleven40' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'after-post',
		'name'			=> __( 'After Post', 'eleven40' ),
		'description'	=> __( 'This is the after post section.', 'eleven40' ),
	) );

	add_filter( 'user_contactmethods', 'be_contactmethods' );
	remove_action( 'show_user_profile', 'genesis_user_options_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
	remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
	remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
	remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );

	// Add extra fields to member profiles
	add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
	add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

	add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

	// Setup Theme Settings
	include_once( CHILD_DIR . '/lib/functions/child-theme-settings.php' );


	// ** Front-End **
	/** Add support for structural wraps */
	add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

	// Change rewrite base for authors to member
	add_action('init', 'new_author_base');

	/** Add Viewport meta tag for mobile browsers */
	add_action( 'genesis_meta', 'eleven40_viewport_meta_tag' );

	/** Add the page title section */
	add_action( 'genesis_before_content_sidebar_wrap', 'eleven40_page_title' );

	/** Add the after post section */
	add_action( 'genesis_after_post_content', 'eleven40_after_post' );

	// Customize Footer
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 's25_footer' );

	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
	add_action( 'genesis_after_footer', 'genesis_footer_widget_areas' );


}


function eleven40_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

function eleven40_page_title() {
   genesis_widget_area( 'page-title', array(
       'before' => '<div class="page-title widget-area">',
       'after' => '</div>'
   ) );
}


function eleven40_after_post() {
   if ( ! is_singular( 'post' ) )
       return;
   genesis_widget_area( 'after-post', array(
       'before' => '<div class="after-post widget-area">',
       'after' => '</div>'
   ) );
}


function crm_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Blog';
	echo '';
}




function new_author_base() {
    global $wp_rewrite;
    $author_slug = 'member';
    $wp_rewrite->author_base = $author_slug;
}


/**
 * Customize Contact Methods
 * @since 1.0.0
 *
 * @author Bill Erickson
 * @link http://sillybean.net/2010/01/creating-a-user-directory-part-1-changing-user-contact-fields/
 *
 * @param array $contactmethods
 * @return array
 */
function be_contactmethods( $contactmethods ) {
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );

	return $contactmethods;
}

function my_show_extra_profile_fields( $user ) { ?>
	<h3>Aditional Member Information</h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter">Twitter username</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
		<tr>
			<th><label for="site_biz_name">Website / Business Name</label></th>
			<td>
				<input type="text" name="site_biz_name" id="site_biz_name" value="<?php echo esc_attr( get_the_author_meta( 'site_biz_name', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
		<tr>
			<th><label for="site_biz_url">URL for Website / Business Name</label></th>
			<td>
				<input type="text" name="site_biz_url" id="site_biz_url" value="<?php echo esc_attr( get_the_author_meta( 'site_biz_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook_url">Facebook Page</label></th>
			<td>
				<input type="text" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin_profile_url">LinkedIn Profile</label></th>
			<td>
				<input type="text" name="linkedin_profile_url" id="linkedin_profile_url" value="<?php echo esc_attr( get_the_author_meta( 'linkedin_profile_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
		<tr>
			<th><label for="gist_url">Gists URL</label></th>
			<td>
				<input type="text" name="gist_url" id="gist_url" value="<?php echo esc_attr( get_the_author_meta( 'gist_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">If you have a Gist page on Github, paste the URL here</span>
			</td>
		</tr>
		<tr>
			<th><label for="pinterest_url">Pinterest Page</label></th>
			<td>
				<input type="text" name="pinterest_url" id="pinterest_url" value="<?php echo esc_attr( get_the_author_meta( 'pinterest_url', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
<?php /*		<tr>
			<td colspan="2">
				<label for="authormore">Member Description</label><br />
				<textarea name="authormore" id="authormore" rows="5" cols="30"><?php echo get_the_author_meta ( 'authormore', $user->ID ); ?></textarea>
			</td>
		</tr>
*/ ?>	</table>

<?php }
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
//	update_usermeta( $user_id, 'authormore', $_POST['authormore'] );
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'site_biz_name', $_POST['site_biz_name'] );
	update_usermeta( $user_id, 'site_biz_url', $_POST['site_biz_url'] );
	update_usermeta( $user_id, 'facebook_url', $_POST['facebook_url'] );
	update_usermeta( $user_id, 'linkedin_profile_url', $_POST['linkedin_profile_url'] );
	update_usermeta( $user_id, 'gist_url', $_POST['gist_url'] );
	update_usermeta( $user_id, 'pinterest_url', $_POST['linkedin_profile_url'] );
}

/**
 * Custom Genesis Child Theme Footer
 *
 * @author Pat Ramsey
 * @link http://slash25.com/
 */
function s25_footer() {
	echo '<div class="footer-wrap"><div class="footer-extra">';
		echo '<div class="one-half first" id="footer-left">' . wpautop( genesis_get_option( 'footer-left', 'child-settings' ) ) . '</div>';
		echo '<div class="one-half" id="footer-right">' . wpautop( genesis_get_option( 'footer-right', 'child-settings' ) ) . '</div>';
	echo '</div></div>';
}

