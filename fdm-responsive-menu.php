<?php
/*
Plugin Name: Slide Out Sidebar Menu
Plugin URI:   https://flyingdonutmedia.com
Description: Customizable slide out sidebar navigation menu.
Version: 1.0
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

	wp_enqueue_style( 'fdm_responsive_menu_styles', plugin_dir_url(  __FILE__  ) . 'assets/css/fdm-responsive-menu.css', array(), null, 'screen' );

	wp_enqueue_script( 'jquery');

	wp_enqueue_script( 'sidr_js', plugin_dir_url( __FILE__ ) . 'assets/sidr/js/jquery.sidr.min.js', array(), null, false );


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

	wp_enqueue_script( 'fdm_responsive_menu_js', plugin_dir_url( __FILE__ ) . 'admin/js/fdm-responsive-menu.min.js', array(), null, true );
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
function add_action_links ( $links ) {
	$settingsLink = array(
		'<a href="' . admin_url( 'themes.php?page=fdm-mobile-menu' ) . '">Settings</a>',
	);
	return array_merge( $links, $settingsLink );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

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
		'social_icon_1'         => '',
		'social_icon_link_1'    => '',
		'social_icon_2'         => '',
		'social_icon_link_2'    => '',
		'social_icon_3'         => '',
		'social_icon_link_3'    => '',
		'social_icon_4'         => '',
		'social_icon_link_4'    => '',
		'menu_background_color' => '#333',
		'menu_link_color'       => '#fff',
		'custom_link_icon_1'    => '',
		'custom_link_1'         => '',
		'custom_link_text_1'    => '',
		'custom_link_icon_2'    => '',
		'custom_link_2'         => '',
		'custom_link_text_2'    => '',
		'custom_link_icon_3'    => '',
		'custom_link_3'         => '',
		'custom_link_text_3'    => '',
		'main_menu_hide'        => '',
	);

}

// create shortcode
function fdm_sidebar_menu_shortcode() {
    $option = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

    $selected_menu = $option['nav_menu'];
	$menu_icon = $option['menu_icon'] ? "<i class='fa ".$option['menu_icon']."'></i>" : '';
	$menu_text = $option['menu_text'] ? "<span class='menu-button-text'>".$option['menu_text']."</span>" : '';
	$img_logo = $option['site_logo'] ? "<div class='mobile-logo'><a href='".home_url()."'><img src='".$option['site_logo']."' /></a></div>" : '';
	$icon_1 = $option['social_icon_1'] ? "<div class='icon icon-1'><a href='".$option['social_icon_1_link']."'><i class='fa ".$option['social_icon_1']."'></i></a></div>" : '';
	$icon_2 = $option['social_icon_2'] ? "<div class='icon icon-2'><a href='".$option['social_icon_2_link']."'><i class='fa ".$option['social_icon_2']."'></i></a></div>" : '';
	$icon_3 = $option['social_icon_3'] ? "<div class='icon icon-3'><a href='".$option['social_icon_3_link']."'><i class='fa ".$option['social_icon_3']."'></i></a></div>" : '';
	$icon_4 = $option['social_icon_4'] ? "<div class='icon icon-4'><a href='".$option['social_icon_4_link']."'><i class='fa ".$option['social_icon_4']."'></i></a></div>" : '';
	$custom_icon1 = $option['custom_link_icon_1'] ? $option['custom_link_icon_1'] : '';
	$custom_link1 = $option['custom_link_1'] ? $option['custom_link_1'] : '';
	$custom_text1 = $option['custom_link_text_1'] ? $option['custom_link_text_1'] : '';

	if ($custom_icon1 || $custom_link1 || $custom_text1) {
		$custom_icon_1 = "<div class='custom-icon custom-icon-1'><a href='".$custom_link1."'><i class='fa ".$custom_icon1."'></i>  ".$custom_text1."</a></div>";
	} else {
		$custom_icon_1 = '';
	}

	$custom_icon2 = $option['custom_link_icon_2'] ? $option['custom_link_icon_2'] : '';
	$custom_link2 = $option['custom_link_2'] ? $option['custom_link_2'] : '';
	$custom_text2 = $option['custom_link_text_2'] ? $option['custom_link_text_2'] : '';

	if ($custom_icon2 || $custom_link2 || $custom_text2) {
		$custom_icon_2 = "<div class='custom-icon custom-icon-2'><a href='".$custom_link2."'><i class='fa ".$custom_icon2."'></i>  ".$custom_text2."</a></div>";
	} else {
		$custom_icon_2 = '';
	}

	$custom_icon3 = $option['custom_link_icon_3'] ? $option['custom_link_icon_3'] : '';
	$custom_link3 = $option['custom_link_3'] ? $option['custom_link_3'] : '';
	$custom_text3 = $option['custom_link_text_3'] ? $option['custom_link_text_3'] : '';

	if ($custom_icon3 || $custom_link3 || $custom_text3) {
		$custom_icon_3 = "<div class='custom-icon custom-icon-3'><a href='".$custom_link3."'><i class='fa ".$custom_icon3."'></i>  ".$custom_text3."</a></div>";
	} else {
		$custom_icon_3 = '';
	}

	$nav_menu = '<div id="mobile-header">';
	$nav_menu .= '<a href="#sidr" id="responsive-menu-button">'.$menu_icon.$menu_text.'</a>';
	$nav_menu .= '</div><!--/mobile-header-->';
	$nav_menu .= '<div id="mobile-navigation">';
	$nav_menu .= '<div class="close-menu"><i class="fa fa-times-circle"></i></div>';
	$nav_menu .= $img_logo;
	$nav_menu .= wp_nav_menu( array ( 'menu' => $selected_menu, 'echo' => false ) );
	$nav_menu .= '<div class="icons">';
	$nav_menu .= $icon_1;
	$nav_menu .= $icon_2;
	$nav_menu .= $icon_3;
	$nav_menu .= $icon_4;
	$nav_menu .= apply_filters( 'compiled_scss_filter', '' );
	$nav_menu .= '</div><!--/icons-->';
	$nav_menu .= $custom_icon_1;
	$nav_menu .= $custom_icon_2;
	$nav_menu .= $custom_icon_3;
	$nav_menu .= '</div><!--/mobile-navigation-->';

	return $nav_menu;

}
add_shortcode('fdm-sidebar-menu', 'fdm_sidebar_menu_shortcode');