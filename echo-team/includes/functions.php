<?php

/**
 * Get all team query
 *
 * @return object
 */
function get_team_members() {
  $args = [
    'post_type' => 'newstride_team',
    'posts_per_page' => -1,
  ];

  return new WP_Query( $args );
}

/**
 * Change title
 *
 * @return string
 */
function newstride_change_team_title( $title ) {
    $screen = get_current_screen();
    return ( 'newstride_team' == $screen->post_type ) ? 'Enter Staff Member' : $title;
}
add_filter( 'enter_title_here', 'newstride_change_team_title' );
