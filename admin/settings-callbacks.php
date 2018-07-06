<?php

// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// callback: display section
function fdm_responsive_menu_callback_section_admin() {

	echo '<p>Choose which navigation menu to use below.  All other settings are optional.</p>';
	echo '<p style="font-size: 14px;"><strong>Shortcode: </strong><input id="shortcode" value="[fdm-sidebar-menu]"/> <button class="copy-shortcode" data-clipboard-target="#shortcode" type="button"><i class="fa fa-copy"></i></button>  <span id="copy-complete" style="color: green; display: none;"><i class="fa fa-check-circle"></i> Shortcode Copied!</span></p>';
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

	echo '<div class="fdm-group">
        	<input name="fdm_responsive_menu_options['. $id .']" data-placement="bottomRight" class="form-control icp icp-auto input-group choose-icon" value="'.$value.'" type="text" />
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
	echo '<p style="padding: 5px; background-color: lightyellow; display: inline-block;">Frontend Example: <a style="text-decoration: none;" href="https://google.com"><i class="fa fa-facebook-square" style="padding: 0 5px"></i></a></p>';
}

// callback: social icon
function fdm_responsive_menu_callback_icon( $args ) {

	$options = get_option( 'fdm_responsive_menu_options' );
	$i = 1;

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<div class="fdm_responsive_menu_rows">';
	echo '<div class="row-titles"><div class="row-title icon-row">Icon</div><div class="row-title URL-row">URL</div></div>';

	if( ! empty( $options[ 'fdm_social_icon_1' ] ) ) {

		foreach ($options as $text_input => $val ) {

			if( substr( $text_input, 0, 16 ) == 'fdm_social_icon_'){

				if ( $i >= 2 ) {
					$removeButton = '<button id="fdm-remove-row-'.$i.'" class="fdm-remove-row" type="button">-</button>';
				}

				$output = '<div id="social-icon-row_'.$i.'" class="fdm-social-icon">';
				$output .= '<input id="social-icon-input_'.$i.'" name="fdm_responsive_menu_options[fdm_social_icon_'. $i .']" data-placement="bottomRight" class="form-control icp icp-auto input-group choose-icon" value="'.$val.'" type="text" autocomplete="nope" />';
				$output .= '<span class="input-group-addon"></span>';
				$output .= '<input type="url" id="social-icon-link_'.$i.'" class="link-input link-input-'.$i.'" name="fdm_responsive_menu_options[fdm_social_link_'.$i.']" value="' . $options['fdm_social_link_'.$i] . '" placeholder="https://" autocomplete="nope" />';
				$output .= $removeButton;
				$output .= '<label for="fdm_responsive_menu_options_'. $i .'">'. $label .'</label>';
				$output .= '</div>';
				$i++;
				echo $output;
			}
		}
	} else {
		$output = '<div id="social-icon-row_'.$i.'" class="fdm-social-icon">';
		$output .= '<input id="social-icon-input_'.$i.'" name="fdm_responsive_menu_options[fdm_social_icon_'. $i .']" data-placement="bottomRight" class="form-control icp icp-auto input-group choose-icon" value="'.$val.'" type="text" autocomplete="nope" />';
		$output .= '<span class="input-group-addon"></span>';
		$output .= '<input type="url" id="social-icon-link_'.$i.'" class="link-input link-input-'.$i.'" name="fdm_responsive_menu_options[fdm_social_link_'.$i.']" value="' . $options['fdm_social_link_'.$i] . '" placeholder="https://" autocomplete="nope" />';
		$output .= $removeButton;
		$output .= '<label for="fdm_responsive_menu_options_'. $i .'">'. $label .'</label>';
		$output .= '</div>';
		echo $output;
	}

	echo "</div>";
	echo '<button class="add-row add-social-icon-row">Add Row</button>';
}

// Optional links Message
function fdm_responsive_menu_callback_links_message( $args ) {
	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<h4 class="admin-message">'.$label.'</h4><p>Use the following options to add messages or links below the navigation menu.</p>';
	// get the domain name only
	$domain = str_replace( array( 'http://', 'https://', 'www.' ), array( '', '', '' ), get_bloginfo('url') );
	echo '<p style="padding: 5px; background-color: lightyellow; display: inline-block;">Frontend Example: <i class="fa fa-envelope" style="padding: 0 5px"></i><a style="text-decoration: none;" href="mailto:name@"'.$domain.'>name@'.$domain.'</a></p>';

}

// callback: Custom Link icon
function fdm_responsive_menu_callback_custom_link_icon( $args ) {
	$options = get_option( 'fdm_responsive_menu_options' );
	$i = 1;

	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

	echo '<div class="fdm_responsive_menu_rows">';
	echo '<div class="row-titles"><div class="row-title icon-row">Icon</div><div class="row-title URL-row">URL, mailto:, or tel:</div><div class="row-title text-row">Text</div></div>';
	if( ! empty( $options[ 'fdm_custom_link_icon_1' ] ) ) {

		foreach ($options as $option => $val ) {

			if( substr( $option, 0, 21 ) == 'fdm_custom_link_icon_'){

				if ( $i >= 2 ) {
					$removeButton = '<button id="fdm-remove-row-'.$i.'" class="fdm-remove-row" type="button">-</button>';
				}

				$output = '<div id="custom-icon-row_'.$i.'" class="fdm-custom-icon-link">';
				$output .= '<input type="text" id="custom-icon-input_'.$i.'" name="fdm_responsive_menu_options[fdm_custom_link_icon_'. $i .']" data-placement="bottomRight" class="form-control icp icp-auto input-group choose-icon" value="'.$val.'" autocomplete="nope" />';
				$output .= '<span class="input-group-addon"></span>';
				$output .= '<input type="text" id="custom-icon-link_'.$i.'" class="custom-link-input custom-link-input-'.$i.'" name="fdm_responsive_menu_options[fdm_custom_link_'.$i.']" value="' . $options['fdm_custom_link_'.$i] . '" placeholder="https://, mailto:, or tel:" />';
				$output .= '<input type="text" id="custom-icon-link-text_'. $i .'" class="custom-icon-link-text custom-icon-link-text-'. $i .'" name="fdm_responsive_menu_options[fdm_custom_link_text_'.$i.']" size="30" value="'. $options['fdm_custom_link_text_'.$i] .'">';
				$output .= $removeButton;
				$output .= '<label for="fdm_responsive_menu_options_'. $i .'">'. $label .'</label>';
				$output .= '</div>';
				$i++;
				echo $output;
			}
		}
	} else {
		$output = '<div id="custom-icon-row_'.$i.'" class="fdm-custom-icon-link">';
		$output .= '<input type="text" id="custom-icon-input_'.$i.'" name="fdm_responsive_menu_options[fdm_custom_link_icon_'. $i .']" data-placement="bottomRight" class="form-control icp icp-auto input-group choose-icon" value="'.$val.'" autocomplete="nope" />';
		$output .= '<span class="input-group-addon"></span>';
		$output .= '<input type="text" id="custom-icon-link_'.$i.'" class="custom-link-input custom-link-input-'.$i.'" name="fdm_responsive_menu_options[fdm_custom_link_'.$i.']" value="' . $options['fdm_custom_link_'.$i] . '" placeholder="https://, mailto:, or tel:" />';
		$output .= '<input type="text" id="custom-icon-link-text_'. $i .'" class="custom-icon-link-text custom-icon-link-text-'. $i .'" name="fdm_responsive_menu_options[fdm_custom_link_text_'.$i.']" size="30" value="'. $options['fdm_custom_link_text_'.$i] .'">';
		//$output .= $removeButton;
		$output .= '<label for="fdm_responsive_menu_options_'. $i .'">'. $label .'</label>';
		$output .= '</div>';
		echo $output;

	}

	echo "</div>";
	echo '<button class="add-row add-custom-link-row">Add Row</button>';
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