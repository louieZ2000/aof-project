<?php
/**
 * Gallery Cover Style 3
 */
?>
<div class="gallery-item cover--style3" itemscope itemtype="http://schema.org/ImageObject" data-caption="<?php echo htmlspecialchars( $attachment->post_excerpt ) ?>" data-description="<?php echo htmlspecialchars( $attachment->post_content ) ?>">
    <div class="cover-wrapper">
        <?php if ( !empty($cover_title) || !empty($first_subtitle) || !empty($second_subtitle) ) { ?>
            <div class="cover-container">
                <div class="cover__content">
                    <style>
                        html .cover__sub-title {
                            <?php wpgrade::display_font_params(wpgrade::option('gallery_cover_subtitle_font_style3')); ?>
                        }

                        html .cover__title {
                            <?php wpgrade::display_font_params(wpgrade::option('gallery_cover_title_font_style3')); ?>
                        }

                        <?php if ( !empty($text_color) ) { ?>

                        /** Give them some color here*/
                        .cover__sub-title, .cover__title, .cover__sub-title a , .cover__title a {
	                        color: <?php echo $text_color ?>;
                        }

                        .cover__circle {
	                        border-color: <?php echo $text_color ?>;
                        }

                        .btn--transparent {
                            border-color: <?php echo $text_color ?>;
                        }

                        body .cover--style3 .cover__title.border--bottom .dash {
	                        background: <?php echo $text_color ?>;
                        }

                        <?php } ?>

                    </style>
                    <?php if (!empty($first_subtitle)) { ?>
                        <div class="cover__sub-title first">
                            <?php echo $first_subtitle; ?>
                        </div>
                    <?php }
                    if (!empty($cover_title)) { ?>
                        <div class="cover__title <?php if (!empty($first_subtitle)) { echo "border--top "; } if (!empty($second_subtitle)) { echo "border--bottom "; } ?>">
                            <?php if (!empty($first_subtitle)) { ?><span class="dash"></span><?php } ?>
                            <?php echo $cover_title ?>
                            <?php if (!empty($second_subtitle)) { ?><span class="dash"></span><?php } ?>
                        </div>
                    <?php }
                    if (!empty($second_subtitle)) { ?>
                        <div class="cover__sub-title second">
                            <?php echo $second_subtitle; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <img src="<?php echo $full_img[0]; ?>" class="attachment-blog-big rsImg" alt="<?php echo $attachment->post_excerpt; ?>" itemprop="contentURL" />
    <?php //echo $caption_text ?>
</div>