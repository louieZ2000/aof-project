<?php




/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	// wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/plugins/response.min.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );










// ensure EXT is defined
if ( ! defined('EXT')) {
	define('EXT', '.php');
}

#
# See: wpgrade-config.php -> include-paths for additional theme specific
# function and class includes
#

// ensure REQUEST_PROTOCOL is defined
if ( ! defined('REQUEST_PROTOCOL')) {
	if (is_ssl()) {
		define( 'REQUEST_PROTOCOL', 'https:' );
	} else {
		define( 'REQUEST_PROTOCOL', 'http:' );
	}
}

// Theme specific settings
// -----------------------

// add theme support for post formats
// child themes note: use the after_setup_theme hook with a callback
//$formats = array('video', 'audio', 'gallery', 'image', 'link');
//add_theme_support('post-formats', $formats);

// Initialize system core
// ----------------------

require_once 'wpgrade-core/bootstrap'.EXT;

#
# Please perform any initialization via options in wpgrade-config and
# calls in wpgrade-core/bootstrap. Required for testing.
#

/**
 * http://codex.wordpress.org/Content_Width
 */
if ( ! isset($content_width)) {
	$content_width = 960;
}

show_admin_bar(false);
