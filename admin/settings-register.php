<?php

// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// register plugin settings
function fdm_responsive_menu_register_settings() {

	/*

	register_setting(
		string   $option_group,
		string   $option_name,
		callable $sanitize_callback
	);

	*/
// Register Display Options
	register_setting(
		'fdm_responsive_menu_options',
		'fdm_responsive_menu_options',
		'fdm_responsive_menu_validate_options'
	);

// Register Menu Options
	register_setting(
		'fdm_responsive_menu_settings_options',
		'fdm_responsive_menu_settings_options',
		'fdm_responsive_menu_settings_validate_options'
	);

// Register Style Options
	register_setting(
		'fdm_responsive_menu_style_options',
		'fdm_responsive_menu_style_options',
		'fdm_responsive_menu_style_validate_options'
	);

	/*

add_settings_section(
	string   $id,
	string   $title,
	callable $callback,
	string   $page
);

*/

// Add Display Options
	add_settings_section(
		'fdm_responsive_menu_section_admin',
		'Slide Out Sidebar Menu Display Options',
		'fdm_responsive_menu_callback_section_admin',
		'fdm-mobile-menu'
	);

// Add Settings Options
	add_settings_section(
		'fdm_responsive_menu_section_settings',
		'Slide Out Sidebar Menu Settings',
		'fdm_responsive_menu_callback_section_settings',
		'fdm-mobile-menu-settings'
	);

// Add Style Options
	add_settings_section(
		'fdm_responsive_menu_section_styles',
		'Slide Out Sidebar Menu Styles',
		'fdm_responsive_menu_callback_section_styles',
		'fdm-mobile-menu-styles'
	);


	/*

		add_settings_field(
			string   $id,
			string   $title,
			callable $callback,
			string   $page,
			string   $section = 'default',
			array    $args = []
		);

		*/
// Add Field Display Options

	add_settings_field(
		'menu_icon',
		esc_html__('Menu Icon', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_button_icon',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'menu_icon', 'label' => esc_html__('Leave blank to only use the Menu Text as the button.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'menu_text',
		esc_html__('Menu Text', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_button_text',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'menu_text', 'label' => esc_html__('Leave blank to only use the menu Icon as the button.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'nav_menu',
		esc_html__('Navigation Menu', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_field_select',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'nav_menu', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'site_logo',
		esc_html__('Site Logo', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_site_logo',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'site_logo', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'admin_message',
		esc_html__('', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_admin_message',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'admin_message', 'label' => 'The optional setting below will show after the navigation in the menu.' ]
	);

	add_settings_field(
		'fdm_social_icon',
		esc_html__('Icons', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_icon',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'social_icon', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

//	add_settings_field(
//		'fdm_social_icon_link',
//		esc_html__('Icon Link', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);

//	add_settings_field(
//		'fdm_social_icon_link',
//		esc_html__('Icon Link 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_1_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);

//	add_settings_field(
//		'social_icon_1',
//		esc_html__('Icon 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_1', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_1_link',
//		esc_html__('Icon Link 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_1_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_2',
//		esc_html__('Icon 2', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_2', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_2_link',
//		esc_html__('Icon Link 2', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_2_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_3',
//		esc_html__('Icon 3', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_3', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_3_link',
//		esc_html__('Icon Link 3', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_3_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_4',
//		esc_html__('Icon 4', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_4', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'social_icon_4_link',
//		esc_html__('Icon Link 4', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_icon_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'social_icon_4_link', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);

	add_settings_field(
		'optional_links_message',
		esc_html__('', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_links_message',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'optional_links_message', 'label' => esc_html__('Optional Custom Links', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'fdm_custom_link',
		esc_html__('Custom Links', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_custom_link_icon',
		'fdm-mobile-menu',
		'fdm_responsive_menu_section_admin',
		[ 'id' => 'custom_link_icon', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

//	add_settings_field(
//		'fdm_custom_link_icon_1',
//		esc_html__('Custom Link Icon 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_icon_1', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_1',
//		esc_html__('Custom Link 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_1', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_text_1',
//		esc_html__('Custom Link Text 1', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_text',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_text_1', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_icon_2',
//		esc_html__('Custom Link Icon 2', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_icon_2', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_2',
//		esc_html__('Custom Link 2', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_2', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_text_2',
//		esc_html__('Custom Link Text 2', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_text',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_text_2', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_icon_3',
//		esc_html__('Custom Link Icon 3', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_icon',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_icon_3', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_3',
//		esc_html__('Custom Link 3', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_3', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);
//
//	add_settings_field(
//		'custom_link_text_3',
//		esc_html__('Custom Link Text 3', 'fdm-responsive-menu'),
//		'fdm_responsive_menu_callback_custom_link_text',
//		'fdm-mobile-menu',
//		'fdm_responsive_menu_section_admin',
//		[ 'id' => 'custom_link_text_3', 'label' => esc_html__('', 'fdm-responsive-menu') ]
//	);

// Add Field Style Options
	add_settings_field(
		'menu_button_color',
		esc_html__('Menu Button Color', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_button_color',
		'fdm-mobile-menu-styles',
		'fdm_responsive_menu_section_styles',
		[ 'id' => 'menu_button_color', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);
	add_settings_field(
		'menu_background_color',
		esc_html__('Menu Background Color', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_bg_color',
		'fdm-mobile-menu-styles',
		'fdm_responsive_menu_section_styles',
		[ 'id' => 'menu_background_color', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'menu_link_color',
		esc_html__('Menu Links Color', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_link_color',
		'fdm-mobile-menu-styles',
		'fdm_responsive_menu_section_styles',
		[ 'id' => 'menu_link_color', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'icon_link_color',
		esc_html__('Icon Links Color', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_icon_link_color',
		'fdm-mobile-menu-styles',
		'fdm_responsive_menu_section_styles',
		[ 'id' => 'icon_link_color', 'label' => esc_html__('', 'fdm-responsive-menu') ]
	);

	// Add Field Settings Options
	add_settings_field(
		'menu_position',
		esc_html__('Menu Position', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_field_radio',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'menu_position', 'label' => esc_html__('The position on screen where the menu is located.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'menu_displacement',
		esc_html__('Menu Displacement', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_displacement',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'menu_displacement', 'label' => esc_html__('Displace the body content on slide open.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'sidr_renaming',
		esc_html__('Class/ID Renaming', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_sidr_renaming',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'sidr_renaming', 'label' => esc_html__('Adds a sidr class/ID to all elements within the menu for more customization.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'fontawesome',
		esc_html__('Font Awesome', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_radio_fontawesome',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'fontawesome', 'label' => esc_html__('If icons are not showing correctly, try toggling Font Awesome.', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'break_point',
		esc_html__('Menu Break Point', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_break_point',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'break_point', 'label' => esc_html__('Enter the break point that you want the menu to show, default is 768px.  Enter 0 to always show (Optional).', 'fdm-responsive-menu') ]
	);

	add_settings_field(
		'main_menu_hide',
		esc_html__('ID or Class to Hide', 'fdm-responsive-menu'),
		'fdm_responsive_menu_callback_menu_hide',
		'fdm-mobile-menu-settings',
		'fdm_responsive_menu_section_settings',
		[ 'id' => 'main_menu_hide', 'label' => esc_html__('Enter the ID or Class of the main menu that needs to be hidden (Optional).', 'fdm-responsive-menu') ]
	);

}
add_action( 'admin_init', 'fdm_responsive_menu_register_settings' );