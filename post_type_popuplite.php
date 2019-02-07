<?php
//adding columns start
add_filter('manage_popup_posts_columns', 'subject_columns_add');

function subject_columns_add($columns) {
    $columns['shortcode'] = 'Short Code';
    return $columns;
}

add_action('manage_popup_posts_custom_column', 'subject_columns');

function subject_columns($name) {
    global $post;
    switch ($name) {
        case 'shortcode':
            echo '[list-posts id="'.$post->ID.'"]';
            break;
    }
}
if (!class_exists('post_type_popup')) {

    /**
     * Pop Up Post Type Class
     */
    class post_type_popup {

        /**
         * The Constructor
         */
        public function __construct() {
            // register actions
            add_action('init', array(&$this, 'popup_init'));
            add_action('admin_init',array(&$this, 'psp_add_role_caps'),999);
        }

        /**
         * hook into WP's init action hook
         */
        public function popup_init() {
            // Initialize Post Type
            $this->popup_register();
        }

        /**
         * Create the Pop Up post type
         */
        public function popup_register() {
            register_post_type('popup', array(
                'labels' => array(
                    'name' => __( 'Pop Up', 'popuplight'),
                    'all_items' => __('All Pop Up', 'popuplight'),
                    'singular_name' => __( 'Pop Up', 'popuplight'),
                    'add_new' => __('Add Pop Up', 'popuplight'),
                    'add_new_item' => __('Add New Pop Up', 'popuplight'),
                    'edit' => __('Edit', 'popuplight'),
                    'edit_item' => __('Edit Pop Up', 'popuplight'),
                    'new_item' => __('New Pop Up', 'popuplight'),
                    'view' => __('View Pop Up', 'popuplight'),
                    'view_item' => __('View Pop Up', 'popuplight'),
                    'search_items' => __('Search Pop Up', 'popuplight'),
                    'not_found' => __('No Pop Up found', 'popuplight'),
                    'not_found_in_trash' => __('No Pop Up found in trash', 'popuplight'),
                    'parent' => __('Parent Pop Up', 'popuplight')
                ),
                'description' => __('This is where you can add new Pop Up.', 'popuplight'),
                'public' => true,
                'show_ui' => true,
                'capability_type' => 'post',
                'map_meta_cap' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'hierarchical' => false,
                'rewrite' => true,'capability_type'     => array('popup','popups'),
                        'map_meta_cap'        => true,
                'query_var' => true,
                'supports' => array('title', 'editor', 'thumbnail','excerpt'),
                'has_archive' => true,
                 'menu_icon'   => 'dashicons-editor-expand',
                    )
            );
        }



  
    function psp_add_role_caps() {

        // Add the roles you'd like to administer the custom post types
        $roles = array('editor','administrator');
        
        // Loop through each role and assign capabilities
        foreach($roles as $the_role) { 

             $role = get_role($the_role);
            
                 $role->add_cap( 'read' );
                 $role->add_cap( 'read_popup');
                 $role->add_cap( 'read_private_popups' );
                 $role->add_cap( 'edit_popup' );
                 $role->add_cap( 'edit_popups' );
                 $role->add_cap( 'edit_others_popups' );
                 $role->add_cap( 'edit_published_popups' );
                 $role->add_cap( 'publish_popups' );
                 $role->add_cap( 'delete_others_popups' );
                 $role->add_cap( 'delete_private_popups' );
                 $role->add_cap( 'delete_published_popups' );
        
        }

    }

   }

    // END class
}

if (class_exists('post_type_popup')) {
    $popup_object = new post_type_popup();
}
