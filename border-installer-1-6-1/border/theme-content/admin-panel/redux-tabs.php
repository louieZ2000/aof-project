<?php

	$tabs = array();

	$theme_data = wp_get_theme();
	$item_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$author_uri = $theme_data->get('AuthorURI');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');
	
	if ($author_uri) {
		$author_title = '<a href="'.$author_uri.'" target="_blank">'.$author . '</a>';
	}
	else { // author_uri not available
		$author_title = $author;
	}

	if ( !empty($tags) ) { // yes, tags could miss sometimes
		$tags = implode(', ', $tags);
	} else {
		$tags = "";
	}

    $item_info =
		'
			<div class="redux-opts-section-desc">

				<p class="redux-opts-item-data description item-uri">
					'.__('<strong>Theme URL:</strong> ', 'border_txtd').'
					<a href="' . $item_uri . '" target="_blank">'.$item_uri.'</a>
				</p>

				<p class="redux-opts-item-data description item-author">
					'.__('<strong>Author:</strong> ', 'border_txtd').$author_title.'
				</p>

				<p class="redux-opts-item-data description item-version">
					'. __('<strong>Version:</strong> ', 'border_txtd').$version.'
				</p>

				<p class="redux-opts-item-data description item-description">
					'.$description.'
				</p>

				<p class="redux-opts-item-data description item-tags">
					'.__('<strong>Tags:</strong> ', 'border_txtd').$tags.'
				</p>

			</div>
		';

	if ( isset($_GET['debug_mod']) && $_GET['debug_mod'] == "true" ) {
	    $tabs['item_info'] = array(
			'icon' => 'info-sign',
			'icon_class' => '',
	        'title' => __('Theme Information', 'border_txtd'),
	        'content' => $item_info
	    );
	}
	return $tabs;
