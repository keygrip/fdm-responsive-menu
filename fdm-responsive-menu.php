<?php
/*
Plugin Name: Slide Out Sidebar Menu
Plugin URI:   https://flyingdonutmedia.com
Description: Customizable slide out sidebar navigation menu.
Version: 1.1.0
Author: Flying Donut Media
Author URI: https://flyingdonutmedia.com
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: fdm-responsive-menu
Domain Path:  /languages
*/

// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// load text domain
function fdm_responsive_menu_load_textdomain() {

	load_plugin_textdomain( 'fdm-responsive-menu', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'fdm_responsive_menu_load_textdomain' );
/**
 * Enqueue scripts and styles.
 */
function fdm_responsive_menu_scripts() {

	wp_enqueue_style( 'sidr_style', plugin_dir_url(  __FILE__  ) . 'assets/sidr/css/jquery.sidr.dark.min.css', array(), null, 'screen' );

	wp_enqueue_style( 'fdm_responsive_menu_styles', plugin_dir_url(  __FILE__  ) . 'assets/css/fdm-styles.css', array(), null, 'screen' );

	wp_enqueue_script( 'jquery');

	wp_enqueue_script( 'sidr_js', plugin_dir_url( __FILE__ ) . 'assets/sidr/js/jquery.sidr.min.js', array(), null, false );

	wp_enqueue_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'fdm_responsive_menu_scripts' );

// Enqueue Admin scripts and styles
function fdm_responsive_menu_admin_scripts() {

	wp_enqueue_style( 'fdm_responsive_menu_admin_styles', plugin_dir_url(  __FILE__  ) . 'admin/css/fdm-responsive-menu-admin.css', array(), null, 'screen' );

	wp_enqueue_style( 'fontawesome-iconpicker_styles', plugin_dir_url(  __FILE__  ) . 'admin/css/fontawesome-iconpicker.min.css', array(), null, 'screen' );

	wp_enqueue_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, 'screen' );

	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'wp-color-picker' );

	wp_enqueue_media();

	wp_enqueue_script( 'clipboard_js', plugin_dir_url( __FILE__ ) . 'admin/js/clipboard.min.js', array(), null, false );

	wp_enqueue_script( 'fontawesome-iconpicker_js', plugin_dir_url( __FILE__ ) . 'admin/js/fontawesome-iconpicker.min.js', array(), null, false );

	wp_enqueue_script( 'fdm_responsive_menu_js', plugin_dir_url( __FILE__ ) . 'admin/js/fdm-responsive-menu.js', array(), null, true );
}
add_action( 'admin_enqueue_scripts', 'fdm_responsive_menu_admin_scripts' );


// if Admin Area
if ( is_admin() ){
	// include plugin dependencies
	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
}

// Include dependencies: admin and public sections of site.
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';

// scss compiler
require_once plugin_dir_path( __FILE__ ) . 'assets/scssphp/scss.inc.php';
use Leafo\ScssPhp\Compiler;
$scss = new Compiler();

// Add settings link to plugin on plugins page
function fdm_responsive_menu_add_action_links ( $links ) {
	$settingsLink = array(
		'<a href="' . admin_url( 'themes.php?page=fdm-mobile-menu' ) . '">Settings</a>',
	);
	return array_merge( $links, $settingsLink );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'fdm_responsive_menu_add_action_links' );

// default plugin options
function fdm_responsive_menu_options_default() {

	return array(
		'menu_icon'             => 'fa-bars',
		'menu_text'             => esc_html__('Menu', 'fdm-responsive-menu'),
		'menu_position'         => 'right',
		'menu_displacement'     => false,
		'nav_menu'              => 'default',
		'fontawesome'           => false,
		'site_logo'             => '',
		'fdm_social_icon_1'         => '',
		'fdm_social_link_1'    => '',
		'menu_background_color' => '#333',
		'menu_link_color'       => '#fff',
		'fdm_custom_link_icon_1'    => '',
		'fdm_custom_link_1'         => '',
		'fdm_custom_link_text_1'    => '',
		'main_menu_hide'        => '',
	);

}

// create shortcode
function fdm_sidebar_menu_shortcode() {
	$option = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );
	$i = 1;

	$selected_menu = $option['nav_menu'];
	$menu_icon = $option['menu_icon'] ? "<i class='fa ".$option['menu_icon']."'></i>" : '';
	$menu_text = $option['menu_text'] ? "<span class='menu-button-text'>".$option['menu_text']."</span>" : '';
	$img_logo = $option['site_logo'] ? "<div class='mobile-logo'><a href='".home_url()."'><img src='".$option['site_logo']."' /></a></div>" : '';

	$nav_menu = '<div id="mobile-header">';
	$nav_menu .= '<a href="#sidr" id="responsive-menu-button">'.$menu_icon.$menu_text.'</a>';
	$nav_menu .= '</div><!--/mobile-header-->';
	$nav_menu .= '<div id="mobile-navigation">';
	$nav_menu .= '<div class="close-menu"><i class="fa fa-times-circle"></i></div>';
	$nav_menu .= $img_logo;
	$nav_menu .= wp_nav_menu( array ( 'menu' => $selected_menu, 'echo' => false ) );
	$nav_menu .= '<div class="icons">';

	foreach ($option as $text_input => $val ){
		if( substr( $text_input, 0, 16 ) == 'fdm_social_icon_') {
			$nav_menu .= '<div class="icon icon-'.$i.'"><a href="'.$option["fdm_social_link_".$i].'"><i class="fa '.$option["fdm_social_icon_".$i].'"></i></a></div>';
			$i++;
		}
	}

	$nav_menu .= apply_filters( 'compiled_scss_filter', '' );
	$nav_menu .= '</div><!--/icons-->';
	$i = 1;
	foreach ($option as $custom => $val ){

		if( substr( $custom, 0, 16 ) == 'fdm_custom_link_') {

			$custom_icon = $option['fdm_custom_link_icon_'.$i] ? $option['fdm_custom_link_icon_'.$i] : '';
			$custom_link = $option['fdm_custom_link_'.$i] ? $option['fdm_custom_link_'.$i] : '';
			$custom_text = $option['fdm_custom_link_text_'.$i] ? $option['fdm_custom_link_text_'.$i] : '';

			if ($custom_icon || $custom_link || $custom_text) {
				$nav_menu .= '<div class="custom-icon custom-icon-'.$i.'"><a href="'.$custom_link.'"><i class="fa '.$custom_icon.'"></i>'.$custom_text.'</a></div>';
			} else {
				$nav_menu .= '';
			}
			$i++;
		}
	}

	$nav_menu .= '</div><!--/mobile-navigation-->';

	return $nav_menu;

}
add_shortcode('fdm-sidebar-menu', 'fdm_sidebar_menu_shortcode');