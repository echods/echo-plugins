<?php

/**
 * Get all revews query
 *
 * @return object
 */
function get_newstride_reviews() {

    $reviews = new stdClass();
    $reviews->collect = [];

    $args = [
        'post_type' => 'newstride_reviews',
        'posts_per_page' => 3,
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $reviews->collect[] =
            [
                'title'         => get_the_title(),
                'description'   => get_the_content()
            ];

        }

        wp_reset_postdata();
    }
    return $reviews;
}

/**
 * Change title
 *
 * @return string
 */
function newstride_change_review_title( $title ) {
    $screen = get_current_screen();
    return ( 'newstride_reviews' == $screen->post_type ) ? 'Enter Person Name' : $title;
}
add_filter( 'enter_title_here', 'newstride_change_review_title' );
