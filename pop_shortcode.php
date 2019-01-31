<?php

if (!class_exists('popup_shortcode')) {

    /**
     * Pop Up Post Type Class
     */
    class popup_shortcode {
	
        /**
         * The Constructor
         */
        public function __construct() {    
       // die('sjo');       
		//add_shortcode( 'list-posts', 'rmcc_post_listing_parameters_shortcode' );
		 add_shortcode('list-posts', array($this, 'rmcc_post_listing_parameters_shortcode'));
        }

// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts

	public function rmcc_post_listing_parameters_shortcode( $atts ) {

	    ob_start();
	 
	    // define attributes and their defaults
	    extract( shortcode_atts( array (
	        'id' => ''

	    ), $atts ) );
	 
	   $content_post = get_post($id);
		$content = $content_post->post_content;
		$post_title = $content_post->post_title;
		$post_excerpt = $content_post->post_excerpt;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		 $post_thumbnail_id = get_post_thumbnail_id( $id );
		$img = wp_get_attachment_image_url( $post_thumbnail_id,'full' );
		if(empty($img)):
			$img ='#';
		else:
			$img = $img;
		endif;
		echo '<div class="bg-popup"><div id="tpopup"> <a href="'.$post_excerpt.'" target="_blank"> <img src="'.$img.'" class="lazyloading" data-was-processed="true"> </a><div id="tclose">X</div></div></div>';

	}
    }

   

    // END class
}

if (class_exists('popup_shortcode')) {
    $ps_object = new popup_shortcode();
}
