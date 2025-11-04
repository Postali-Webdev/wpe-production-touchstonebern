<?php
/**
 * Custom Job Listings Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

// Create Job Listings taxonomy for attorneys and Job Listings post types
function create_custom_post_type_jobs() {
// set up labels
    $labels = array(
        'name' => 'Job Listings',
        'singular_name' => 'Job Listing',
        'add_new' => 'Add New Job Listing',
        'add_new_item' => 'Add New Job Listing',
        'edit_item' => 'Edit Job Listing',
        'new_item' => 'New Job Listing',
        'all_items' => 'All Job Listings',
        'view_item' => 'View Job Listings',
        'search_items' => 'Search Job Listings',
        'not_found' =>  'No Job Listings Found',
        'not_found_in_trash' => 'No Job Listings found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Job Listings',

    );
    //register post type
    register_post_type( 'Job Listings', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-networking',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'careers/job-listings', 'with_front' => false ), 
        )
    );

}
add_action( 'init', 'create_custom_post_type_jobs' );