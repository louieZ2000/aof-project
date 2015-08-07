<?php
/**
 * Template Name: Single Classic
 */
get_header();


global $wpgrade_private_post;

if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {
	// password protection
	get_template_part('theme-partials/password-request-form');

} else {
	global $post; ?>

    <div class="content--blog-classic  content--pixproof">
        <div class="container--blog-classic">
            <article class="article-blog-classic  article--single  soft--top">
                <header>
                    <h1 class="article__title"><?php the_title() ?></h1>
                    <?php if (has_post_thumbnail()):
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-big');
						if (!empty($image[0])): ?>
                        <section class="article__featured-image">
                            <img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>
                        </section>
                    <?php endif;
					endif; ?>
                </header>
                <section class="article__content  cf  js-post-gallery">
                    <?php the_content(); ?>
                </section>
                <footer class="entry__meta">
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
                    endif; ?>
                    <div class="separator separator--dotted"></div>
                </footer>

                <?php

                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template(); ?>
            </article>
        </div>
    </div>
<?php
}
get_footer();
