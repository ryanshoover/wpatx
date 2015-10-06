<?php

// we can only use this Widget if the plugin is active
if( class_exists( 'WidgetImageField' ) )
    add_action( 'widgets_init', create_function( '', "register_widget( 'ITI_Widget_Image' );" ) );


class ITI_Widget_Image extends WP_Widget
{
    var $image_field = 'image';  // the image field ID

    function __construct()
    {
        $widget_ops = array(
                'classname'     => 'image_widget',
                'description'   => __( "Image Widget")
            );
        parent::__construct( 'image_widget', __('Image Widget'), $widget_ops );
    }

    function form( $instance )
    {
        $headline   = esc_attr( isset( $instance['headline'] ) ? $instance['headline'] : '' );
        $image_id   = esc_attr( isset( $instance[$this->image_field] ) ? $instance[$this->image_field] : 0 );
        $blurb      = esc_attr( isset( $instance['blurb'] ) ? $instance['blurb'] : '' );

        $image      = new WidgetImageField( $this, $image_id );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php _e( 'Headline:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'headline' ); ?>" name="<?php echo $this->get_field_name( 'headline' ); ?>" type="text" value="<?php echo $headline; ?>" />
                </label>
            </p>
            <div>
                <label><?php _e( 'Image:' ); ?></label>
                <?php echo $image->get_widget_field(); ?>
            </div>
            <p>
                <label for="<?php echo $this->get_field_id( 'blurb' ); ?>"><?php _e( 'Blurb:' ); ?>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'blurb' ); ?>" name="<?php echo $this->get_field_name( 'blurb' ); ?>" type="text" value="<?php echo $blurb; ?>" />
                </label>
            </p>
        <?php
    }

    function widget( $args, $instance )
    {
        extract($args);

        $headline   = $instance['headline'];
        $image_id   = $instance[$this->image_field];
        $blurb      = $instance['blurb'];

        $image      = new WidgetImageField( $this, $image_id );

        echo $before_widget;

        ?>
            <?php if( !empty( $headline ) ) : ?>
                <h5 class="branded"><?php echo $headline; ?></h5>
            <?php endif; ?>
            <?php if( !empty( $image_id ) ) : ?>
                <img src="<?php echo $image->get_image_src( 'thumbnail' ); ?>" width="<?php echo $image->get_image_width( 'thumbnail' ); ?>" height="<?php echo $image->get_image_height( 'thumbnail' ); ?>" />
            <?php endif; ?>
            <?php if( !empty( $blurb ) ) : ?>
                <p><?php echo $blurb; ?></p>
            <?php endif; ?>
        <?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['headline']            = strip_tags( $new_instance['headline'] );
        $instance[$this->image_field]    = intval( strip_tags( $new_instance[$this->image_field] ) );
        $instance['blurb']               = strip_tags( $new_instance['blurb'] );

        return $instance;
    }
}