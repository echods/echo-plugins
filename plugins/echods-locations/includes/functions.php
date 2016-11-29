<?php

/**
 * Get all locations query
 *
 * @return object
 */
function get_newstride_locations() {

    $locations = new stdClass();
    $locations->collect = [];

    $args = [
        'post_type' => 'newstride_locations',
        'posts_per_page' => -1,
    ];

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $locations->collect[] =
            [
                'title'         => get_the_title(),
                'description'   => get_the_content(),
                'address'       => get_field('location_address'),
                'city'          => get_field('location_city'),
                'state'         => get_field('location_state'),
                'zip'           => get_field('location_zip'),
                'phone'         => get_field('location_phone'),
                'fax'           => get_field('location_fax'),
                'map'           => get_field('location_map')
            ];

        }

        wp_reset_postdata();
    }
    return $locations;
}

/**
 * Change title
 *
 * @return string
 */
function newstride_change_location_title( $title ) {
    $screen = get_current_screen();
    return ( 'newstride_locations' == $screen->post_type ) ? 'Enter Location Name' : $title;
}
add_filter( 'enter_title_here', 'newstride_change_location_title' );
