<?php

/**
 * Loop Template Grid
 *
 */

?>
<div class="content--blog  content--blog-grid">
	<?php if ( have_posts() ) :
		border::get_archive_title();
		?>
		<div class="grid  grid--thin">
			<?php

			while ( have_posts() ) : the_post(); ?><!--
				--><div class="grid__item">
				<?php
				$blog_style = wpgrade::option('blog_layout', 'grid');
				get_template_part('theme-partials/post-templates/loop-content/' . $blog_style); ?>
			</div><!--
			--><?php endwhile; // end while have_posts() ?>
		</div><!-- .grid -->

		<div class="pagination  pagination--archive">
			<?php echo wpgrade::pagination(); ?>
		</div>

	<?php else: get_template_part( 'no-results' ); endif; // end if have_posts()
	?>
</div><!-- .content .content--blog -->