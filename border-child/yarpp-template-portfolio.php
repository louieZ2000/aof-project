<?php
/*
YARPP Template: Related Projects
*/

if ( have_posts() ):?>
    <div class="related-projects-container">
        <h3 class="related-projects-title"><?php _e('Related projects', wpgrade::textdomain()); ?></h3>

        <div class="mosaic  mosaic--grid  mosaic--archive">
            <?php while (have_posts()) : the_post(); ?>
                    
                    <div class="mosaic__item">
                        <a href="<?php the_permalink(); ?>">
                            <?php
								$image_size = 'square';
								$image = array();
								if (has_post_thumbnail()) {
									$image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
								} else {
									//try and get the first image in the gallery
									$image = wpgrade_get_first_gallery_image_src(get_the_ID(),$image_size);
								}
								if (!empty($image)) :
							?>
                                <div class="mosaic__image">
									<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                                </div>
                            <?php else: ?>
                                <div class="mosaic__image  no-image">
                                </div>
                            <?php endif; ?>
                            <div class="mosaic__meta">
                                <div class="flexbox">
                                    <div class="flexbox__item">
                                        <h5 class="meta__title"><?php the_title(); ?></h5>
                                        <hr class="separator  separator--light">
                                        <?php
                                        $taxonomy = wpgrade::shortname() . '_portfolio_categories';
                                        $categories = get_the_terms( get_the_ID(), $taxonomy );
                                        if ($categories) : ?>
                                                <?php foreach ($categories as $category): ?>
                                                    <span class="meta__category"><?php echo $category->name; ?></span>
                                                <?php break; endforeach;?>
                                        <?php endif; ?>                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
            <?php endwhile; ?>
        </div><!-- .mosaic -->        
    </div>
    <?php else: ?>
        <p><?php _e("No related projects yet.", wpgrade::textdomain()); ?></p>
<?php endif;