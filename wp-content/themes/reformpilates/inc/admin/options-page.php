<?php 

	//Register Options Page
	if ( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Opciones',
			'menu_title'	=> 'Opciones',
			'menu_slug' 	=> 'theme-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}

	//Move Options Page to Top of menu
	function custom_menu_order($menu_ord) {
		if (!$menu_ord) return true;
		$menu = 'theme-settings';
		$menu_ord = array_diff($menu_ord, array( $menu ));
		array_splice( $menu_ord, 1, 0, array( $menu ) );
		return $menu_ord;
	}  
	add_filter('custom_menu_order', 'custom_menu_order');
	add_filter('menu_order', 'custom_menu_order');