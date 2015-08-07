<?php

$sections = array();

// General Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => 'icon-database-1',
	'icon_class' => '',
	'title'      => __( 'General', 'border_txtd' ),
	'desc'       => sprintf( '<p class="description">' . __( 'General settings contains options that have a site-wide reach like defining your site dynamics or branding (including logo and other icons).', 'border_txtd' ) . '</p>', wpgrade::themename() ),
	'fields'     => array(
		array(
			'id'       => 'use_smooth_scroll',
			'type'     => 'switch',
			'title'    => __( 'Smooth Scrolling', 'border_txtd' ),
			'subtitle' => __( 'Enable / Disable smooth scrolling.', 'border_txtd' ),
			'default'  => '1'
		),
		array(
			'id'       => 'use_ajax_loading',
			'type'     => 'switch',
			'title'    => __( 'Ajax Loading', 'border_txtd' ),
			'subtitle' => __( 'Enable / Disable dynamic page content loading using AJAX.', 'border_txtd' ),
			'default'  => '1'
		),
		array(
			'id'       => 'enable_copyright_overlay',
			'type'     => 'switch',
			'title'    => __( 'Right-Click Protected ?', 'border_txtd' ),
			'subtitle' => __( 'Prevent right-click saving for images.', 'border_txtd' ),
			'default'  => '0',
		),
		array(
			'id'       => 'copyright_overlay_text',
			'type'     => 'text',
			'required' => array( 'enable_copyright_overlay', '=', 1 ),
			'title'    => __( 'Right click protection text', 'border_txtd' ),
			'default'  => 'This content is &copy; 2014 ' . wpgrade::themename() . ' | All rights reserved.',
		),
		array(
			'id'   => 'branding-header-90821',
			'desc' => '<h3>' . __( 'Branding', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'main_logo',
			'type'     => 'media',
			'title'    => __( 'Main Logo', 'border_txtd' ),
			'subtitle' => __( 'If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', 'border_txtd' ),
		),
		array(
			'id'       => 'use_retina_logo',
			'type'     => 'switch',
			'title'    => __( '2x Retina Logo', 'border_txtd' ),
			'subtitle' => __( 'To be Retina-ready you need to add a 2x size logo image.', 'border_txtd' ),
		),
		array(
			'id'       => 'retina_main_logo',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Retina Logo', 'border_txtd' ),
			'required' => array( 'use_retina_logo', 'equals', 1 )
		),
		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Favicon', 'border_txtd' ),
			'subtitle' => __( 'Upload a 16 x 16px image that will be used as a favicon.', 'border_txtd' ),
		),
		array(
			'id'       => 'apple_touch_icon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Apple Touch Icon', 'border_txtd' ),
			'subtitle' => __( 'You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', 'border_txtd' )
		),
		array(
			'id'       => 'metro_icon',
			'type'     => 'media',
			'class'    => 'js-class-hook image--small',
			'title'    => __( 'Metro Icon', 'border_txtd' ),
			'subtitle' => __( 'The size of this icon must be 144x144px.', 'border_txtd' )
		)
	)
);


// Style Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => "icon-params",
	'icon_class' => '',
	'title'      => __( 'Style', 'border_txtd' ),
	'desc'       => '<p class="description">' . __( 'The style options control the general styling of the site, like accent color and Google Web Fonts. You can choose custom fonts for various typography elements with font weight, character set, size and/or line height. You also have a live preview for your chosen fonts.', 'border_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'          => 'main_color',
			'type'        => 'color',
			'title'       => __( 'Main Color', 'border_txtd' ),
			'subtitle'    => __( 'Use the color picker to change the main color of the site to match your brand color.', 'border_txtd' ),
			'default'     => '#2ecc71',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false,
		),
		array(
			'id'   => 'border-219632',
			'desc' => '<h3>' . __( 'Border Area Style', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'          => 'border_bg_color',
			'type'        => 'color',
			'title'       => __( 'Border Background Color', 'border_txtd' ),
			'subtitle'    => __( 'Choose a color for the background of the border area.', 'border_txtd' ),
			'default'     => '#ffffff',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false,
		),
		array(
			'id'          => 'border_content_color',
			'type'        => 'color',
			'title'       => __( 'Border Content Color', 'border_txtd' ),
			'subtitle'    => __( 'Choose a color for the content of the border area (eg. text, links, arrows).', 'border_txtd' ),
			'default'     => '#1a1717',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false,
		),
		array(
			'id'   => 'page-bg-219782',
			'desc' => '<h3>' . __( 'Pages Background', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'          => 'bg_tiled',
			'type'        => 'color',
			'title'       => __( 'Tiled Pages Style Background', 'border_txtd' ),
			'subtitle'    => __( 'Eg. galleries, gallery & portfolio archive.', 'border_txtd' ),
			'default'     => '#1a1717',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false,
		),
		array(
			'id'          => 'bg_text',
			'type'        => 'color',
			'title'       => __( 'Text Pages Style Background', 'border_txtd' ),
			'subtitle'    => __( 'Eg. blog posts, pages.', 'border_txtd' ),
			'default'     => '#f5f5f5',
			'validate'    => 'color',
			'compiler'    => true,
			'transparent' => false,
		),
		array(
			'id'       => 'border_size',
			'type'     => 'text',
			'title'    => __( 'Border Size (px)', 'border_txtd' ),
			'subtitle' => __( 'Set the size of the border area.', 'border_txtd' ),
			'validate' => 'numeric',
			'default'  => '42',
			'class'    => 'small-text',
			'compiler' => true
		),
		array(
			'id'   => 'head-typography-21',
			'desc' => '<h3>' . __( 'Typography', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'use_google_fonts',
			'type'     => 'switch',
			'title'    => __( 'Do you need custom web fonts?', 'border_txtd' ),
			'subtitle' => __( 'Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', 'border_txtd' ),
			'default'  => '0',
			'compiler' => true
		),
		// Headings Font
		array(
			'id'          => 'google_titles_font',
			'type'        => 'typography',
			'google'      => true,
			'color'       => false,
			'font-size'   => false,
			'line-height' => false,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'use_google_fonts', '=', 1 ),
			'title'       => __( 'Headings Font', 'border_txtd' ),
			'subtitle'    => __( 'Font for titles and headings.', 'border_txtd' ),
			'compiler'    => true
		),
		// Navigation Font
		array(
			'id'          => 'google_nav_font',
			'type'        => 'typography',
			'google'      => true,
			'color'       => false,
			'font-size'   => false,
			'line-height' => false,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'use_google_fonts', '=', 1 ),
			'title'       => __( 'Navigation Font', 'border_txtd' ),
			'subtitle'    => __( 'Font for the navigation menu.', 'border_txtd' ),
			'compiler'    => true
		),
		// Body Font
		array(
			'id'         => 'google_body_font',
			'type'       => 'typography',
			'google'      => true,
			'color'      => false,
			'all-styles' => true,
			'text-align'  => false,
			'required'   => array( 'use_google_fonts', '=', 1 ),
			'title'      => __( 'Body Font', 'border_txtd' ),
			'subtitle'   => __( 'Font for content and widget text.', 'border_txtd' ),
			'compiler'   => true
		),
	)
);

// Header/Footer Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Border Area', 'border_txtd' ),
	'desc'   => '<p class="description">' . __( 'Border area options allow you to control both the visual and functional aspects of the border area.', 'border_txtd' ) . '</p>',
	'fields' => array(

		//        array(
		//            'id'=>'top_layout-218293203',
		//            'desc'=> '<h3>'.__('Top', 'border_txtd').'</h3>',
		//            'type' => 'info'
		//        ),
		//
		//        array(
		//            'id'=>'bottom_layout-212135678432',
		//            'desc'=> '<h3>'.__('Bottom', 'border_txtd').'</h3>',
		//            'type' => 'info'
		//        ),
		array(
			'id'       => 'nav_trigger_style',
			'type'     => 'select',
			'title'    => __( 'Main Nav Trigger Layout', 'border_txtd' ),
			'subtitle' => __( 'Choose the layout of the push menu trigger button.', 'border_txtd' ),
			'options'  => array(
				'1' => 'Icon Only',
				'2' => 'Text + Icon',
				'3' => 'Text Only'
			),
			'default'  => '1',
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			)
		),
		array(
			'id'       => 'nav_trigger_icon',
			'type'     => 'select',
			'title'    => __( 'Nav Icon Style:', 'border_txtd' ),
			'options'  => array(
				'1' => 'Three Horizontal Lines',
				'2' => 'Plus Symbol',
				'3' => 'Dots & Horizontal Lines '
			),
			'default'  => '1',
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'required' => array( 'nav_trigger_style', '!=', '3' ),
		),
		array(
			'id'       => 'nav_trigger_text',
			'type'     => 'text',
			'title'    => __( 'Menu Text', 'border_txtd' ),
			//		    'subtitle' => __('Provide a text placeholder for menu icon.', 'border_txtd'),
			'default'  => 'Menu',
			'required' => array( 'nav_trigger_style', '!=', '1' ),
		),
		array(
			'id'       => 'back_to_top',
			'type'     => 'switch',
			'title'    => __( 'Back To Top Link', 'border_txtd' ),
			'subtitle' => __( 'Add a link that helps users jump to the top of the page (instead of pressing the "Home" key).', 'border_txtd' ),
			'default'  => '1',
		),
		array(
			'id'       => 'copyright_text',
			'type'     => 'editor',
			'title'    => __( 'Copyright Text', 'border_txtd' ),
			'subtitle' => sprintf( __( 'Text that will appear in bottom left area (eg. Copyright 2014 %s | All Rights Reserved).', 'border_txtd' ), wpgrade::themename() ),
			'default'  => 'Copyright &copy; 2014 ' . wpgrade::themename() . ' | All rights reserved.',
			'rows'     => 3,
		)

	)
);


// Article Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'   => 'icon-pencil-1',
	'title'  => __( 'Blog', 'border_txtd' ),
	'desc'   => sprintf( '<p class="description">' . __( 'Blog options control the various aspects related to displaying posts both in archives and single pages. You can control things like excerpt length and page layout.', 'border_txtd' ) . '</p>', wpgrade::themename() ),
	'fields' => array(
		array(
			'id'       => 'single_layout',
			'type'     => 'image_select',
			'title'    => __( 'Single Post Layout', 'border_txtd' ),
			'subtitle' => __( 'Choose the layout for single posts.', 'border_txtd' ),
			'default'  => 'split',
			'options'  => array(
				'split'   => array( 'Split', 'img' => wpgrade::resourceuri( 'images/article-split.png' ) ),
				'classic' => array( 'Classic', 'img' => wpgrade::resourceuri( 'images/article-classic.png' ) ),
			)
		),
		array(
			'id'       => 'blog_single_show_share_buttons',
			'type'     => 'switch',
			'title'    => __( 'Show Share Buttons', 'border_txtd' ),
			'subtitle' => __( 'Do you want to show the social share buttons in your posts?', 'border_txtd' ),
			'default'  => '1',
		),
		array(
			'id'   => 'article-21',
			'desc' => '<h3>' . __( 'Blog Archive', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'blog_layout',
			'type'     => 'image_select',
			'title'    => __( 'Blog Archive Layout', 'border_txtd' ),
			'subtitle' => __( 'Choose the layout for blog areas (eg. blog archive page, categories, search results).', 'border_txtd' ),
			'default'  => 'grid',
			'options'  => array(
				'grid'    => array( 'Grid', 'img' => wpgrade::resourceuri( 'images/blog-grid.png' ) ),
				'classic' => array( 'Classic', 'img' => wpgrade::resourceuri( 'images/blog-classic.png' ) ),
			)
		),
		array(
			'id'       => 'blog_excerpt_length',
			'type'     => 'text',
			'title'    => __( 'Excerpt Length', 'border_txtd' ),
			'subtitle' => __( 'Set the number of characters for posts excerpt.', 'border_txtd' ),
			'default'  => '150',
		),
		array(
			'id'       => 'blog_excerpt_more_text',
			'type'     => 'text',
			'title'    => __( 'Excerpt "More" Text', 'border_txtd' ),
			'subtitle' => __( 'Change the default [...] with something else (leave empty if you want to remove it).', 'border_txtd' ),
			'default'  => '..',
		),
	)
);

// Galleries Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Galleries', 'border_txtd' ),
	'desc'   => '<p class="description">' . __( 'Galleries options allow you to style and control various features your galleries use.', 'border_txtd' ) . '</p>',
	'fields' => array(

		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Cover Fonts', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'gallery_type',
			'type'     => 'image_select',
			'title'    => __( 'Select Cover Type:', 'border_txtd' ),
			'subtitle' => __( 'Choose a cover style to change its fonts. Each cover type has it\'s own different font settings.', 'border_txtd' ),
			'default'  => 'type1',
			'options'  => array(
				'type1' => array( 'Type 1', 'img' => wpgrade::resourceuri( 'images/cover-style-1.png' ) ),
				'type2' => array( 'Type 2', 'img' => wpgrade::resourceuri( 'images/cover-style-2.png' ) ),
				'type3' => array( 'Type 3', 'img' => wpgrade::resourceuri( 'images/cover-style-3.png' ) ),
			)
		),
		// Cover Style 1
		array(
			'id'          => 'gallery_cover_title_font_style1',
			'type'        => 'typography',
			'color'       => false,
			'font-size'   => true,
			'units'       => 'em',
			'line-height' => true,
			'all-styles'  => true,
			'text-align'  => false,
			'title'       => '<h4>' . __( 'Cover Style 1', 'border_txtd' ) . '</h4><br/>' . __( 'Title Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'required'    => array( 'gallery_type', '=', 'type1' ),
			'default'     => array(
				'font-style'  => '400',
				'font-family' => 'Montserrat',
				'google'      => true,
				'font-size'   => '3',
				'line-height' => '1',
				'subset'      => 'latin'
			),
		),
		array(
			'id'          => 'gallery_cover_subtitle_font_style1',
			'type'        => 'typography',
			'color'       => false,
			'font-size'   => true,
			'units'       => 'em',
			'line-height' => true,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'gallery_type', '=', 'type1' ),
			'title'       => __( 'Subtitle Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'default'     => array(
				'font-style'  => '400',
				'font-family' => 'Open Sans',
				'google'      => true,
				'font-size'   => '1.12',
				'line-height' => '1',
				'subset'      => 'latin'
			),
		),
		// Cover Style 2
		array(
			'id'          => 'gallery_cover_title_font_style2',
			'type'        => 'typography',
			'color'       => false,
			'font-size'   => true,
			'units'       => 'em',
			'line-height' => true,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'gallery_type', '=', 'type2' ),
			'title'       => '<h4>' . __( 'Cover Style 2', 'border_txtd' ) . '</h4><br/>' . __( 'Title Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'default'     => array(
				'font-style'  => '400',
				'font-family' => 'Oswald',
				'google'      => true,
				'font-size'   => '3.5',
				'line-height' => '1',
				'subset'      => 'latin'
			),
		),
		array(
			'id'          => 'gallery_cover_subtitle_font_style2',
			'type'        => 'typography',
			'color'       => false,
			'all-styles'  => true,
			'units'       => 'em',
			'line-height' => true,
			'text-align'  => false,
			'required'    => array( 'gallery_type', '=', 'type2' ),
			'title'       => __( 'Subtitle Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'default'     => array(
				'font-style'  => 'italic',
				'font-family' => 'Gentium Book Basic',
				'google'      => true,
				'font-size'   => '2.25',
				'line-height' => '1',
				'subset'      => 'latin'
			),
		),
		// Cover Style 3
		array(
			'id'          => 'gallery_cover_title_font_style3',
			'type'        => 'typography',
			'color'       => false,
			'font-size'   => true,
			'units'       => 'em',
			'line-height' => true,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'gallery_type', '=', 'type3' ),
			'title'       => '<h4>' . __( 'Cover Style 3', 'border_txtd' ) . '</h4><br/>' . __( 'Title Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'default'     => array(
				'font-style'  => '900italic',
				'font-family' => 'Playfair Display',
				'google'      => true,
				'font-size'   => '4.5',
				'line-height' => '1.12',
				'subset'      => 'latin'
			),
		),
		array(
			'id'          => 'gallery_cover_subtitle_font_style3',
			'type'        => 'typography',
			'color'       => false,
			'font-size'   => true,
			'units'       => 'em',
			'line-height' => true,
			'all-styles'  => true,
			'text-align'  => false,
			'required'    => array( 'gallery_type', '=', 'type3' ),
			'title'       => __( 'Subtitle Font', 'border_txtd' ),
			'subtitle'    => ' ',
			'default'     => array(
				'font-style'  => '300',
				'font-family' => 'Open Sans',
				'google'      => true,
				'font-size'   => '1.25',
				'line-height' => '1',
				'subset'      => 'latin'
			),
		),
		//        array(
		//            'id'=>'header_layout-21828765',
		//            'desc'=> '<h3>'.__('Others', 'border_txtd').'</h3>',
		//            'type' => 'info'
		//        ),

		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Archives', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'galleries_archive_layout',
			'type'     => 'image_select',
			'title'    => __( 'Archives Layout', 'border_txtd' ),
			'subtitle' => __( 'Choose the layout for galleries archive (eg. galleries archive page, categories).', 'border_txtd' ),
			'default'  => 'grid',
			'options'  => array(
				'grid'    => array( 'Grid', 'img' => wpgrade::resourceuri( 'images/archive-grid.png' ) ),
				'masonry' => array( 'Masonry', 'img' => wpgrade::resourceuri( 'images/archive-masonry.png' ) ),
			)
		),
		array(
			'id'       => 'galleries_per_page',
			'type'     => 'text',
			'title'    => __( 'Galleries Per Page', 'border_txtd' ),
			'subtitle' => __( 'Set the number of galleries to display on each archive page.', 'border_txtd' ),
			'default'  => '6',
		),
		array(
			'id'      => 'galleries_show_archive_title',
			'type'    => 'switch',
			'title'   => __( 'Show galleries archive title', 'border_txtd' ),
			'default' => '0',
			'switch'  => true,
		),
		array(
			'id'       => 'galleries_infinitescroll',
			'type'     => 'switch',
			'title'    => __( 'Infinite Scroll', 'border_txtd' ),
			'subtitle' => __( 'Replace the regular pagination with AJAX loading new items on scroll (will load at once the number of galleries specified above).', 'border_txtd' ),
			'default'  => '1',
			'switch'   => true,
		),
		array(
			'id'       => 'galleries_archive_filtering',
			'type'     => 'switch',
			'title'    => __( 'Filter Links', 'border_txtd' ),
			'subtitle' => __( 'Display filter links (categories) on Galleries Archive Page', 'border_txtd' ),
			'default'  => '1',
			'switch'   => true,
		),
		array(
			'id'       => 'galleries_archive_filtering_style',
			'title'    => __( 'Filter Links  Style', 'border_txtd' ),
			'required' => array( 'galleries_archive_filtering', '=', 1 ),
			'type'     => 'select',
			'default'  => 'horizontal',
			'options'  => array(
				'horizontal' => __( 'Horizontal list', 'border_txtd' ),
				'dropdown'   => __( 'Dropdown', 'border_txtd' )
			),
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
		),
		array(
			'id'       => 'galleries_archive_hide_current_category',
			'type'     => 'switch',
			'title'    => __( 'Hide Current Category', 'border_txtd' ),
			'subtitle' => __( 'Do you want us to hide the current category on the galleries category archives?', 'border_txtd' ),
			'default'  => '0',
			'switch'   => true,
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Sharing', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'galleries_single_show_share_buttons',
			'type'     => 'switch',
			'title'    => __( 'Show Share Buttons', 'border_txtd' ),
			'subtitle' => __( 'Do you want to show the share buttons in your galleries (overwrites single gallery setting)?', 'border_txtd' ),
			'default'  => '1',
		),
	)
);

// Portfolio Options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Portfolio', 'border_txtd' ),
	'desc'   => '<p class="description">' . __( 'Portfolio options allow you to style and control what features your projects use.', 'border_txtd' ) . '</p>',
	'fields' => array(
		array(
			'id'       => 'portfolio_archive_layout',
			'type'     => 'image_select',
			'title'    => __( 'Archives Layout', 'border_txtd' ),
			'subtitle' => __( 'Choose the layout for portfolio archive (eg. portfolio archive page, categories).', 'border_txtd' ),
			'default'  => 'grid',
			'options'  => array(
				'grid'    => array( 'Grid', 'img' => wpgrade::resourceuri( 'images/archive-grid.png' ) ),
				'masonry' => array( 'Masonry', 'img' => wpgrade::resourceuri( 'images/archive-masonry.png' ) ),
			)
		),
		array(
			'id'       => 'portfolio_projects_per_page',
			'type'     => 'text',
			'title'    => __( 'Projects Per Page', 'border_txtd' ),
			'subtitle' => __( 'Set the number of projects to display on each archive page.', 'border_txtd' ),
			'default'  => '6',
		),
		array(
			'id'      => 'portfolio_show_archive_title',
			'type'    => 'switch',
			'title'   => __( 'Show portfolio archive title', 'border_txtd' ),
			'default' => '0',
			'switch'  => true,
		),
		array(
			'id'       => 'portfolio_infinitescroll',
			'type'     => 'switch',
			'title'    => __( 'Infinite Scroll', 'border_txtd' ),
			'subtitle' => __( 'Replace the regular pagination with AJAX loading new items on scroll (we will load at once the number of projects set above).', 'border_txtd' ),
			'default'  => '1',
			'switch'   => true,
		),
		array(
			'id'       => 'portfolio_projects_filtering',
			'type'     => 'switch',
			'title'    => __( 'Filter Links', 'border_txtd' ),
			'subtitle' => __( 'Display filter links (categories) on the Portfolio Archive Page', 'border_txtd' ),
			'default'  => '1',
			'switch'   => true,
		),
		array(
			'id'       => 'portfolio_projects_filtering_style',
			'title'    => __( 'Filter Links  Style', 'border_txtd' ),
			'required' => array( 'portfolio_projects_filtering', '=', 1 ),
			'type'     => 'select',
			'default'  => 'horizontal',
			'options'  => array(
				'horizontal' => __( 'Horizontal list', 'border_txtd' ),
				'dropdown'   => __( 'Dropdown', 'border_txtd' )
			),
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
		),
		array(
			'id'       => 'portfolio_archive_hide_current_category',
			'type'     => 'switch',
			'title'    => __( 'Hide Current Category', 'border_txtd' ),
			'subtitle' => __( 'Do you want us to hide the current category on the portfolio category archives?', 'border_txtd' ),
			'default'  => '0',
			'switch'   => true,
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Sharing', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'projects_single_show_share_buttons',
			'type'     => 'switch',
			'title'    => __( 'Show Share Buttons', 'border_txtd' ),
			'subtitle' => __( 'Do you want to show the share buttons in your projects?', 'border_txtd' ),
			'default'  => '1',
		),
	)
);

$sections[ ] = array(
	'type' => 'divide',
);


// Social and SEO options
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => "icon-thumbs-up-1",
	'icon_class' => '',
	'title'      => __( 'Social and SEO', 'border_txtd' ),
	'desc'       => '<p class="description">' . __( 'Social and SEO options allow you to display your social links and choose where to display them. Then you can set the social SEO related info added in the meta tags or used in various widgets.', 'border_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Sharing', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'share_buttons_settings',
			'type'     => 'text',
			'title'    => __( 'Share Services', 'border_txtd' ),
			'subtitle' => __( 'Add here the share services you want to use, single comma delimited (no spaces). You can find the full list of services here: <a href="http://www.addthis.com/services/list">http://www.addthis.com/services/list</a>. Also you can use the <strong>more</strong> tag to show the plus sign and the <strong>counter</strong> tag to show a global share counter.<br/><br/>Important: If you want to allow AddThis to show your visitors personalized lists of share buttons you can use the <strong>preferred</strong> tag. More about this here: <a href="http://bit.ly/1fLP69i">http://bit.ly/1fLP69i</a>.', 'border_txtd' ),
			'default'  => 'more,preferred,preferred,preferred,preferred',
		),
		array(
			'id'       => 'share_buttons_enable_tracking',
			'type'     => 'switch',
			'title'    => __( 'Sharing Analytics', 'border_txtd' ),
			'subtitle' => __( 'Do you want to get analytics for your social shares?', 'border_txtd' ),
			'default'  => '0',
		),
		array(
			'id'       => 'share_buttons_enable_addthis_tracking',
			'type'     => 'switch',
			'title'    => __( 'AddThis Tracking', 'border_txtd' ),
			'subtitle' => __( 'Do you want to enable AddThis tracking? This will all you to see sharing analytics in your AddThis account (see more here: <a href="http://bit.ly/1oe5zad">bit.ly/1oe5zad</a>)', 'border_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_addthis_username',
			'type'     => 'text',
			'title'    => __( 'AddThis Username', 'border_txtd' ),
			'subtitle' => __( 'Enter here your AddThis username so you will receive analytics data.', 'border_txtd' ),
			'default'  => '',
			'required' => array( 'share_buttons_enable_addthis_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_enable_ga_tracking',
			'type'     => 'switch',
			'title'    => __( 'Google Analytics Tracking', 'border_txtd' ),
			'subtitle' => __( 'Do you want to enable the AddThis - Google Analytics tracking integration? See more about this here: <a href="http://bit.ly/1kxPg7K">bit.ly/1kxPg7K</a>', 'border_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_ga_id',
			'type'     => 'text',
			'title'    => __( 'GA Property ID', 'border_txtd' ),
			'subtitle' => __( 'Enter here your GA property ID (generally a serial number of the form UA-xxxxxx-x).', 'border_txtd' ),
			'default'  => '',
			'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_enable_ga_social_tracking',
			'type'     => 'switch',
			'title'    => __( 'GA Social Tracking', 'border_txtd' ),
			'subtitle' => __( 'If you are using the latest version of GA code, you can take advantage of Google\'s new <a href="http://bit.ly/1iVvkbk">social interaction analytics</a>.', 'border_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Social Links', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'         => 'social_icons',
			'type'       => 'text_sortable',
			'title'      => __( 'Social Links', 'border_txtd' ),
			'subtitle'   => sprintf( __( 'Define and reorder your social pages links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.<br /><br /><strong> You need to input the <strong>complete</strong> URL (ie. http://twitter.com/username)</strong>', 'border_txtd' ), wpgrade::themename() ),
			'desc'       => __( 'Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', 'border_txtd' ),
			'checkboxes' => array(
				'widget' => __( 'Widget', 'border_txtd' ),
				'footer' => __( 'Footer', 'border_txtd' )
			),
			'options'    => array(
				'flickr'        => __( 'Flickr', 'border_txtd' ),
				'tumblr'        => __( 'Tumblr', 'border_txtd' ),
				'pinterest'     => __( 'Pinterest', 'border_txtd' ),
				'instagram'     => __( 'Instagram', 'border_txtd' ),
				'behance'       => __( 'Behance', 'border_txtd' ),
				'fivehundredpx' => __( '500px', 'border_txtd' ),
				'deviantart'    => __( 'DeviantART', 'border_txtd' ),
				'dribbble'      => __( 'Dribbble', 'border_txtd' ),
				'twitter'       => __( 'Twitter', 'border_txtd' ),
				'facebook'      => __( 'Facebook', 'border_txtd' ),
				'gplus'         => __( 'Google+', 'border_txtd' ),
				'youtube'       => __( 'Youtube', 'border_txtd' ),
				'vimeo'         => __( 'Vimeo', 'border_txtd' ),
				'linkedin'      => __( 'LinkedIn', 'border_txtd' ),
				'tumblr'        => __( 'Tumblr', 'border_txtd' ),
				'skype'         => __( 'Skype', 'border_txtd' ),
				'soundcloud'    => __( 'SoundCloud', 'border_txtd' ),
				'digg'          => __( 'Digg', 'border_txtd' ),
				'lastfm'        => __( 'Last.FM', 'border_txtd' ),
				'rdio'          => __( 'Rdio', 'border_txtd' ),
				'sina-weibo'    => __( 'Sina Weibo', 'border_txtd' ),
				'vkontakte'     => __( 'VKontakte', 'border_txtd' ),
				'appnet'        => __( 'App.net', 'border_txtd' ),
				'rss'           => __( 'RSS Feed', 'border_txtd' ),
			)
		),
		//		array(
		//			'id'=>"social_icons",
		//			'type' => 'group',//doesnt need to be called for callback fields
		//			'title' => __('Social Icons', 'border_txtd'),
		//			'subtitle' => __('Group any items together.', 'border_txtd'),
		//			'desc' => __('No limit as to what you can group. Just don\'t try to group a group.', 'border_txtd'),
		//			'groupname' => __('Social Icon', 'border_txtd'), // Group name
		//			'subfields' => array(
		//				array(
		//					'id'=>'social_icons_name',
		//					'type' => 'text',
		//					'title' => __('Social Icon Name', 'border_txtd'),
		//					'subtitle'=> __('This will apear as alt text on icon', 'border_txtd'),
		//				),
		//				array(
		//					'id'=>'social_icons_url',
		//					'type' => 'text',
		//					'title' => __('Link', 'border_txtd'),
		//					'subtitle' => __('Here you put your subtitle', 'border_txtd'),
		//				),
		//				array(
		//					'id' => 'social_icons_image_type',
		//					'type' => 'image_select',
		//					'title' => __('Icon Type', 'border_txtd'),
		//					'options' => array(
		//						'image' => array( __('Image', 'border_txtd' ), 'img' => 'images/align-right.png' ),
		//						'font-awesome'=> array( __('Font Awesome', 'border_txtd'), 'img' => 'images/align-left.png' )
		//					),
		//					'default' => 'image',
		//				),
		//				array(
		//					'id'=>'social_icons_image',
		//					'type' => 'media',
		//					'title' => __('Image', 'border_txtd'),
		//					'subtitle' => __('Upload the image.', 'border_txtd'),
		//					'required' => array('social_icons_image_type', '=', 'image'),
		//				),
		//				array(
		//					'id'=>'social_icons_font_awesome',
		//					'type' => 'text',
		//					'title' => __('Icon Name', 'border_txtd'),
		//					'subtitle' => __('Here you can write a font-awesome class name (e.g. fa-facebook).', 'border_txtd'),
		//					'required' => array('social_icons_image_type', '=', 'font-awesome'),
		//				),
		//			),
		//		),

		array(
			'id'       => 'social_icons_target_blank',
			'type'     => 'switch',
			'title'    => __( 'Open Social Links In a New Tab?', 'border_txtd' ),
			'subtitle' => __( 'Do you want to open social links in a new tab?', 'border_txtd' ),
			'default'  => '1',
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Social Metas', 'border_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'prepare_for_social_share',
			'type'     => 'switch',
			'title'    => __( 'Add Social Meta Tags', 'border_txtd' ),
			'subtitle' => __( 'Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section. These include Open Graph (Facebook), Google+ and Twitter metas.', 'border_txtd' ),
			'default'  => '1',
		),
		array(
			'id'       => 'facebook_id_app',
			'type'     => 'text',
			'title'    => __( 'Facebook Application ID', 'border_txtd' ),
			'subtitle' => __( 'Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', 'border_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'facebook_admin_id',
			'type'     => 'text',
			'title'    => __( 'Facebook Admin ID', 'border_txtd' ),
			'subtitle' => __( 'The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', 'border_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'google_page_url',
			'type'     => 'text',
			'title'    => __( 'Google+ Publisher', 'border_txtd' ),
			'subtitle' => __( 'Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', 'border_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'twitter_card_site',
			'type'     => 'text',
			'title'    => __( 'Twitter Site Username', 'border_txtd' ),
			'subtitle' => __( 'The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', 'border_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'    => 'social_share_default_image',
			'type'  => 'media',
			'title' => __( 'Default Social Share Image', 'border_txtd' ),
			'desc'  => __( 'If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', 'border_txtd' ),
		),
		array(
			'id'       => 'remove_parameters_from_static_res',
			'type'     => 'switch',
			'title'    => __( 'Clean Static Files URL', 'border_txtd' ),
			'subtitle' => __( 'Do you want us to remove the version parameters from static resources so they can be cached better?', 'border_txtd' ),
			'default'  => '0',
		),
		//        array(
		//            'id' => 'use_twitter_widget',
		//            'type' => 'switch',
		//            'title' => __('Use Twitter Widget', 'border_txtd'),
		//            'subtitle' => __('Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', 'border_txtd'),
		//            'default' => '1',
		//        ),
		//        array(
		//            'id' => 'info_about_twitter_app',
		//            'type' => 'info',
		//            'title' => __('Important Note : ', 'border_txtd'),
		//            'desc' => __('<div>In order to use the Twitter widget you will need to create a Twitter application <a href="https://dev.twitter.com/apps/new" >here</a> and get your own key, secrets and access tokens. This is due to the changes that Twitter made to it\'s API (v1.1). Please note that these defaults are used on the theme demo site but they might be disabled at any time, so we <strong>strongly</strong> recommend you to input your own bellow.</div>', 'border_txtd'),
		//            'required' => array('use_twitter_widget', '=', 1)
		//        ),
		//        array(
		//            'id' => 'twitter_consumer_key',
		//            'type' => 'text',
		//            'title' => __('Consumer Key', 'border_txtd'),
		//            'default' => 'UGciUkPwjDpCRyEqcGsbg',
		//            'required' => array('use_twitter_widget', '=', 1)
		//        ),
		//        array(
		//            'id' => 'twitter_consumer_secret',
		//            'type' => 'text',
		//            'title' => __('Consumer Secret', 'border_txtd'),
		//            'default' => 'nuHkqRLxKTEIsTHuOjr1XX5YZYetER6HF7pKxkV11E',
		//            'required' => array('use_twitter_widget', '=', 1)
		//        ),
		//        array(
		//            'id' => 'twitter_oauth_access_token',
		//            'type' => 'text',
		//            'title' => __('Oauth Access Token', 'border_txtd'),
		//            'default' => '205813011-oLyghRwqRNHbZShOimlGKfA6BI4hk3KRBWqlDYIX',
		//            'required' => array('use_twitter_widget', '=', 1)
		//        ),
		//        array(
		//            'id' => 'twitter_oauth_access_token_secret',
		//            'type' => 'text',
		//            'title' => __('Oauth Access Token Secret', 'border_txtd'),
		//            'default' => '4LqlZjf7jDqmxqXQjc6MyIutHCXPStIa3TvEHX9NEYw',
		//            'required' => array('use_twitter_widget', '=', 1)
		//        ),
	)
);

// Custom Code
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => "icon-database-1",
	'icon_class' => '',
	'title'      => __( 'Custom Code', 'border_txtd' ),
	'desc'       => '<p class="description">' . __( 'You can change the site style and behaviour by adding custom scripts to all pages within your site using the custom code areas below.', 'border_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom CSS', 'border_txtd' ),
			'subtitle' => __( 'Enter your custom CSS code. It will be included in the head section of the page and will overwrite the main CSS styling.', 'border_txtd' ),
			'desc'     => __( '', 'border_txtd' ),
			'mode'     => 'css',
			'theme'    => 'chrome',
			//'validate' => 'html',
			'compiler' => true
		),
		array(
			'id'       => 'inject_custom_css',
			'type'     => 'select',
			'title'    => __( 'Apply Custom CSS', 'border_txtd' ),
			'subtitle' => sprintf( __( 'Select how to insert the custom CSS into your pages.', 'border_txtd' ), wpgrade::themename() ),
			'default'  => 'inline',
			'options'  => array(
				'inline' => __( 'Inline <em>(recommended)</em>', 'border_txtd' ),
				'file'   => __( 'Write To File (might require file permissions)', 'border_txtd' )
			),
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'compiler' => true
		),
		array(
			'id'       => 'custom_js',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript (header)', 'border_txtd' ),
			'subtitle' => __( 'Enter your custom Javascript code. This code will be loaded in the head section of your pages.', 'border_txtd' ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
		array(
			'id'       => 'custom_js_footer',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript (footer)', 'border_txtd' ),
			'subtitle' => __( 'This javascript code will be loaded in the footer. You can paste here your <strong>Google Analytics tracking code</strong> (or for what matters any tracking code) and we will put it on every page.', 'border_txtd' ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
	)
);

// Utilities - Theme Auto Update + Import Demo Data
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => "icon-truck",
	'icon_class' => '',
	'title'      => __( 'Utilities', 'border_txtd' ),
	'desc'       => '<p class="description">' . __( 'Utilities help you keep up-to-date with new versions of the theme. Also you can import the demo data from here.', 'border_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'   => 'head-theme-one-click-21',
			'desc' => __( '<h3>Theme One-Click Update</h3>
				<p class="description">' . __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!', 'border_txtd' ) . '</p>', 'border_txtd' ),
			'type' => 'info'
		),
		array(
			'id'       => 'themeforest_upgrade',
			'type'     => 'switch',
			'title'    => __( 'One-Click Update', 'border_txtd' ),
			'subtitle' => __( 'Activate this to enter the info needed for the theme\'s one-click update to work.', 'border_txtd' ),
			'default'  => '1',
		),
		array(
			'id'       => 'marketplace_username',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Username', 'border_txtd' ),
			'subtitle' => __( 'Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', 'border_txtd' ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'marketplace_api_key',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Secret API Key', 'border_txtd' ),
			'subtitle' => __( 'Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'border_txtd' ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'themeforest_upgrade_backup',
			'type'     => 'switch',
			'title'    => __( 'Backup Theme Before Upgrade?', 'border_txtd' ),
			'subtitle' => __( 'Check this if you want us to automatically save your theme as a ZIP archive before an upgrade. The directory those backups get saved to is <code>wp-content/envato-backups</code>. However, if you\'re experiencing problems while attempting to upgrade, it\'s likely to be a permissions issue and you may want to manually backup your theme before upgrading. Alternatively, if you don\'t want to backup your theme you can disable this.', 'border_txtd' ),
			'default'  => '0',
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'   => 'head-import-21',
			'desc' => __( '<h3>Import Demo Data</h3>
				<p class="description">' . __( 'Here you can import the demo data and get on your way of setting up the site like the theme demo (images not included due to copyright).', 'border_txtd' ) . '</p>', 'border_txtd' ),
			'type' => 'info'
		),
		array(
			'id'   => 'wpGrade_import_demodata_button',
			'type' => 'info',
			'desc' => '
                    <input type="hidden" name="wpGrade-nonce-import-posts-pages" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_posts_pages' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_theme_options' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_widgets' ) . '" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />

						<a href="#" class="button button-primary" id="wpGrade_import_demodata_button">
							' . __( 'Import demo data', 'border_txtd' ) . '
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								' . __( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and <strong>don\'t reload the page</strong>. You will be notified as soon as the import has finished!', 'border_txtd' ) . '
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
						<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>
					',
		),
		array(
			'id'       => 'admin_panel_options',
			'type'     => 'switch',
			'title'    => __( 'Admin Panel Options', 'border_txtd' ),
			'subtitle' => __( 'Here you can copy/download your current admin option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'border_txtd' ),
		),
		array(
			'id'       => 'theme_options_import',
			'type'     => 'import_export',
			'required' => array( 'admin_panel_options', '=', 1 )
		),
	)
);


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// WooCommerce
	// ------------------------------------------------------------------------
	$sections[ ] = array(
		'icon'       => "icon-money",
		'icon_class' => '',
		'title'      => __( 'WooCommerce', 'border_txtd' ),
		'desc'       => '<p class="description">' . __( 'WooCommerce options!', 'border_txtd' ) . '</p>',
		'fields'     => array(
			array(
				'id'       => 'enable_woocommerce_support',
				'type'     => 'switch',
				'title'    => __( 'Enable WooCommerce Support', 'border_txtd' ),
				'subtitle' => __( 'Turn this off to avoid loading the WooCommerce assets (CSS and JS).', 'border_txtd' ),
				'default'  => '1',
			),
			array(
				'id'       => 'woocommerce_products_numbers',
				'type'     => 'text',
				'title'    => __( 'Products per page', 'border_txtd' ),
				'subtitle' => __( 'Select the number of products per page.This must be numeric.', 'border_txtd' ),
				'validate' => 'numeric',
				'default'  => '12',
				'class'    => 'small-text'
			),
		)
	);
}


// Help and Support
// ------------------------------------------------------------------------

$sections[ ] = array(
	'icon'       => "icon-cd-1",
	'icon_class' => '',
	'title'      => __( 'Help and Support', 'border_txtd' ),
	'desc'       => '<p class="description">' . __( 'If you had anything less than a great experience with this theme please contact us now. You can also find answers in our community site, or official articles and tutorials in our knowledge base.', 'border_txtd' ) . '</p>
		<ul class="help-and-support">
			<li>
				<a href="http://bit.ly/19G56H1">
					<span class="community-img"></span>
					<h4>Community Answers</h4>
					<span class="description">Get Help from other people that are using this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/19G5cyl">
					<span class="knowledge-img"></span>
					<h4>Knowledge Base</h4>
					<span class="description">Getting started guides and useful articles to better help you with this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/new-ticket">
					<span class="community-img"></span>
					<h4>Submit a Ticket</h4>
					<span class="description">File a ticket for a personal response from our support team.</span>
				</a>
			</li>
		</ul>
	',
	'fields'     => array()
);


return $sections;
