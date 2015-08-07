<?php

	/*
	 * Register custom menus.
	 * This works on 3.1+
	 */
	function wpgrade_register_custom_menus() {
//		wpgrade::options()->set
//			(
//				'nav_menus',
//				array
//				(
//                    'main_menu' => __('Header Menu', 'border_txtd'),
//					'top_menu_left' => __('Top Menu Left', 'border_txtd'),
//                    'top_menu_right' => __('Top Menu Right', 'border_txtd'),
//					'footer_menu' => __('Footer Menu', 'border_txtd'),
//				)
//			);

		add_theme_support('menus');
		$menus = wpgrade::confoption('import_nav_menu');
		foreach ($menus as $key => $value) {
			register_nav_menu($key, $value);
		}
	}

	add_action("after_setup_theme", "wpgrade_register_custom_menus");


    /*
     * Function for displaying The Main Header Menu
     */
	function wpgrade_main_nav() {
		// test if there are menu locations to prevent errors
		$theme_locations = get_nav_menu_locations();

//		if (isset($theme_locations["main_menu"]) && ($theme_locations["main_menu"] != 0)) {
//			require_once(wpgrade::themefilepath('theme-utilities/includes/WPGrade_Border_Walker_Nav_Menu.php'));
			
			$args = array
				(
					'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  nav--main  sub-menu',
                    'menu_id'         => '',
                    'fallback_cb'     => 'wpgrade_please_select_a_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new WPGrade_Arrow_Walker_Nav_Menu()
                );

            wp_nav_menu($args);
//        }
    }

    /*
     * Function for displaying The Main Header Menu
     */
    function wpgrade_main_nav_mobile() {
        // test if there are menu locations to prevent errors
        $theme_locations = get_nav_menu_locations();

//        if (isset($theme_locations["main_menu"]) && ($theme_locations["main_menu"] != 0)) {
//            require_once(wpgrade::themefilepath('theme-utilities/includes/WPGradBorderit_Walker_Nav_Menu.php'));
            
            $args = array
                (
                    'theme_location'  => 'main_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  nav--main',
                    'menu_id'         => '',
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                );

            wp_nav_menu($args);
//        }
    }    

    /*
     * Function for displaying The Top Left Menu 
     */

    function wpgrade_top_nav_left($menu_classes = 'nav--top-left  flush--bottom', $mobile = false) {
        $theme_locations = get_nav_menu_locations();
        $wrap = '';
        if($mobile) $wrap = '<hr class="separator  separator--mobile-nav" />';
//
//        if (isset($theme_locations["top_menu_right"]) && ($theme_locations["top_menu_right"] != 0)) {
//          require_once(wpgrade::themefilepath('theme-utilities/includes/WPGBorderBorder_Walker_Nav_Menu.php'));
            $args = array
                (
                    'theme_location'  => 'top_menu_left',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  ' . $menu_classes,
                    'fallback_cb'     => false,
                    'menu_id'         => '',
                    'echo'            => false,
                    'depth'           => 1,
                    'items_wrap'      => $wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>',
//                    'walker'          => new WPBorder_Border_Walker_Top_Nav_Menu()
                );

            $menu = wp_nav_menu($args);
//        }

        if ( empty( $menu ) ) {
            return false;
        } else {
            return $menu;
        }

    }


	/*
     * Function for displaying The Top Right Menu 
     */
    function wpgrade_top_nav_right($menu_classes = 'nav--top-right  flush--bottom', $mobile = false) {
        $theme_locations = get_nav_menu_locations();
        $wrap = '';
        if($mobile) $wrap = '<hr class="separator  separator--mobile-nav" />';
//
//        if (isset($theme_locations["top_menu_right"]) && ($theme_locations["top_menu_right"] != 0)) {
//			require_once(wpgrade::themefilepath('theme-utilities/includes/WPGBorderBorder_Walker_Nav_Menu.php'));
            $args = array
                (
                    'theme_location'  => 'top_menu_right',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav  ' . $menu_classes,
                    'fallback_cb'     => false,
                    'menu_id'         => '',
	                'echo'            => false,
                    'depth'           => 1,
                    'items_wrap'      => $wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>',
//                    'walker'          => new WPBorder_Border_Walker_Top_Nav_Menu()
                );

            $menu = wp_nav_menu($args);
//        }

	    if ( empty( $menu ) ) {
		    return false;
	    } else {
		    return $menu;
	    }

    }


    /*
     * Function for displaying The Footer Menu
     */
	function wpgrade_footer_nav() {
        $theme_locations = get_nav_menu_locations();

        if (isset($theme_locations["footer_menu"]) && ($theme_locations["footer_menu"] != 0)) {
            $args = array
                (
                    'theme_location'  => 'footer_menu',
                    'menu'            => '',
                    'container'       => '',
                    'container_id'    => '',
//                    'menu_class'      => 'site-navigation site-navigation--footer site-navigation--secondary flush--bottom',
                    'menu_class'      => 'footer-menu',
                    'fallback_cb'     => 'wp_page_menu',
                    'menu_id'         => '',
					'depth'			  => 1,
					'items_wrap'      => '<ul id="%1$s" class="%2$s  nav  flush--bottom  border-menu">%3$s</ul>',
                );

            wp_nav_menu($args);
		}
	}

	function wpgrade_please_select_a_menu(){
		echo '
		<ul class="nav  nav--main sub-menu" >
			<li><a href="'. admin_url('nav-menus.php?action=locations') .'">'.__('Please select a menu in this location', 'border_txtd' ) .'</a></li>
		</ul>';
	}