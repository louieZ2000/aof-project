<?php
	/* @var string $main_color */
	/* @var array  $fonts */
	/* @var string $rgb */


$main_color = wpgrade::option('main_color');

//if we are in a category page then let's see if we have a custom accent color
if (is_category()) {
	//first get the current category ID
	$cat_id = get_query_var('cat');
	//get the color
	$cat_color = get_category_color($cat_id);
	
	if ($cat_color) {
		$main_color = $cat_color;
	}
} else if (is_single()) { //also for single posts we also take the color of the first category
	//get the categories
	$categories = get_the_category();
	if (!empty($categories)) {
		//get the color
		$cat_color = get_category_color($categories[0]->cat_ID);

		if ($cat_color) {
			$main_color = $cat_color;
		}
	}
}


$rgb = implode(',', wpgrade::hex2rgb_array($main_color));
$fonts = array();

if (wpgrade::option('use_google_fonts')) {
	$fonts_array = array
	(
		'google_titles_font',
		'google_second_font',
		'google_nav_font',
		'google_body_font'
	);

	foreach ($fonts_array as $font) {
		$the_font = wpgrade::get_the_typo($font);
		if ( isset($the_font['font-family'] ) && ! empty($the_font['font-family'])) {
			$fonts[$font] = $the_font;
		}
	}
}

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
//     return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

if ( !empty($main_color) ){
$rgb = implode(",", hex2rgb($main_color)); ?>
a:hover, .small-link, .tabs__nav a.current, 
.tabs__nav a:hover, .widget--footer__title em, 
.small-link,
a:hover > .pixcode--icon,
.nav--main > li a:hover, .nav--main > li a:hover:after,
.pagination--archive ol li:first-child a:hover, 
.pagination--archive ol li:last-child a:hover,
.meta-box--portfolio a:hover,
.site-navigation__trigger:hover .nav-text {
    color: <?php echo $main_color; ?>;
}

select:focus, textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .form-control:focus{
    outline: 1px solid <?php echo $main_color; ?>;
}

.mosaic__item a{
    color: white;
}

a:hover{
    border-color: <?php echo $main_color ?>;
}
 
.pagination .pagination-item--current span,
.pagination li a:hover, .pagination li span:hover, 
.rsNavSelected, .progressbar__progress,
.btn:hover, .comments_add-comment:hover, 
.form-submit #comment-submit:hover,
.widget_tag_cloud a:hover, .btn--primary,
.comments_add-comment, .form-submit #comment-submit,
a:hover > .pixcode--icon.circle, a:hover > .pixcode--icon.square,
.btn--add-to-cart, .wpcf7-form-control.wpcf7-submit, .pagination--archive ol li a:hover,
.pixproof-border-gallery .proof-photo.selected .background-container {
    background: <?php echo $main_color; ?>;
}

@media only screen and (min-width: 900px){
    .nav--main li:hover, .nav--main li.current-menu-item {
        border-bottom-color: <?php echo $main_color; ?>;     
    }
    .back-to-top a:hover:after, .back-to-top a:hover:before {
        border-color: <?php echo $main_color; ?>; 
    }
}

@media only screen and (min-width: 1201px){
    .team-member__profile  {
        background: rgba(<?php echo $rgb ?>, 0.5);
    }
}

ol {
    border-left: 0 solid <?php echo $main_color; ?>;
}

blockquote, h3.emphasize{
    border-left: 12px solid <?php echo $main_color; ?>;
}
<?php }

// Border Background Color
$border_bg_color = wpgrade::option('border_bg_color');
if ( !empty($border_bg_color) ){ ?>
.fixed-bar {
    background: <?php echo $border_bg_color; ?>;
}

@media only screen and (max-width: 899px) {
  .site-footer {
    background: <?php echo $border_bg_color; ?>;
  }
}

.site-logo--text{
   background: <?php echo $border_bg_color; ?>; 
}
<?php }

// Border Content Color
$border_content_color = wpgrade::option('border_content_color');
if ( !empty($border_content_color) ){ ?>
.fixed-bar, .fixed-bar a,
.site-navigation__trigger .nav-text,
.slider-controls__arrows {
    color:<?php echo $border_content_color; ?>;
}
.site-header .site-navigation__trigger .nav-icon, 
.site-header .site-navigation__trigger .nav-icon:after, 
.site-header .site-navigation__trigger .nav-icon:before,
.slider-controls__bullets .rsNavSelected {
    background-color:<?php echo $border_content_color; ?>;
}
.article-navigation .navigation-item--previous .arrow:before {
    border-color:<?php echo $border_content_color; ?>;
}
<?php }
$border_size = wpgrade::option('border_size');
if ( !empty($border_size) ){ ?>


@media only screen and (min-width: 900px) {

.wrapper{
    padding: <?php echo $border_size; ?>px;
}

.horizontal-bar, .site-header, .site-footer,
.archive-categories-wrapper
{
    height: <?php echo $border_size; ?>px;
}

.vertical-bar, .slider-arrow, .slider-controls__bullets, 
.slider-controls__arrows .slider-arrow,
.article-navigation .navigation-item .arrow{
    width: <?php echo $border_size; ?>px;
}

.site-header, .site-footer{
    padding-left: <?php echo $border_size; ?>px;
    padding-right: <?php echo $border_size; ?>px;
}

.site-home-title{
    height: <?php echo $border_size; ?>px;
}

.footer__container {
height: <?php echo $border_size; ?>px;
}

.wrapper, .content--gallery-slider, .content--client-area{
    padding: <?php echo $border_size; ?>px;
}


.navigation-container {
    top: <?php echo $border_size; ?>px;
    right: <?php echo $border_size; ?>px;
    bottom: <?php echo $border_size; ?>px;
}

html body.admin-bar .navigation-container{
    top: <?php echo $border_size+32; ?>px;
}

.article--split__left {
	top: <?php echo $border_size; ?>px;
	left: <?php echo $border_size; ?>px;
	bottom: <?php echo $border_size; ?>px;
}

html body.admin-bar .article--split__left{
    top: <?php echo $border_size + 32; ?>px;
}

.archive-categories-wrapper {
	right: <?php echo $border_size; ?>px;
}
}

<?php }

/*@media screen and (min-width: 900px){
    .logo-overflow .site-home-title{
        top: -<?php echo $border_size/2;?>px;
    }
}*/

// Tiled Page Background Color
$bg_tiled = wpgrade::option('bg_tiled');
if ( !empty($bg_tiled) ){ ?>
.bg--tiled {
    background-color:<?php echo $bg_tiled; ?>;
}
<?php }

// Content Page Background Color
$bg_text = wpgrade::option('bg_text');
if ( !empty($bg_text) ){ ?>
.bg--text {
    background-color:<?php echo $bg_text; ?>;
}
<?php }

// Typography
if ( isset($fonts['google_titles_font']) ) {?>
	/* Select classes here */
    .badge, h1, h2, h3, h4, h5, h6, hgroup,
    .hN, .article__author-name, .comment__author-name,
    .widget_calendar caption, blockquote,
    .tabs__nav, .popular-posts__time,
    .heading .hN,
    .heading .comment__author-name,  
    .widget_calendar .heading caption, .latest-comments__author,
    .pagination li a, .pagination li span,
    .heading span.archive__side-title, .article__content .first-letter{
		<?php wpgrade::display_font_params($fonts['google_titles_font']); ?>
	}

<?php }

if ( isset($fonts['google_nav_font']) ) {?>
	/* Select classes here */
    .navigation--main a, .navigation--main .menu-back, .border-menu {
		<?php wpgrade::display_font_params($fonts['google_nav_font']); ?>
	}

<?php }

if ( isset($fonts['google_body_font']) ) {

    if(isset($fonts['google_body_font']['font-size'])) {
        $font_size = $fonts['google_body_font']['font-size'];
        unset($fonts['google_body_font']['font-size']);
    } ?>
	/* Select classes here */
	html, .wp-caption-text, .small-link, 
    .post-nav-link__label, .author__social-link,
    .comment__links, .score__desc  {
		<?php wpgrade::display_font_params($fonts['google_body_font']); ?>
	}
 <?php if ( !empty($font_size) ) { ?>
    /* Size Classes */
    .article, .single .main, .page .main, 
    .comment__content,
    .footer__widget-area  {
        font-size: <?php echo $font_size ?>;
    }

<?php }
}
if (wpgrade::option('custom_css')):
	echo "\n" . wpgrade::option('custom_css') . "\n";
endif;

