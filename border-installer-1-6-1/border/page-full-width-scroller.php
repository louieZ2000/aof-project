<?php
/**
* Template Name: Full Width Scroller
*/

get_header();

global $wpgrade_private_post;

if ( post_password_required() && !$wpgrade_private_post['allowed'] ) {
// password protection
get_template_part('theme-partials/password-request-form');

} else { ?>



<div class="content--page-fullwidth">

<?php if (have_posts()): the_post(); ?>




<article class="article page page-single page-regular">
<!--  <header>
    <?php if (has_post_thumbnail()):
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
	if (!empty($image[0])): ?>
    <div class="page__featured-image">
        <img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>
    </div>
    <?php endif;
	endif;?>
</header> -->
<div class="page__wrapper"  >





<div id="fullpage">
    <div class="section parent-height" id="first-section" data-anchor="first-section-anchor">
        <div class="pixcode  pixcode--grid  grid">
                <div id='second-image-1'  data-img-width="731" data-img-height="900" class="grid__item  three-twelfths palm-one-whole full-hieght no-padd-left not-fullscreen background one-third-height-mobile"></div>

                <div class="grid__item  six-twelfths palm-one-whole full-hieght white-bg text--center no-padd-left relative-div two-third-height-mobile">
                    <div class="panel vertical-center">
                    <h1 class='animated  fadeInUp'><span>The</span><br/> Art of Fadez</h1>
                    <p class='animated  fadeInUp'>Welcome to the Art of Fadez Barbershop. We have reinvented the barbershop experience by combining both the old and the new. Traditional services with a new fresh feel. Stylish hair, epic beards, polished looks, tight fades, hot shaves and conversations thatll make you feel right at home. </p>
                    <p><img src="/wp-content/themes/border-installer-1-6-1/border/theme-content/images/misc/blue_LOGO.png" alt=""></p>
                    </div>
                    <span data-menuanchor="second-section-anchor">
                            <a href="#second-section-anchor" class=" arrow-bottom"> <img src="/wp-content/themes/border-installer-1-6-1/border/theme-content/images/misc/arrow_Bottom.png" alt=""></a>
                    </span>
                </div>
 
                <div class="grid__item  three-twelfths palm-one-whole full-hieght no-padd-left hide-mobile">
                    <div id='second-image-2' class="not-fullscreen background half-vertical-height" data-img-width="731" data-img-height="900"> </div>
                    <div id='second-image-3' class="not-fullscreen background half-vertical-height" data-img-width="731" data-img-height="900"> </div>
                </div>
 
        </div>
   
    </div>
    <div class="section" id="second-section" data-anchor="second-section-anchor">
        <div class="pixcode  pixcode--grid  grid " >
            <div class="grid__item  five-twelfths palm-one-whole full-hieght white-bg text--center no-padd-left  relative-div">
                <div class="panel vertical-center">
                      <h1><span>Our</span><br/> Professional Barbers</h1>
                        <p>We do not simply consider our selves barbers. Instead we think of our selves as profesinals and all that word entails. We workd hard not becuase its a way to earn a living, but because we take pride in every haircut that steps out of our door. Your appearance should not be your most important impression, but it is your first and we can help.  


                         </p>
                     <p><br/><a href="#" class="btn btn--transparent btn--hard">Book Appointment</a></p>
                </div>
                <span  data-menuanchor="third-section-anchor">
                    <a href="#third-section-anchor" class="active arrow-bottom">
                        <img src="/wp-content/themes/border-installer-1-6-1/border/theme-content/images/misc/arrow_Bottom.png" alt="">
                    </a>
                </span>
            </div>

            <div class="grid__item  seven-twelfths palm-one-whole full-hieght no-padd-left video-responsive">
 
<iframe src="https://player.vimeo.com/video/134226025?title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<!-- 
                <div id='photo-1' class="not-fullscreen background half-vertical-height animated  fadeInDownBig" data-img-width="1326" data-img-height="814"></div>
                <div id='photo-2' class="not-fullscreen background half-vertical-height animated fadeInUpBig" data-img-width="1326" data-img-height="814"></div> -->
            </div>


        </div>
    </div>


<div class="section " id="third-section" data-anchor="third-section-anchor">





<div class="pixcode  pixcode--grid  grid  ">
<div  class="grid__item  five-twelfths palm-one-whole full-hieght no-padd-left">
    <div id='third-image-1' class="not-fullscreen background half-vertical-height" data-img-width="731" data-img-height="900"></div>
    <div id='third-image-2' class="not-fullscreen background half-vertical-height" data-img-width="1460" data-img-height="899"></div>
</div>


<div class="grid__item  seven-twelfths palm-one-whole full-hieght white-bg text--center no-padd-left relative-div">
    <span data-menuanchor="second-section-anchor ">
        <a href="#second-section-anchor" class=" arrow-top"> <img src="/wp-content/themes/border-installer-1-6-1/border/theme-content/images/misc/arrow_Top.png" alt=""></a>
    </span>
    <div class="panel vertical-center">

         <h1><span>Come</span><br/> Visit Us Today</h1>
        <p>We now have two locations for your convience. Our flagship shop located at <a href='https://www.google.com/maps?ll=41.90372,-87.988109&z=16&t=m&hl=en-US&gl=US&mapclient=embed&cid=9872118752379599176'>727 N Addison Rd, Addison IL</a> and since 2014 opened a second location <a href=''>in West Chicago</a> with partner, Jovanny Cervantes and has also been on a fast rise.


        </p>

         <p><br/>
            <a href="#" class="btn btn--transparent btn--hard">Locations</a>
            <a href="#" class="btn btn--transparent btn--hard">View Our Gallery</a>
         </p>
    <span class="copyright-info"><?php echo wpgrade::option( 'copyright_text' ) ?></span>

            
    </div>
</div>


</div>


</div>
</div>


<!-- 
    <section class="page__content  cf  js-post-gallery"> -->


       <!--  <?php the_content(); ?>


        <?php if (wpgrade::option('blog_single_show_share_buttons')): ?>
        <div class="social-links  social-links--inverse">
            <div class="share-logo">
                <i class="icon-e-share"></i>
            </div> <div class="addthis_toolbox addthis_default_style addthis_32x32_style  social-links-list"
                 addthis:url="<?php echo esc_attr( wpgrade_get_current_canonical_url() ) ?>"
                 addthis:title="<?php wp_title('|', true, 'right') ?>"
                 addthis:description="<?php echo esc_attr( trim(strip_tags(get_the_excerpt())) ) ?>">
                <?php get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
            </div>
        </div>
        <?php endif; ?>                          
    </section>
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

	//comments
	if ( comments_open() || '0' != get_comments_number() ):
	comments_template();
	endif; ?> -->
</div>
</article>

<?php
else :
get_template_part( 'no-results' );
endif; ?>

</div><!-- .content -->

<?php } // close if password protection

get_footer();
