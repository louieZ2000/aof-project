<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till the main content
 *
 * @package Border
 * @since   Border 1.0
 */


//detect what type of content are we displaying
$schema_org = '';
if ( is_singular( wpgrade::shortname() . '_portfolio' ) ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/CreativeWork"';
} elseif ( is_singular( wpgrade::shortname() . '_gallery' ) ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/CreativeWork"';
} elseif ( is_single() ) {
	$schema_org .= ' itemscope itemtype="http://schema.org/Article"';
} else {
	$schema_org .= ' itemscope itemtype="http://schema.org/WebPage"';
}
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if IE 9]>
<html class="ie9" <?php language_attributes(); echo $schema_org; ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); echo $schema_org; ?>> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="MobileOptimized" content="320">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	/**
	 * One does not simply remove this and walk away alive!
	 */
	wp_head(); ?>
</head>
<?php

$class_name = '';

if ( wpgrade::option( 'enable_copyright_overlay' ) ) {
	$class_name .= '  is--copyright-protected  ';
}

if ( is_page() && get_page_template_slug( wpgrade::lang_original_post_id( get_the_ID() ) ) == 'template-journal.php' ) {
	$class_name .= ' blog';
}

$data_ajaxloading = ( wpgrade::option( 'use_ajax_loading' ) == 1 ) ? 'data-ajaxloading' : '';
$class_name .= ( wpgrade::option( 'use_ajax_loading' ) == 1 ) ? ' animations' : '';
$data_smoothscrolling = ( wpgrade::option( 'use_smooth_scroll' ) == 1 ) ? 'data-smoothscrolling' : '';

//we use this so we can generate links with post id
//right now we use it to change the Edit Post link in the admin bar
$data_currentid = '';
if ( ( wpgrade::option( 'use_ajax_loading' ) == 1 ) ) {
	global $wp_the_query;
	$current_object = $wp_the_query->get_queried_object();

	if ( ! empty( $current_object->post_type ) && ( $post_type_object = get_post_type_object( $current_object->post_type ) ) && current_user_can( 'edit_post', $current_object->ID ) && $post_type_object->show_ui && $post_type_object->show_in_admin_bar ) {
		$data_currentid = 'data-curpostid="' . $current_object->ID . '"';
	} elseif ( ! empty( $current_object->taxonomy ) && ( $tax = get_taxonomy( $current_object->taxonomy ) ) && current_user_can( $tax->cap->edit_terms ) && $tax->show_ui ) {
		$data_currentid = 'data-curpostid="' . $current_object->term_id . '"';
	}
} ?>

<body <?php body_class( $class_name ); echo ' ' . $data_ajaxloading . ' ' . $data_currentid . ' ' . $data_smoothscrolling . ' ' ?> >
	<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
		your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
		improve your experience.</p>
	<![endif]-->
	<div class="pace-activity"></div>
	<?php if ( wpgrade::option( 'enable_copyright_overlay' ) ) { ?>
		<div class="copyright-overlay">
			<div class="copyright-overlay__container">
				<div class="copyright-overlay__content">
					<?php echo wpgrade::option( 'copyright_overlay_text' ) ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="wrapper  js-wrapper">
		<div class="navigation-container" id="push-menu">
			<div class="navigation  navigation--main" id="js-navigation--main">
				<h2 class="accessibility"><?php _e( 'Primary Navigation', 'border_txtd' ) ?></h2>
				<?php

				wpgrade_main_nav();

				get_sidebar( 'menu' );

				?>
			</div><!-- .navigation  .navigation--main -->
		</div>

		<div class="fixed-bar  horizontal-bar  top-bar">
			
			<header class="site-header  flexbox<?php if ( ! empty( $top_right_menu ) ) { echo '  has--right-menu'; } ?>">
				<?php get_template_part( 'theme-partials/header/nav-icon' ); ?>
				<div class="flexbox__item">
					<?php get_template_part( 'theme-partials/header/branding' ); ?>
					

					<div class="grid">
						<div class="grid__item  menu-top--left__container">
							
						</div><!--
						--><div class="grid__item  menu-top--right__container">
							
						</div>
					</div>


					<div class="sidebar--menu  nav-top--mobile">
						<?php
						$top_left_menu_mobile = wpgrade_top_nav_left( 'menu--list  push-half--bottom' );
						if ( ! empty( $top_left_menu_mobile ) ) {
							echo '<hr class="separator separator--light">' . $top_left_menu_mobile;
						}

						$top_right_menu_mobile = wpgrade_top_nav_right( 'menu--list  push-half--bottom' );
						if ( ! empty( $top_right_menu_mobile ) ) {
							echo '<hr class="separator separator--light">' . $top_right_menu_mobile;
						} ?>
					</div>
				</div>
				
			</header><!-- .site-header -->
		</div>


		<div class="fixed-bar  vertical-bar  left-bar">  
				<a href="" class="appointment-link">


					
<svg version="1.1" id="appointments" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="60px" height="200px" viewBox="0 0 48 144" enable-background="new 0 0 48 144" xml:space="preserve">
<g>
	<path   d="M30,122.3v3.7h-0.3v-1.2l-3.5,1.3v4l3.5,1.3v-1.2H30v2.7h-0.3v-0.7c0-0.2-0.1-0.3-0.3-0.3l-10.8-4v-0.6l10.8-4
		c0.2-0.1,0.3-0.2,0.3-0.3v-0.7H30z M20.8,128l4.9,1.8v-3.6L20.8,128z"/>
	<path d="M33.3,120.8H22.8c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3V121c0-0.7,0-1.2-0.1-1.5h2.5c-0.9-0.2-1.5-0.5-2-1
		c-0.4-0.5-0.7-1-0.7-1.5c0-0.8,0.4-1.4,1.1-2s1.8-0.9,3-0.9s2.2,0.3,3,1s1.1,1.5,1.1,2.6c0,0.7-0.2,1.3-0.5,1.8h3.6
		c0.2,0,0.3-0.1,0.3-0.3v-1.2h0.3v3.9h-0.3v-0.8C33.6,120.9,33.5,120.8,33.3,120.8z M26.2,115.5c-1.1,0-2,0.2-2.6,0.5
		c-0.6,0.3-0.9,0.8-0.9,1.3c0,0.5,0.4,1,1.1,1.5c0.7,0.4,1.7,0.7,3.1,0.7h2.4c0.3-0.5,0.5-1.1,0.5-1.7s-0.3-1.2-1-1.6
		C28.2,115.8,27.3,115.5,26.2,115.5z"/>
	<path d="M33.3,111.8H22.8c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3V112c0-0.7,0-1.2-0.1-1.5h2.5c-0.9-0.2-1.5-0.5-2-1
		c-0.4-0.5-0.7-1-0.7-1.5c0-0.8,0.4-1.4,1.1-2s1.8-0.9,3-0.9s2.2,0.3,3,1s1.1,1.5,1.1,2.6c0,0.7-0.2,1.3-0.5,1.8h3.6
		c0.2,0,0.3-0.1,0.3-0.3v-1.2h0.3v3.9h-0.3v-0.8C33.6,111.9,33.5,111.8,33.3,111.8z M26.2,106.5c-1.1,0-2,0.2-2.6,0.5
		c-0.6,0.3-0.9,0.8-0.9,1.3c0,0.5,0.4,1,1.1,1.5c0.7,0.4,1.7,0.7,3.1,0.7h2.4c0.3-0.5,0.5-1.1,0.5-1.7s-0.3-1.2-1-1.6
		C28.2,106.8,27.3,106.5,26.2,106.5z"/>
	<path d="M29.1,102.7c-0.7,0.7-1.7,1-3,1c-1.3,0-2.3-0.3-3-1c-0.7-0.7-1.1-1.5-1.1-2.6c0-1.1,0.4-2,1.1-2.6c0.7-0.7,1.7-1,3-1
		c1.3,0,2.3,0.3,3,1c0.7,0.7,1.1,1.6,1.1,2.6C30.2,101.2,29.9,102,29.1,102.7z M23.4,101.7c0.7,0.4,1.6,0.6,2.7,0.6
		c1.1,0,2-0.2,2.7-0.6c0.7-0.4,1-1,1-1.6c0-0.6-0.3-1.2-1-1.6c-0.7-0.4-1.6-0.7-2.7-0.7c-1.1,0-2,0.2-2.7,0.7c-0.7,0.4-1,1-1,1.6
		C22.4,100.7,22.7,101.3,23.4,101.7z"/>
	<path d="M20.2,93.8c-0.2,0.2-0.4,0.2-0.6,0.2c-0.2,0-0.4-0.1-0.6-0.2c-0.2-0.2-0.2-0.4-0.2-0.6s0.1-0.4,0.2-0.6
		c0.2-0.2,0.4-0.2,0.6-0.2c0.2,0,0.4,0.1,0.6,0.2c0.2,0.2,0.2,0.4,0.2,0.6S20.4,93.6,20.2,93.8z M29.4,93.8h-6.6
		c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3V94c0-0.7,0-1.2-0.1-1.5h7.3c0.1,0,0.2-0.1,0.2-0.3v-0.8H30v3.5h-0.3v-0.8
		C29.7,93.9,29.6,93.8,29.4,93.8z"/>
	<path d="M24.8,82.7h4.7c0.1,0,0.2-0.1,0.2-0.3v-0.8H30v3.2h-0.3v-0.6c0-0.2-0.1-0.3-0.2-0.3h-5c-0.6,0-1.1,0.1-1.4,0.4
		c-0.3,0.3-0.4,0.6-0.4,1.1c0,0.6,0.4,1.1,1.1,1.5c0.7,0.4,1.8,0.6,3.2,0.6h2.4c0.2,0,0.3-0.1,0.3-0.3v-0.6H30v3.2h-0.3v-0.8
		c0-0.2-0.1-0.3-0.2-0.3h-6.7c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3v-0.9c0-0.7,0-1.2-0.1-1.5h2.4C22.9,87.3,22,86.4,22,85
		c0-0.6,0.2-1.2,0.7-1.6C23.1,83,23.8,82.7,24.8,82.7z"/>
	<path d="M20.3,78.5v-0.3h1.9v-1.8h0.3v1.8h6.1c0.6,0,1-0.2,1-0.5c0-0.2-0.1-0.3-0.2-0.4s-0.3-0.2-0.5-0.2s-0.4,0-0.6,0.1l-0.1-0.3
		c0.2,0,0.4-0.1,0.6-0.1c0.4,0,0.8,0.1,1,0.4c0.3,0.3,0.4,0.6,0.4,1s-0.2,0.8-0.5,1c-0.3,0.3-0.9,0.4-1.5,0.4h-5.4
		c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3v-0.9C22.2,79.4,21.6,79,20.3,78.5z"/>
	<path d="M24.8,63.4h4.7c0.1,0,0.2-0.1,0.2-0.3v-0.8H30v3.2h-0.3v-0.6c0-0.2-0.1-0.3-0.2-0.3h-5c-0.6,0-1.1,0.1-1.4,0.4
		c-0.3,0.3-0.4,0.6-0.4,1c0,0.6,0.4,1.1,1.2,1.5c0.8,0.4,1.9,0.6,3.3,0.6h2.2c0.2,0,0.3-0.1,0.3-0.3V67H30v3.2h-0.3v-0.6
		c0-0.2-0.1-0.3-0.2-0.3h-5c-0.6,0-1.1,0.1-1.4,0.4c-0.3,0.3-0.4,0.6-0.4,1c0,0.6,0.4,1.1,1.2,1.5c0.8,0.4,1.9,0.6,3.3,0.6h2.2
		c0.2,0,0.3-0.1,0.3-0.3v-0.6H30v3.2h-0.3v-0.8c0-0.2-0.1-0.3-0.2-0.3h-6.7c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3v-0.9
		c0-0.7,0-1.2-0.1-1.5h2.4c-1.7-0.4-2.5-1.2-2.5-2.6c0-0.6,0.2-1.1,0.6-1.5s1.1-0.7,1.9-0.7c-1.7-0.4-2.5-1.2-2.5-2.6
		c0-0.6,0.2-1.1,0.7-1.5C23.1,63.6,23.8,63.4,24.8,63.4z"/>
	<path d="M22,57.3c0-0.8,0.3-1.5,0.8-2c0.6-0.5,1.4-0.7,2.4-0.7c0.2,0,0.5,0,0.7,0v4.9h0.1c1.1,0,2-0.2,2.7-0.6c0.7-0.4,1-0.9,1-1.6
		c0-0.7-0.2-1.2-0.5-1.6c-0.3-0.4-0.8-0.7-1.4-0.9l0.1-0.3c0.7,0.1,1.3,0.5,1.7,1c0.4,0.5,0.6,1.1,0.6,1.8c0,1-0.4,1.9-1.1,2.6
		s-1.7,1-3,1s-2.3-0.3-3-1C22.4,59.2,22,58.3,22,57.3z M24.7,55.9c-1.5,0-2.2,0.6-2.2,1.7c0,0.6,0.3,1,0.9,1.4
		c0.6,0.4,1.4,0.6,2.3,0.6v-3.6C25.2,55.9,24.9,55.9,24.7,55.9z"/>
	<path d="M24.8,45.6h4.7c0.1,0,0.2-0.1,0.2-0.3v-0.8H30v3.2h-0.3v-0.6c0-0.2-0.1-0.3-0.2-0.3h-5c-0.6,0-1.1,0.1-1.4,0.4
		c-0.3,0.3-0.4,0.6-0.4,1.1c0,0.6,0.4,1.1,1.1,1.5c0.7,0.4,1.8,0.6,3.2,0.6h2.4c0.2,0,0.3-0.1,0.3-0.3v-0.6H30v3.2h-0.3v-0.8
		c0-0.2-0.1-0.3-0.2-0.3h-6.7c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3V52c0-0.7,0-1.2-0.1-1.5h2.4c-1.7-0.4-2.6-1.3-2.6-2.7
		c0-0.6,0.2-1.2,0.7-1.6C23.1,45.8,23.8,45.6,24.8,45.6z"/>
	<path d="M20.3,41.4v-0.3h1.9v-1.8h0.3v1.8h6.1c0.6,0,1-0.2,1-0.5c0-0.2-0.1-0.3-0.2-0.4s-0.3-0.2-0.5-0.2s-0.4,0-0.6,0.1l-0.1-0.3
		c0.2,0,0.4-0.1,0.6-0.1c0.4,0,0.8,0.1,1,0.4c0.3,0.3,0.4,0.6,0.4,1s-0.2,0.8-0.5,1c-0.3,0.3-0.9,0.4-1.5,0.4h-5.4
		c-0.2,0-0.3,0.1-0.3,0.3v0.8h-0.3v-0.9C22.2,42.2,21.6,41.8,20.3,41.4z"/>
	<path d="M25.1,35.9l0.7-1.9c0.2-0.4,0.4-0.8,0.8-1c0.3-0.2,0.7-0.4,1.1-0.4c0.6,0,1.2,0.3,1.7,0.8c0.5,0.5,0.8,1.2,0.8,2.1
		s-0.2,1.7-0.5,2.5c-0.3-0.1-0.8-0.1-1.5-0.1h-0.7v-0.3l0.9-0.1c0.9-0.1,1.4-0.7,1.4-1.9c0-0.5-0.2-0.9-0.5-1.3
		c-0.3-0.3-0.7-0.5-1.1-0.5c-0.6,0-1,0.3-1.2,1l-0.7,1.9c-0.2,0.4-0.4,0.7-0.7,1s-0.7,0.3-1.1,0.3c-0.6,0-1.2-0.2-1.7-0.7
		c-0.5-0.5-0.7-1-0.7-1.7s0.2-1.5,0.5-2.3c0.3,0.1,0.8,0.1,1.5,0.1h0.7v0.3l-0.9,0.1c-0.9,0.1-1.3,0.6-1.3,1.6
		c0,0.4,0.1,0.8,0.4,1.1s0.6,0.4,1,0.4C24.5,36.9,24.9,36.5,25.1,35.9z"/>
</g>
<path d="M10.4,8.6c4,1.3,7.3,6.1,7.3,6.1s-0.5-1.8-0.9-3.4c6.2,1.8,8.5,6.2,8.5,6.2s-0.5-1.8-0.9-2.9c4.6,1.6,6.1,5.7,6.1,5.7
	s-0.7-2-0.6-2.2c0.1-0.2,3,3.1,3,3.1l9.5,3.1l0.6,1.3l-9.2-2.9l-4.6,0.5l-0.2-1.4l-1.7,1.2c0,0-0.2,0-1.3,0c-1,0-3.3-1.2-3.3-1.2
	l2.6-0.3l-1.5-0.3l1.2-0.4l-0.1-0.3c0,0-3.7,0.5-4.2,0.4s-2.5-1.2-2.5-1.2L17.7,19l0-0.7c0,0-2.8-0.8-4.3-1.5
	c0.4,0.5,3.4,0.5,3.6,0.5c0.1,0,0-0.2-0.2-0.5c0-0.1-1.9-0.3-2-0.4c0-0.1,1.8,0.1,1.7,0c-0.1-0.1-0.2-0.2-0.3-0.3
	c-5-0.5-6.9-3.3-6.9-3.3l1.6-0.8l-0.5-0.3c0,0-2.2-0.2-2.3-0.2c-0.2,0-3-5.5-3-5.5l3.7,1.5l1.8,3.1 M10.7,10.9
	c0,0,15.4,8.9,21.3,10.3c0,0-11.7-4.3-20.8-10.4C11.3,10.9,10.7,10.9,10.7,10.9z"/>
</svg>


				</a>


<!-- 

			<?php $top_left_menu  = wpgrade_top_nav_left( 'border-menu' );



			$top_right_menu = wpgrade_top_nav_right( 'border-menu' );
			?>

			<?php if ( ! empty( $top_right_menu ) ) {
								echo $top_right_menu;
							} ?>

				<?php if ( ! empty( $top_left_menu ) ) {
								echo $top_left_menu;
							} ?> -->

				

		</div>
		 <div class="fixed-bar  vertical-bar  right-bar"></div> 
		<?php
		/**
		 * Display static content like:
		 * - a serialized list with the enqueued resources on page load
		 */
		do_action( wpgrade::shortname() . '_before_dynamic_content' ); ?>

		<div id="main" class="content js-content djax-updatable">