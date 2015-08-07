<?php
// theme activation
function wpgrade_callback_geting_active() {

	/**
	 * make sure pixlikes has the right settings
	 */
	$pixlikes_settings = array(
		'show_on_post'         => false,
		'show_on_page'         => false,
		'show_on_hompage'      => false,
		'show_on_archive'      => false,
		'like_action'          => 'click',
		'hover_time'           => 1000,
		'free_votes'           => false,
		'load_likes_with_ajax' => false,
	);
	update_option( 'pixlikes_settings', $pixlikes_settings );

	/**
	 * Create custom post types, taxonomies and metaboxes
	 * These will be taken by pixtypes plugin and converted in their own options
	 */
	$types_options = get_option( 'pixtypes_themes_settings' );
	if ( empty( $types_options ) ) {
		$types_options = array();
	}
	$theme_key                   = wpgrade::shortname() . '_pixtypes_theme';
	$types_options[ $theme_key ] = array();

	$types_options[ $theme_key ][ 'post_types' ] = array(
		wpgrade::shortname() . '_portfolio' => array(
			'labels'        => array(
				'name'               => __( 'Project', 'border_txtd' ),
				'singular_name'      => __( 'Project', 'border_txtd' ),
				'add_new'            => __( 'Add New', 'border_txtd' ),
				'add_new_item'       => __( 'Add New Project', 'border_txtd' ),
				'edit_item'          => __( 'Edit Project', 'border_txtd' ),
				'new_item'           => __( 'New Project', 'border_txtd' ),
				'all_items'          => __( 'All Projects', 'border_txtd' ),
				'view_item'          => __( 'View Project', 'border_txtd' ),
				'search_items'       => __( 'Search Projects', 'border_txtd' ),
				'not_found'          => __( 'No Project found', 'border_txtd' ),
				'not_found_in_trash' => __( 'No Project found in Trash', 'border_txtd' ),
				'menu_name'          => __( 'Projects', 'border_txtd' ),
			),
			'public'        => true,
			'rewrite'       => array(
				'slug'       => wpgrade::shortname() . '_portfolio',
				'with_front' => false,
			),
			'has_archive'   => 'portfolio-archive',
			'menu_icon'     => 'report.png',
			'menu_position' => null,
			'supports'      => array(
				'title',
				'editor',
				'thumbnail',
				'page-attributes',
				'excerpt',
				'comments',
				'revisions'
			),
			'yarpp_support' => true,
		),
		wpgrade::shortname() . '_gallery'   => array(
			'labels'        => array(
				'name'               => __( 'Gallery', 'border_txtd' ),
				'singular_name'      => __( 'Gallery', 'border_txtd' ),
				'add_new'            => __( 'Add New', 'border_txtd' ),
				'add_new_item'       => __( 'Add New Gallery', 'border_txtd' ),
				'edit_item'          => __( 'Edit Gallery', 'border_txtd' ),
				'new_item'           => __( 'New Gallery', 'border_txtd' ),
				'all_items'          => __( 'All Galleries', 'border_txtd' ),
				'view_item'          => __( 'View Gallery', 'border_txtd' ),
				'search_items'       => __( 'Search Galleries', 'border_txtd' ),
				'not_found'          => __( 'No Gallery found', 'border_txtd' ),
				'not_found_in_trash' => __( 'No Gallery found in Trash', 'border_txtd' ),
				'menu_name'          => __( 'Galleries', 'border_txtd' ),
			),
			'public'        => true,
			'rewrite'       => array(
				'slug'       => wpgrade::shortname() . '_galleries',
				'with_front' => false,
			),
			'has_archive'   => 'galleries-archive',
			'menu_icon'     => 'slider.png',
			'menu_position' => null,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes', 'excerpt', 'revisions' ),
			//'yarpp_support' => true,
		),
	);
	$types_options[ $theme_key ][ 'taxonomies' ] = array(
		wpgrade::shortname() . '_portfolio_categories' => array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => __( 'Portfolio Categories', 'border_txtd' ),
				'singular_name'     => __( 'Portfolio Category', 'border_txtd' ),
				'search_items'      => __( 'Search Portfolio Categories', 'border_txtd' ),
				'all_items'         => __( 'All Portfolio Categories', 'border_txtd' ),
				'parent_item'       => __( 'Parent Portfolio Category', 'border_txtd' ),
				'parent_item_colon' => __( 'Parent Portfolio Category: ', 'border_txtd' ),
				'edit_item'         => __( 'Edit Portfolio Category', 'border_txtd' ),
				'update_item'       => __( 'Update Portfolio Category', 'border_txtd' ),
				'add_new_item'      => __( 'Add New Portfolio Category', 'border_txtd' ),
				'new_item_name'     => __( 'New Portfolio Category Name', 'border_txtd' ),
				'menu_name'         => __( 'Portfolio Categories', 'border_txtd' ),
			),
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'portfolio-category', 'with_front' => false ),
			'sort'              => true,
			'post_types'        => array( wpgrade::shortname() . '_portfolio' )
		),
		wpgrade::shortname() . '_gallery_categories'   => array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => __( 'Gallery Categories', 'border_txtd' ),
				'singular_name'     => __( 'Gallery Category', 'border_txtd' ),
				'search_items'      => __( 'Search Gallery Category', 'border_txtd' ),
				'all_items'         => __( 'All Gallery Categories', 'border_txtd' ),
				'parent_item'       => __( 'Parent Gallery Category', 'border_txtd' ),
				'parent_item_colon' => __( 'Parent Gallery Category: ', 'border_txtd' ),
				'edit_item'         => __( 'Edit Gallery Category', 'border_txtd' ),
				'update_item'       => __( 'Update Gallery Category', 'border_txtd' ),
				'add_new_item'      => __( 'Add New Gallery Category', 'border_txtd' ),
				'new_item_name'     => __( 'New Gallery Category Name', 'border_txtd' ),
				'menu_name'         => __( 'Gallery Categories', 'border_txtd' ),
			),
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'gallery-category', 'with_front' => false ),
			'sort'              => true,
			'post_types'        => array( wpgrade::shortname() . '_gallery' )
		),
	);
	$types_options[ $theme_key ][ 'metaboxes' ]  = array(
		wpgrade::shortname() . '_project_gallery'  => array(
			'id'         => 'project_gallery',
			'title'      => __( 'Project Gallery', 'border_txtd' ),
			'pages'      => array( wpgrade::shortname() . '_portfolio' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'   => __( 'Images', 'border_txtd' ),
					'id'     => wpgrade::prefix() . 'project_gallery',
					'type'   => 'gallery',
					'hidden' => true,
				),
			)
		),
		wpgrade::shortname() . '_project_metadata' => array(
			'id'         => 'project_metadata',
			'title'      => __( 'Project Details', 'border_txtd' ),
			'pages'      => array( wpgrade::shortname() . '_portfolio' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Client Name', 'border_txtd' ),
					'id'   => wpgrade::prefix() . 'project_client_name',
					'type' => 'text_medium',
				),
				array(
					'name' => __( 'Client Link', 'border_txtd' ),
					'id'   => wpgrade::prefix() . 'project_client_link',
					'type' => 'text_medium',
				),
				//                array(
				//                    'name' => __('Template Style', 'border_txtd'),
				//                    'desc' => __('Select the template you want for this project.', 'border_txtd'),
				//                    'id' => wpgrade::prefix() . 'project_template',
				//                    'type' => 'select',
				//                    'options' => array(
				//                        array(
				//                            'name' => __('Full Width Slider', 'border_txtd'),
				//                            'value' => 'fullwidth'
				//                        ),
				////                        array(
				////                            'name' => __('Sidebar Right', 'border_txtd'),
				////                            'value' => 'sidebar'
				////                        ),
				////                        array(
				////                            'name' => __('Classic', 'border_txtd'),
				////                            'value' => 'classic'
				////                        ),
				//                    ),
				//                    'std' => 'fullwidth',
				//                ),
				array(
					'name'    => __( 'Image Scaling', 'border_txtd' ),
					'desc'    => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><strong>Fit if Smaller</strong> scales image to fit only if size of slider container is less than size of image.</p>
<p class="cmb_metabox_description"><strong>Auto Height</strong> scales the container to fit the full size image.</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'project_slider_image_scale_mode',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Fill', 'border_txtd' ),
							'value' => 'fill'
						),
						array(
							'name'  => __( 'Fit', 'border_txtd' ),
							'value' => 'fit'
						),
						array(
							'name' => __('Fit if Smaller', 'border_txtd'),
							'value' => 'fit-if-smaller'
						),
						array(
							'name'  => __( 'Auto Height', 'border_txtd' ),
							'value' => 'auto'
						),
					),
					'std'     => 'fill'
				),
				array(
					'name'       => __( 'Slider height ratio', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'project_slider_height_ratio',
					'type'       => 'text_small',
					'desc'       => __( '<p>Width ratio is set to 100. For example, if you set a height ratio of 50, you have a slider ratio of 100/50 (2/1).', 'border_txtd' ),
					'std'        => '45',
				),
				array(
					'name'    => __( 'Show Nearby Images', 'border_txtd' ),
					'desc'    => __( 'Enable this if you want to avoid having empty space on the sides of the image when using mostly portrait images.', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'project_slider_visiblenearby',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', 'border_txtd' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'border_txtd' ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'    => __( 'Slider Transition Animation', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'project_slider_transition',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Slide/Move', 'border_txtd' ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', 'border_txtd' ),
							'value' => 'fade'
						)
					),
					'std'     => 'move'
				),
				array(
					'name'       => __( 'Slider Transition Direction', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_transition_direction',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'project_slider_transition',
							'value' => 'move'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Horizontal', 'border_txtd' ),
							'value' => 'horizontal'
						),
						array(
							'name'  => __( 'Vertical', 'border_txtd' ),
							'value' => 'vertical'
						)
					),
					'std'        => 'horizontal'
				),
				array(
					'name'    => __( 'Slider Autoplay', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'project_slider_autoplay',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Enabled', 'border_txtd' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'border_txtd' ),
							'value' => false
						)
					),
					'std'     => false
				),
				array(
					'name'       => __( 'Autoplay delay between slides (in milliseconds)', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'project_slider_delay',
					'type'       => 'text_small',
					'std'        => '1000',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'project_slider_autoplay',
							'value' => true
						)
					),
				),
				array(
					'name'    => __( 'Show fullscreen slider button', 'border_txtd' ),
					'desc'    => __( 'Show the fullscreen button in the top right corner.', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'project_full_screen_button',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Show', 'border_txtd' ),
							'value' => 'show'
						),
						array(
							'name'  => __( 'Hide', 'border_txtd' ),
							'value' => 'hide'
						),
					),
					'std'     => 'hide'
				),
				//				array(
				//					'name' => __('Full Screen Button', 'border_txtd'),
				//					'id' => wpgrade::prefix() . 'full_screen_button',
				//					'type' => 'select',
				//					'options' => array(
				//						array(
				//							'name' => __('Show', 'border_txtd'),
				//							'value' => 'show'
				//						),
				//						array(
				//							'name' => __('Hide', 'border_txtd'),
				//							'value' => 'hide'
				//						)
				//					),
				//					'std' => 'show'
				//				),
				//				array(
				//					'name' => __('Share Buttons', 'border_txtd'),
				////                    'desc' => __('Display social sharing buttons.', 'border_txtd'),
				//					'id' => wpgrade::prefix() . 'share_button',
				//					'type' => 'select',
				//					'options' => array(
				//						array(
				//							'name' => __('Show', 'border_txtd'),
				//							'value' => true
				//						),
				//						array(
				//							'name' => __('Hide', 'border_txtd'),
				//							'value' => false
				//						)
				//					),
				//					'std' => true
				//				),
				array(
					'name'    => __( 'Exclude From Archives', 'border_txtd' ),
					'desc'    => __( 'Exclude this project from the portfolio archives (main, categories, etc).', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'exclude_from_archives',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'No', 'border_txtd' ),
							'value' => false
						),
						array(
							'name'  => __( 'Yes', 'border_txtd' ),
							'value' => true
						)
					),
					'std'     => false
				),
			)
		),
		wpgrade::shortname() . '_gallery_details'  => array(
			'id'         => wpgrade::shortname() . '_gallery_details',
			'title'      => __( 'Gallery Details', 'border_txtd' ),
			'pages'      => array( wpgrade::shortname() . '_gallery' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name' => __( 'Images', 'border_txtd' ),
					'id'   => wpgrade::prefix() . 'main_gallery',
					'type' => 'gallery',
				),
				array(
					'name'    => __( 'Template Style', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'gallery_template',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Grid', 'border_txtd' ),
							'value' => 'grid'
						),
						array(
							'name'  => __( 'Slideshow', 'border_txtd' ),
							'value' => 'slideshow'
						),
					),
					'std'     => 'grid',
				),
				array(
					'name'       => __( 'Grid Thumbnails', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'grid_thumbnails',
					'type'       => 'select',
					'options'    => array(
						array(
							'name'  => __( 'Square', 'border_txtd' ),
							'value' => 'square'
						),
						array(
							'name'  => __( 'Masonry', 'border_txtd' ),
							'value' => 'masonry'
						),
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'grid'
						)
					),
					'std'        => 'square',
				),
				array(
					'name'       => __( 'Show gallery title', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'show_gallery_title',
					'type'       => 'select',
					'options'    => array(
						array(
							'name'  => __( 'Show', 'border_txtd' ),
							'value' => 'show'
						),
						array(
							'name'  => __( 'Hide', 'border_txtd' ),
							'value' => 'hide'
						)
					),
					'std'        => 'hide',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'grid'
						)
					),
				),
				array(
					'name'       => __( 'Image Scaling', 'border_txtd' ),
					'desc'       => __( '<p class="cmb_metabox_description"><strong>Fill</strong> scales image to completely fill slider container (recommended for landscape images)</p>
<p class="cmb_metabox_description"><strong>Fit</strong> scales image to fit the container (recommended for portrait images)</p>
<p class="cmb_metabox_description"><a target="_blank" href="http://bit.ly/slider-image-scaling">Visual explanation</a></p>', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_image_scale_mode',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'slideshow'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Fit', 'border_txtd' ),
							'value' => 'fit'
						),
						array(
							'name'  => __( 'Fill', 'border_txtd' ),
							'value' => 'fill'
						),
					),
					'std'        => 'fill'
				),
				array(
					'name'       => __( 'Show Nearby Images', 'border_txtd' ),
					'desc'       => __( 'Enable this if you want to avoid having empty spaces on the sides of the image when using mostly portrait images.', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_visiblenearby',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'slideshow'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Enabled', 'border_txtd' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'border_txtd' ),
							'value' => false
						)
					),
					'std'        => false
				),
				array(
					'name'       => __( 'Slider Transition Animation', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_transition',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'slideshow'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Slide/Move', 'border_txtd' ),
							'value' => 'move'
						),
						array(
							'name'  => __( 'Fade', 'border_txtd' ),
							'value' => 'fade'
						)
					),
					'std'        => 'fade'
				),
				array(
					'name'       => __( 'Slider Transition Direction', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_transition_direction',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_slider_transition',
							'value' => 'move'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Horizontal', 'border_txtd' ),
							'value' => 'horizontal'
						),
						array(
							'name'  => __( 'Vertical', 'border_txtd' ),
							'value' => 'vertical'
						)
					),
					'std'        => 'horizontal'
				),
				array(
					'name'       => __( 'Slider Autoplay', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_autoplay',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'slideshow'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Enabled', 'border_txtd' ),
							'value' => true
						),
						array(
							'name'  => __( 'Disabled', 'border_txtd' ),
							'value' => false
						)
					),
					'std'        => false
				),
				array(
					'name'       => __( 'Autoplay delay between slides (in milliseconds)', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_slider_delay',
					'type'       => 'text_small',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_slider_autoplay',
							'value' => true
						)
					),
					'std'        => '1000'
				),
				array(
					'name'       => __( 'Full Screen Button', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'full_screen_button',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'gallery_template',
							'value' => 'slideshow'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Show', 'border_txtd' ),
							'value' => 'show'
						),
						array(
							'name'  => __( 'Hide', 'border_txtd' ),
							'value' => 'hide'
						)
					),
					'std'        => 'show'
				),
				array(
					'name'    => __( 'Social Share Buttons', 'border_txtd' ),
					'desc'    => __( 'Display your AddThis social sharing buttons configured in the <i>Theme Options > Social and SEO</i> section.', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'gallery_share_button',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'Show', 'border_txtd' ),
							'value' => 'true'
						),
						array(
							'name'  => __( 'Hide', 'border_txtd' ),
							'value' => 'false'
						)
					),
					'std'     => 'true'
				),
				array(
					'name'    => __( 'Exclude From Archives', 'border_txtd' ),
					'desc'    => __( 'Exclude this gallery from the galleries archives (main, categories, etc).', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'exclude_from_archives',
					'type'    => 'select',
					'options' => array(
						array(
							'name'  => __( 'No', 'border_txtd' ),
							'value' => false
						),
						array(
							'name'  => __( 'Yes', 'border_txtd' ),
							'value' => true
						)
					),
					'std'     => false
				),
			)
		),
		wpgrade::shortname() . '_gallery_cover'    => array(
			'id'         => wpgrade::shortname() . '_gallery_cover',
			'title'      => __( 'Gallery Cover', 'border_txtd' ),
			'pages'      => array( wpgrade::shortname() . '_gallery' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'display_on' => array(
				'display' => true,
				'on'      => array(
					'field' => wpgrade::prefix() . 'gallery_template',
					'value' => 'slideshow'
				)
			),
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => __( 'Use first gallery image as cover', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'set_first_img_as_cover',
					'type'    => 'radio',
					'options' => array(
						array(
							'name'  => __( 'Yes', 'border_txtd' ),
							'value' => 'yes'
						),
						array(
							'name'  => __( 'No', 'border_txtd' ),
							'value' => 'no'
						),
					),
					'std'     => 'no',
				),
				array(
					'name'       => __( 'Cover Title Style', 'border_txtd' ),
					'desc'       => __( 'Choose one of the 3 cover styles (fonts defined in Theme Options > Gallery).', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'cover_title_style',
					'type'       => 'select',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'set_first_img_as_cover',
							'value' => 'yes'
						)
					),
					'options'    => array(
						array(
							'name'  => __( 'Style 1', 'border_txtd' ),
							'value' => 'style1'
						),
						array(
							'name'  => __( 'Style 2', 'border_txtd' ),
							'value' => 'style2'
						),
						array(
							'name'  => __( 'Style 3', 'border_txtd' ),
							'value' => 'style3'
						)
					),
					'std'        => 'style_1'
				),
				array(
					'name'       => __( 'First Subtitle', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_cover_first_subtitle',
					'type'       => 'wysiwyg',
					'options'    => array(
						'media_buttons' => false,
						'textarea_rows' => 1,
						'teeny'         => true,
						'tinymce'       => false,
						'quicktags'     => false
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'set_first_img_as_cover',
							'value' => 'yes'
						)
					),
				),
				array(
					'name'       => __( 'Title', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_cover_title',
					'type'       => 'wysiwyg',
					'options'    => array(
						'media_buttons' => false,
						'textarea_rows' => 1,
						'teeny'         => true,
						'tinymce'       => false,
						'quicktags'     => false
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'set_first_img_as_cover',
							'value' => 'yes'
						)
					),
				),
				array(
					'name'       => __( 'Second Subtitle', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_cover_second_subtitle',
					'type'       => 'wysiwyg',
					'options'    => array(
						'media_buttons' => false,
						'textarea_rows' => 1,
						'teeny'         => true,
						'tinymce'       => false,
						'quicktags'     => false
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'set_first_img_as_cover',
							'value' => 'yes'
						)
					),
				),
				array(
					'name'       => __( 'Text Color', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'gallery_cover_text_color',
					'type'       => 'colorpicker',
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'set_first_img_as_cover',
							'value' => 'yes'
						)
					),
				)
			)
		),
		wpgrade::shortname() . '_homepage_chooser' => array(
			'id'         => wpgrade::shortname() . '_homepage_chooser',
			'title'      => __( 'Choose Your Home Page', 'border_txtd' ),
			'pages'      => array( 'page' ), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'hidden'     => true,
			'show_on'    => array( 'key' => 'page-template', 'value' => array( 'page-frontpage.php' ), ),
			'show_names' => true, // Show field names on the left
			'fields'     => array(
				array(
					'name'    => __( 'Choose:', 'border_txtd' ),
					'desc'    => __( 'Select what would you like to be your home page. If you want to have a static page as your homepage simply go the WordPress classic way and set it up in Settings > Reading (instead of this one).', 'border_txtd' ),
					'id'      => wpgrade::prefix() . 'custom_homepage',
					'type'    => 'radio',
					'options' => array(
						array(
							'name'  => __( 'Portfolio Archive', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_portfolio_archive',
						),
						array(
							'name'  => __( 'Portfolio Category', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_portfolio_cat',
						),
						array(
							'name'  => __( 'Project', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_project',
						),
						array(
							'name'  => __( 'Galleries Archive', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_galleries_archive',
						),
						array(
							'name'  => __( 'Galleries Category', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_galleries_cat',
						),
						array(
							'name'  => __( 'Gallery', 'border_txtd' ),
							'value' => wpgrade::shortname() . '_gallery',
						),
					),
					'std'     => wpgrade::shortname() . '_portfolio_archive',
				),
				array(
					'name'       => __( 'Select a portfolio category', 'border_txtd' ),
					'desc'       => __( 'Select a portfolio category and we will show it on your homepage.', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'homepage_portfolio_category',
					'type'       => 'select_cpt_term',
					'taxonomy'   => wpgrade::shortname() . '_portfolio_categories',
					'options'    => array(//'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_portfolio_cat'
						)
					),
				),
				array(
					'name'       => __( 'Select a project', 'border_txtd' ),
					'desc'       => __( 'Select a project and we will show it on your homepage.', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'homepage_project',
					'type'       => 'select_cpt_post',
					'options'    => array(
						'args' => array(
							'post_type' => wpgrade::shortname() . '_portfolio',
						),
						//'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_project'
						)
					),
				),
				array(
					'name'       => __( 'Select a galleries category', 'border_txtd' ),
					'desc'       => __( 'Select a galleries category and we will show it on your homepage.', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'homepage_galleries_category',
					'type'       => 'select_cpt_term',
					'taxonomy'   => wpgrade::shortname() . '_gallery_categories',
					'options'    => array(//'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_galleries_cat'
						)
					),
				),
				array(
					'name'       => __( 'Select a gallery', 'border_txtd' ),
					'desc'       => __( 'Select a gallery and we will show it on your homepage.', 'border_txtd' ),
					'id'         => wpgrade::prefix() . 'homepage_gallery',
					'type'       => 'select_cpt_post',
					'options'    => array(
						'args' => array(
							'post_type' => wpgrade::shortname() . '_gallery',
						),
						//'hidden' => true,
					),
					'display_on' => array(
						'display' => true,
						'on'      => array(
							'field' => wpgrade::prefix() . 'custom_homepage',
							'value' => wpgrade::shortname() . '_gallery'
						)
					),
				),
				//				array(
				//					'name' => __('Number of items', 'border_txtd'),
				//					'desc' => __('Select a number of items (projects or galleries) to show on your homepage. For unlimited items keep it empty', 'border_txtd'),
				//					'id'   => wpgrade::prefix() . 'homepage_projects_number',
				//					'type' => 'text_small',
				//				)
			)
		),
	);

	/**
	 * Woocommerce stuff
	 */

	// We really needs these settings off -- no need anymore
	//	update_option( 'shop_catalog_image_size', array(1024, NULL, 0) ); 		// Product category thumbs
	//	update_option( 'shop_single_image_size', array(1024, NULL, 0) );  		// Single product image
	//	update_option( 'shop_thumbnail_image_size', array(400, NULL, 0) );

	update_option( 'woocommerce_enable_lightbox', 'no' );

	update_option( 'pixtypes_themes_settings', $types_options );

	// flush permalinks rules on theme activation
	//		flush_rewrite_rules();
	//		global $wp_rewrite;
	//		$wp_rewrite->generate_rewrite_rules();
	//		flush_rewrite_rules();

	/**
	 * http://wordpress.stackexchange.com/questions/36152/flush-rewrite-rules-not-working-on-plugin-deactivation-invalid-urls-not-showing
	 * nothing from above works in plugin so ...
	 */
	delete_option( 'rewrite_rules' );
}

add_action( 'after_switch_theme', 'wpgrade_callback_geting_active' );

// temporary for testing purpose
//add_action('wp', 'wpgrade_callback_geting_active');