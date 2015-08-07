<?php

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

if (!empty($attachments) ) :
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

    <div class="mosaic-wrapper">
        <div class="mosaic  mosaic--grid  js-gallery" <?php echo ($share_button) ? 'data-share-buttons="'.$share_links.'"' : '' ?>>
        <?php
        $show_gallery_title = get_post_meta( $post->ID, wpgrade::prefix() . 'show_gallery_title', true );
        if ( ! empty( $show_gallery_title ) && $show_gallery_title == "show" ) { ?>
	        <div class="mosaic__item  mosaic__title">
		        <a href="#">
			        <div class="mosaic__image" style="padding-top: 100%;">
			        </div>
			        <div class="mosaic__meta">
				        <div class="flexbox">
					        <div class="flexbox__item">
						        <h1><?php the_title(); ?></h1>
					        </div>
				        </div>
			        </div>
		        </a>
	        </div>
        <?php
        }

        foreach($attachments as  $key => $attachment ) :

            $the_link = $attachment->guid;
            $the_class = 'mfp-image';
            $the_icon = '+';
            $attachment_fields = get_post_custom( $attachment->ID );
            $external_url = ( isset($attachment_fields['_external_url'][0] ) && !empty( $attachment_fields['_external_url'][0]) ) ? esc_url( $attachment_fields['_external_url'][0] ) : '';

            if (!empty($external_url) ) {
                $the_link = $external_url;
                $the_class = '';
                $the_icon = '<i class="icon-e-link"></i>';
            }
            // check if this attachment has a video url
            $video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';
            if (!empty($video_url) ) {
                $the_link = $video_url;
                $the_class = 'mfp-video  mfp-iframe';
                $the_icon = '<i class="icon-e-play"></i>';
            }

            $image = wp_get_attachment_image_src($attachment->ID, 'square', false); ?>
			<div class="mosaic__item<?php echo (!empty($video_url) ) ? ' item--video' : '';?>  <?php echo (!empty($external_url) ) ? ' item--link' : '';?>">
                <a href="<?php echo $the_link ?>"<?php if(!empty($external_url)) echo ' target="_blank" ';?>class="<?php echo $the_class; ?>" data-caption="<?php echo htmlspecialchars( $attachment->post_excerpt ) ?>" data-description="<?php echo htmlspecialchars( $attachment->post_content ) ?>" title="<?php echo $attachment->post_title; ?>" >
                    <div class="mosaic__image" style="padding-top: 100%;">
						<?php if (!empty($image[0])) : ?>
                        <img src="<?php echo $image[0] ?>" alt="<?php echo $attachment->post_title; ?>">
						<?php endif; ?>
                    </div>
                    <div class="mosaic__meta">
                        <div class="mosaic__hoverdir">
                            <div class="flexbox">
                                <div class="flexbox__item">
                                    <div class="meta__icon"><?php echo $the_icon;?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        <div class="gallery-infobox">
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
        </div><!-- .mosaic -->
    </div><!-- .mosaic-wrapper -->
	<?php if ($share_button) get_template_part('theme-partials/wpgrade-partials/addthis-js-config'); ?>
<?php else : ?>
    <div class="empty-gallery">
        <?php _e('Currently there are no images assigned to this gallery', 'border_txtd'); ?>
    </div>
<?php endif;
