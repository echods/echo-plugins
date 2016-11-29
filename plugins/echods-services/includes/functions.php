<?php

/**
 * Get all services query
 *
 * @return object
 */
function get_services() {
  $args = [
    'post_type' => 'newstride_services',
    'posts_per_page' => -1,
  ];

  return new WP_Query( $args );
}

/**
 * Change title
 *
 * @return string
 */
function newstride_change_services_title( $title ) {
    $screen = get_current_screen();
    return ( 'newstride_services' == $screen->post_type ) ? 'Enter Service' : $title;
}
add_filter( 'enter_title_here', 'newstride_change_services_title' );
