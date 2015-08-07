<?php
/**
 * The Template for displaying all single galleries.
 *
 */

get_header();

if ( have_posts() ) : the_post();

    global $wpgrade_private_post;

    if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {
		// password protection
        get_template_part('theme-partials/password-request-form');
    } else {
        $template = border::get_gallery_type(get_the_ID());
        get_template_part('theme-partials/gallery-templates/single-content/' . $template);
    }

else :
    get_template_part('no-results');
endif;

get_footer();