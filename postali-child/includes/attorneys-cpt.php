<?php
/**
 * Custom Attorneys Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

function create_custom_post_type_attorneys() {

// set up labels
    $labels = array(
        'name' => 'Attorneys',
        'singular_name' => 'Attorney',
        'add_new' => 'Add New Attorney',
        'add_new_item' => 'Add New Attorney',
        'edit_item' => 'Edit Attorney',
        'new_item' => 'New Attorney',
        'all_items' => 'All Attorneys',
        'view_item' => 'View Attorneys',
        'search_items' => 'Search Attorneys',
        'not_found' =>  'No Attorneys Found',
        'not_found_in_trash' => 'No Attorneys found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Attorneys',

    );
    //register post type
    register_post_type( 'Attorneys', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => false,
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => '/'),
        'rewrite' => array( 'slug' => 'our-attorneys', 'with_front' => false ), // Has /about/ as pre front for the theme, if there are more then attorneys to be listed under here this need removed
        )
    );

}
add_action( 'init', 'create_custom_post_type_attorneys' );

// Register Occupation Taxonomy
function attorney_occupation() {

	$labels = array(
		'name'                       => _x( 'Occupation', 'Occupations' ),
		'singular_name'              => _x( 'Occupation', 'Occupation' ),
		'menu_name'                  => __( 'Occupations' ),
		'all_items'                  => __( 'All Occupations' ),
		'new_item_name'              => __( 'New Occupation' ),
		'add_new_item'               => __( 'Add Occupation' ),
		'edit_item'                  => __( 'Edit Occupation' ),
		'update_item'                => __( 'Update Occupation' ),
		'view_item'                  => __( 'View Occupation' ),
		'separate_items_with_commas' => __( 'Separate Occupations with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Occupations' ),
		'popular_items'              => __( 'Popular Occupations' ),
		'search_items'               => __( 'Search Occupations' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Occupations' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'attorney_occupation', array( 'attorneys' ), $args );

}
add_action( 'init', 'attorney_occupation', 0 );
