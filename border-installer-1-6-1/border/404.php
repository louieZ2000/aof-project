<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

<div class="content--blog-classic">
    <div class="container--blog-classic">
        <article class="article-blog-classic  article--single">
			<h2 class="hN"><?php _e( 'Oops! That page can&rsquo;t be found.', 'border_txtd' ); ?></h2>
			<p><?php printf( __( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing.<br />You should try the <a href="%s">homepage</a> instead or maybe do a search?', 'border_txtd' ), home_url()); ?></p>
			<div class="search-form  search-form--404 push--bottom">
				<?php get_search_form(); ?>
			</div>
		</article>
	</div>
</div>
    
<?php get_footer(); ?>