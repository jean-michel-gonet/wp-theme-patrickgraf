<?php 
	function patrickgraf_customize_register( $wp_customize ) {
		$wp_customize->add_setting( 'header_textcolor' , array(
			'default'     => '#000000',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_section( 'mytheme_new_section_name' , array(
		    'title'      => __( 'Visible Section Name', 'mytheme' ),
		        'priority'   => 30,
			) );
	}
	add_action('customize_register', 'patrickgraf_customize_register');

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

	// This is to add version number to the CSS:	
	wp_enqueue_style( "css", get_stylesheet_uri(), "", "1.6");

	// This is to remove wrapping ul in menus
	// remove ul wp_nav_menu
	add_filter( 'wp_nav_menu', 'pgraf_menus_have_no_ul' );
	function pgraf_menus_have_no_ul( $menu ) {
		return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
	}
	
	// This is for home-page only display posts with 'home-page' tag:
	function home_page_shows_featured_posts($query) {
		if ($query->is_home) {
			$query->set('tag', 'featured');
		}
		$category_name = $query->query_vars['category_name'];
		if ($category_name == 'performances' || $category_name == 'prints' || $category_name == 'misc') {
			$query->set('posts_per_page', 1);
		}
	}
	add_filter('pre_get_posts', 'home_page_shows_featured_posts');

	function custom_pagination() {
		global $wp_query;
		$big = 999999999;
		$pages = paginate_links(array(
			'base' => str_replace($big, '%#%', get_pagenum_link($big)),
			'format' => '?page=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 1,
			'prev_next' => false,
			'type' => 'array',
			'prev_next' => TRUE,
			'prev_text' => '&lt;',
			'next_text' => '&gt;',
				));
		if (is_array($pages)) {
			$current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
			echo "<ul class=\"pagination\">\r\n";
			foreach ($pages as $i => $page) {
				$classes = "";
				if ($current_page == 1 && $i == 0) {
					$classes = "active";
				}
				if ($current_page != 1 && $current_page == $i) {
					$classes = "active";
				}
				if (strpos($page, 'next') !== false) {
					$classes = "$classes nav-next";
				}
				if (strpos($page, 'prev') !== false) {
					$classes = "$classes nav-previous";
				}
				echo "	<li class=\"$classes\">$page</li>\r\n";
			}
			echo "</ul>\r\n";
		}
	}
	// This filter is to allow images in the srcset to be as big as the large media size.
	add_filter('max_srcset_image_width', 'max_srcset_image_width');
	function max_srcset_image_width($max_size, $size_array) {
		return get_option('large_size_w');
	}
?>
