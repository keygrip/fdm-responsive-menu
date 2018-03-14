<?php
// exit if uninstall constant is not defined
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

	exit;

}

// get selection from Remove Data on Uninstall in Admin
delete_option( 'fdm_responsive_menu_options' );
delete_transient( 'fdm_responsive_menu_options' );
delete_option( 'fdm_responsive_menu_settings_options' );
delete_transient( 'fdm_responsive_menu_settings_options' );
delete_option( 'fdm_responsive_menu_style_options' );
delete_transient( 'fdm_responsive_menu_style_options' );