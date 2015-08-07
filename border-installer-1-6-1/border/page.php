<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */

get_header();

global $wpgrade_private_post;

if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {
	// password protection
    get_template_part('theme-partials/password-request-form');

} else { ?>
    <div class="content--page-regular">

        <?php if (have_posts()): the_post(); ?>

            <article class="article page page-single page-regular">
                <header>
                    <?php if (has_post_thumbnail()):
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
					if (!empty($image[0])): ?>
                    <div class="page__featured-image">
                        <img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>
                    </div>
                    <?php endif;
					endif;?>
                </header>
                <div class="page__wrapper">
                    <section class="page__content  js-post-gallery  cf">
                        <h1 class="page__title"><?php the_title(); ?></h1>
                        <hr class="separator separator--dark" />
                        <?php the_content(); ?>
                        
                        <?php if (wpgrade::option('blog_single_show_share_buttons')): ?>
                        <div class="social-links  social-links--inverse">
                            <div class="share-logo">
                                <i class="icon-e-share"></i>
                            </div><!--
                        --><div class="addthis_toolbox addthis_default_style addthis_32x32_style  social-links-list"
                                 addthis:url="<?php echo esc_attr( wpgrade_get_current_canonical_url() ) ?>"
                                 addthis:title="<?php wp_title('|', true, 'right') ?>"
                                 addthis:description="<?php echo esc_attr( trim(strip_tags(get_the_excerpt())) ) ?>">
                                <?php get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
                            </div>
                        </div>
                        <?php endif; ?>                        
                    </section>
                    <?php 
                    global $numpages; 
                    if($numpages > 1):
                    ?>
                    <div class="entry__meta-box  meta-box--pagination">
                        <span class="meta-box__title"><?php _e('Pages', 'border_txtd') ?></span>
                        <?php
                        $args = array(
                            'before' => '<ol class="nav  pagination--single">',
                            'after' => '</ol>', 
                            'next_or_number' => 'next_and_number',
                            'previouspagelink' => __('&laquo;', 'border_txtd'),
                            'nextpagelink' => __('&raquo;', 'border_txtd')
                        );
                        wp_link_pages( $args ); 
                        ?>
                    </div>
                    <?php
                    endif;

					//comments
					if ( comments_open() || '0' != get_comments_number() ):
					comments_template();
					endif; ?>
                </div>
            </article>

        <?php
        else :
            get_template_part( 'no-results' );
        endif; ?>

    </div><!-- .content -->

<?php } // close if password protection

get_footer();
