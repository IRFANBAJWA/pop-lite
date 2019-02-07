<?php
if( !function_exists('wpac_plugin_scripts')) {
    function wpac_plugin_scripts() {
        $user_id = get_current_user_id();
        //Plugin Frontend CSS
        wp_enqueue_style('wpac-css', plugin_dir_url( __FILE__ ) . 'custom-css.css');

        //FontAwesome CSS
     /*  wp_enqueue_style( 'wpac-font-awesome', plugin_dir_url. 'assets/font-awesome/css/fontawesome-all.min.css', array(), NULL);*/

        //Plugin Ajax JS
        wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ) . 'custom.js', true );

    }
    add_action('wp_enqueue_scripts', 'wpac_plugin_scripts');

}