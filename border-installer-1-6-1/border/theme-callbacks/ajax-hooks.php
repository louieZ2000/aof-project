<?php

add_action( 'border_before_dynamic_content', 'border_before_dynamic_content', 10 );

function border_before_dynamic_content() {

	/**
	 * Localize a static list with resourses already loaded on the first page load this lists will be filled on
	 * each d-jax request which has new resources
	 *
	 * Note: make this dependent to wpgrade-main-scripts because we know for sure it is there
	 */
	wp_localize_script( 'wpgrade-main-scripts', 'border_static_resources', array(
		'scripts' => border::get_queued_scripts(),
		'styles'  => border::get_queued_styles()
	) );

}

add_action('wp_footer', 'border_last_function', 999999999);

function border_last_function(){
	/**
	 * Display dynamic generated data while runing d-jax requests :
	 *
	 * a script which will load others scripts on the run
	 */
	$dynamic_scripts = border::get_queued_scripts();
	$dynamic_styles  = border::get_queued_styles();?>
	<div id="djax_list_scripts_and_styles">
		<script id="border_list_scripts_and_styles"  class="djax-updatable">
			(function ($) {
				// wait for all dom elements
				$(document).ready(function () {
					// run this only if we have resources
					if (!window.hasOwnProperty('border_static_resources')) return;
					window.border_dynamic_loaded_scripts = <?php echo json_encode( $dynamic_scripts ); ?>;
					window.border_dynamic_loaded_styles = <?php echo json_encode( $dynamic_styles ); ?>;

					// run this only if we have resources
					if (!window.hasOwnProperty('border_static_resources')) return;

					// border_dynamic_loaded_scripts is generated in footer when all the scripts should be already enqueued
					$.each( window.border_dynamic_loaded_scripts, function (key, url) {

						if (key in border_static_resources.scripts) return;

						if (globalDebug) {console.dir("Scripts loaded dynamic");}
						if (globalDebug) {console.dir(key);}
						if (globalDebug) {console.log(url);}

						// add this script to our global stack so we don't enqueue it again
						border_static_resources.scripts[key] = url;

						$.getScript(url)
							.done(function (script, textStatus) {
								//console.log(textStatus);
							})
							.fail(function (jqxhr, settings, exception) {
								//if (globalDebug) {console.log('I failed');}
							});

						if (globalDebug) {console.groupEnd();}

						$(document).trigger('border:page_scripts:loaded');
					});

					$.each( window.border_dynamic_loaded_styles, function (key, url) {

						if (key in border_static_resources.styles) return;

						if (globalDebug) {console.dir("Styles loaded dynamic");}
						if (globalDebug) {console.dir(key);}
						if (globalDebug) {console.log(url);}

						// add this style to our global stack so we don't enqueue it again
						border_static_resources.styles[key] = url;

						// sorry no cache this time
						$.ajax({
							url: url,
							dataType: 'html',
							success: function (data) {
								$('<style type="text/css">\n' + data + '</style>').appendTo("head");
							}
						});

						if (globalDebug) {console.groupEnd();}

						$(document).trigger('border:page_styles:loaded');
					});
				});
			})(jQuery);
		</script>
	</div>
<?php
}