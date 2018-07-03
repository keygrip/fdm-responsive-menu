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

	// Icon 1
	if ( isset( $input['social_icon_1'] ) ) {

		$input['social_icon_1'] = sanitize_text_field( $input['social_icon_1'] );

	}

	// Icon 1 Link
	if ( isset( $input['social_icon_link_1'] ) ) {

		$input['social_icon_link_1'] = esc_url( $input['social_icon_link_1'] );

	}

//	// Icon 1 Link
//	if ( isset( $input['social_icon_1_link'] ) ) {
//
//		$input['social_icon_1_link'] = esc_url( $input['social_icon_1_link'] );
//
//	}

//	// Icon 2
//	if ( isset( $input['social_icon_2'] ) ) {
//
//		$input['social_icon_2'] = sanitize_text_field( $input['social_icon_2'] );
//
//	}
//
//	// Icon 2 Link
//	if ( isset( $input['social_icon_2_link'] ) ) {
//
//		$input['social_icon_2_link'] = esc_url( $input['social_icon_2_link'] );
//
//	}
//
//	// Icon 3
//	if ( isset( $input['social_icon_3'] ) ) {
//
//		$input['social_icon_3'] = sanitize_text_field( $input['social_icon_3'] );
//
//	}
//
//	// Icon 3 Link
//	if ( isset( $input['social_icon_3_link'] ) ) {
//
//		$input['social_icon_3_link'] = esc_url( $input['social_icon_3_link'] );
//
//	}
//
//	// Icon 4
//	if ( isset( $input['social_icon_4'] ) ) {
//
//		$input['social_icon_4'] = sanitize_text_field( $input['social_icon_4'] );
//
//	}
//
//	// Icon 4 Link
//	if ( isset( $input['social_icon_4_link'] ) ) {
//
//		$input['social_icon_4_link'] = esc_url( $input['social_icon_4_link'] );
//
//	}

	// Custom Link Icon 1
	if ( isset( $input['custom_link_icon_1'] ) ) {

		$input['custom_link_icon_1'] = sanitize_text_field( $input['custom_link_icon_1'] );

	}

	// Custom Link 1
	if ( isset( $input['custom_link_1'] ) ) {

		$input['custom_link_1'] = esc_url( $input['custom_link_1'] );

	}

	// Custom Link Text 1
	if ( isset( $input['custom_link_text_1'] ) ) {

		$input['custom_link_text_1'] = sanitize_text_field( $input['custom_link_text_1'] );

	}

	// Custom Link Icon 2
	if ( isset( $input['custom_link_icon_2'] ) ) {

		$input['custom_link_icon_2'] = sanitize_text_field( $input['custom_link_icon_2'] );

	}

	// Custom Link 2
	if ( isset( $input['custom_link_2'] ) ) {

		$input['custom_link_2'] = esc_url( $input['custom_link_2'] );

	}

	// Custom Link Text 2
	if ( isset( $input['custom_link_text_2'] ) ) {

		$input['custom_link_text_2'] = sanitize_text_field( $input['custom_link_text_2'] );

	}

	// Custom Link Icon 3
	if ( isset( $input['custom_link_icon_3'] ) ) {

		$input['custom_link_icon_3'] = sanitize_text_field( $input['custom_link_icon_3'] );

	}

	// Custom Link 3
	if ( isset( $input['custom_link_3'] ) ) {

		$input['custom_link_3'] = esc_url( $input['custom_link_3'] );

	}

	// Custom Link Text 3
	if ( isset( $input['custom_link_text_3'] ) ) {

		$input['custom_link_text_3'] = sanitize_text_field( $input['custom_link_text_3'] );

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