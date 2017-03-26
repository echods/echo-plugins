<?php
/*
 * Plugin Name: Newstride Team
 * Description: Add team members for Newstride
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
if(!defined('NEWSTRIDE_TEAM_DIR')) define('NEWSTRIDE_TEAM_DIR', dirname(__FILE__));

 //Require files
require_once NEWSTRIDE_TEAM_DIR . '/includes/functions.php';

function newstride_team_posttypes()
{
  $labels = array(
    'name'  => 'Team',
    'singular_name' => 'Team',
    'menu_name' => 'Team Members',
    'name_admin_bar' => 'Team',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Team Member',
    'new_item' => 'New Member',
    'edit_item' => 'Edit Member',
    'view_item' => 'View Member',
    'all_items' => 'All Team',
    'search_items' => 'Search Team',
    'parent_item_colon' => 'Parent Team',
    'not_found' => 'No team members found.',
    'not_found_in_trash' => 'No members found in Trash.',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true, // ?post_type={post_type_key}
    'show_ui' => true, // display user interface
    'show_in_nav_menus' => false, // whether post_type is avialable in navigation menus
    'show_in_menu' => true, // display in top of admin menu
    'menu_position' => 23,
    'menu_icon' => 'dashicons-groups',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'team' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'posts_per_page' => -1,
    'supports' => array( 'title', 'editor' )
  );
  register_post_type( 'newstride_team', $args);
}
add_action('init', 'newstride_team_posttypes' );

function newstride_team_flush() {
  // First, we "add" the custom post type via the above written function.
  // Note: "add" is written with quotes, as CPTs don't get added to the DB,
  // They are only referenced in the post_type column with a post entry,
  // when you add a post of this CPT.
  newstride_team_posttypes();

  // ATTENTION: This is *only* done during plugin activation hook in this example!
  // You should *NEVER EVER* do this on every page load!!
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'newstride_team_flush' );
