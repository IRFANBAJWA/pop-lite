<?php
/**
 * Plugin Name: Pop up lite
 * Plugin URI: #
 * Description: 
 * Version: 1.0.0
 * Author: Irfan 
 * Author URI: #
 * License: A short license name. Example: GPL2
 */
if(!class_exists('popuplite'))
{
    class popuplite
    {
	public $plugin_url;
        /**
         * Construct
         */
        public function __construct()
        {
            require_once('post_type_popuplite.php');
             require_once('assets/scripts.php');
            require_once('pop_shortcode.php');
           // add_action('wp_enqueue_scripts', array(&$this, 'wpac_plugin_scripts'));
            add_action('admin_enqueue_scripts', array(&$this, 'defaultfiles_plugin_enqueue'));
        }
        public static function plugin_url(){
                return plugin_dir_url( __FILE__ );

        }
        /**
         * Activate the plugin
         */
        public static function activate()
        {	
            add_option( 'popuplite_plugin', 'installed' );
        } 
        /**
         * Deactivate the plugin
         */     
        static function deactivate()
        {
            delete_option( 'popuplite_plugin');
        } 
         /**
         * Include Default Scripts and styles
         */  
        public function defaultfiles_plugin_enqueue()
        {
            wp_enqueue_script('jquery');

        }
        function wpac_plugin_scripts() {
            $user_id = get_current_user_id();
            //Plugin Frontend CSS
            wp_enqueue_style('wpac-css', plugin_dir_url( __FILE__ ) .'assets/custom-css.css');

            //FontAwesome CSS
         /*  wp_enqueue_style( 'wpac-font-awesome', plugin_dir_url. 'assets/font-awesome/css/fontawesome-all.min.css', array(), NULL);*/

            //Plugin Ajax JS
            wp_enqueue_script('wpac-ajax', plugin_dir_url( __FILE__ ) . 'assets/js/ajax.js', 'jQuery', '1.0.0', true );

            wp_localize_script( 'wpac-ajax', 'wpac_ajax_url', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'user_id'  => '1'
            ));
        }
        

    } // End Class
}

if(class_exists('popuplite'))
{
    // instantiate the plugin class
	$popuplite = new popuplite();
	register_activation_hook( __FILE__, array( 'popuplite', 'activate' ));
	register_deactivation_hook(__FILE__, array('popuplite', 'deactivate'));
}