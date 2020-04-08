<?php

if ( ! function_exists('uhu_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function uhu_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'uhu' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'uhu' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'uhu' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'uhu' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'uhu' ),
                'add_new_item'       => __( 'Add New Portfolio', 'uhu' ),
                'new_item'           => __( 'New Portfolio', 'uhu' ),
                'edit_item'          => __( 'Edit Portfolio', 'uhu' ),
                'view_item'          => __( 'View Portfolio', 'uhu' ),
                'all_items'          => __( 'All Portfolio', 'uhu' ),
                'search_items'       => __( 'Search Portfolio', 'uhu' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'uhu' ),
                'not_found'          => __( 'No Portfolio found.', 'uhu' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'uhu' )
            ),

            'description'        => __( 'Description.', 'uhu' ),
            'menu_icon'          => 'dashicons-layout',
            'public'             => true,
            'show_in_menu'       => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'supports'           => array( 'title', 'editor', 'thumbnail' )
        ));

        // portfolio taxonomy
        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio Category', 'uhu' ),
                    'add_new_item'      => __( 'Add New Category', 'uhu' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'uhu_custom_post_type' );

}