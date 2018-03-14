<?php

// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// callback: display section
function fdm_responsive_menu_callback_section_admin() {

	echo '<p>Choose which navigation menu to use below.  All other settings are optional.</p>';

}

// callback: styles section
function fdm_responsive_menu_callback_section_styles() {

	echo '<p></p>';

}

// callback: settings section
function fdm_responsive_menu_callback_section_settings() {

	echo '<p></p>';

}

// callback: menu icon
function fdm_responsive_menu_callback_menu_button_icon( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<div class="input-group choose-icon">
        	<input name="fdm_responsive_menu_options['. $id .']" data-placement="bottomRight" class="form-control icp icp-auto" value="'.$value.'" type="text" />
            <span class="input-group-addon"></span>
        </div>
        ';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';

}

// callback: menu button text
function fdm_responsive_menu_callback_menu_button_text( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<input id="fdm_responsive_menu_options_'. $id .'" name="fdm_responsive_menu_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';

}

// callback: Nav Menu Location
function fdm_responsive_menu_callback_field_radio( $args ) {

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	$select_options = array(

		'left'  => 'Left Side',
		'right' => 'Right Side'

	);
	echo '<select id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']">';
	foreach ( $select_options as $value => $option ) {

		$selected = selected( $selected_option === $value, true, false );

		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';

	}

	echo '</select> <label for="fdm_responsive_menu_settings_options_'. $id .'"></label>';

}

// callback: Nav Menu Displacement
function fdm_responsive_menu_callback_menu_displacement( $args ) {

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

	echo '<label class="switch"><input id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']" type="checkbox" value="1"'. $checked .'><span class="slider round"></span></label> ';
	echo '<label for="fdm_responsive_menu_settings_options_'. $id .'">'. $label .'</label>';
}

// select field options -  get all navigation menus and returns them as an array.
function fdm_responsive_menu_options_select() {

	$menus = wp_get_nav_menus();
	$menu_array = array();
	foreach ( $menus as $menu ) {

		$menu_name =  $menu->name;
		$menu_slug =  $menu->slug;
		$menu_array[$menu_slug] = $menu_name;
	}
	return $menu_array;
}

// callback: select nav menu
function fdm_responsive_menu_callback_field_select( $args ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	$select_options = fdm_responsive_menu_options_select();

	echo '<select id="fdm_responsive_menu_options_'. $id .'" name="fdm_responsive_menu_options['. $id .']">';

	foreach ( $select_options as $value => $option ) {

		$selected = selected( $selected_option === $value, true, false );

		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';

	}

	echo '</select> <label for="fdm_responsive_menu_options_'. $id .'"></label>';

}

// callback: fontawesome
function fdm_responsive_menu_callback_radio_fontawesome( $args ) {
	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

	echo '<label class="switch"><input id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']" type="checkbox" value="1"'. $checked .'><span class="slider round"></span></label> ';
	echo '<label for="fdm_responsive_menu_settings_options_'. $id .'">'. $label .'</label>';

}

// callback: Break Point
function fdm_responsive_menu_callback_break_point( $args ) {
	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<input id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']" type="text" size="40" value="'. $value .'" placeholder="768"><br />';
	echo '<label for="fdm_responsive_menu_settings_options_'. $id .'">'. $label .'</label>';

}

// callback: Hide Main Menu
function fdm_responsive_menu_callback_menu_hide( $args ) {
	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<input id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="fdm_responsive_menu_settings_options_'. $id .'">'. $label .'</label>';

}

// callback: SIDR Renaming
function fdm_responsive_menu_callback_sidr_renaming( $args ) {
	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

	echo '<label class="switch"><input id="fdm_responsive_menu_settings_options_'. $id .'" name="fdm_responsive_menu_settings_options['. $id .']" type="checkbox" value="1"'. $checked .'><span class="slider round"></span></label> ';
	echo '<label for="fdm_responsive_menu_settings_options_'. $id .'">'. $label .'</label>';

}

// callback: Site Logo
function fdm_responsive_menu_callback_site_logo( $args ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	if( empty( $value ) ) {
		$clearbutton = '';
		$image = '';
	} else {
		$clearbutton = ' <input type="button" value="Remove Image" class="button" id="reset-site-logo-uploader" />';
		$image = '<br/><span id="logo-image"><img src="'.$value.'" /></span>';
	}
	echo '
        <form method="post" id="site-logo-uploader">
  			<input id="fdm_responsive_menu_options'. $id .'" name="fdm_responsive_menu_options['. $id .']" type="text" size="40" value="'. $value .'">
  			<input id="upload-button" type="button" class="button" value="Upload Image" />'.$clearbutton.'
		</form>
    ';
	echo '<label for="fdm_responsive_menu_options'. $id .'">'. $label .'</label>';

	if( !empty( $value ) ){
		echo $image;
	}
}

// Optional Settings Message
function fdm_responsive_menu_callback_admin_message( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<h4 class="admin-message">'.$label.'</h4>';
}

// callback: social icon
function fdm_responsive_menu_callback_icon( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<div class="input-group choose-icon">
        	<input name="fdm_responsive_menu_options['. $id .']" data-placement="bottomRight" class="form-control icp icp-auto" value="'.$value.'" type="text" />
            <span class="input-group-addon"></span>
        </div>
        ';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';
}

// callback: social icon link
function fdm_responsive_menu_callback_icon_link( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="icon-link">
        	<input name="fdm_responsive_menu_options['. $id .']" value="'.$value.'" type="text" placeholder="https://"/>
		</div>
		<hr/>
        ';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';
}

// Optional links Message
function fdm_responsive_menu_callback_links_message( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<h4 class="admin-message">'.$label.'</h4><p>Use the following options to add messages or links below the navigation menu.</p>';

}

// callback: Custom Link icon
function fdm_responsive_menu_callback_custom_link_icon( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<div class="input-group choose-icon">
        	<input name="fdm_responsive_menu_options['. $id .']" data-placement="bottomRight" class="form-control icp icp-auto" value="'.$value.'" type="text" />
            <span class="input-group-addon"></span>
        </div>
        ';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';
}

// callback: Custom Link
function fdm_responsive_menu_callback_custom_link( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="icon-link">
        	<input name="fdm_responsive_menu_options['. $id .']" value="'.$value.'" type="text"/>
		</div>
        ';
	echo '<label for="fdm_responsive_menu_options_'. $id .'">'. $label .'</label>';
}

// callback: Custom Link Text
function fdm_responsive_menu_callback_custom_link_text( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<input id="fdm_responsive_menu_options_'. $id .'" name="fdm_responsive_menu_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';
	echo '<hr/>';

}

// callback: Menu Button Color
function fdm_responsive_menu_callback_menu_button_color( $args ) {
	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="color-picker">
        	<input id="fdm_responsive_menu_style_options'. $id .'" class="fdm-menu-color-field" name="fdm_responsive_menu_style_options['. $id .']" type="text" value="'.$value.'" />
		</div>
        ';
	echo '<label for="fdm_responsive_menu_style_options_'. $id .'">'. $label .'</label>';
}

// callback: Menu Background Color
function fdm_responsive_menu_callback_menu_bg_color( $args ) {
	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="color-picker">
        	<input id="fdm_responsive_menu_style_options'. $id .'" class="fdm-menu-color-field" name="fdm_responsive_menu_style_options['. $id .']" type="text" value="'.$value.'" />
		</div>
        ';
	echo '<label for="fdm_responsive_menu_style_options_'. $id .'">'. $label .'</label>';
}

// callback: Menu Link Color
function fdm_responsive_menu_callback_menu_link_color( $args ) {
	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="color-picker">
        	<input id="fdm_responsive_menu_style_options'. $id .'" class="fdm-menu-color-field" name="fdm_responsive_menu_style_options['. $id .']" type="text" value="'.$value.'" />
		</div>
        ';
	echo '<label for="fdm_responsive_menu_style_options_'. $id .'">'. $label .'</label>';
}

// callback: Icon Link Color
function fdm_responsive_menu_callback_icon_link_color( $args ) {
	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '
        <div class="color-picker">
        	<input id="fdm_responsive_menu_style_options'. $id .'" class="fdm-menu-color-field" name="fdm_responsive_menu_style_options['. $id .']" type="text" value="'.$value.'" />
		</div>
        ';
	echo '<label for="fdm_responsive_menu_style_options_'. $id .'">'. $label .'</label>';
}