<?php
/**
 * Template Name: Single Classic
 */
get_header();?>
    <div class="content--blog-classic">
        <div class="container--blog-classic">
            <article class="article-blog-classic  article--single">
                <header>
                    <h1 class="article__title"><?php the_title() ?></h1>
                    <section class="article__meta">
                        <span class="article__date"><?php echo get_the_date(); ?></span>&nbsp;/ <?php
                        $categories = get_the_category();
                        if (!empty($categories)) { ?>
                            <ul class="nav  flush--bottom  article__categories">
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                        <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo esc_attr(sprintf(__("View all posts in %s", 'border_txtd'), $category->name)) ?>">
                                            <?php echo $category->cat_name; ?>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        <?php } ?>
                    </section>

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
                    endif;

                    $tags = get_the_tags();
                    if (!empty($tags)): ?>
                        <div class="entry__meta-box  meta-box--tags">
                            <span class="meta-box__title"><?php _e('Tagged', 'border_txtd') ?></span>
                            <ul class="nav nav--keywords inline">
                                <?php
                                foreach ($tags as $tag):
                                    echo '<li><a href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s", 'border_txtd'), $tag->name)) .'">'. $tag->name .'</a></li>';
                                endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
					<?php if (wpgrade::option('blog_single_show_share_buttons')): ?>
					<div class="social-links  social-links--inverse">
						<div class="share-logo">
							<i class="icon-e-share"></i>
						</div><!--
					--><div class="addthis_toolbox addthis_default_style addthis_32x32_style  social-links-list"
							 addthis:url="<?php echo esc_attr( wpgrade_get_current_canonical_url() ) ?>"
							 addthis:title="<?php wp_title('|', true, 'right'); ?>"
							 addthis:description="<?php echo esc_attr( trim(strip_tags(get_the_excerpt())) ) ?>">
							<?php get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
						</div>
					</div>
					<?php endif; ?>

                    <div class="article-navigation">
                        <?php previous_post_link('<div class="navigation-item  navigation-item--previous">%link</div>', 
                                    sprintf('<span class="arrow"></span>
                                            <div class="navigation-item__content">
                                                <div class="navigation-item__wrapper">
                                                    <span class="button-title">%s</span>
                                                    <h3 class="post-title">%%title</h3>
                                                </div>
                                            </div>', 
                                    __('Previous Article', 'border_txtd')) ); ?>
                                    
                        <?php next_post_link('<div class="navigation-item  navigation-item--next">%link</div>', 
                                    sprintf('<span class="arrow"></span>
                                            <div class="navigation-item__content">
                                                <div class="navigation-item__wrapper">
                                                    <span class="button-title">%s</span>
                                                    <h3 class="post-title">%%title</h3>
                                                </div>
                                            </div>',
                                    __('Next Article', 'border_txtd')) ); ?>
                    </div>
                    <hr class="separator  separator--dark" />
                </footer>

                <?php
                if ( function_exists('yarpp_related') ) {
                    yarpp_related(array(
                        'template'=>'yarpp-template-post.php',
                        // Pool options: these determine the "pool" of entities which are considered
                        'post_type' => array('post'),
                        'show_pass_post' => false, // show password-protected posts
                        'limit' => 3, // maximum number of results
                    ));
                }

                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template(); ?>
            </article>
        </div>
    </div>

<?php
get_footer();
