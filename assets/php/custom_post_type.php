<?php 
add_action( 'init', 'ad_taxonomy' );

function ad_taxonomy() {

    register_taxonomy(
        'add-category',
        'ads',
        array(
            'label' => 'Add Category',
            'rewrite' => array( 'slug' => 'add-category' ),
            'hierarchical' => true,
            'show_admin_column' => true
        )
    );
}


add_action( 'init', 'ad_init', 0 );

function ad_init() {
	$labels = array(
		'name'               => 'Ads',
		'singular_name'      => 'Ad',
		'menu_name'          => 'Ads', 
		'name_admin_bar'     => 'Addm',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Ad', 
		'new_item'           => 'New Ad', 
		'edit_item'          => 'Edit Ad',
		'view_item'          => 'View Ad',
		'all_items'          => 'All Ads', 
		'search_items'       => 'Search Ads',
		'parent_item_colon'  => 'Parent Ads:',
		'not_found'          => 'No Ad sfound.',
		'not_found_in_trash' => 'No Ads found in Trash.',
		
	);

	$args = array(
		'labels'             => $labels,         
		'public'             => true,
		'publicly_queryable' => true,
		
		'query_var'          => true,
		'rewrite'            => array( 'slug' => '/ads' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon' =>   'dashicons-images-alt2',
        'supports'           => array( 'title'),
        'taxonomies'          => array( 'add-category' )
        
	);
	register_post_type( 'ads', $args );
}
?>