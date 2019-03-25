<?php
// Exit if file is called directly
if (! defined( 'ABSPATH' ) ){
	exit;
}

// SIDR JS
function fdm_responsive_menu_sidrJS_options() {

	$menu_position = fdm_responsive_menu_position();
	$menu_displacement = fdm_responsive_menu_displacement();
    $sidr_renaming = fdm_responsive_menu_sidr_renaming();
    //var_dump($sidr_renaming);
	?>
    <script>
        jQuery(document).ready( function ($) {

            var menuPosition = '<?php echo $menu_position; ?>',
                menuDisplacement = '<?php echo $menu_displacement; ?>',
                sidrRenaming = '<?php echo $sidr_renaming; ?>';

            //sidr mobile nav
            $('#responsive-menu-button').sidr({
                name: 'sidr-main',
                source: '#mobile-navigation',
                side: menuPosition,
                renaming: sidrRenaming,
                displace: menuDisplacement,
                onOpen: function () {
                    $('body').addClass('mobileOpen');
                }
            });
            // close menu button
            $('.close-menu').on('click', function (e) {
                e.preventDefault();
                $.sidr('close', 'sidr-main');
                $('body').removeClass('mobileOpen');

            });

            //Slide Open Mobile Nav Sub Menu

            //append the span tag to all list that have a child list
            $("#sidr-main ul.menu li:has('ul.sub-menu')").closest('li').addClass('expand');

            // Below does what the above does - doing some testing
            // $('#sidr-main ul.menu li').each(function () {
            //     $(this).has('ul.sub-menu').addClass('expand');
            //     //console.log( $(this).has('ul.sub-menu') );
            // })

            $("li.expand > a").append('<a href="javascript:void(0);" class="open-menu"><i class="fa fa-caret-down"></i></a>');
            //when the expand button is clicked, open child list and add class to the expand button.
            $('.expand a .open-menu').click(function(){
                $(this).toggleClass('open');
                $(this).parent().parent().children('ul').toggle('slow');
                //console.log($(this).parent().parent().children('ul'));
            });
            // Set link in mobile menu to "#" for above slider to work.
            //$("#sidr-main ul.menu li.expand > a").attr("href", "#");

        });
    </script>
	<?php

}
add_action( 'wp_footer', 'fdm_responsive_menu_sidrJS_options' );

// menu button icon
function fdm_responsive_menu_button_icon( $icon) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_icon'] ) && ! empty( $options['menu_icon'] ) ) {

		$icon = esc_attr( $options['menu_icon'] );

	}

	return $icon;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_button_icon' );

// menu button text
function fdm_responsive_menu_button_text( $text ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_text'] ) && ! empty( $options['menu_text'] ) ) {

		$text = esc_attr( $options['menu_text'] );

	}

	return $text;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_button_text' );

// Menu Position
function fdm_responsive_menu_position() {

	$position = 'right';

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_position'] ) && ! empty( $options['menu_position'] ) ) {

		$position = sanitize_text_field( $options['menu_position'] );

	}
    return $position;
}
add_action( 'wp_footer', 'fdm_responsive_menu_position' );

// Menu Displacement
function fdm_responsive_menu_displacement() {

	$displacement = false;

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_displacement'] ) && ! empty( $options['menu_displacement'] ) ) {

		$displacement = sanitize_text_field( $options['menu_displacement'] );

	}

	return $displacement;

}
add_action( 'wp_footer', 'fdm_responsive_menu_displacement' );

// Menu Selection
function fdm_responsive_menu_selection() {

	$menu = 'default';

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['nav_menu'] ) && ! empty( $options['nav_menu'] ) ) {

		$menu = sanitize_text_field( $options['nav_menu'] );

	}

	$args = array( 'menu' => $menu, 'echo' => false );

	wp_nav_menu( $args );

}
add_action( 'wp_footer', 'fdm_responsive_menu_selection' );

// FontAwesome
function fdm_responsive_menu_fontawesome() {

	$styles = false;

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['fontawesome'] ) && ! empty( $options['fontawesome'] ) ) {

		$styles = sanitize_text_field( $options['fontawesome'] );

	}

	if ( true == $styles ) {

		//wp_enqueue_style( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/myplugin-login.css', array(), null, 'screen' );

		wp_enqueue_script( 'fontawesome_script', '//use.fontawesome.com/releases/v5.0.8/js/all.js', array(), null, true );

	}

}
add_action( 'wp_footer', 'fdm_responsive_menu_fontawesome' );

// SIDR Renaming
function fdm_responsive_menu_sidr_renaming() {

	$renaming = false;

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['sidr_renaming'] ) && ! empty( $options['sidr_renaming'] ) ) {

		$renaming = sanitize_text_field( $options['sidr_renaming'] );

	}

	return $renaming;
}
add_action( 'wp_footer', 'fdm_responsive_menu_sidr_renaming' );

// Site Logo
function fdm_responsive_menu_site_logo( $url ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['site_logo'] ) && ! empty( $options['site_logo'] ) ) {

		$url = esc_url( $options['site_logo'] );

	}

	return $url;

}
add_action( 'wp_footer', 'fdm_responsive_menu_site_logo' );

// Icons
function fdm_responsive_menu_icon( $icon ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['social_icon_1'] ) && ! empty( $options['social_icon_1'] ) ) {

		$icon = esc_attr( $options['social_icon_1'] );

	}

	return $icon;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_icon' );

// Icon Links
function fdm_responsive_menu_site_icon_links( $url ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['social_icon_link_1'] ) && ! empty( $options['social_icon_link_1'] ) ) {

		$url = esc_url( $options['social_icon_link_1'] );

	}

	return $url;

}
add_action( 'wp_footer', 'fdm_responsive_menu_site_icon_links' );

// Custom Link Icons
function fdm_responsive_menu_custom_link_icon( $icon) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['custom_link_icon_1'] ) && ! empty( $options['custom_link_icon_1'] ) ) {

		$icon = esc_attr( $options['custom_link_icon_1'] );

	}

	return $icon;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_custom_link_icon' );

// Custom Link
function fdm_responsive_menu_custom_link( $link ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['custom_link_1'] ) && ! empty( $options['custom_link_1'] ) ) {

		$link = esc_attr( $options['custom_link_1'] );

	}

	return $link;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_custom_link' );

// Custom Link Text
function fdm_responsive_menu_custom_link_text( $text ) {

	$options = get_option( 'fdm_responsive_menu_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['custom_link_text_1'] ) && ! empty( $options['custom_link_text_1'] ) ) {

		$text = esc_attr( $options['custom_link_text_1'] );

	}

	return $text;

}
add_filter( 'wp_footer', 'fdm_responsive_menu_custom_link_text' );

// Menu Button Color
function fdm_responsive_menu_button_color( $color ) {

	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_button_color'] ) && ! empty( $options['menu_button_color'] ) ) {

		$color = esc_attr( $options['menu_button_color'] );

	}

	return $color;

}
add_action( 'admin_head', 'fdm_responsive_menu_button_color' );

// Menu Background Color
function fdm_responsive_menu_background_color( $color ) {

	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_background_color'] ) && ! empty( $options['menu_background_color'] ) ) {

		$color = esc_attr( $options['menu_background_color'] );

	}

	return $color;

}
add_action( 'admin_head', 'fdm_responsive_menu_background_color' );

// Menu Link Color
function fdm_responsive_menu_link_color( $color ) {

	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['menu_link_color'] ) && ! empty( $options['menu_link_color'] ) ) {

		$color = esc_attr( $options['menu_link_color'] );

	}

	return $color;

}
add_action( 'admin_head', 'fdm_responsive_menu_link_color' );

// Icon Link Color
function fdm_responsive_icon_link_color( $color ) {

	$options = get_option( 'fdm_responsive_menu_style_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['icon_link_color'] ) && ! empty( $options['icon_link_color'] ) ) {

		$color = esc_attr( $options['icon_link_color'] );

	}

	return $color;

}
add_action( 'admin_head', 'fdm_responsive_icon_link_color' );

// Break Point
function fdm_responsive_menu_break_point( $breakpoint ) {

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['break_point'] ) && ! empty( $options['break_point'] ) ) {

		$breakpoint = esc_attr( $options['break_point'] );

	}

	return $breakpoint;

}
add_action( 'wp_head', 'fdm_responsive_menu_break_point' );

// Hide Main Menu
function fdm_responsive_menu_hide_main_menu( $classID ) {

	$options = get_option( 'fdm_responsive_menu_settings_options', fdm_responsive_menu_options_default() );

	if ( isset( $options['main_menu_hide'] ) && ! empty( $options['main_menu_hide'] ) ) {

		$classID = esc_attr( $options['main_menu_hide'] );

	}

	//return $classID;
	$menuBreakPoint = ( !empty( $options['break_point'] ) ? $options['break_point'] : '768' ); ?>
    <style>
        @media (max-width: <?php echo $menuBreakPoint; ?>px){
            <?php echo $classID; ?>{
                display: none!important;
            }
            #mobile-header {
                display: block;
            }
        }
    </style>
    <?php

}
add_action( 'wp_footer', 'fdm_responsive_menu_hide_main_menu', 99999 );

// Compile SCSS
function compiled_scss() {
	global $scss;

	$menuBackgroundColor = ( !empty( fdm_responsive_menu_background_color('') ) ? fdm_responsive_menu_background_color('') : '#333' );
	$menuLinkColor = ( !empty( fdm_responsive_menu_link_color('') ) ? fdm_responsive_menu_link_color('') : '#fff' );
	$iconLinkColor = ( !empty( fdm_responsive_icon_link_color('') ) ? fdm_responsive_icon_link_color('') : '#fff' );
	$menuButtonColor = ( !empty( fdm_responsive_menu_button_color('') ) ? fdm_responsive_menu_button_color('') : '#000' );

    $css = $scss->compile('
              
            $menuBackground: '.$menuBackgroundColor.';
            $boxShadow: darken($menuBackground, 5%);
            $border: darken($menuBackground, 6%);
            $menuLinkColor: '.$menuLinkColor.';
            $iconLinkColor: '.$iconLinkColor.';
            $menuButtonColor: '.$menuButtonColor.';
	
	       #responsive-menu-button{
	            color: $menuButtonColor;
	       }
            #sidr-main.sidr {
                background: $menuBackground;
                box-shadow: 0 0 5px 5px $boxShadow inset;
            }
            .sidr p a {
              color: $menuLinkColor;
            }
            .sidr ul {
              border-top: 1px solid $border;
              border-bottom: 1px solid $border;
            }
            .sidr ul li {
              border-top: 1px solid $border;
              border-bottom: 1px solid $border;
            }
            .sidr ul li:hover,
            .sidr ul li.active,
            .sidr ul li.sidr-class-active {
              border-top: 1px solid $border;
            }
            .sidr ul li:hover>a,
            .sidr ul li:hover>span,
            .sidr ul li.active>a,
            .sidr ul li.active>span,
            .sidr ul li.sidr-class-active>a,
            .sidr ul li.sidr-class-active>span {
              box-shadow: 0 0 15px 3px $boxShadow inset
            }
            .sidr ul li ul li:hover,
            .sidr ul li ul li.active,
            .sidr ul li ul li.sidr-class-active {
              border-top: 1px solid $border;
            }
            .sidr ul li ul li:hover>a,
            .sidr ul li ul li:hover>span,
            .sidr ul li ul li.active>a,
            .sidr ul li ul li.active>span,
            .sidr ul li ul li.sidr-class-active>a,
            .sidr ul li ul li.sidr-class-active>span {
              box-shadow: 0 0 15px 3px $boxShadow inset
            }
            .sidr ul li a,
            .sidr ul li span {
              color: $menuLinkColor;
            }
            .sidr ul li ul li a,
            .sidr ul li ul li span {
              color: $menuLinkColor;
            }
            
            #sidr-main .icons .icon a{
                color: $iconLinkColor;
            }
            .custom-icon{
                text-align: center;
                padding-top: 20px;
                a{
                    color: $menuLinkColor;
                    text-decoration: none;
                }
            }
        ');

	echo '<style>';
	echo $css;
	echo '</style>';

}
add_action( 'wp_head', 'compiled_scss' );