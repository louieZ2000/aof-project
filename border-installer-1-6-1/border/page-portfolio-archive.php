<?php
/**
 * Template Name: Portfolio Archive
 */

get_header();

$portfolio_style = wpgrade::option('portfolio_archive_layout', 'grid');

get_template_part('theme-partials/portfolio-templates/loop/'.$portfolio_style);

get_footer();