<?php
// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// validate plugin settings
function fdm_responsive_menu_validate_options($input) {

	// Menu Button Text
	if ( isset( $input['menu_text'] ) ) {

		$input['menu_text'] = sanitize_text_field( $input['menu_text'] );

	}

	// menu Button Icon
	if ( isset( $input['menu_icon'] ) ) {

		$input['menu_icon'] = sanitize_text_field( $input['menu_icon'] );

	}

	// menu position
	$radio_options = array(

		'left'  => 'Left Side',
		'right' => 'Right Side'

	);

	if ( ! isset( $input['menu_position'] ) ) {

		$input['menu_position'] = null;

	}
	if ( ! array_key_exists( $input['menu_position'], $radio_options ) ) {

		$input['menu_position'] = null;

	}

	// Select Menu
	$select_options = fdm_responsive_menu_options_select();

	if ( ! isset( $input['nav_menu'] ) ) {

		$input['nav_menu'] = null;

	}

	if ( ! array_key_exists( $input['nav_menu'], $select_options ) ) {

		$input['nav_menu'] = null;

	}

	// include Font Awesome
	$radio_options_fontawesome = array(

		'enable'  => 'Enable Font Awesome',
		'disable' => 'Disable Font Awesome'

	);

	if ( ! isset( $input['fontawesome'] ) ) {

		$input['fontawesome'] = null;

	}
	if ( ! array_key_exists( $input['fontawesome'], $radio_options_fontawesome ) ) {

		$input['fontawesome'] = null;

	}

	// Site Logo
	if ( isset( $input['site_logo'] ) ) {

		$input['site_logo'] = esc_url( $input['site_logo'] );

	}

	// Icon
	if ( isset( $input['fdm_social_icon_1'] ) ) {

		$input['fdm_social_icon_1'] = sanitize_text_field( $input['fdm_social_icon_1'] );

	}


	// Icon Link
	if ( isset( $input['fdm_social_icon_link_1'] ) ) {

		$input['fdm_social_icon_link_1'] = esc_url( $input['fdm_social_icon_link_1'] );

	}

	// Menu Button Color
	if ( isset( $input['menu_button_color'] ) ) {

		$input['menu_button_color'] = sanitize_text_field( $input['menu_button_color'] );

	}

	// Menu Background Color
	if ( isset( $input['menu_background_color'] ) ) {

		$input['menu_background_color'] = sanitize_text_field( $input['menu_background_color'] );

	}

	// Menu link Color
	if ( isset( $input['menu_link_color'] ) ) {

		$input['menu_link_color'] = sanitize_text_field( $input['menu_link_color'] );

	}

	// Icon link Color
	if ( isset( $input['icon_link_color'] ) ) {

		$input['icon_link_color'] = sanitize_text_field( $input['icon_link_color'] );

	}

	// Menu Displacement
	if ( isset( $input['menu_displacement'] ) ) {

		$input['menu_displacement'] = sanitize_text_field( $input['menu_displacement'] );

	}

	// SIDR Renaming
	if ( isset( $input['sidr_renaming'] ) ) {

		$input['sidr_renaming'] = sanitize_text_field( $input['sidr_renaming'] );

	}

	// Break Point
	if ( isset( $input['break_point'] ) ) {

		$input['break_point'] = sanitize_text_field( $input['break_point'] );

	}

	// Main Menu Hide
	if ( isset( $input['main_menu_hide'] ) ) {

		$input['main_menu_hide'] = sanitize_text_field( $input['main_menu_hide'] );

	}


	return $input;

}