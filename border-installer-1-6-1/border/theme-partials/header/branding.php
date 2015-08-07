<h1 class="site-home-title">
    <div class="flexbox">
        <div class="flexbox__item">
<?php if (wpgrade::image_src('main_logo')):
    $retina_logo = wpgrade::image_src('retina_main_logo');
    ?>
            <a class="site-logo  site-logo--image   <?php if (wpgrade::option('use_retina_logo') && !empty($retina_logo)) echo "  site-logo--image-2x"; ?>" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name') ?>">
                <?php $data_retina_logo = (wpgrade::option('use_retina_logo') && !empty($retina_logo)) ? 'data-logo2x="'.$retina_logo.'"' : ''; ?>
                <img src="<?php echo wpgrade::image_src('main_logo'); ?>" <?php echo $data_retina_logo; ?> rel="logo" alt="<?php echo get_bloginfo('name') ?>"/>
            </a>
<?php else: ?>
            <a class="site-logo  site-logo--text" href="<?php echo home_url() ?>">
                <?php echo get_bloginfo('name') ?>
            </a>
<?php endif; ?>
        </div>
    </div>
</h1>
