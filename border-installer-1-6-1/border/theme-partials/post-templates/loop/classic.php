<?php
/**
 * Loop Template Classic
 */

?>
<div class="content--blog  content--blog-classic">
    <div class="container--blog-classic">
        <?php

        if ( have_posts() ):
            border::get_archive_title();
            $blog_style = wpgrade::option('blog_layout', 'classic');
            while ( have_posts() ) : the_post();
                get_template_part('theme-partials/post-templates/loop-content/' . $blog_style);
            endwhile;
        ?>
        
        <hr class="separator" />    
        <div class="pagination  pagination--archive">
        <?php echo wpgrade::pagination(); ?>
        </div>

        <?php 
        else: get_template_part( 'no-results' ); endif; // end if have_posts()
		?>
    </div>

</div><!-- .content .content--blog -->