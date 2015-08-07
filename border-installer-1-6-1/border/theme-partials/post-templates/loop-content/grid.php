<?php
/**
 * Template to display the article in archives in grid style
 */

$has_thumb = has_post_thumbnail();

$post_class_thumb = 'has-thumbnail';
if ( ! $has_thumb ) {
	$post_class_thumb = 'no-thumbnail';
} ?>

<article <?php post_class( 'article  article--blog  article--blog-split ' . $post_class_thumb ); ?>>
	<div class="article__container">
		<?php
		if ( $has_thumb ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-medium' ); ?>
			<div class="article__thumb">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo $image[ 0 ] ?>" alt="<?php the_title(); ?>"/>
				</a>
			</div>
		<?php } ?>

		<div class="article__info">
			<h2 class="article__title  article__title--blog"><a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</h2>

			<div class="article__excerpt">
				<a href="<?php the_permalink(); ?>">
					<?php echo wpgrade_better_excerpt( get_the_content() ); ?>
				</a>
			</div>
			<div class="article__meta-footer">
				<div class="grid">
					<div class="grid__item  one-whole  lap-and-up-one-half">
						<span class="article__timestamp"><?php echo get_the_date(); ?></span>
					</div>
					<div class="grid__item  one-whole  lap-and-up-one-half">
						<?php
						$categories = get_the_category();
						if ( ! is_wp_error( $categories ) ) { ?>
							<ul class="nav  article__categories  flush">
								<?php foreach ( $categories as $category ) { ?>
									<li class="article__category">
										<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", 'border_txtd' ), $category->name ) ) ?>">
											<?php echo $category->cat_name; ?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
