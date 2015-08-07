<?php 
/*
Template Name: Custom Home Page
*/

get_header('homepage');
//now this is a template that simply reads the meta data of the page with this template and delivers the output
//let's get cranking

//get the option the user chosed in the page metaboxes
$source = get_post_meta(wpgrade::lang_page_id(get_the_ID()), wpgrade::prefix() . 'custom_homepage', true);

if (!empty($source)) {
	switch ($source) {
		case 'border_portfolio_archive':
			$portfolio_style = wpgrade::option('portfolio_archive_layout', 'grid');

			get_template_part('theme-partials/portfolio-templates/loop/'.$portfolio_style);
			break;
		case 'border_portfolio_cat':
			//get the portfolio cat
			$portfolio_cat_slug = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_portfolio_category', true);
			
			//lets set in the query
			set_query_var('border_portfolio_categories', $portfolio_cat_slug);
			$portfolio_style = wpgrade::option('portfolio_archive_layout', 'grid');

			get_template_part('theme-partials/portfolio-templates/loop/'.$portfolio_style);
			wp_reset_query();
			break;
		case 'border_project':
			//get the project id
			$projectID = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_project', true);

			if (is_numeric($projectID)) {
				global $wp_query;
				query_posts('post_type=border_portfolio&p='.$projectID);
				if (have_posts()) {
					the_post();
					//for now we only have one project layout
					get_template_part('theme-partials/portfolio-templates/single-content/slideshow');
				}
				wp_reset_query();
			}
			break;
		case 'border_galleries_archive':
			$galleries_style = wpgrade::option('galleries_archive_layout', 'grid');

			get_template_part('theme-partials/gallery-templates/loop/'.$galleries_style);
			break;
		case 'border_galleries_cat':
			//get the galleries cat
			$galleries_cat_slug = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_galleries_category', true);
			
			//lets set in the query
			set_query_var('border_gallery_categories', $galleries_cat_slug);
			$galleries_style = wpgrade::option('galleries_archive_layout', 'grid');

			get_template_part('theme-partials/gallery-templates/loop/'.$galleries_style);
			wp_reset_query();
			break;
		case 'border_gallery':
			//get the gallery id
			$galleryID = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_gallery', true);

			if (is_numeric($galleryID)) {
				global $wp_query;
				query_posts('post_type=border_gallery&p='.$galleryID);
				if (have_posts()) {
					the_post();
					$template = border::get_gallery_type($galleryID);
					get_template_part('theme-partials/gallery-templates/single-content/' . $template);
				}
				wp_reset_query();
			}
			break;
		default: 
	}
}
get_footer();