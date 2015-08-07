<?php
/**
 * Template Name: Blog Archive
 */

get_header();

// save the page title and excerpt
$current_title = get_the_title();
$current_excerpt = get_the_excerpt();

global $paged;
global $wp_query;
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');
query_posts( array('post_type' => 'post', 'paged'=>$paged));

$blog_style = wpgrade::option('blog_layout', 'classic');

get_template_part('theme-partials/post-templates/loop/'. $blog_style);

wp_reset_query();
get_footer();