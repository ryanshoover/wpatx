<?php

/**
 * Add a "welcome" box above the home content for some intro text
 */
add_action( 'genesis_before_content', 'eleven40_home_welcome_content' );

function eleven40_home_welcome_content() {
	// Only show if we're using the home as the front page
	if( ! is_front_page() ) {
		return false;
	}

	$site_url = get_site_url();


	$tracks = array(
		array(
			'title' => 'Beginners',
			'link'  => $site_url . '/tracks/beginners',
			'image' => THEME_URL . '/images/icon-baby.png',
			),
		array(
			'title' => 'Power Users',
			'link'  => $site_url . '/tracks/power-users',
			'image' => THEME_URL . '/images/icon-muscle.png',
			),
		array(
			'title' => 'Developers',
			'link'  => $site_url . '/tracks/developers',
			'image' => THEME_URL . '/images/icon-code.png',
			),
		array(
			'title' => 'eCommerce',
			'link'  => $site_url . '/tracks/ecommerce',
			'image' => THEME_URL . '/images/icon-barcode.png',
			),
		array(
			'title' => 'San Marcos',
			'link'  => $site_url . '/tracks/san-marcos',
			'image' => THEME_URL . '/images/icon-south.png',
			),
		);

	echo <<<HTML
<div class="welcome-box">
	<div class="wrap">
		<h2>Welcome to the Austin WordPress Meetup Group!</h2>
		<p>We are a large and active group of WordPress enthusiasts in sunny Austin, TX. Our members come from a number of different backgrounds: freelancers, professional developers, designers, and the curious.</p>
		<p>Join us at one of our upcoming meetups! We have five distinct tracks for all levels of users:</p>

		<div class="tracks">
HTML;

	$count = 0;
	foreach ( $tracks as $track ) {
		$count++;
		$first = 1 == $count ? ' first' : '';

		echo <<<HTML
			<div class="one-fifth{$first}">
				<a href="{$track['link']}">
					<img src="{$track['image']}">
					<h3>{$track['title']}</h3>
				</a>
			</div>
HTML;
	}

	echo <<<HTML
		</div>
	</div>
</div>

<h2>News and Updates</h2>
HTML;
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'eleven40_grid_loop_helper' );

/** Add support for Genesis Grid Loop */
function eleven40_grid_loop_helper() {

	echo '<div class="recent-posts">';

	if ( function_exists( 'genesis_grid_loop' ) ) {
		genesis_grid_loop( array(
			'features' => 2,
			'feature_image_size' => 0,
			'feature_image_class' => 'alignleft post-image',
			'feature_content_limit' => 400,
			'grid_image_size'		=> 'grid-thumbnail',
			'grid_image_class'		=> 'alignnone',
			'grid_content_limit' => 250,
			'more' => __( '[Continue reading]', 'genesis' ),
			'posts_per_page' => 5,
		) );
	} else {
		genesis_standard_loop();
	}

	echo '</div>';
}

genesis();