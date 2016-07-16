<?php 

	register_nav_menus(); 
	
	// This is to remove the in-page styling of the galleries:
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	// This is for posts to have a thumb nail
	add_theme_support( 'post-thumbnails' );
	
	remove_action('wp_head', 'start_post_rel_link', 10, 0 );
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');

	// This is to remove the admin bar on top of the web site:
	add_filter( 'show_admin_bar' , 'pgraf_has_no_admin_bar');
	function pgraf_has_no_admin_bar() 
	{ 
		return false; 
	}

	// This is to include js libraries  
	add_action( 'wp_enqueue_scripts', 'pgraf_scripts_with_jquery' );
	function pgraf_scripts_with_jquery()  
	{  
		wp_register_script( 'pgraf-script', get_template_directory_uri() . '/pgraf.js', array( 'jquery' ) );
		wp_enqueue_script( 'pgraf-script' );  
	}

	// This is to remove wrapping ul in menus
	// remove ul wp_nav_menu
	add_filter( 'wp_nav_menu', 'pgraf_menus_have_no_ul' );
	function pgraf_menus_have_no_ul( $menu ) {
		return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
	}
	
	// Register a menu
	add_action('init', 'register_menu');
	function register_menu() {
		register_nav_menu('right-menu', 'Right Menu');
	}

?>
