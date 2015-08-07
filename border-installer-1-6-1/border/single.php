<?php 
/**
 * The Template for displaying all single posts.
 *
 */

get_header();


global $wpgrade_private_post;

if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {
	// password protection
    get_template_part('theme-partials/password-request-form');

} else {
    $single_layout = wpgrade::option('single_layout', 'classic');

    get_template_part('theme-partials/post-templates/single-content/'. $single_layout);
}
get_footer();
