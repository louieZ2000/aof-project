<?php
/**
 * Template Name: Galleries Archive
 */

get_header();

$galleries_style = wpgrade::option('galleries_archive_layout', 'grid');

get_template_part('theme-partials/gallery-templates/loop/'.$galleries_style);

get_footer();