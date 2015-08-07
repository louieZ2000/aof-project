/* ====== INTERNAL FUNCTIONS ====== */

/* --- HoverDir Init --- */
function hoverDirInit() {
	if (globalDebug) {console.log("HoverDir Init");}

	// Call Direction Aware Hover Effect
	$('.mosaic__item:not(.item--video, .item--link) a').each(function() {
		$(this).hoverdir({
			hoverElem: '.mosaic__hoverdir'
		});
	});
}


/* --- PUSH MENU HEIGHT --- */

function pushMenuHeight() {
	var containerH = $('.navigation-container').height();
	$('.navigation--main').height(containerH);
	if (globalDebug) {console.log('PushMenu Container Height: '+containerH);}
	$('.sidebar--menu').appendTo('.nav--main');
}

/* --- Load Web Fonts --- */

function loadWebFonts() {
	if ( typeof WebFont != 'undefined' && ! empty(WebFont) && typeof WebFontConfig != 'undefined' && ! empty(WebFontConfig.google)) {
		if (globalDebug) {console.log("Load Web Fonts");}
		WebFont.load(WebFontConfig);
	} else {
		if (globalDebug) {console.log("No Web Fonts Need Loading :(");}
		//we need to make sure that somebody knows that the fonts were loaded without our help anyway
		fontLoader_fontsLoaded = true;
	}
}

function fontsLoadedCallback() {
	if (globalDebug) {console.log("Fonts Loaded Callback");}
	fontLoader_fontsLoaded = true;

	//we need to check whether Royal Slider has also added to the DOM the first slide
	//so we can see what type of cover it is etc.
	if (royalSlider_loadedFirstSlide === true) {
		coverText.init();

		fontLoader_fontsLoaded = false;
	}
}

/* --- NICESCROLL --- */
function niceScrollInit() {
	if (globalDebug) {console.log("NiceScroll Init");}

	var smoothScroll = $('body').data('smoothscrolling') !== undefined;

	// if ($('.site-navigation').length) {
	//     var offset = $('.site-navigation').offset();
	//     mobile = offset.left > ww;
	// }

	if (smoothScroll && ww > 899 && !touch && !is_OSX) {
		$('html').addClass('nicescroll');
		$('[data-smoothscrolling]').niceScroll({
			zindex: 9999,
			cursorcolor: '#000000',
			cursoropacitymin: 0.1,
			cursoropacitymax: 0.5,
			cursorwidth: 4,
			cursorborder: 0,
			railpadding: { right : 2 },
			mousescrollstep: 40,
			scrollspeed: 100,
			hidecursordelay: 100
			// autohidemode: false
		});
	}

	// Push Menu Scroll
	if(!touch)
	$('.navigation-container').niceScroll({
		horizrailenabled: false,
		zindex: 9999,
		cursorcolor: '#000000',
		cursoropacitymin: 0,
		cursoropacitymax: 0.5,
		cursorwidth: 4,
		cursorborder: 0,
		railpadding: { right : 2 },
		mousescrollstep: 40,
		scrollspeed: 100,
		hidecursordelay: 100,
		railalign: 'left'
	});
}

function scrollToTopInit() {
	if (!empty($('.up-link'))) {
		if (globalDebug) {console.log("ScrollToTop Init");}

		var offset = 220,
			duration = 500;

		$(window).scroll(function() {
			if ($(this).scrollTop() > offset) {
				$('.up-link').fadeIn(duration);
			} else {
				$('.up-link').fadeOut(duration);
			}
		});

		$('.up-link a').click(function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop: 0}, duration);
			return false;
		});
	}
}

/* --- Progressbar Init --- */
function progressbarInit() {
	if (globalDebug) {console.log("ProgressBar Init");}

	var progressbar_shc = $('.progressbar');

	progressbar_shc.addClass('is-visible');
	if (progressbar_shc.length) {
		progressbar_shc.each(function() {
			var self = $(this).find('.progressbar__progress');
			self.css({'width': self.data('value')});
		});
	}
}

function infoboxDescTrigger(){
	if (globalDebug) {console.log("Infobox Description Trigger");}

	$(document).on('click', '.gallery-infobox__logo', function(event){
		event.preventDefault();
		event.stopPropagation();

		if (globalDebug) {console.log("Infobox Description Triggered");}

		var $galleryInfobox = $('.gallery-infobox');

		if($('.gallery-infobox').hasClass('js--desc-active')){
			$('.gallery-infobox').removeClass('js--desc-active');

			//animateInfoboxDescription('out');
		} else {
			$('.gallery-infobox').addClass('js--desc-active');

			//animateInfoboxDescription('in');
		}
	});
}


var pixsliderGallery = $('.pixslider--gallery'),
	contentGallerySlider = $('.content--gallery-slider');

// update divs for the fullscreen slideshow gallery trigger to work
function fullScreenTriggerUpdateDivs(){
	if (globalDebug) {console.log("Fullscreen Trigger Update Divs");}

	pixsliderGallery = $('.pixslider--gallery');
	contentGallerySlider = $('.content--gallery-slider');
}

function playAnimations(direction){

	if($('body').hasClass('animations')){
		if (globalDebug) {console.group("PlayAnimations");}

		var element = $('.js-content > div'),
			animationPlayed = false;

		switch(direction){
			case 'in':{
				if(element.hasClass('content--blog')){
					animateBlog('in');
					animationPlayed = true;
				}

				// if(element.hasClass('content--article-split')){
				//     animateSplit('in');
				//     animationPlayed = true;
				// }

				if(element.hasClass('content--gallery-slider')){
					animateGallerySlider('in');
					animationPlayed = true;
				}

				if(element.hasClass('mosaic') || element.hasClass('mosaic-wrapper')){
					animateGrid('in');
					animationPlayed = true;
				}

				if(animationPlayed === false){
					animateContent('in');
				}

				break;
			}
			case 'out':{
				if(element.hasClass('content--blog')){
					animateBlog('out');
					animationPlayed = true;
				}

				// if(element.hasClass('content--article-split')){
					// animateSplit('out');
					// animationPlayed = true;
				// }

				if(element.hasClass('content--gallery-slider')){
					animateGallerySlider('out');
					animationPlayed = true;
				}

				if(element.hasClass('mosaic') || element.hasClass('mosaic-wrapper')){
					animateGrid('out');
					animationPlayed = true;
				}

				if(animationPlayed === false){
					animateContent('out');
				}
				break;
			}
			default: break;
		}

		if (globalDebug) {console.groupEnd();}
	}
}

function mainMenuInit() {
	if (globalDebug) {console.log("MainMenu Init");}



	if($('html').hasClass('lt-ie9')){
		$(document).on('click', '.js-nav-trigger', function(){
			$('html').addClass('navigation--is-visible');
            $('.js-nav-trigger').addClass('is-active');
		})
	} else {
		$main_menu = new mlPushMenu( $('#js-navigation--main')[0], $('.js-nav-trigger')[0], {
			type : 'overlap'
		});

		if ( !$main_menu.initHasBeenCalled) {
				$main_menu._init();
		}
	}


}

/* --- $VIDEOS --- */

function initVideos() {

    var videos = $('iframe, video');

    // Figure out and save aspect ratio for each video
    videos.each(function() {
        $(this).data('aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    // Firefox Opacity Video Hack
    $('iframe').each(function(){
		var url = $(this).attr("src");
	    if ( !empty(url) )
			$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
	});
}


function resizeVideos() {

    var videos = $('iframe, video');

    videos.each(function() {
        var video = $(this),
            ratio = video.data('aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w/ratio;
        video.height(h);
    });
}


/* ====== INTERNAL FUNCTIONS END ====== */

function init(){
	if (globalDebug) {console.group("Init");}

	// /* GLOBAL VARS */
	touch = false;

	//  GET BROWSER DIMENSIONS
	browserSize();

	// /* DETECT PLATFORM */
	platformDetect();

	pushMenuHeight();

	loadAddThisScript();

	/* INSTANTIATE DJAX */
	if ($('body').data('ajaxloading') !== undefined) {

		var djax_transition = function($newEl) {

			if (globalDebug) {console.group("djax Transition");}

			var $oldEl = this;

			if($('body').hasClass('gallery--is-fullscreen')){
				fullScreenTrigger();
			}

			if($newEl.hasClass('content')) {
				$('html').removeClass('is--gallery-fullscreen');
				$('html').removeClass('is--gallery-grid');

				if (!empty($newEl.find('.pixslider--fullscreen')) || !empty($newEl.find('.content--client-area'))) {
					$('html').addClass('is--gallery-fullscreen');
				}

				if (!empty($newEl.find('.mosaic-wrapper'))) {
					$('html').addClass('is--gallery-grid');
				}
			}

			$oldEl.replaceWith($newEl);

			playAnimations('in');

			// update divs for the fullscreen slideshow gallery trigger to work
			fullScreenTriggerUpdateDivs();


            setTimeout(function() {
                $('html').removeClass('loading');
            });

			if (globalDebug) {console.groupEnd();}

		};
		setTimeout(function() {
			$('body').djax('.djax-updatable', ['.pdf','.doc','.eps','.png','.zip','admin','wp-','wp-admin','feed','#', '?lang=', '&lang=', '&add-to-cart=', '?add-to-cart=', '?remove_item', 'download_file='], djax_transition);
		}, 500);
	}

	if (is_android || window.opera) {
		$('html').addClass('android-browser').removeClass('no-android-browser');
	}

	var is_retina = (window.retina || window.devicePixelRatio > 1);
	if (is_retina && $('.site-logo--image-2x').length) {
	    var image = $('.site-logo--image-2x').find('img');

	    if (image.data('logo2x') !== undefined) {
	        image.attr('src', image.data('logo2x'));
	        $('.site-logo--image-2x').addClass('using-retina-logo');
	    }
	}

	if(!empty($('.site-logo--image'))){
		if($('.site-logo--image').height() > $('.top-bar').height()){
			$('html').addClass('logo-overflow');
		}
	}

	$('html').addClass('loaded');

	if(!empty($('.js-content .pixslider--fullscreen')) || !empty($('.js-content .content--client-area'))){
		$('html').addClass('is--gallery-fullscreen');
	}

	if($('.js-content > div:first-of-type').hasClass('mosaic-wrapper')){
		$('html').addClass('is--gallery-grid');
	}

	/* ONE TIME EVENT HANDLERS */
	eventHandlersOnce();

	/* INSTANTIATE EVENT HANDLERS */
	eventHandlers();

	//add listener for fonts loaded
	if ( typeof WebFontConfig != 'undefined' && ! empty(WebFontConfig)) {
		if (globalDebug) {console.log("Fonts Loaded Callback - Binded");}
		WebFontConfig.ready(fontsLoadedCallback);
	}

	if (globalDebug) {console.groupEnd();}
}


/* ====== CONDITIONAL LOADING ====== */

function loadUp(){
	if (globalDebug) {console.group("LoadUp");}

	//load web fonts
	loadWebFonts();

	// always
	niceScrollInit();

	isotopeInit();

	// no need for hoverdir when there's no pointer involved
	if(!touch)
		hoverDirInit();

	progressbarInit();

	royalSliderInit();

	magnificPopupInit();

	initVideos();
	resizeVideos();

	//Set textarea from contact page to autoresize
	// if($("textarea").length) { $("textarea").autosize(); }

	$(".pixcode--tabs").organicTabs();

	if (globalDebug) {console.groupEnd();}
}


/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {
	if (globalDebug) {console.group("Event Handlers Once");}

	mainMenuInit();

	scrollToTopInit();

	infoboxDescTrigger();
	copyrightOverlayInit();

	if (globalDebug) {console.groupEnd();}
}

function eventHandlers() {
	if (globalDebug) {console.group("Event Handlers");}

	//Magnific Popup arrows
	$('body').off('click', '.js-arrow-popup-prev', magnificPrev).on('click', '.js-arrow-popup-prev', magnificPrev);
	$('body').off('click', '.js-arrow-popup-next', magnificNext).on('click', '.js-arrow-popup-next', magnificNext);
	//Magnific Popup fullscreen button
	$('body').off('click', '.js-slider-toggle-fullscreen', fullScreenTrigger).on('click', '.js-slider-toggle-fullscreen', fullScreenTrigger);

	$(document).keyup(function(e) {
	  if (e.keyCode == 27 && (!empty($('.js-content > .content--gallery-slider')) ||  !empty($('.js-content > .content--portfolio-slider')) )  ) { fullScreenTrigger(); }   // esc
	});

	// update menu event handlers only
	/*just for being able to view in ie8, for the moment ----> */
	if(!$('html').hasClass('lt-ie9')) {
		$main_menu.update('.js-content > div');
	}

	if ( typeof woocommerce_scripts_load == 'function') {
		woocommerce_scripts_load();
	}

	if (globalDebug) {console.groupEnd();}
}


/* --- GLOBAL EVENT HANDLERS --- */

function magnificPrev(e) {
	if (globalDebug) {console.log("Magnific Popup Prev");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.prev();
	return false;
}

function magnificNext(e) {
	if (globalDebug) {console.log("Magnific Popup Next");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.next();
	return false;
}


$(window).bind('beforeunload', function(event) {
	if (globalDebug) {console.log("ON BEFORE UNLOAD");}

	event.stopPropagation();

	animateBlog('out');
});


/* ====== ON DOCUMENT READY ====== */

$(document).ready(function(){







	if (globalDebug) {console.group("OnDocumentReady");}

	/* --- INITIALIZE --- */
	init();

	if($('body').hasClass('animations')){

		animateWrapper('in');

		$(document).on('animateWrapperDone', function(){
			if (globalDebug) {console.log("ON animateWrapperDone READY");}

			/* --- CONDITIONAL LOADING --- */
			loadUp();
		});

	} else {

		if (globalDebug) {console.log("ON DOCUMENT READY");}

		/* --- CONDITIONAL LOADING --- */
		loadUp();
	}

	if (globalDebug) {console.groupEnd();}
});


/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
	if (globalDebug) {console.group("OnWindowLoad");}

	// lazyLoad();
	$('.pixcode--tabs').organicTabs();
	$('html').removeClass('loading');
});


/* ====== ON RESIZE ====== */

$(window).on("debouncedresize", function(e){
	if (globalDebug) {console.group("OnResize");}

	// isotopeInit();
	niceScrollInit();
	pushMenuHeight();
	resizeVideos();

	if ( !empty(coverText) ){
		coverText.circleSize();
	}

	if (globalDebug) {console.groupEnd();}
});


// /* ====== ON DJAX REQUEST ====== */

$(window).bind('djaxClick', function(e, data) {
	if (globalDebug) {console.group("On-dJaxClick");}

	e.preventDefault();

	// close the menu before go on the next page
	$main_menu.close();

	playAnimations('out');

	$('html').addClass('loading');
	$('html, body').animate({scrollTop: 0}, 300);

	if (globalDebug) {console.groupEnd();}
});


// /* ====== ON DJAX LOAD ====== */

$(window).bind('djaxLoad', function(e, data) {
	if (globalDebug) {console.group("On-dJaxLoad");}

	setTimeout(function() {

		// update the menu
		$main_menu.update();

		// get data and replace the body tag with a nobody tag
		// because jquery strips the body tag when creating objects from data
		data = data.response.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>', data);
		// get the nobody tag's classes
		var nobodyClass = $(data).filter('notbody').attr("class");
		// set it to current body tag
		$('body').attr("class", nobodyClass);
		// let the party begin
		$('html').removeClass('loading');

		// progressbars anyone?

		eventHandlers();

		//     browserSize();
		//     resizeVideos();
		//     lazyLoad();

		loadUp();

		//fire the AddThis reinitialization separate from loadUp()
		//because on normal load we want to fire it only after the API is fully loaded - addthisReady()
		addThisInit();

		//need to get the id from the data
		var curpostid = $(data).filter('notbody').data("curpostid");
		if (curpostid !== undefined) {
			adminBarEditFix(curpostid);
		}
		woocommerce_scripts_load();
	}, 500);

	$('html').removeClass('loading');

	//lets do some Google Analytics Tracking
	if (window._gaq) {
		_gaq.push(['_trackPageview']);
	}

	if (globalDebug) {console.groupEnd();}
});


// /* ====== ON DJAX LOADING!!! ====== */

$(window).bind('djaxLoading', function(e, data) {
	if (globalDebug) {console.group("On-dJaxLoading");}

	cleanupBeforeDJax();

	if (globalDebug) {console.groupEnd();}
});