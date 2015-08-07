<?php
/**
 * The Partial Template for displaying projects - Slideshow.
 *
 */

$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'project_gallery', true );
if (!empty($gallery_ids)) {
    $gallery_ids = explode(',',$gallery_ids);
} else {
    $gallery_ids = array();
}

if ( !empty($gallery_ids) ) {
    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'orderby' => "post__in",
        'post__in'     => $gallery_ids
    ) );
} else {
    $attachments = array();
}

$client_name = '';
$client_name = get_post_meta( get_the_ID(), wpgrade::prefix() . 'project_client_name', true );

$client_link = get_post_meta( get_the_ID(), wpgrade::prefix() . 'project_client_link', true );
if($client_link == '') $client_link = '#';

if (!empty($attachments)) {
	$image_scale_mode = get_post_meta(get_the_ID(), wpgrade::prefix().'project_slider_image_scale_mode', true);
	$slider_visiblenearby = get_post_meta(get_the_ID(), wpgrade::prefix() . 'project_slider_visiblenearby', true);
	$slider_transition = get_post_meta(get_the_ID(), wpgrade::prefix().'project_slider_transition', true);
	$slider_transition_direction ='';
	$slider_transition_direction = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_transition_direction', true);
	$slider_autoplay = get_post_meta(get_the_ID(), wpgrade::prefix().'project_slider_autoplay', true);
	if($slider_autoplay)
		$slider_delay = get_post_meta(get_the_ID(), wpgrade::prefix().'project_slider_delay', true);

	if ($slider_visiblenearby)
		$slider_transition = 'move';

	$full_screen_button = get_post_meta(get_the_ID(), wpgrade::prefix() . 'project_full_screen_button', true);
}

$slider_height_ratio = get_post_meta(get_the_ID(), wpgrade::prefix() . 'project_slider_height_ratio', true);
if($slider_height_ratio == "")
	$slider_height_ratio = 45;

if ($image_scale_mode == '') {
	$image_scale_mode = 'fill';
}
$data_scaling = $image_scale_mode == 'auto' ? 'data-autoheight' : 'data-imagealigncenter data-imagescale="'.$image_scale_mode.'"';

?>
  <!--   <div class="content--portfolio-slider">   -->
<div id='article-holder' class="content--article-split"> 
 

  <article class="article--split  single-post">
                <div class="article--split-grid">
 					<div class="article--split__left--container floatLeft hide-mobile">
                        <div class="article--split__left white-bg" >
                          <div class="panel-small">
								<h1 class="med-title"><span>Our Other services</span></h1>

 

 <ul id='other-links'>
	<li><a href="/portfolio/hot-towel-shave/" class="btn btn--transparent-inline btn--hard">Hot Towel Shave</a></li>
	<li><a href="/portfolio/fade/" class="btn btn--transparent-inline btn--hard">Taperd Fade</a></li>
	<li><a href="/portfolio/fade-beard/" class="btn btn--transparent-inline btn--hard">Fade & Beard</a></li>
	<li><a href="/portfolio/eye-brows/" class="btn btn--transparent-inline btn--hard">Eye Brows</a></li>
	<li><a href="/portfolio/scissor-trim/" class="btn btn--transparent-inline btn--hard">Scissor Tim</a></li>
	<li><a href="/portfolio/hair-lining/" class="btn btn--transparent-inline btn--hard">Hair Lining</a></li>
	<li><a href="/portfolio/creative-cuts/" class="btn btn--transparent-inline btn--hard">Creative Cuts</a></li>
	<li><a href="/portfolio/layrite/" class="btn btn--transparent-inline btn--hard">Layrite Products</a></li>
	<li><a href="/portfolio/johnny-b/" class="btn btn--transparent-inline btn--hard">Johnny B Products</a></li>
	<li><a href="/portfolio/gibs-beard-oil/" class="btn btn--transparent-inline btn--hard">Gibs Beard Oil</a></li>

 </ul>	 
 
		 
		 
		 
 		
	 
	 
	 
	 
	 
	 

 



		 




							</div>




                        </div><!-- .article- -split__left -->
                    </div><!--
                    -->

                    <div class="article--split__right--container floatRight no-padd-left">
                        <div class="article--split__right">
                            <div class="article__content  js-post-gallery  cf">
                                


								<div class="slider-controls  slider-controls--portfolio">
									<div class="slider-controls__arrows">
										<span class="slider-arrow  js-slider-arrow-prev"><i class="icon-angle-up"></i></span>
										<span class="slider-arrow  js-slider-arrow-next"><i class="icon-angle-down"></i></span>
									</div>
								</div>
								<div class="gallery-controls--fullscreen">
									<div class="gallery-controls__arrows">
										<a href="#" class="gallery-arrow  gallery-arrow--left  js-slider-arrow-prev">prev</a>
										<a href="#" class="gallery-arrow  gallery-arrow--right  js-slider-arrow-next">next</a>
									</div>
								</div>		

								<?php if (!empty($attachments) ) : ?>
											<?php if ($full_screen_button == 'show') { ?>
												<div class="gallery-toggle-fullscreen  js-slider-toggle-fullscreen">
													<i class="icon-e-resize-full"></i>
												</div>
											<?php } ?>
											<div class="pixslider  pixslider--portfolio  pixslider--gallery  js-pixslider"
												 data-customarrows="right"
												<?php //echo ($full_screen_button == 'show') ? 'data-fullscreen' : '' ?>
												 data-imagealigncenter
												 <?php echo $data_scaling; ?>
												 data-slidertransition="<?php echo $slider_transition; ?>"
												 <?php if ($slider_transition == 'move') : ?>
												 data-slidertransitiondirection="<?php echo $slider_transition_direction; ?>"
												 <?php endif; ?>
												 data-bullets
												 data-autoscalesliderheight="<?php echo $slider_height_ratio; ?>"
												 data-autoscalesliderwidth="100"
												<?php
												if ($slider_autoplay) {
													echo 'data-sliderautoplay="" ';
													echo 'data-sliderdelay="'. $slider_delay.'" ';
												}
												if ($slider_visiblenearby) {
													echo 'data-visiblenearby ';
												}
												if (wpgrade::option('show_title_caption_popup') == 1) {
													echo "data-enablecaption ";
												}
												?> >

												<?php
												foreach ( $attachments as $attachment ) :

													$attachment_fields = get_post_custom( $attachment->ID );

													$video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

													$thumbimg = wp_get_attachment_image_src($attachment->ID, 'big'); ?>
													<div class="gallery-item<?php echo (!empty($video_url)) ? ' video' : '' ?>" itemscope itemtype="http://schema.org/ImageObject" >
														<img src="<?php echo $thumbimg[0]; ?>" class="attachment-blog-big rsImg" alt="<?php echo $attachment->post_excerpt; ?>" itemprop="contentURL" <?php echo (!empty($video_url)) ? ' data-rsVideo="'.$video_url.'"' : '' ?>/>
													</div>
												<?php
												endforeach; ?>
											</div>
											<?php endif; ?>















<article class="portfolio  portfolio--single">
			
			<div class="portfolio__container">
				<div class="grid">
					<div id='port-body' class="grid__item lap-and-up-one-whole text--center">













						<div class="portfolio__body">
							<h1 class="portfolio__title"><?php the_title(); ?></h1>
						
							<div class="portfolio__content  cf  js-post-gallery">
								<?php the_content(); ?>


	<hr class="separator separator--light" />
							<?php if ( !empty($client_name) ) { ?>
										 
											<span class="meta-box__title"><?php _e('Price', 'border_txtd' ); ?></span>
											<a href="<?php echo $client_link; ?>" target="_blank"><?php echo $client_name; ?></a> &nbsp;&nbsp;&nbsp;
										 
									<?php } ?>




								<?php $taxonomy = wpgrade::shortname() . '_portfolio_categories';
									$categories = get_the_terms( get_the_ID(), $taxonomy );
									if ( !empty($categories) ) { ?>
									 
										<span class="meta-box__title"><?php _e('Categories', 'border_txtd');?></span>
										 
											<?php foreach ($categories as $category): ?>
												 
													<a href="<?php echo get_term_link($category->term_id, $taxonomy); ?>">
														<?php echo $category->name; ?>
													</a> ,
											 
											<?php endforeach;?>
									 
								 
									<?php } ?>

 


								 
							</div>
						</div>
					</div>

</div>
<div class="grid full-grid squared-grid">

		<div class="grid__item lap-and-up-one-half floatLeft portfolio-featured animated fadeInLeft  " <?php echo border::featured_image_as_style_bg(); ?>>

 
 
 


		</div>
		<div id='portfolio-color-div' class="grid__item lap-and-up-one-half floatLeft animated fadeInRight">
			<div class="panel">
				

				<?php the_excerpt(); ?> 

				<?php if (wpgrade::option('projects_single_show_share_buttons')): ?>
									<div class="social-links  social-links--inverse">
										<div class="share-logo">
											<i class="icon-e-share"></i>
										</div><!--
									 --><div class="addthis_toolbox addthis_default_style addthis_32x32_style  social-links-list"
											 addthis:url="<?php echo esc_attr( wpgrade_get_current_canonical_url() ) ?>"
											 addthis:title="<?php wp_title('|', true, 'right'); ?>"
											 addthis:description="<?php echo esc_attr( trim(strip_tags(get_the_excerpt())) ) ?>" >
											<?php get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
										</div>
									</div>
									<?php endif; ?>









			</div>
 



		</div>

</div>







 
		<div class="grid full-grid ">

				<div class="grid__item no-padd  lap-and-up-one-whole floatLeft mosaic-item-nopadd">


							<?php
							if ( function_exists('yarpp_related') ) {
								yarpp_related(array(
									'template'=>'yarpp-template-portfolio.php',
									// Pool options: these determine the "pool" of entities which are considered
									'post_type' => array(get_post_type()),
									'show_pass_post' => false, // show password-protected posts
									'limit' => 3, // maximum number of results
								));
							} ?>


				</div>
		</div>







<span class="copyright-info"><?php echo wpgrade::option( 'copyright_text' ) ?></span>



						</footer>




					</div>
				</div>
			</div>
        </article>
























                                                            
                            </div>
						</div>
					</div>
				</div>

	</article>




        
    </div><!-- .content .content--portfolio-slider -->

<?php
