<?php
/**
 * Single Template Classic
 *
 */

global $wpgrade_private_post; ?>
    <div class="content--article-split">
        <?php if ( have_posts() ) : the_post(); ?>
            <article class="article--split">
                <div class="article--split-grid">
                    <div class="article--split__left--container">
                        <div class="article--split__left" <?php echo border::featured_image_as_style_bg(); ?>>
                            <div class="article__featured-image">
                                &nbsp;
                            </div>
                            <div class="article__meta">
                                <h1 class="article__title">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="grid  article__meta-footer">
                                    <div class="grid__item  one-whole  lap-and-up-one-half">
                                        <span class="article__timestamp"><?php echo get_the_date(); ?></span>
                                    </div><!--
                                    --><div class="grid__item  one-whole  lap-and-up-one-half">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) { ?>
                                        <ul class="nav  article__categories">
                                            <?php foreach ($categories as $category): ?>
                                                <li class="article__category">
                                                    <a href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo esc_attr(sprintf(__("View all posts in %s", 'border_txtd'), $category->name)) ?>"><?php echo $category->cat_name; ?></a>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .article--split__left -->
                    </div><!--
                    --><div class="article--split__right--container">
                        <div class="article--split__right">
                            <div class="article__content  js-post-gallery  cf">
                                <?php
								if ( !(post_password_required() && !$wpgrade_private_post['allowed'] )):
									$content = strip_tags(strip_shortcodes(get_the_content()));
									if (!empty($content)):
										set_error_handler("custom_warning_handler", E_WARNING);
										//find the first alphanumeric character - multibyte
										preg_match('/[\p{Xan}]/u',$content, $first_letter);

										if (isset($first_letter) && !empty($first_letter[0])): ?>
										<div class="first-letter"><?php echo $first_letter[0]; ?></div>
									<?php else:
											//lets try the old fashion way
											//find the first alphanumeric character - non-multibyte
											preg_match('/[a-zA-Z\d]/',$content, $first_letter);

											if (isset($first_letter) && !empty($first_letter[0])): ?>
											<div class="first-letter"><?php echo $first_letter[0]; ?></div>
										<?php endif;
											endif;
										restore_error_handler();
									endif;
								endif;
								the_content(); ?>
                            </div>
                        </div>
                        <footer class="entry__meta  entry__meta--single">
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
                                <div class="entry__meta-box meta-box--tags">
                                    <span class="meta-box__title"><?php _e('Tagged', 'border_txtd') ?></span>
                                    <ul class="nav nav--keywords inline">
                                        <?php
                                        foreach ($tags as $tag):
                                            echo '<li><a href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s", 'border_txtd'), $tag->name)) .'">'. $tag->name.'</a></li>';
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
                    </div>
                </div><!-- .grid -->
            </article>
        <?php endif; ?>
    </div><!-- .content -->
<?php
