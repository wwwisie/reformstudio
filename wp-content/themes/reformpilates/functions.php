<?php
	
	//Edit Log In
	function custom_loginlogo() {
		echo '<style type="text/css"> h1 a {
			width: 160px !important;
			height: 60px !important;
			background-size: 100% !important;
			background-image: url('.get_bloginfo('template_directory').'/img/logo.svg) !important;
		} </style>';
	}
	add_action('login_head', 'custom_loginlogo');	
	
	// Load jQuery
	function load_scripts() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"), false);
			wp_enqueue_script('jquery');
			wp_register_script('functions', get_template_directory_uri().'/js/min/functions.min.js?'.date('j-m-y-h:i:s'), array('jquery'), false, true);
			wp_enqueue_script('functions');
			wp_register_script( 'slick-slider-js', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), false, true );
			wp_enqueue_script('slick-slider-js');
			wp_register_script('TweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', array('jquery'), false, true);
			wp_enqueue_script('TweenMax');
		}
		wp_enqueue_style('slick-slider', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css' );
		wp_enqueue_style('fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css' );
		wp_enqueue_style('style', get_template_directory_uri().'/css/style.css?'.date('j-m-y-h:i:s'));
	}
	add_action('wp_enqueue_scripts','load_scripts');

	// Clean up the <head>
	function removeHeadLinks() {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	add_action('init', 'removeHeadLinks');
	remove_action('wp_head', 'wp_generator');
	
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => 'Sidebar Widgets',
			'id'   => 'sidebar-widgets',
			'description'   => 'These are widgets for the sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
		));
	}

	//Remove Dashboard Options
	function remove_menus () {
		global $menu;
		$restricted = array( __('Profile'), __('Links'), __('Comments'), __('Tools'));
		end ($menu);
		while (prev($menu)) {
			$value = explode(' ',$menu[key($menu)][0]);
			if (in_array($value[0] != NULL?$value[0]:"" , $restricted)) {
				unset($menu[key($menu)]);
			}
		}
	}
	add_action('admin_menu', 'remove_menus');

	//Stop ACF Updates
	function filter_plugin_updates( $value ) {
		unset( $value->response['advanced-custom-fields/acf.php'] );
		return $value;
	}
	add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

	//Remove WP Updates
	function remove_core_updates(){
		global $wp_version;
		return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
	}
	// add_filter('pre_site_transient_update_core','remove_core_updates');
	// add_filter('pre_site_transient_update_plugins','remove_core_updates');
	// add_filter('pre_site_transient_update_themes','remove_core_updates');

	//Remove Admin Bar Links
	function remove_admin_bar_links() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');			// Remove the WordPress logo
		$wp_admin_bar->remove_menu('about');			// Remove the about WordPress link
		$wp_admin_bar->remove_menu('wporg');			// Remove the WordPress.org link
		$wp_admin_bar->remove_menu('documentation');	// Remove the WordPress documentation link
		$wp_admin_bar->remove_menu('support-forums');	// Remove the support forums link
		$wp_admin_bar->remove_menu('feedback');			// Remove the feedback link
		$wp_admin_bar->remove_menu('updates');			// Remove the updates link
		$wp_admin_bar->remove_menu('comments');			// Remove the comments link
		$wp_admin_bar->remove_menu('new-content');		// Remove the content link
		$wp_admin_bar->remove_menu('w3tc');				// Remove the W3 performance link
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

	//Support Featured Image
	add_theme_support('post-thumbnails');

	//Add XL Image Size 
	add_image_size('xl',2000,2000);

	/* STRING TRANSLATIONS */
	include(get_template_directory().'/inc/admin/lang.php');

	/* Post Types */
	// include(get_template_directory().'/inc/posttypes/proyectos.php');

	/* Admin Functions */
	include(get_template_directory().'/inc/admin/options-page.php');
	include(get_template_directory().'/inc/admin/svg-upload.php');


	// Admin CSS
	function admin_styles() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css?'.date('j-m-y-h:i:s'));
	}
	add_action('admin_enqueue_scripts', 'admin_styles');

	/* Deregister Scripts */
	function my_deregister_scripts(){
		wp_deregister_script( 'wp-embed' );
	}
	add_action( 'wp_footer', 'my_deregister_scripts' );

	/* Hide Admin Bar */
	add_filter('show_admin_bar','__return_false');

	//ACF Google Maps API Key
	function acf_google_map_api( $api ){
		$api['key'] = 'AIzaSyDzKb8-Y2cdQUKajFsLPvsO_SP6A_qt1Bs';
		return $api;
	}
	add_filter('acf/fields/google_map/api', 'acf_google_map_api');

	// Disable Block Editor
	function disable_block_editor($use_block_editor) {
		return false;
	}
	add_filter('use_block_editor_for_post_type', 'disable_block_editor');

	/* Show ACF Admin for Editors */
	add_filter('acf/settings/show_admin', '__return_true');
	add_filter('acf/settings/capability', function($cap) {
		return 'edit_posts';
	});

	/* Register Navigation Menus */
	function reform_register_menus() {
		register_nav_menus(
			array(
				'header_menu' => __( 'Menú del Header' )
			)
		);
	}
	add_action( 'init', 'reform_register_menus' );
