<?php
/*
 * Plugin Name: Newstride Services
 * Description: Add to services section for Newstride
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
if(!defined('NEWSTRIDE_SERVICES_DIR')) define('NEWSTRIDE_SERVICES_DIR', dirname(__FILE__));

 //Require files
require_once NEWSTRIDE_SERVICES_DIR . '/includes/functions.php';
require_once NEWSTRIDE_SERVICES_DIR . '/includes/ServicesWidget.php';

function newstride_services_posttypes()
{
  $labels = array(
    'name'  => 'Services',
    'singular_name' => 'Service',
    'menu_name' => 'Services',
    'name_admin_bar' => 'Services',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Service',
    'new_item' => 'New Services',
    'edit_item' => 'Edit Services',
    'view_item' => 'View Services',
    'all_items' => 'All Services',
    'search_items' => 'Search Services',
    'parent_item_colon' => 'Parent Services',
    'not_found' => 'No services found.',
    'not_found_in_trash' => 'No services found in Trash.',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true, // ?post_type={post_type_key}
    'show_ui' => true, // display user interface
    'show_in_nav_menus' => true, // whether post_type is avialable in navigation menus
    'show_in_menu' => true, // display in top of admin menu
    'menu_position' => 22,
    'menu_icon' => 'dashicons-awards',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'services' ),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'posts_per_page' => -1,
    'supports' => array( 'title', 'editor' )
  );
  register_post_type( 'newstride_services', $args);
}
add_action('init', 'newstride_services_posttypes' );

function newstride_services_flush() {
  // First, we "add" the custom post type via the above written function.
  // Note: "add" is written with quotes, as CPTs don't get added to the DB,
  // They are only referenced in the post_type column with a post entry,
  // when you add a post of this CPT.
  newstride_services_posttypes();

  // ATTENTION: This is *only* done during plugin activation hook in this example!
  // You should *NEVER EVER* do this on every page load!!
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'newstride_services_flush' );
