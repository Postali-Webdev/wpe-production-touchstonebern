<?php
/**
 * Custom Cases Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

// Create cases taxonomy for attorneys and cases post types
function create_custom_post_type_cases() {
// set up labels
    $labels = array(
        'name' => 'Cases',
        'singular_name' => 'Case',
        'add_new' => 'Add New Case',
        'add_new_item' => 'Add New Case',
        'edit_item' => 'Edit Case',
        'new_item' => 'New Case',
        'all_items' => 'All Cases',
        'view_item' => 'View Cases',
        'search_items' => 'Search Cases',
        'not_found' =>  'No Cases Found',
        'not_found_in_trash' => 'No cases found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Cases',

    );
    //register post type
    register_post_type( 'cases', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => false,
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => '/'),
        'rewrite' => array( 'slug' => 'our-cases', 'with_front' => false ), // Has /about/ as pre front for the theme, if there are more then cases to be listed under here this need removed
        )
    );

}
add_action( 'init', 'create_custom_post_type_cases' );