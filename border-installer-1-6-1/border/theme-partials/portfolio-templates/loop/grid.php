<?php
/**
 * Loop Portfolio Archive Grid
 */

//what taxonomy to use when filtering
$taxonomy = wpgrade::shortname() . '_portfolio_categories';
//how many per page
$projects_per_page = wpgrade::option('portfolio_projects_per_page');
//filtering
$show_filtering = array();
$show_filtering['enabled'] = wpgrade::option('portfolio_projects_filtering') ? true : false;

if($show_filtering['enabled']){
	$show_filtering['style'] = 'horizontal';
	$show_filtering['style'] =  wpgrade::option('portfolio_projects_filtering_style');
}

//classes
$classes = 'mosaic--grid';
//infinite scrolling
if (wpgrade::option('portfolio_infinitescroll')) {
	$classes .= ' infinite_scroll';
}
//filtering class
if (wpgrade::option('portfolio_projects_filtering')) {
	$classes .= ' filter_by';
}
?>
<div class="mosaic-wrapper" data-itemstype="portfolio" data-itemslayout="grid">

<?php wpgrade_display_mosaic(wpgrade::shortname().'_portfolio',$projects_per_page,true,$taxonomy,$show_filtering,'square',$classes); ?>

</div>