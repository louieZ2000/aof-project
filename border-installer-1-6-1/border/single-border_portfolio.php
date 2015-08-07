<?php
/**
 * The Template for displaying all projects.
 *
 */

get_header();

if ( have_posts() ) : the_post();

    global $wpgrade_private_post;

    if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {

        get_template_part('theme-partials/password-request-form');

    } else { // password protection

        get_template_part('theme-partials/portfolio-templates/single-content/slideshow');
    }

else :
    get_template_part('no-results');
endif;

get_footer();