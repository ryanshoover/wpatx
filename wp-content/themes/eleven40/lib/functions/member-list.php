<?php 

add_action( 'widgets_init', 'WP_Member_WidgetReg' );

// Registers the widget
function WP_Member_WidgetReg() {
	register_widget( 'WP_Member_Widget' );
}

class WP_Member_Widget extends WP_Widget {	
    /**
     * Constructor
     *
     * @return void
     **/
	function WP_Member_Widget() {
		$widget_ops = array( 'classname' => 'wpatx_member_widget', 'description' => 'WordPress Austin Member List Widget' );
		$this->WP_Widget( 'wpatx_member_widget', 'WordPress Austin Member List Widget', $widget_ops );
	}

	function save_settings( $settings ) {
		$settings['_multiwidget'] = 0;
		update_option( $this->option_name, $settings );
	}

	function widget( $args, $instance ) {
		$qargs  = array(
			'orderby' => 'display_name',
			'exclude' => 1
		);
		extract( $args );
		$instance = wp_parse_args( (array) $instance, array('title' => __('Our Members', 'wpaustin' ) ) );

		echo $before_widget;
        $title = apply_filters('widget_title', $instance['title'] );

		//var_export($title);
 		if ( !empty($instance['title']) )
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

		$wp_user_query = new WP_User_Query($qargs);
		$authors = $wp_user_query->get_results();
		if (!empty($authors)) {
			echo '<ul class="members-list">';
				foreach ($authors as $author) {
					$user_last = get_user_meta($author->ID, 'last_name', true );
					if ($user_last) {
						$author_info = get_userdata($author->ID);
						$user_twitter = $author_info->twitter; 
						?>
						<li>
							<a href="/member/<?php echo $author_info->user_login?>" title="<?php echo $author_info->first_name.' '.$author_info->last_name; ?>">
							<?php 
							if ($user_twitter) {
								echo '<img class="avatar" src="https://api.twitter.com/1/users/profile_image/'.$user_twitter.'?size=normal" width="48" height="48">';
							} else {
								echo get_avatar($author->ID, 48);
							} 
							?>
							</a>
						</li> 
						<?php
					}
				}
			echo '</ul>';
		} else {
			echo 'No authors found';
		}
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$new_instance['title'] = strip_tags( $new_instance['title'] );
		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array('title' => __('Our Members', 'wpaustin' ) ) ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
	<?php 
	}
}
