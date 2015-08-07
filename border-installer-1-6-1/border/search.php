<?php
/**
 * The template for displaying Search Results pages.
 */

get_header();

$blog_style = wpgrade::option('blog_layout', 'classic');

get_template_part('theme-partials/post-templates/loop/'. $blog_style);

get_footer();