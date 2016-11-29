<?php

/**
 ** Adds Foo_Widget widget.
 **/
class ServicesWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'services_widget', // Base ID
            'Services Widget', // Name
            array('description' => __( 'Displays all services'))
        );
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance) {
        if( $instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'services_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        $this->listServices();

        echo $after_widget;
    }

    protected function listServices()
    {
        $services = get_services();

        echo '<ul class="services-widget">';

        while($services->have_posts()) {
            $services->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
        wp_reset_postdata();
        return $output;
    }


}

// register Foo_Widget widget
function register_services() {
    register_widget( 'ServicesWidget' );
}
add_action( 'widgets_init', 'register_services' );
