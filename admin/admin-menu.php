<?php // Admin Menu



// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// add sub-level administrative menu
function fdm_responsive_menu_add_sublevel_menu() {

	/*

	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);

	*/

	add_submenu_page(
		'themes.php',
		'Mobile Menu Settings',
		'Mobile Menu',
		'manage_options',
		'fdm-mobile-menu',
		'fdm_responsive_menu_display_settings_page'
	);

}
add_action( 'admin_menu', 'fdm_responsive_menu_add_sublevel_menu' );