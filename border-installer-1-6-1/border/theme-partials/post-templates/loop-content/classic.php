<?php
/**
 * Template to display the article in archives in a clasic way
 */

$has_thumb = has_post_thumbnail();

$post_class_thumb = 'has-thumbnail';
if(!$has_thumb) $post_class_thumb = 'no-thumbnail'; ?>

<article <?php post_class('article-blog-classic  ' . $post_class_thumb); ?>>
    <div class="article__container">
        <header>
            <h1 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <section class="article__meta">
                <span class="article__date"><?php echo get_the_date(); ?></span>
                <?php $categories = get_the_category();
                if ( !is_wp_error( $categories ) ) { ?>
                    &nbsp;/ <ul class="nav flush--bottom article__categories">
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
            <?php
            if ($has_thumb):
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-big');
				if (!empty($image[0])) : ?>
                <section class="article__featured-image">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/></a>
                </section>
            <?php endif;
			endif;?>
        </header>
        <section class="article__content">
            <?php echo wpgrade_better_excerpt(); ?>
        </section>
    </div>
</article>
<?php

