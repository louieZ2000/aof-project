<?php
/**
 * Loop Gallery Archive Grid
 */

//what taxonomy to use when filtering
$taxonomy = wpgrade::shortname() . '_gallery_categories';
//how many per page
$galleries_per_page = wpgrade::option('galleries_per_page');
//filtering
$show_filtering = array();
$show_filtering['enabled'] = wpgrade::option('galleries_archive_filtering') ? true : false;

if($show_filtering['enabled']){
	$show_filtering['style'] = 'horizontal';
	$show_filtering['style'] =  wpgrade::option('galleries_archive_filtering_style');
}

//classes
$classes = 'mosaic--grid';
//infinite scrolling
if (wpgrade::option('galleries_infinitescroll')) {
	$classes .= ' infinite_scroll';
}
//filtering class
if (wpgrade::option('galleries_archive_filtering')) {
	$classes .= ' filter_by';
}
?>
<div class="mosaic-wrapper" data-itemstype="gallery" data-itemslayout="grid">


<?php wpgrade_display_mosaic( wpgrade::shortname().'_gallery',$galleries_per_page,true,$taxonomy,$show_filtering,'square',$classes); ?>

</div>