<?php
//function to make sure that the proper cover fonts are loaded
function prepare_covers(){
    if ( wpgrade::shortname() . '_gallery' ==  get_post_type() || is_front_page() ) {
        add_filter( 'wpgrade_google_fonts', 'wpgrade_add_google_cover_fonts', 10, 1);
    }
}
add_action('wp_head', 'prepare_covers');

//filter the google fonts so we add the proper cover fonts
function wpgrade_add_google_cover_fonts( $families = array() ) {

	$galleryID = null;

	if (is_front_page()) {
		//get the option the user chosed in the page metaboxes
		$source = get_post_meta(wpgrade::lang_page_id(get_the_ID()), wpgrade::prefix() . 'custom_homepage', true);

		if (!empty($source)) {
			if ($source == 'border_gallery') {
				//get the gallery id
				$tempID = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'homepage_gallery', true);

				if (is_numeric($tempID)) {
					$galleryID = $tempID;
				}
			}
		}
	} else {
		$galleryID = wpgrade::lang_page_id(get_the_ID());
	}

    $style = get_post_meta( $galleryID, wpgrade::prefix().'cover_title_style', true);

    $title_font = wpgrade::get_google_font_name( 'gallery_cover_title_font_' . $style );
    $subtitle_font = wpgrade::get_google_font_name( 'gallery_cover_subtitle_font_' . $style );

    if ( ! empty($title_font) ) {
        $families[] = $title_font;
    }

    if ( ! empty($subtitle_font) ) {
        $families[] = $subtitle_font;
    }
    return $families;
}

function wpgrade_is_all_multibyte($string)
{
	if (function_exists('mb_check_encoding')) {
		// check if the string doesn't contain invalid byte sequence
		if (mb_check_encoding($string, 'UTF-8') === false) return false;

		$length = mb_strlen($string, 'UTF-8');

		for ($i = 0; $i < $length; $i += 1) {
			$char = mb_substr($string, $i, 1, 'UTF-8');

			// check if the string doesn't contain single character
			if (mb_check_encoding($char, 'ASCII')) {
				return false;
			}
		}

		return true;
	} else {
    	return false;
    }

}

function wpgrade_contains_any_multibyte($string)
{
	if (function_exists('mb_check_encoding')) {
    	return !mb_check_encoding($string, 'ASCII') && mb_check_encoding($string, 'UTF-8');
    } else {
    	return false;
    }
}

/**
* Cutting the titles and adding '...' after
* @param  [string] $text       [description]
* @param  [int] $cut_length [description]
* @param  [int] $limit      [description]
* @return [type]             [description]
*/
function short_text($text, $cut_length, $limit, $echo = true){
   $char_count = mb_strlen($text);
   $text = ( $char_count > $limit ) ? mb_substr($text,0,$cut_length).wpgrade::option('blog_excerpt_more_text') : $text;
   if ($echo) {
	   echo $text;
   } else {
	   return $text;
   }
}

/**
* Borrowed from CakePHP
*
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* ### Options:
*
* - `ending` Will be used as Ending and appended to the trimmed string
* - `exact` If false, $text will not be cut mid-word
* - `html` If true, HTML tags would be handled correctly
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param array $options An array of html attributes and options.
* @return string Trimmed string.
* @access public
* @link http://book.cakephp.org/view/1469/Text#truncate-1625
*/

function truncate($text, $length = 100, $options = array()) {
    $default = array(
        'ending' => '...', 'exact' => true, 'html' => false
    );
    $options = array_merge($default, $options);
    extract($options);

    if ($html) {
        if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        $totalLength = mb_strlen(strip_tags($ending));
        $openTags = array();
        $truncate = '';

        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                    array_unshift($openTags, $tag[2]);
                } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false) {
                        array_splice($openTags, $pos, 1);
                    }
                }
            }
            $truncate .= $tag[1];

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0]);
                        } else {
                            break;
                        }
                    }
                }

                $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                break;
            } else {
                $truncate .= $tag[3];
                $totalLength += $contentLength;
            }
            if ($totalLength >= $length) {
                break;
            }
        }
    } else {
        if (mb_strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - mb_strlen($ending));
        }
    }
    if (!$exact) {
        $spacepos = mb_strrpos($truncate, ' ');
        if (isset($spacepos)) {
            if ($html) {
                $bits = mb_substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                if (!empty($droppedTags)) {
                    foreach ($droppedTags as $closingTag) {
                        if (!in_array($closingTag[1], $openTags)) {
                            array_unshift($openTags, $closingTag[1]);
                        }
                    }
                }
            }
            $truncate = mb_substr($truncate, 0, $spacepos);
        }
    }
    $truncate .= $ending;

    if ($html) {
        foreach ($openTags as $tag) {
            $truncate .= '</'.$tag.'>';
        }
    }

    return $truncate;
}

//@todo CLEANUP refactor function
function wpgrade_better_excerpt($text = '') {
	global $post;
	$raw_excerpt = '';

	//if the post has a manual excerpt ignore the content given
	if ($text == '' && function_exists('has_excerpt') && has_excerpt()) {
		$text = get_the_excerpt();
		$raw_excerpt = $text;

		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		$allowed_tags = '<p><a><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		$text = strip_tags($text, $allowed_tags);
//		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
//		$text .= $excerpt_more;

	} else {

		if (empty($text)) {
			//need to grab the content
			$text = get_the_content();
		}

		$raw_excerpt = $text;
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		//$allowed_tags = '<p><a><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		$text = strip_tags($text, '');

		// Set custom excerpt length - number of words to be shown in excerpts
		if (wpgrade::option('blog_excerpt_length'))	{
			$excerpt_length = absint(wpgrade::option('blog_excerpt_length'));
		} else {
			$excerpt_length = 180;
		}

		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

        $options = array(
            'ending' => $excerpt_more, 'exact' => false, 'html' => true
        );
        $text = truncate($text, $excerpt_length, $options);

	}

	// IMPORTANT! Prevents tags cutoff by excerpt (i.e. unclosed tags) from breaking formatting
	$text = force_balance_tags( $text );

	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/*
 * COMMENT LAYOUT
 */
function wpgrade_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
		<?php
		$author_email = get_comment_author_email($comment->comment_ID);
		$avatar = get_avatar( $author_email );

		if ( ! empty( $avatar ) ) { ?>

			<aside class="comment__avatar  media__img">
				<?php echo $avatar; ?>
			</aside>

		<?php } ?>

		<div class="media__body">
			<header class="comment__meta comment-author">
				<?php printf('<span class="comment__author-name">%s</span>', get_comment_author_link()) ?>
				<time class="comment__time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp"><?php printf(__('on %s at %s', 'border_txtd'),get_comment_date(),get_comment_time()); ?> </a></time>
				<div class="comment__links">
					<?php
					edit_comment_link(__('Edit', 'border_txtd'),'  ','');
					comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					?>
				</div>
			</header><!-- .comment-meta -->
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert info">
					<p><?php _e('Your comment is awaiting moderation.', 'border_txtd') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
			</section>
		</div>
	</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

function custom_excerpt_length( $length ) {
	// Set custom excerpt length - number of words to be shown in excerpts
	if (wpgrade::option('blog_excerpt_length'))	{
		return absint(wpgrade::option('blog_excerpt_length'));
	} else {
		return 55;
	}
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Replace the [...] wordpress puts in when using the the_excerpt() method.
 */
function new_excerpt_more($excerpt) {
	return wpgrade::option('blog_excerpt_more_text');
}
add_filter('excerpt_more', 'new_excerpt_more');

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


/** Add New Field To Category **/
function extra_category_fields( $tag ) {
	if (isset($tag->term_id)) {
		$t_id = $tag->term_id;
		$cat_meta = get_option( "category_$t_id" );
	} else {
		$cat_meta = array();
	}
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="meta-color"><?php _e('Category Custom Accent Color', 'border_txtd'); ?></label></th>
		<td>
			<div id="colorpicker">
				<input type="text" name="cat_meta[cat_custom_accent]" class="colorpicker" size="3" style="width:20%;" value="<?php echo (isset($cat_meta['cat_custom_accent'])) ? $cat_meta['cat_custom_accent'] : wpgrade::option('main_color'); ?>" />
			</div>
			<br />
			<span class="description"><?php _e('Set here a custom accent color for this category. We will change the main accent color with this one in the category archives and posts in that category. <b>Note:</b> You must apply the custom CSS <b>Inline</b> for this to work (Theme Options > Custom Code).', 'border_txtd'); ?></span>
			<br />
		</td>
	</tr>
<?php
}
add_action ( 'category_add_form_fields', 'extra_category_fields');
add_action('category_edit_form_fields','extra_category_fields');

/** Save Category Meta **/
function save_extra_category_fields( $term_id ) {

	if ( isset( $_POST['cat_meta'] ) ) {
		$t_id = $term_id;
		$cat_meta = get_option( "category_$t_id");
		$cat_keys = array_keys($_POST['cat_meta']);
		foreach ($cat_keys as $key){
			if (isset($_POST['cat_meta'][$key])){
				$cat_meta[$key] = $_POST['cat_meta'][$key];
			}
		}
		//save the option array
		update_option( "category_$t_id", $cat_meta );
	}
}
add_action ( 'edited_category', 'save_extra_category_fields');

function get_category_color($cat_id) {
	$cat_data = get_option("category_$cat_id");

	if (!empty($cat_data['cat_custom_accent']) && ($cat_data['cat_custom_accent'] != wpgrade::option('main_color'))) {
		return $cat_data['cat_custom_accent'];
	} else {
		return false;
	}
}

/** Enqueue Color Picker **/
function colorpicker_enqueue() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'colorpicker-js', wpgrade::resourceuri('js/admin/color-picker.js'), array( 'wp-color-picker' ) );
}
add_action( 'admin_enqueue_scripts', 'colorpicker_enqueue' );

//fix the canonical url of YOAST because on the front page it ignores the pagination
add_filter( 'wpseo_canonical', 'wpgrade_get_current_canonical_url' );
//fix the canonical url of AIOSEOP because on the front page it breaks the pagination
add_filter( 'aioseop_canonical_url', 'wpgrade_get_current_canonical_url' );

/**
 * Filter the page title so that plugins can unhook this
 *
 */
function wpgrade_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'border_txtd' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wpgrade_wp_title', 10, 2 );


function wpgrade_fix_yoast_page_number( $title ) {

	global $paged, $page, $sep;

	if ( is_home() || is_front_page() ) {
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'border_txtd' ), max( $paged, $page ) );
	}
	return $title;
}
//filter the YOAST title so we can correct the page number missing on frontpage
add_filter('wpseo_title', 'wpgrade_fix_yoast_page_number');

//get the first image in a gallery or portfolio
function wpgrade_get_first_gallery_image_src($post_ID,$image_size) {
	$post_type = get_post_type($post_ID);

	switch ($post_type) {
		case wpgrade::shortname().'_portfolio':
			$gallery_ids = get_post_meta( $post_ID, wpgrade::prefix() . 'project_gallery', true );
			break;
		case wpgrade::shortname().'_gallery':
			$gallery_ids = get_post_meta( $post_ID, wpgrade::prefix() . 'main_gallery', true );
			break;
	}

	if (!empty($gallery_ids)) {
		$gallery_ids = explode(',',$gallery_ids);
	} else {
		$gallery_ids = array();
	}

	if ( !empty($gallery_ids[0]) ) {
		return wp_get_attachment_image_src($gallery_ids[0], $image_size);
	} else {
		return null;
	}
}

//function to output the portfolio and galleries archives
function wpgrade_display_mosaic($post_type, $posts_per_page, $show_pagination = true, $taxonomy = '', $filter_by_tax = array('enabled'=>false, 'style'=>'horizontal'), $image_size = 'square', $mosaic_class = 'mosaic--grid', $display_all = false) {
	global $paged;

	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');

	//set the query args
	$args = array(
		'post_type' => $post_type,
		'paged' => $paged,
		'posts_per_page' => $posts_per_page,
		'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'),
//		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => wpgrade::prefix() . 'exclude_from_archives',
				'value' => true,
				'compare' => '!='
			),
			array(
				'key' => wpgrade::prefix() . 'exclude_from_archives',
				'compare' => 'NOT EXISTS',
				'value' => ''
			),
		),
	);

	if (!empty($taxonomy)) {
		//test if we are in a category archive
		$cat_param = get_query_var($taxonomy);
		//$cat_data = get_term_by('slug', $cat_param, $taxonomy);

		if (!empty($cat_param)) {
			$args[ 'tax_query' ] = array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $cat_param,
				)
			);
		}
	}

	//in case we just want all of the items
	//most likely we are in a ajax call
	if ($display_all) {
		$args['posts_per_page'] = 999;

		//check if we have a offset in $_POST
		if ( isset( $_POST['offset'] ) ) {
			$args['offset'] = (int)$_POST['offset'];
		}
	}

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		?>
		<div class="mosaic  <?php echo $mosaic_class; ?>  mosaic--archive" data-maxpages="<?php echo $query->max_num_pages ?>" >
			<?php
			$page_one = false;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			// are we on page one?
			if(1 == $paged) $page_one = true;

			$show_title = false;

			if($post_type == 'border_gallery' && wpgrade::option('galleries_show_archive_title', false))
				$show_title = true;

			if($post_type == 'border_portfolio' && wpgrade::option('portfolio_show_archive_title', false))
				$show_title = true;

			if($show_title && $page_one) { ?>
				<div class="mosaic__item  mosaic__title">
					<a href="#">
						<div class="mosaic__image" style="padding-top: 100%;">
						</div>
						<div class="mosaic__meta">
							<div class="flexbox">
								<div class="flexbox__item">
									<h1><?php the_title(); ?></h1>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php }

			while ( $query->have_posts() ) : $query->the_post();
				$terms = array();
				if ($filter_by_tax) {
					$terms = wp_get_post_terms( get_the_ID(), $taxonomy, array("fields" => "slugs"));
				} ?>
				<div class="mosaic__item  <?php if ( !empty($terms) && is_array($terms) && !is_wp_error($terms) ) { echo 'cat-'.implode( ' cat-', $terms); } ?> ">
					<a href="<?php the_permalink() ?>">
						<?php
							$image = array();
							if (has_post_thumbnail()) {
								$image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
							} else {
								//try and get the first image in the gallery
								$image = wpgrade_get_first_gallery_image_src(get_the_ID(),$image_size);
							}

							$image_ratio = 100; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
							//if we are dealing with masonry shit
							if (strpos($mosaic_class,'masonry') !== false) {
								if (isset($image[1]) && isset($image[2]) && $image[1] > 0) {
									$image_ratio = $image[2] * 100/$image[1];
								}
							}

							if (!empty($image[0])) : ?>
								<div class="mosaic__image" style="padding-top: <?php echo $image_ratio;?>%;">
									<img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
								</div>
							<?php else: ?>
								<div class="mosaic__image  no-image">
								</div>
							<?php endif; ?>
 		
						<div class="mosaic__meta">
							<div class="flexbox">
								<div class="flexbox__item">

							

									<h2 class="meta__title"><?php the_title()?> </h2>


									

								<!-- 	<?php
									$item_categories = get_the_terms(get_the_ID(), $taxonomy );
									if ( !is_wp_error( $item_categories ) && !empty( $item_categories ) ) { ?>
										<hr class="separator  separator--light">
										<?php
										foreach ($item_categories as $key => $cat ) {
											if (!empty($cat_param) && $cat->slug == $cat_param && ((wpgrade::option('galleries_archive_hide_current_category') && $post_type == wpgrade::shortname().'_gallery') || (wpgrade::option('portfolio_archive_hide_current_category') && $post_type == wpgrade::shortname().'_portfolio'))) {
												//do nothing
											} else {
												echo '<span class="meta__category">'.$cat->name.'</span>';
											}
										}
									} ?> -->


<hr class="separator  separator--light">
 
<span class="meta__category">
										
<?php 
$client_name = '';
$client_name = get_post_meta( get_the_ID(), wpgrade::prefix() . 'project_client_name', true );
$client_link = get_post_meta( get_the_ID(), wpgrade::prefix() . 'project_client_link', true );
if($client_link == '') $client_link = '#';
echo $client_name; ?>
</span>



								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
		</div><!-- close mosaic container -->
	<?php if ($show_pagination) : ?>
		<div class="pagination  pagination--archive  inversed">
			<?php echo wpgrade::pagination($query); ?>
		</div>
	<?php endif;
	/* Restore original Post Data */
	wp_reset_postdata();

	//get the option the user chosed in the page metaboxes, if any
	$source = get_post_meta(wpgrade::lang_page_id(get_the_ID()), wpgrade::prefix() . 'custom_homepage', true);
	//if we are in a custom frontpage template then don't display the filters for category archives
	if (!empty($source) && ($source == 'border_portfolio_cat' || $source == 'border_galleries_cat')) {
		$filter_by_tax['enabled'] = false;
	}

	// display the filter
	if ($filter_by_tax['enabled'] && !is_tax() ) {
		border::display_filter_box($taxonomy, $filter_by_tax['style']);
	};

	endif;
}

//for isotope filtering
/*
 * Ajax loading all galleries
 */
add_action( 'wp_ajax_wpgrade_load_all_gallery_items', 'wpgrade_load_all_gallery_items');
add_action( 'wp_ajax_nopriv_wpgrade_load_all_gallery_items', 'wpgrade_load_all_gallery_items');
function wpgrade_load_all_gallery_items( ) {

	$archive_layout = 'grid';
	if (isset($_POST['layout'])) {
		$archive_layout = $_POST['layout'];
	}

	//what taxonomy to use
	$taxonomy = wpgrade::shortname() . '_gallery_categories';

	ob_start();

	switch ($archive_layout) {
		case 'grid':
			wpgrade_display_mosaic(wpgrade::shortname().'_gallery',999,true,$taxonomy,true,'square','mosaic--grid', true);
			break;
		case 'masonry':
			wpgrade_display_mosaic(wpgrade::shortname().'_gallery',999,true,$taxonomy,true,'small-size','mosaic--masonry js-mosaic--masonry', true);
			break;
	}

	echo json_encode( ob_get_clean() );
	die();
}

/*
 * Ajax loading all projects
 */
add_action( 'wp_ajax_wpgrade_load_all_portfolio_items', 'wpgrade_load_all_portfolio_items');
add_action( 'wp_ajax_nopriv_wpgrade_load_all_portfolio_items', 'wpgrade_load_all_portfolio_items');
function wpgrade_load_all_portfolio_items( ) {

	$archive_layout = 'grid';
	if (isset($_POST['layout'])) {
		$archive_layout = $_POST['layout'];
	}

	//what taxonomy to use
	$taxonomy = wpgrade::shortname() . '_portfolio_categories';

	ob_start();

	switch ($archive_layout) {
		case 'grid':
			wpgrade_display_mosaic(wpgrade::shortname().'_portfolio',999,true,$taxonomy,true,'square','mosaic--grid', true);
			break;
		case 'masonry':
			wpgrade_display_mosaic(wpgrade::shortname().'_portfolio',999,true,$taxonomy,true,'small-size','mosaic--masonry js-mosaic--masonry', true);
			break;
	}

	echo json_encode( ob_get_clean() );
	die();
}