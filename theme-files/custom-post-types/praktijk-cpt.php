<?php
/**
 * Custom Post Type for praktijk
 */

add_action('init', 'create_praktijk_post_type' );

/**
 * Create & register the custom post type.
 */

function create_praktijk_post_type() {
    $labels = array(
    'name'               => 'De praktijk',
    'singular_name'      => 'De praktijk',
    'add_new'            => 'Add New', 'Praktijk post',
    'add_new_item'       => 'Add New Praktijk post',
    'edit_item'          => 'Edit Praktijk post',
    'new_item'           => 'New Praktijk post',
    'all_items'          => 'All Praktijk posts',
    'view_item'          => 'View Praktijk post',
    'search_items'       => 'Search Praktijk posts',
    'not_found'          => 'No Praktijk posts found',
    'not_found_in_trash' => 'No Praktijk posts found in the Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'De praktijk'
    );
    $args = array(
    'labels'                => $labels,
    'public'                => true,
    'menu_position'         => 6,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'           => false,
    //        'register_meta_box_cb'  => 'add_meta_boxes',
    'taxonomies'            => array('category')
    );
    register_post_type( 'praktijk', $args);
}