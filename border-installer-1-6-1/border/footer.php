<?php
/**
 * The template for displaying the footer widget areas.
 * @package Border
 * @since   Border 1.0
 **/

	echo do_action( 'webfontloader' ); ?>
	</div><!-- close div #main -->

	<div class="fixed-bar  horizontal-bar  bottom-bar">
		<footer class="site-footer testing"> 
			<h2 class="accessibility"><?php __( 'Footer', 'border_txtd' ) ?></h2>

			<div class="footer__container">
				<div class="footer__content  footer__content--left  cf">
					<ul class="nav  footer-social-icons  flush--bottom">
						<?php get_template_part( 'theme-partials/wpgrade-partials/social-icons-list' ); ?>
					</ul>
					 

					<?php wpgrade_footer_nav(); ?>
				</div>
			</div>
			<?php
			if ( wpgrade::option( 'back_to_top' ) ) { ?>
				<div class="up-link">
					<a href="#ns__wrapper"><i class="icon-arrow-up"></i></a>
				</div>
			<?php } ?>
			<span class="bg--tiled hidden"></span>
			<span class="bg--text hidden"></span>
		</footer>
		<!-- .site__footer -->

	</div>
</div><!-- #wrapper-->
<?php wp_footer(); ?>
</body>
</html>