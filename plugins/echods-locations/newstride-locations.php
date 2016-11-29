<?php
/*
 * Plugin Name: Newstride Locations
 * Description: Add locations for Newstride
 * Version: 1.0.0
 * Author: Isaac Castillo
 * License: GPL2

/*  Copyright 2016 Isaac Castillo  (email : isaac@echods.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!defined('NEWSTRIDE_LOCATIONS_DIR')) define('NEWSTRIDE_LOCATIONS_DIR', dirname(__FILE__));

 //Require files
require_once NEWSTRIDE_LOCATIONS_DIR . '/includes/functions.php';

function newstride_locations_posttypes()
{
  $labels = array(
    'name'  => 'Locations',
    'singular_name' => 'Location',
    'menu_name' => 'Locations',
    'name_admin_bar' => 'Locations',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Location',
    'new_item' => 'New Location',
    'edit_item' => 'Edit Location',
    'view_item' => 'View Location',
    'all_items' => 'All Locations',
    'search_items' => 'Search Location',
    'parent_item_colon' => 'Parent Location',
    'not_found' => 'No locations found.',
    'not_found_in_trash' => 'No locations found in Trash.',
  );

  $args = array(
    'labels' => $labels,
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => true, // ?post_type={post_type_key}
    'show_ui' => true, // display user interface
    'show_in_nav_menus' => false, // whether post_type is avialable in navigation menus
    'show_in_menu' => true, // display in top of admin menu
    'menu_position' => 20,
    'menu_icon' => 'dashicons-location-alt',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'locations' ),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'posts_per_page' => -1,
    'supports' => array( 'title', 'editor' )
  );
  register_post_type( 'newstride_locations', $args);
}
add_action('init', 'newstride_locations_posttypes' );

function newstride_locations_flush() {
  // First, we "add" the custom post type via the above written function.
  // Note: "add" is written with quotes, as CPTs don't get added to the DB,
  // They are only referenced in the post_type column with a post entry,
  // when you add a post of this CPT.
  newstride_locations_posttypes();

  // ATTENTION: This is *only* done during plugin activation hook in this example!
  // You should *NEVER EVER* do this on every page load!!
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'newstride_locations_flush' );
