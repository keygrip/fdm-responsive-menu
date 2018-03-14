<?php // MyPlugin - Settings Page



// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

// display the plugin settings page
function fdm_responsive_menu_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
		?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=fdm-mobile-menu&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>
            <a href="?page=fdm-mobile-menu&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Style Options</a>
            <a href="?page=fdm-mobile-menu&tab=settings_options" class="nav-tab <?php echo $active_tab == 'settings_options' ? 'nav-tab-active' : ''; ?>">Settings Options</a>
        </h2>
		<form action="options.php" method="post">
			<?php

			if( $active_tab == 'display_options' ) {

				settings_fields( 'fdm_responsive_menu_options' );
				do_settings_sections( 'fdm-mobile-menu' );

			} elseif ( $active_tab == 'settings_options' ){

				settings_fields( 'fdm_responsive_menu_settings_options' );
				do_settings_sections( 'fdm-mobile-menu-settings' );

            } else {

				settings_fields( 'fdm_responsive_menu_style_options' );
				do_settings_sections( 'fdm-mobile-menu-styles' );

			}
			// submit button
			submit_button();

			?>
		</form>
	</div>

	<?php

}

// display default admin notice
function fdm_responsive_menu_add_settings_errors() {

	settings_errors();

}
add_action('admin_notices', 'fdm_responsive_menu_add_settings_errors');