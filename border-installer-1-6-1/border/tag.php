<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();

$blog_style = wpgrade::option('blog_layout', 'classic');

get_template_part('theme-partials/post-templates/loop/'. $blog_style);

get_footer();
