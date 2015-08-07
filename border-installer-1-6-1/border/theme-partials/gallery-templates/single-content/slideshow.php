<?php
/**
 * The Partial Template for displaying galleries - Slideshow.
 *
 */
global $post;

$gallery_ids = get_post_meta( $post->ID, wpgrade::prefix() . 'main_gallery', true );

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

if ( !empty($attachments) ) :
	//let's grab info regarding the slider
	$image_scale_mode = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_image_scale_mode', true);
	$slider_visiblenearby = get_post_meta(get_the_ID(), wpgrade::prefix() . 'gallery_slider_visiblenearby', true);
	$slider_transition = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_transition', true);
	$slider_transition_direction =''; $slider_transition_direction = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_transition_direction', true);
	$slider_autoplay = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_autoplay', true);

	$full_screen_button = get_post_meta(get_the_ID(), wpgrade::prefix() . 'full_screen_button', true);

	$share_button = get_post_meta(get_the_ID(), wpgrade::prefix() . 'gallery_share_button', true);

	if($slider_autoplay) {
		$slider_delay = get_post_meta(get_the_ID(), wpgrade::prefix().'gallery_slider_delay', true);
	}

	$share_button = true;
	if (wpgrade::option('galleries_single_show_share_buttons')) {
		$share_button_single = get_post_meta(get_the_ID(), wpgrade::prefix() . 'gallery_share_button', true);
		$share_links = wpgrade::option('share_buttons_settings');

		if (empty($share_links) || $share_button_single == 'false') {
			//if we have no link settings then there is no point in doing anything
			$share_button = false;
		}
	} else {
		$share_button = false;
	}
	?>
	<div class="content--gallery-slider">
		<div class="content-helper">
			<div class="gallery-controls--fullscreen">
				<div class="gallery-controls__arrows">
					<a href="#" class="gallery-arrow  gallery-arrow--left  js-slider-arrow-prev">prev</a>
					<a href="#" class="gallery-arrow  gallery-arrow--right  js-slider-arrow-next">next</a>
				</div>
			</div>
			<div class="slider-controls">
				<div class="slider-controls__arrows">
					<span class="slider-arrow  js-slider-arrow-prev"><i class="icon-angle-up"></i></span>
					<span class="slider-arrow  js-slider-arrow-next"><i class="icon-angle-down"></i></span>
				</div>
			</div>
			<div class="pixslider  pixslider--gallery  pixslider--fullscreen  js-pixslider"
				 data-customarrows="right"
				 <?php echo ($full_screen_button == 'show') ? 'data-fullscreen' : '' ?>
				 data-imagealigncenter
				 data-imagescale="<?php echo $image_scale_mode; ?>"
				 data-slidertransition="<?php echo $slider_transition; ?>"
				 <?php if ($slider_transition == 'move') : ?>
				 data-slidertransitiondirection="<?php echo $slider_transition_direction; ?>"
				 <?php endif; ?>
				 data-bullets
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
				if ($share_button)  {
					echo 'data-share-buttons="'.$share_links.'"';
				} ?> >
				<?php
				$set_cover = get_post_meta( get_the_ID(), wpgrade::prefix().'set_first_img_as_cover', true);

				foreach ( $attachments as $attachment ) :

					$full_img = wp_get_attachment_image_src($attachment->ID, 'full-size');
					$attachment_fields = get_post_custom( $attachment->ID );

					// prepare the video url if there is one
					$video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

					// should the video auto play?
					$video_autoplay = ( isset($attachment_fields['_video_autoplay'][0] ) && !empty( $attachment_fields['_video_autoplay'][0]) && $attachment_fields['_video_autoplay'][0] === 'on' ) ? $attachment_fields['_video_autoplay'][0] : '';

					if ( !empty($set_cover)  && $set_cover != 'no') {

						$style = get_post_meta( get_the_ID(), wpgrade::prefix().'cover_title_style', true);
						$cover_title = get_post_meta( get_the_ID(), wpgrade::prefix().'gallery_cover_title', true);
						$first_subtitle = get_post_meta( get_the_ID(), wpgrade::prefix().'gallery_cover_first_subtitle', true);
						$second_subtitle = get_post_meta( get_the_ID(), wpgrade::prefix().'gallery_cover_second_subtitle', true);
						$text_color = get_post_meta( get_the_ID(), wpgrade::prefix().'gallery_cover_text_color', true);

						// We use require _once here because get_template_part() does NOT pass variables in that template
						require_once( get_template_directory() . '/theme-partials/gallery-templates/covers/'.$style . '.php');
						$set_cover = false;
					} else { ?>
						<div class="gallery-item<?php echo (!empty($video_url) ? ' video' : '' ); echo ( $video_autoplay == 'on' ) ? ' video_autoplay' : ''; ?>" itemscope itemtype="http://schema.org/ImageObject" data-caption="<?php echo htmlspecialchars( $attachment->post_excerpt ) ?>" data-description="<?php echo htmlspecialchars( $attachment->post_content ) ?>" <?php echo (!empty($video_autoplay) ) ? 'data-video_autoplay="'.$video_autoplay.'"' : ''; ?>>
							<img src="<?php echo $full_img[0]; ?>" class="attachment-blog-big rsImg" alt="<?php echo $attachment->post_excerpt; ?>" itemprop="contentURL" <?php echo (!empty($video_url)) ? ' data-rsVideo="'.$video_url.'"' : ''; ?>  />
						</div>
					<?php }
				endforeach; ?>
			</div>
			<?php if ($full_screen_button == 'show') { ?>
				<div class="gallery-toggle-fullscreen  js-slider-toggle-fullscreen">
					<i class="icon-e-resize-full"></i>
				</div>
			<?php }

			$desc_class = '';
			if(empty($attachments[0]->post_content)) {
				$desc_class = 'no-desc';
			}
			?>
			<div class="gallery-infobox  <?php echo $desc_class; ?>">
				<div class="gallery-infobox__head">
					<div class="gallery-infobox__logo">
						<i class="icon-e-info"></i>
					</div>
					<div class="gallery-infobox__data">
						<span>&nbsp;</span>
					</div>
					<?php if ( $share_button ) { ?>
						<div class="social-links">
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
					<?php } ?>
				</div>
				<div class="gallery-infobox__description"></div>
			</div>
		</div>
	</div><!-- .content .content--gallery-slider -->
<?php else : ?>
    <div class="empty-gallery">
        <?php _e('Currently there are no images assigned to this gallery', 'border_txtd'); ?>
    </div>
<?php endif;
