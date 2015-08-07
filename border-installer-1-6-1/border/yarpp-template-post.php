<?php
/*
YARPP Template: Related Articles
*/
?>
<?php if (have_posts()):?>
    <h3 class="emphasize"><?php _e('You may also like', 'border_txtd'); ?></h3>
        <div class="related-posts-container">
            <ul class="related-projects__list  grid"><!--
                <?php while (have_posts()) : the_post(); ?>
                    --><li class="related-projects__item  grid__item  one-whole  lap-and-up-one-third">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="project-thumb">
                                    <?php the_post_thumbnail('square'); ?>
                                </div>
                            <?php else : ?>
								<div class="mosaic__image  no-image">
								</div>
							<?php endif; ?>
                            <div class="project-content">
                                <h4 class="project-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="entry__meta">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) { ?>
                                        <div class="entry__meta-box">
                                            <?php foreach ($categories as $category): ?>
                                                <a class="project-category" href="<?php echo get_category_link($category->term_id); ?>" title="<?php echo esc_attr(sprintf(__("View all posts in %s", 'border_txtd'), $category->name)) ?>">
                                                    <?php echo $category->cat_name; ?>
                                                </a>
                                            <?php endforeach;?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </li><!--
                <?php endwhile; ?>
            --></ul>
        </div>
    <?php else: ?>
    <p><?php _e("No related articles yet.", 'border_txtd'); ?></p>
<?php endif;
