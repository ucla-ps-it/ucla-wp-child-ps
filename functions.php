<?php
// Load the Parent and Child Stylesheets
add_action( 'wp_enqueue_scripts', 'ucla_theme_enqueue_styles' );
function ucla_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'ucla-style' ),
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}

add_action( 'after_setup_theme', 'remove_parent_widget_init' );

function remove_parent_widget_init()
{
  remove_action( 'widgets_init', 'ucla_widgets_init' );
  // Add Sidebar widget
  add_action( 'widgets_init', 'ucla_widgets_init_nolist' );
  function ucla_widgets_init_nolist() {
      register_sidebar( array(
        'name' => esc_html__( 'Sidebar Widget Area', 'ucla' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
      ) );
  }
}

add_filter( 'upload_size_limit', 'AOS_increase_upload' );
function AOS_increase_upload( $bytes )
{
	return 26214400; // 1 megabyte
}                // CPT 
/*function custom_post_type_publication()
{
        $labels = array(
                'name' => 'Publications',
                'singular_name' => 'Publication',
                'add_new' => 'Add  Publication',
                'all_items' => 'All Items',
                'add_new_item' => 'Add Item',
                'edit_item' => 'Edit Item',
                'new_item' => 'New Item',
                'view_item' => 'View Item',
                'search_item' => 'Search Portfolio',
                'not_found' => 'No items found',
                'not_found_in_trash' => 'No items found in trash',
                'parent_item_colon' => 'Parent  Item'
        );
        $args = array(
'labels' => $labels,
                'public' => true,
                'has_archive' => true,
		'menu-icon' => 'dashicons-analytics',
		'publicly_queryable' =>  true,
                'query_var' => true,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => true,
                'supports' => array(
                        'title',
                        'editor',
                        'excerpt',
			'revisions',
			'thumbnail',
			'custom-fields',
		),
                //'taxonomies' =>  array('category', 'post_tag'),
                'menu_position' => 5,
                'exclude_from_search' => false
        );
        register_post_type('publication', $args);
}
add_action('init','custom_post_type_publication');
function publications_taxonomy()
{
        $args = array(
                'labels' => array(
                        'name' => 'Years',
                        'singular_name' => 'Year',
                ),
                'public' => true,
                'hierarchical' => true, //acts like a category
        );
        register_taxonomy('years', array('publication'), $args);
}
add_action('init', 'publications_taxonomy');*/

