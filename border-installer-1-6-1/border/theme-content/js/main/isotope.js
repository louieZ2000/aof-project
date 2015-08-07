//global isotope variables
var $isotope_container,
	max_isotope_pages,
	is_everything_loaded,
	isotope_page_counter;

/* --- Isotope Init --- */

function isotopeInit() {
	if (globalDebug) {console.group("IsotopeInit");console.log("Isotope Init");}

	//initialize global variables
	$isotope_container = $('.mosaic');

	if ( !empty($isotope_container)) {
		max_isotope_pages = $isotope_container.data('maxpages');
		is_everything_loaded = false;

		isotopeRun();

		//force the infinite scroll to wait for the first images to load before doing it's thing
		if ($isotope_container.hasClass('infinite_scroll')) {
			$isotope_container.imagesLoaded(function(){
				infiniteScrollingInit();
			});
		}

		if ($isotope_container.hasClass('filter_by')) {
			isotopeFilteringInit();
		}
	}

	if (globalDebug) {console.groupEnd();}
} //end isotopeInit

/* --- Isotope Update --- */

function isotopeUpdateLayout() {
	if (globalDebug) {console.log("Isotope Update Layout");}

	if ( !empty($isotope_container) && $isotope_container.length ) {
		$isotope_container.isotope( 'layout');
	}
}

/* --- Isotope Destroy --- */

function isotopeDestroy() {
	if (globalDebug) {console.log("Isotope Destroy");}

	if ( !empty($isotope_container) && $isotope_container.length ) {
		$isotope_container.isotope( 'destroy');
	}
}


/* --- Layout Refresh --- */

function layoutRefresh() {
	if (globalDebug) {console.log("Isotope Layout Refresh");}

    isotopeUpdateLayout();
}

/* --- Isotope Run --- */

function isotopeRun() {
	if (!empty($isotope_container) && $isotope_container.length) {
		if (globalDebug) {console.log("Isotope Initialization (isotopeRun)");}
		// Isotope init
		$isotope_container.isotope({
			speed: 200,
			easing: 'ease-out',
			itemSelector: '.mosaic__item',
			layoutMode: 'masonry',
			// control here the style for hidding and showing, see http://isotope.metafizzy.co/beta/options.html
			transitionDuration: '0.4s',
			hiddenStyle: {
				opacity: 0,
				transform: 'scale(0.5)'
			},
			visibleStyle: {
				opacity: 1,
				transform: 'scale(1)'
			}
		});

	}
}

/* -- Infinite Scrolling Initialization --- */

function infiniteScrollingInit() {
	if (globalDebug) {console.log("Isotope Infinite Scroll Init");}

	isotope_page_counter = 1;

	$isotope_container.infinitescroll({
			navSelector  : 'div.pagination--archive',    // selector for the paged navigation
			nextSelector : 'div.pagination--archive a.next',  // selector for the NEXT link
			itemSelector : 'div.mosaic__item',     // selector for all items you'll retrieve
			loading: {
				finished: undefined,
				finishedMsg: objectl10n.infscrReachedEnd,
				img: "data:image/gif;base64,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",
				msg: null,
				msgText: objectl10n.infscrLoadingText,
				selector: null,
				speed: 'fast',
				start: undefined
			},
			debug: globalDebug,
			//animate      : true,
			//extraScrollPx: 500,
			prefill: true,
			maxPage: max_isotope_pages,
			errorCallback: function(){}
			// called when a requested page 404's or when there is no more content
			// new in 1.2
		},
		// trigger Isotope as a callback
		function( newElements ) {
			newElements.forEach(function(e){
				$(e).css('opacity', 0);
			});

			var $newElems = $( newElements );

			isotope_ready_to_filter = false;

			if (globalDebug) {console.log("Infinite Scroll - Adding new "+$newElems.length+" items to the DOM");}

			//$isotope_container.append($newElems);
			// ensure that images load before adding to masonry layout
			$newElems.imagesLoaded(function(){

				$isotope_container.isotope( 'appended', $newElems );

				// animateGridItems($newElems);

				if (globalDebug) {console.log("Isotope Infinite Scroll Loaded Next Page");}

				layoutRefresh();

				isotope_ready_to_filter = true;

				isotope_page_counter++;
			});
		});

}

//in case you need to control infinitescroll
function infiniteScrollingPause() {
	if (globalDebug) {console.log("Isotope Infinite Scroll Pause");}

	$isotope_container.infinitescroll('pause');
}
function infiniteScrollingResume() {
	if (globalDebug) {console.log("Isotope Infinite Scroll Resume");}

	$isotope_container.infinitescroll('resume');
}
function infiniteScrollingDestroy() {
	if (globalDebug) {console.log("Isotope Infinite Scroll Destroy");}

	$isotope_container.infinitescroll('destroy');
}


/* --- Portfolio and Gallery filtering --- */

function isotopeFilteringInit() {
	if (globalDebug) {console.log("Isotope Filtering Init");}

	isotope_ready_to_filter = true;

	$(".archive-categories-list a").each(function() {
		$(this).click(function(e){
			e.preventDefault();

			if (isotope_ready_to_filter === true) { //only proceed if we are in a ready state
				var selector = $(this).attr('data-filter');

				//some checks
				if (max_isotope_pages == isotope_page_counter) {
					//we have already loaded all the pages
					is_everything_loaded = true;
				}
				if (globalDebug) {console.log("Isotope Page Counter = " + isotope_page_counter + " | Max Pages = " + max_isotope_pages);}

				$('.archive-categories-list a').removeClass('selected');
				$(this).addClass('selected');

				if ( !is_everything_loaded ) {
					if (globalDebug) {console.log("Isotope Filtering - Loading all items");}

					//stop the infinite scroll
					infiniteScrollingDestroy();

	//				$isotope_container.prepend('<div class="loading-gif"></div>');
					var offset = $isotope_container.find('.mosaic__item').length,
						itemstype = $('.mosaic-wrapper').attr('data-itemstype'),
						itemslayout = $('.mosaic-wrapper').attr('data-itemslayout');

					if (globalDebug) {console.log("Isotope Filtering Init - AJAX Offset = " + offset);}

					$.post(
						ajaxurl,
						{
							action: 'wpgrade_load_all_'+itemstype+'_items',
							offset: offset,
							layout: itemslayout
						},
						function(response) {
							if (globalDebug) {console.log("Isotope Filtering - Loaded All Items");}

							var $result = $(JSON.parse(response)).find('.mosaic__item');

							if (globalDebug) {console.log("Isotope Filtering - Adding new "+$result.length+" items to the DOM");}

							$isotope_container.append($result);

							$result.imagesLoaded(function(){
								if (globalDebug) {console.log("Isotope Filtering - Images Loaded");}

								$isotope_container.isotope( 'appended', $result);

								animateGridItems($result);

								is_everything_loaded = true;

								if (globalDebug) {console.log("Isotope Filtering - Filter by "+selector);}

								$('html, body').animate({scrollTop: 0}, 200);
								setTimeout(function() {
									$isotope_container.isotope({ filter: selector });
								}, 200);
							});
						}
					);
				} else {
					if (globalDebug) {console.log("Isotope Filtering - Filter by "+selector);}

					$('html, body').animate({scrollTop: 0}, 200);
					setTimeout(function() {
						$isotope_container.isotope({ filter: selector });
					}, 200);
				}
			} else {
				if (globalDebug) {console.log("Isotope Filtering - NOT READY TO FILTER");}
			}

			return false;
		});
	}); //end filtering on click
}