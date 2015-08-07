<?php
/**
 * Loop Portfolio Archive Masonry
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
$classes = 'mosaic--masonry js-mosaic--masonry';
//infinite scrolling
if (wpgrade::option('portfolio_infinitescroll')) {
	$classes .= ' infinite_scroll';
}
//filtering class
if (wpgrade::option('portfolio_projects_filtering')) {
	$classes .= ' filter_by';
}
?>






<div id='services-holder' class="content--article-split" style="opacity: 1;">
			<article class="article--split">
                <div class="article--split-grid">
                    <div class="article--split__left--container lap-and-up-one-quarter">
                        <div class="article--split__left white-bg">
                            <div class="panel-small">
								<h1 class='med-title'><span>Our</span><br/>Services</h1>


                               <p>
                               	From the traditional too the cutting edge, we at the Art of Fadez have a full line up quality services and cuts. We also stock some of the best products to keep you looking like a modern gentlemen.
                               </p>
      





















							</div>
                            <div class="article__featured-image">
                                &nbsp;
                            </div>
                            <div class="article__meta">
                               

								                          
                            </div>
                        </div>
                    </div> 
					<div class="article--split__right--container lap-and-up-two-thirds"  >
                        <div class="article--split__right">
                            <div class="article__content  js-post-gallery  cf">
                                											 
									


								<div class="mosaic-wrapper" data-itemstype="portfolio" data-itemslayout="masonry">

								<?php wpgrade_display_mosaic(wpgrade::shortname().'_portfolio',$projects_per_page,true,$taxonomy,$show_filtering,'small-size',$classes); ?>

								</div>






							</div>
						</div>
					</div>
				</div>

			</article>


</div>





