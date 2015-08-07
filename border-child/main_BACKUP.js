// /* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts;

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

var nua = navigator.userAgent;
var is_android = ((nua.indexOf('Mozilla/5.0') !== -1 && nua.indexOf('Android ') !== -1 && nua.indexOf('AppleWebKit') !== -1) && nua.indexOf('Chrome') === -1);

var useTransform = true;
var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
var transform;

// setting up transform prefixes
var prefixes = {
    webkit: 'webkitTransform',
    firefox: 'MozTransform',
    ie: 'msTransform',
    w3c: 'transform'
};

if (useTransform) {
    if (is_webkit) {
        transform = prefixes.webkit;
    } else if (is_firefox) {
        transform = prefixes.firefox;
    } else if (is_newer_ie) {
        transform = prefixes.ie;
    }
}

var isotope_ready_to_filter; /* will use this variable to determine if we can filter */

//keep a global variable to be able to access the royal slider object from different places
var royalSlider = null;

//variables used to determine if both the fonts and royal slider have loaded - so we can do cover texts animation
var royalSlider_loadedFirstSlide = false,
	fontLoader_fontsLoaded = false;

/* --- To enable verbose debug add to Theme Options > Custom Code footer -> globalDebug=true; --- */
var globalDebug = false,
	timestamp;


(function($,window,undefined) {

	/* --- DETECT VIEWPORT SIZE --- */

	function browserSize(){
		wh = $(window).height();
		ww = $(window).width();
		dh = $(document).height();
		ar = ww/wh;
	}


	/* --- DETECT PLATFORM --- */

	function platformDetect(){
		$.support.touch = 'ontouchend' in document;
		var navUA = navigator.userAgent.toLowerCase(),
			navPlat = navigator.platform.toLowerCase();

		var isiPhone = navPlat.indexOf("iphone"),
			isiPod = navPlat.indexOf("ipod"),
			isAndroidPhone = navPlat.indexOf("android"),
			safari = (navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1) ? true : false,
			svgSupport = (window.SVGAngle) ? true : false,
			svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
			ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;

		phone = (isiPhone > -1 || isiPod > -1 || isAndroidPhone > -1) ? true : false;
		touch = $.support.touch ? true : false;
		if(is_touch_laptop()) touch = true;
		ltie9 = $.support.leadingWhitespace ? false : true;
		lteie9 = typeof window.atob === 'undefined' ? true : false;

		var $bod = $('body');

		if (touch) {
			$('html').addClass('touch');
		}
		if (safari) $bod.addClass('safari');
		if (phone) $bod.addClass('phone');

	}
/* ====== ANIMATIONS ====== */
var bgTiled = ($('.bg--tiled').length) ? $('.bg--tiled').css('backgroundColor') : '#1a1717',
    bgText  = ($('.bg--text').length) ? $('.bg--text').css('backgroundColor') : '#f5f5f5';

function animateBg($speed, $color, $delay){
    TweenMax.to($('html'), $speed, {backgroundColor: $color, delay: $delay});

}

function animateBlog(direction){
    var articles = $(".content--blog article"); //slice(0,10);

    switch(direction){
        case 'in':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Blog - IN"+timestamp);}

        
            animateBg(0.3, bgText);

            TweenMax.staggerFromTo(articles, 0.3, 
                {opacity: 0, y: "100px", delay: 0},
                {opacity: 1, y: 0, ease:Back.easeOut},
            0.1);
            TweenMax.fromTo($('.pagination--archive'), 0.3, 
                {opacity: 0, y:"100%"},
                {opacity: 1, y: 0, ease:Back.easeOut}
            );
            

            break;
        }
        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Blog - OUT"+timestamp);}

            TweenMax.staggerFromTo(articles, 0.3, 
                {opacity: 1, y: 0},
                {opacity: 0, y: "100px", ease:Back.easeOut},

            0.1);
            TweenMax.fromTo($('.pagination--archive'), 0.3, 
                {opacity: 1, y: 0},
                {opacity: 0, y:"100%", ease:Back.easeOut}
            );            

            break;
        }
        default: break;
    }
}

function animateGallerySlider(direction){
    switch (direction){
        case 'in': {
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Gallery Slider - IN"+timestamp);}

            animateBg(0.3, bgTiled);
            TweenMax.from($('.slider-controls'), 0.3, {opacity: 0}, 0.25);

            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Gallery Slider - OUT"+timestamp);}
            TweenMax.to($('.slider-controls'), 0.3, {opacity: 0});
            TweenMax.to($('.pixslider--gallery'), 0.3, {opacity: 0});
            break;
        }
    }
}

function animateFixedBars(direction){
    var fixedBarAnimDelay = 0;
    var fixedBarAnimTime = 0.5;

    switch (direction){
        case 'in':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Fixed Bars - IN"+timestamp);}

            TweenMax.fromTo($('.top-bar'), fixedBarAnimTime, {y: "-100%", delay: fixedBarAnimDelay}, {y: "0", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.bottom-bar'), fixedBarAnimTime, {y: "100%", delay: fixedBarAnimDelay}, {y: "0", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.left-bar'), fixedBarAnimTime, {x: "-100%", delay: fixedBarAnimDelay}, {x: "0", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.right-bar'), fixedBarAnimTime, {x: "100%", delay: fixedBarAnimDelay}, {x: "0", delay: fixedBarAnimDelay});

			break;
        }

        case 'out':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Fixed Bars - OUT"+timestamp);}

            TweenMax.fromTo($('.top-bar'), fixedBarAnimTime, {y: "0", delay: fixedBarAnimDelay}, {y: "-100%", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.bottom-bar'), fixedBarAnimTime, {y: "0", delay: fixedBarAnimDelay}, {y: "100%", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.left-bar'), fixedBarAnimTime, {x: "0", delay: fixedBarAnimDelay}, {x: "-100%", delay: fixedBarAnimDelay});
            TweenMax.fromTo($('.right-bar'), fixedBarAnimTime, {x: "0", delay: fixedBarAnimDelay}, {x: "100%", delay: fixedBarAnimDelay});

			break;
        }

        default: break;
    }

    
}

function animateWrapper(direction){
    function playInAnimations(){
        // play all other 'in' animations
        var element = $('.js-content > div');

        var animationPlayed = false;

        if(element.hasClass('content--blog')){
            animateBlog('in');
            animationPlayed = true;
        }

        if(element.hasClass('content--article-split')){
            animateSplit('in');
            animationPlayed = true;
        }

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
    }

    var wrapperAnimation = new TimelineLite({
            paused: true,
            onComplete: function(){
                $(document).trigger('animateWrapperDone');
            }
    });

    wrapperAnimation.from($('.js-wrapper'), 0.5, {padding: 0}).from($('.js-content'), 0.2, {opacity: 0,
        onStart: function(){
            playInAnimations();
        },
        onComplete: function(){
            // Remove inline style due to responsive padding changes
            $('.js-wrapper').css('padding','');
        }
    });

    switch (direction){
        case 'in':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Wrapper - IN"+timestamp);}

            animateFixedBars('in');
            wrapperAnimation.play();

			break;
        }

        case 'out':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Wrapper - OUT"+timestamp);}

            animateFixedBars('out');
            wrapperAnimation.reverse();

			break;
        }

        default: break;
    }   

}

function animateSplit(direction){
    var splitAnimation = new TimelineLite({paused: true});

    splitAnimation.from($('.content--article-split'), 0.3, {opacity: 0});

    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Split - IN"+timestamp);}
            
            animateBg(0.3, bgText, 0);

            TweenMax.fromTo($('.content--article-split'), 0.3, 
                {opacity: 0},
                {opacity: 1}
            );

            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Split - OUT"+timestamp);}

            TweenMax.fromTo($('.content--article-split'), 0.3, 
                {opacity: 1},
                {opacity: 0}
            );

            break;
        }

        default: break;
    }
}

function animateGrid(direction){
    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Grid - IN"+timestamp);}

            TweenMax.staggerFromTo($('.mosaic__item'), 0.3, 
                {scale: 0.85}, 
                {scale: 1, ease:Back.easeOut, delay: 0.5, onStart: function(){
                
                    animateBg(0.3, bgTiled);
                }}, 
            0.12);

            TweenMax.staggerFromTo($('.mosaic__item'), 0.15, 
                {opacity: 0}, 
                {opacity: 1, ease:Sine.easeOut, delay: 0.5}, 
            0.12);

            TweenMax.staggerFromTo($('.mosaic__item img'), 0.4, 
                {scale: 1.15}, 
                {scale: 1, ease:Sine.easeOut, delay: 0.5}, 
            0.12);


            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Grid - OUT" +timestamp);}

            setTimeout(function(){
                // TweenMax.fromTo($('html'), 0.1, 
                //     {backgroundColor: "#1a1717"},
                //     {backgroundColor: "#f5f5f5"}
                // );
            }, 500);

            TweenMax.staggerFromTo($('.mosaic__item'), 0.1, 
                {scale: 1}, 
                {scale: 0.85, ease:Back.easeOut, delay: 0.1}, 
            0.12);

            TweenMax.staggerFromTo($('.mosaic__item'), 0.15, 
                {opacity: 1}, 
                {opacity: 0, ease:Back.easeOut, delay: 0.1}, 
            0.12);

            TweenMax.staggerFromTo($('.mosaic__item img'), 0.1, 
                {scale: 1}, 
                {scale: 1.15, ease:Sine.easeOut, delay: 0.1}, 
            0.12);

            break;
        }

        default: break;
    }
}


// used to animate items that are loaded via ajax in isotope
function animateGridItems(items){
            TweenMax.staggerFromTo(items, 0.3, 
                {scale: 0.85}, 
                {scale: 1, ease:Back.easeOut, delay: 0.5}, 
            0.12);

            TweenMax.staggerFromTo(items, 0.15, 
                {opacity: 0}, 
                {opacity: 1, ease:Sine.easeOut, delay: 0.5}, 
            0.12);

            var $itemsImg = items.find('img');

            TweenMax.staggerFromTo($itemsImg, 0.4, 
                {scale: 1.15}, 
                {scale: 1, ease:Sine.easeOut, delay: 0.5}, 
            0.12);    
}

function animateContent(direction){

    var contentAnimation = new TweenMax.fromTo($('.js-content > div'), 0.3, {autoAlpha: 1}, {autoAlpha: 0, paused: true});

    switch (direction){
        case 'in':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Content - IN"+timestamp);}

            TweenMax.fromTo($('.js-content > div'), 0.3, {opacity: 0}, {opacity: 1});
            // TweenMax.to($('html'), 0.5, {backgroundColor: "#f5f5f5"} );
        
            animateBg(0.5, bgText, 0)
            // contentAnimation.play();

            break; 
        }

        case 'out':{
			if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Content - OUT"+timestamp);}

            TweenMax.fromTo($('.js-content > div'), 0.5, {opacity: 1}, {opacity: 0, onComplete: function(){

            }});

            break;
        }

        default: break;
    }    
}


function fullScreenTrigger(direction){
    var contentGallerySliderPadding = $('.top-bar').height() + 'px',
		fullScreenSliderAnimation = new TimelineLite();

    if($('.left-bar').css('position') == 'static') contentGallerySliderPadding += ' 0 0 0';

    if($('body').hasClass('gallery--is-fullscreen')){

        // fullscreen out
        if (globalDebug) {console.log("Fullscreen Trigger - OUT");}

        fullScreenSliderAnimation
            .to(pixsliderGallery, 0.1, {opacity: 0})
            .to(contentGallerySlider, 0.4, {padding: contentGallerySliderPadding,
                onStart: function(){
                    animateFixedBars('in');

                    TweenMax.to($('.wrapper'), 0.3, {padding: contentGallerySliderPadding, onComplete: function(){
                        $('.wrapper').removeAttr('style');
                    }});

                },
                onComplete: function(){
                    $('body').removeClass('gallery--is-fullscreen');
                    pixsliderGallery.data('royalSlider').updateSliderSize();

                    TweenMax.to($('.portfolio__container'), 0.1, {opacity: 1});
                },
                ease:Quint.easeInOut
                // delay: 0.2
            })
            .to(pixsliderGallery, 0.2, {opacity: 1, ease:Quint.easeIn});


        $('.js-slider-toggle-fullscreen i').removeClass().addClass('icon-e-resize-full');

    } else {

        // fullscreen in
        if (globalDebug) {console.log("Fullscreen Trigger - IN");}


        fullScreenSliderAnimation
            .to(pixsliderGallery, 0.1, {opacity: 0})
            .to(contentGallerySlider, 0.4, {padding: 0,
                onStart: function(){
                    animateFixedBars('out');
                    TweenMax.to($('.portfolio__container'), 0.1, {opacity: 0});

                },
                onComplete: function(){
                    TweenMax.to($('.wrapper'), 0.3, {padding: 0});

                    $('body').addClass('gallery--is-fullscreen');
                    pixsliderGallery.data('royalSlider').updateSliderSize();
                },
                ease:Quint.easeInOut
                // delay: 0.2
            })
            .to(pixsliderGallery, 0.2, {opacity: 1, ease:Quint.easeOut})
            .to($('.gallery-controls--fullscreen'), 0.3, {opacity: 1});


        $('.js-slider-toggle-fullscreen i').removeClass().addClass('icon-e-resize-small');

    }
}

function copyrightOverlayAnimation(direction, x, y){
    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - IN"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 0, scale: 0.7}, {opacity: 1, scale: 1,
                onStart: function(){
                    $('.copyright-overlay').css({top: y, left: x});
                    $('body').addClass('is--active-copyright-overlay');
                }
            });

            break; 
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - OUT"+timestamp);}

            TweenMax.fromTo($('.copyright-overlay'), 0.1, {opacity: 1, scale: 1}, {opacity: 0, scale: 0.7,
                onComplete: function(){
                    $('body').removeClass('is--active-copyright-overlay');
                }
            });

            break;
        }

        default: break;
    }        
}
/* --- Cover Text Animation (for sliders) --- */
var cvr,
    coverText = {
        settings: {
            cover: $('.cover__content')
        },

        init: function() {
			if (globalDebug) {console.log("Cover Text Animation - Init");}

            cvr = this.settings;
			//just to make sure - although it's quite strange
            //cvr.cover = $('.cover__content');
            
			if (!empty(cvr.cover)) {
				if (globalDebug) {console.log("Cover Text Animation - Animating");}

				var cover_h,
					circle_size,
					circle_clip;

				this.animateIn();
			} else {
				if (globalDebug) {console.log("Cover Text Animation - SHOW STOPPER - No cover detected");}
			}
        },

        //Find cover style and start the animation
        animateIn: function() {
			if (globalDebug) {console.log("Cover Text Animation - AnimateIn");}

            if ($('.cover--style1').length) {
				this.coverStyle1();
			} else if ($('.cover--style2').length) {
				this.coverStyle2();
			} else if ($('.cover--style3').length) {
				this.coverStyle3();
			}
        },

        coverStyle1: function() {
			if (globalDebug) {console.log("Cover Text Animation - CoverStyle1");}

            if (this.circleSize()) {

				var cover = new TimelineLite({paused: true});

				cover.from($('.cover__title'), 0.3, {opacity: 0, delay: 0.5})

					.from($('.cover__sub-title.first'), 0.3, {y: 40, opacity: 0, ease:Back.easeOut}, "-=0.1")
					.from($('.cover__sub-title.first .dash'), 0.25, {width:0, ease:Back.easeOut})

					.from($('.cover__sub-title.second'), 0.3, {y: -40, opacity: 0, ease:Back.easeOut}, "-=0.35")
					.from($('.cover__sub-title.second .dash'), 0.25, {width:0, ease:Back.easeOut})

					.from($('.cover__circle.first'), 0.6, {clip: "rect(0,0,"+circle_clip+"px,0)", ease:Circ.easeOut})
					.from($('.cover__circle.second'), 0.6, {clip: "rect("+(circle_size-circle_clip)+"px, "+circle_size+"px, "+circle_size+"px,"+circle_size+"px)", ease:Circ.easeOut}, "-=0.6");

				if($('.slider--loaded').length) {
					if (globalDebug) {console.log("Cover Text Animation - PLAY");}
					cover.play();
				}
			}
        },

        coverStyle2: function() {
			if (globalDebug) {console.log("Cover Text Animation - CoverStyle2");}

            var cover = new TimelineLite({paused: true});

            cover.from($('.cover__title'), 0.3, {opacity: 0, delay: 0.5})

                .from($('.cover__sub-title.first'), 0.3, {y: 40, opacity: 0, ease:Back.easeOut}, "-=0.1")
                .from($('.cover__sub-title.first .dash'), 0.25, {width:0, ease:Back.easeOut})

                .from($('.cover__sub-title.second'), 0.3, {y: -40, opacity: 0, ease:Back.easeOut}, "-=0.35")
                .from($('.cover__sub-title.second .dash'), 0.25, {width:0, ease:Back.easeOut});

            if($('.slider--loaded').length) {
				if (globalDebug) {console.log("Cover Text Animation - PLAY");}
                cover.play();
            }
        },

        coverStyle3: function() {
			if (globalDebug) {console.log("Cover Text Animation - CoverStyle3");}

            var cover = new TimelineLite({paused: true});

            cover.from($('.cover__title'), 0.3, {y:30, opacity: 0, ease:Back.easeOut, delay: 0.5})
                .staggerFrom($('.cover__title .dash'), 0.3, {scaleX:0, opacity:0, ease:Back.easeOut}, 0.25)

                .from($('.cover__sub-title.first'), 0.3, {y: 40, opacity: 0, ease:Back.easeOut}, "-=0.1")

                .from($('.cover__sub-title.second'), 0.3, {y: -40, opacity: 0, ease:Back.easeOut});

            if($('.slider--loaded').length) {
				if (globalDebug) {console.log("Cover Text Animation - PLAY");}
                cover.play();
            }
        },

        // Set Circle Size & Clip Mask for Cover Style 1
        circleSize: function() {
			if (globalDebug) {console.log("Cover Text Animation - Circle Size");}

            //do nothing if no cover is present
            if ( !empty(cvr) && !empty(cvr.cover) ) {

                cvr.cover = $('.cover__content');
                var cover_circle = $('.cover__circle'),
                    cover_circle_1 = $('.cover__circle.first'),
                    cover_circle_2 = $('.cover__circle.second');

                cover_h = cvr.cover.height();
                circle_size = cover_h + 90;
                circle_clip = (circle_size - cover_h)/2 - 10;

                cvr.cover.addClass('george');

                cover_circle.css({
                    "width": circle_size,
                    "height": circle_size
                });

                cover_circle_1.css({
                    "clip": "rect(0, "+circle_size+"px, "+circle_clip+"px, 0)"
                });

                cover_circle_2.css({
                    "clip": "rect("+(circle_size-circle_clip)+"px, "+circle_size+"px, "+circle_size+"px, 0)"
                });
            } else {
				if (globalDebug) {console.log("Cover Text Animation - SHOW STOPPER - No circle size detected");}
				return false;
			}

			return true;
        }
    };

/* --- Magnific Popup Initialization --- */

function magnificPopupInit() {
	if (globalDebug) {console.log("Magnific Popup - Init");}

    $('.js-gallery').each(function() { // the containers for all your galleries should have the class gallery


        $(this).magnificPopup({
            delegate: '.mosaic__item .mfp-image, .mosaic__item .mfp-video, .zoom', // the container for each your gallery items
            mainClass: 'mfp-fade',
            closeOnBgClick: false,
            image: {
                markup: '<button class="mfp-close">x</button>'+
                    '<div class="mfp-figure">'+
                    '<div class="mfp-img"></div>'+
                    '</div>'+
                    '<div class="mfp-bottom-bar">'+
                    '</div>',
                titleSrc: function (item){
                    var output = '';
                    if ( !empty(item.el.attr('data-caption')) ) {
                        output = item.el.attr('data-caption');
                    }
                    // if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
                    //         output += '<small>'+item.el.attr('data-alt')+'</small>';
                    // }
                    return output;
                }
            },
            iframe: {
                markup: '<button class="mfp-close">x</button>'+
                    '<div class="mfp-figure">'+
                    '<div class="mfp-iframe-scaler">'+
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>'+
                    '</div>'+
                    '<div class="mfp-bottom-bar">'+
                    '<div class="gallery-infobox">'+
                    '</div>',
                titleSrc: function (item){
                    var output = '';
                    if ( !empty(item.el.attr('data-title')) ) {
                        output = item.el.attr('data-title');
                    }
                    // if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
                    //         output += '<small>'+item.el.attr('data-alt')+'</small>';
                    // }
                    return output;
                },
                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                        id: function(url){
                            var video_id = url.split('v=')[1];
                            var ampersandPosition = video_id.indexOf('&');
                            if(ampersandPosition != -1) {
                              video_id = video_id.substring(0, ampersandPosition);
                            }

                            return video_id;                            
                        }, // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }
                        src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
                    },
                    youtu_be: {
                        index: 'youtu.be/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                        id: '.be/', // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }
                        src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
                    },
                    
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                    // you may add here more sources
                },
                srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                arrowMarkup: '<a href="#" class="gallery-arrow gallery-arrow--%dir% control-item arrow-button arrow-button--%dir%">%dir%</a>'
            },
            callbacks:{
                open: function(){
                    $('body').addClass('is--open-gallery-popup');
                },
                close: function(){
                    $('body').removeClass('is--open-gallery-popup');
                },
                elementParse: function(item) {
					if (globalDebug) {console.log("Magnific Popup - Parse Element");}

                    $(item).find('iframe').each(function(){
                        var url = $(this).attr("src");
                        $(this).attr("src", url+"?wmode=transparent");
                    });

                    //some AddThis magic
                    addThisInit();                     

                },
                change: function(item){
                    $('.gallery-infobox').removeClass('js--desc-active');

                    if( !empty(item.el.attr('data-caption')) ){
                        $('.gallery-infobox__data span').html(item.el.attr('data-caption'));
                    } else {
                        $('.gallery-infobox__data span').html('');
                    }

                    if( !empty(item.el.attr('data-description')) ){
                        $('.gallery-infobox').removeClass('no-desc');
                        $('.gallery-infobox__description').html(item.el.attr('data-description'));
                    }
                    else $('.gallery-infobox').addClass('no-desc');
                },
                imageLoadComplete: function() {

                    var magnificPopup = $.magnificPopup.instance;

                    $(".mfp-container").swipe( {
                    //Generic swipe handler for all directions
                    swipe:function(event, direction, distance, duration, fingerCount) {
                        switch(direction){
                            case 'left':{
                                magnificPopup.next();
                                break;
                            }
                            case 'right':{
                                magnificPopup.prev();
                                break;
                            }
                            default: break;
                        }
                    },
                    //Default is 75px, set to 0 for demo so any distance triggers swipe
                     threshold:0
                    });                      

                }
            }
        });
    });

    $('.js-post-gallery').each(function() { // the containers for all your galleries should have the class gallery
      $(this).magnificPopup({
          delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
          type: 'image',
          removalDelay: 500,
          mainClass: 'mfp-fade',
          image: {
                markup: '<button class="mfp-close">x</button>'+
                '<div class="mfp-figure">'+
                '<div class="mfp-img"></div>'+
                '</div>'+
                '<div class="mfp-bottom-bar">'+
                '</div>',       
              titleSrc: function (item){
                  var output = '';
                  if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
                    output = item.el.attr('data-title');
                  }
                  if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
                    output += '<small>'+item.el.attr('data-alt')+'</small>';
                  }
                  return output;
              }
          },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                arrowMarkup: '<a href="#" class="gallery-arrow gallery-arrow--%dir% control-item arrow-button arrow-button--%dir%">%dir%</a>'
            }
      });
    });

    $('.js-pixproof-border-gallery').each(function() { // the containers for all your galleries should have the class gallery
        $(this).magnificPopup({
            delegate: 'a.zoom-action', // the container for each your gallery items
            type: 'image',
            mainClass: 'mfp-fade',
            closeOnBgClick: false,
            image: {
                markup: '<button class="mfp-close">x</button>'+
                '<div class="mfp-figure">'+
                '<div class="mfp-img"></div>'+
                '</div>'+
                '<div class="mfp-bottom-bar">'+
                    '<div class="mfp-title"></div>'+
                    '<div class="mfp-counter"></div>'+                
                '</div>', 
                titleSrc: function(item) {
                    var text = $('#' + item.el.data('photoid')).hasClass('selected') == true ? 'Deselect' : 'Select';

                    return '<a class="meta__action  meta__action--popup  select-action"  id="popup-selector" href="#" data-photoid="' + item.el.data('photoid') + '"><span class="button-text">' + text + '</span></a>';
                }                   
            },
            gallery:{
                enabled:true,
                navigateByImgClick: true,
                arrowMarkup: '<a href="#" class="gallery-arrow gallery-arrow--%dir% control-item arrow-button arrow-button--%dir%">%dir%</a>'
            }
        });
    });

}


/*
 * Push Menu
 * mlpushmenu.js v1.0.0
 */


function mlPushMenu( el, trigger, options ) {
    this.el = el;
    this.trigger = trigger;
    this.options = extend( this.defaults, options );
    // support 3d transforms
    this.support = Modernizr.csstransforms3d;
    if( this.support ) {
        this._init();
    }
}

mlPushMenu.prototype = {
    defaults : {
        // overlap: there will be a gap between open levels
        // cover: the open levels will be on top of any previous open level
        type : 'overlap', // overlap || cover
        // space between each overlaped level
        levelSpacing : 20,
        // classname for the element (if any) that when clicked closes the current level
        backClass : 'menu-back'
    },
    _init : function() {
	    this.initHasBeenCalled = true;
        // if menu is open or not
        this.open = false;
        // level depth
        this.level = 0;
        // the moving wrapper
        this.wrapper = $('.js-content')[0];
		this.verticalBar = $('.vertical-bar');
        // the mp-level elements
        this.levels = Array.prototype.slice.call( $( '#push-menu .sub-menu' ) );
        // save the depth of each of these mp-level elements
        var self = this;
        $(this.levels).each( function( i,el ) { el.setAttribute( 'data-level', getLevelDepth( el, self.el.id, 'sub-menu' ) ); } );
        // the menu items
        this.menuItems = Array.prototype.slice.call( $( '#push-menu li' ) );
        // if type == "cover" these will serve as hooks to move back to the previous level
        this.levelBack = Array.prototype.slice.call( $( '.' + this.options.backClass ) );
        // event type (if mobile use touch events)
        this.eventtype = 'click';
        // add the class mp-overlap or mp-cover to the main element depending on options.type
        $(this.el).addClass( 'mp-' + this.options.type );
        // initialize / bind the necessary events
        this._initEvents();

        this.close = function(){
            this._resetMenu();
        };
        // because sometimes you may lose your wrapper ()
        this.update = function ( wrapper ){
            this.wrapper = $(wrapper)[0];
			this.verticalBar = $('.vertical-bar');
        };
    },
    _initEvents : function() {
        var self = this;

        // the menu should close if clicking somewhere on the body
        var bodyClickFn = function( el ) {
            self._resetMenu();
            $(el).off( self.eventtype, bodyClickFn );
        };

        // open (or close) the menu
        var openEvent = 'touchstart click'
        if(is_android) openEvent = 'click';

        $(this.trigger).on( openEvent, function( ev ) {
            ev.stopPropagation();
            ev.preventDefault();

            if( self.open ) {
                self._resetMenu();
            }
            else {
                self._openMenu();
                // the menu should close if clicking somewhere on the body (excluding clicks on the menu)
                $(document).on( self.eventtype, function( ev ) {
                    if( self.open && !hasParent( ev.target, self.el.id ) ) {
                        bodyClickFn( this );
                    }
                } );
            }
        } );

        // opening a sub level menu
        $(this.menuItems).each( function( i, el ) {
            // check if it has a sub level
            var subLevel = $(el).children( '.sub-menu' );
            if( subLevel.length > 0 ) {

                // Temporary - ignore djax on submenus
                var $this_a = $(el).children( 'a' );
                var current_href = $this_a.attr('href');
	            current_href = current_href + '#';

	            $this_a.attr('href', current_href);

	            $this_a.on( self.eventtype, function( ev ) {
                    ev.preventDefault();

                    var level = closest( el, 'sub-menu' ).getAttribute( 'data-level' );
                    if( self.level <= level ) {
                        ev.stopPropagation();
                        $( closest( el, 'sub-menu') ).addClass( 'sub-menu-overlay' );
                        self._openMenu( subLevel );

                        TweenMax.to($(el).parents('.sub-menu' ).last(), 0.5, {x: "-="+self.options.levelSpacing+"", ease:Expo.easeInOut});
                    }

                    return false;
                } );
            }
        } );

        // closing the sub levels :
        // by clicking on the visible part of the level element
        $(this.levels).each( function( i, el ) {
            $(el).on( self.eventtype, function( ev ) {
                ev.stopPropagation();
                var level = el.getAttribute( 'data-level' );
                if( self.level > level ) {
                    ev.preventDefault();
                    self.level = level;
                    self._closeLevel();
                }
            } );
        } );

        // by clicking on a specific element
        $(this.levelBack).each( function( i, el ) {
            var backEvent = 'touchstart click';
            if(is_android) backEvent = 'click';

            $(el).on( backEvent, function( ev ) {
                ev.preventDefault();
                var currentLevel = $(el).closest('.sub-menu'),
                    level = currentLevel.attr( 'data-level' );

                if( self.level <= level ) {
                    ev.stopPropagation();
                    self.level = closest( el, 'sub-menu' ).getAttribute( 'data-level' ) - 1;
                    if (self.level === 0)  {
						self._resetMenu();
					} else {
						self._closeLevel(currentLevel);
					}
                }
            } );
        } );
    },
    _openMenu : function( subLevel ) {
        // increment level depth
        ++this.level;        

        // move the main wrapper
        var levelFactor = ( this.level - 1 ) * this.options.levelSpacing,
            translateValWrapper = this.el.offsetWidth + levelFactor;

        if(this.level > 1) levelFactor = this.options.levelSpacing;
        var translateVal = this.el.offsetWidth - levelFactor;

        // Trying to fix THE BUG
        // http://stackoverflow.com/questions/2637058/positions-fixed-doesnt-work-when-using-webkit-transform
        // if($('.article--split__left').length == 1){
        //     $('.article--split__left').css('height', $('.article--split__left').height() + 'px');
        //     $('.article--split__left').css('width', $('.article--split__left').width() + 'px');
        // }

        // Temporary solution for 'fixed' positioned elements from Split page layout
        if($(this.wrapper).length && ($('.content--article-split').length) != 1) {
            TweenMax.to(this.wrapper, 0.5, {x: "-"+translateValWrapper+"", ease:Expo.easeInOut,
                onStart: function(){
					$('.vertical-bar').css('z-index', '10');
                }
            });
        }

        // add class mp-pushed to main wrapper if opening the first time
        if( this.level === 1 ) {
        	if (!empty(this.wrapper)) {
            	$( this.wrapper).addClass( 'mp-pushed' );
            }
            $('html').addClass('navigation--is-visible');
            $('.js-nav-trigger').addClass('is-active');
            this.open = true;
        }
        // add class sub-menu-open to the opening level element
        $( subLevel || this.levels[0]).addClass( 'sub-menu-open' );
        TweenMax.to(subLevel || this.levels[0], 0.5, {x: "-"+translateVal+"", ease:Expo.easeInOut});

    },
    // close the menu
    _resetMenu : function() {
        // this._setTransform('translate3d(0,0,0)');
        if (!empty(this.wrapper)) {
			TweenMax.to(this.wrapper, 0.5, {x: 0, ease:Expo.easeInOut, onComplete: function(){
				$('html').removeClass('navigation--is-visible');
				$('.vertical-bar').css('z-index', 'auto');
				$('.js-content > div').attr('style', '');
			}});
		} else {
			$('html').removeClass('navigation--is-visible');
			$('.vertical-bar').css('z-index', 'auto');
			$('.js-content > div').attr('style', '');
		}

        $('.js-nav-trigger').removeClass('is-active');

        this.level = 0;
        // remove class mp-pushed from main wrapper
        // if (!empty(this.wrapper)) {
        // 	$( this.wrapper ).removeClass( 'mp-pushed' );
        // }
        this._closeAllLevels();
        this.open = false;
    },

    // translate the el
    _setTransform : function( val, el ) {
        el = el || this.wrapper;
        el.style.WebkitTransform = val;
        el.style.MozTransform = val;
        el.style.transform = val;
    },

    // Reset the Menu
    _closeAllLevels : function(el) {
        var wrapperLocal = this.wrapper;  

        TweenMax.to($('.sub-menu'), 0.5, {x: 0, ease:Expo.easeInOut, onComplete: function(){
            $('.sub-menu').removeClass('sub-menu-open').removeClass('sub-menu-overlay');
            $( wrapperLocal ).removeClass( 'mp-pushed' );

            // Trying to fix THE BUG
            // http://stackoverflow.com/questions/2637058/positions-fixed-doesnt-work-when-using-webkit-transform
            // if($('.article--split__left').length == 1){
            //     $('.article--split__left').css('height', '');
            //     $('.article--split__left').css('width', '');
            // }                  
        }});
    },

    // Close clicked level
    _closeLevel : function(currentLevel) {

        var translateVal = this.options.type === 'overlap' ? this.el.offsetWidth + ( this.level - 1 ) * this.options.levelSpacing : this.el.offsetWidth;

        // Temporary solution for 'fixed' positioned elements from Split Layout
        if($(this.wrapper).length && ($('.content--article-split').length) != 1) {
            TweenMax.to(this.wrapper, 0.5, {x: -translateVal, ease:Expo.easeInOut});
        }

        // Move the Current SubMenu outside
        TweenMax.to(currentLevel, 0.5, {x: 0, ease:Expo.easeInOut, onComplete: function(){
            currentLevel.removeClass( 'sub-menu-open' );
        }});

        // Remove transparency for the 'back' button
        currentLevel.closest('.sub-menu-overlay').removeClass('sub-menu-overlay');

        // Move the First Level to -> Menu Width + (Clicked Level No * Level Spacing) (default: 20px)
        TweenMax.to(this.levels[0], 0.5, {x: "-"+(this.el.offsetWidth + ((this.level - 1) * this.options.levelSpacing))+"", ease:Expo.easeInOut}); 
    }
};

// add to global namespace
window.mlPushMenu = mlPushMenu;

/* Push Menu End */

/* --- Royal Slider Init --- */

function royalSliderInit(){
	if (globalDebug) {console.log("Royal Slider - Init");}

    $('.js-pixslider').each(function(){

        var $slider = $(this);

        $slider.find('.rsImg').removeClass('invisible');

        var $children = $(this).children(),
            rs_arrows = typeof $slider.data('arrows') !== "undefined",
            rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
            rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
            rs_autoScaleSlider = false,
            rs_autoScaleSliderWidth = $slider.data('autoscalesliderwidth'),
            rs_autoScaleSliderHeight = $slider.data('autoscalesliderheight'),
            rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
            rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
            rs_keyboardNav  = true,
            rs_imageScale  = $slider.data('imagescale'),
            rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined",
            rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
            rs_transition = !empty( $slider.data('slidertransition') ) ? $slider.data('slidertransition') : 'move',
            rs_transition_direction = !empty( $slider.data('slidertransitiondirection') ) ? $slider.data('slidertransitiondirection') : 'horizontal',
            rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined",
            rs_delay = !empty( $slider.data('sliderdelay') ) ? $slider.data('sliderdelay') : '1000',
            rs_drag = true,
            rs_globalCaption = typeof $slider.data('showcaptions') !== "undefined";

        if ( rs_autoheight ) {
            rs_autoScaleSlider = false;
        } else {
            rs_autoScaleSlider = true;
        }

        // Single slide case
        if ($children.length == 1){
            rs_arrows = false;
            rs_bullets = 'none';
            rs_customArrows = false;
            rs_keyboardNav = false;
            rs_drag = false;
            rs_transition = 'fade';
        }

        // make sure default arrows won't appear if customArrows is set
        if (rs_customArrows) arrows = false;

        //the main params for Royal Slider
        var royalSliderParams = {
            autoHeight: rs_autoheight,
            autoScaleSlider: rs_autoScaleSlider,
            loop: true,
            autoScaleSliderWidth: rs_autoScaleSliderWidth,
            autoScaleSliderHeight: rs_autoScaleSliderHeight,
            imageScaleMode: rs_imageScale,
            imageAlignCenter: rs_imageAlignCenter,
            slidesSpacing: rs_slidesSpacing,
            arrowsNav: rs_arrows,
            controlNavigation: rs_bullets,
            keyboardNavEnabled: rs_keyboardNav,
            arrowsNavAutoHide: false,
            navigateByClick: true,
            sliderDrag: rs_drag,
            transitionType: rs_transition,
            slidesOrientation: rs_transition_direction,
            autoPlay: {
                enabled: rs_autoPlay,
                stopAtAction: true,
                pauseOnHover: true,
                delay: rs_delay
            },
            globalCaption:rs_globalCaption,
            numImagesToPreload: 2,
            addActiveClass: false
        };

        if (rs_visibleNearby) {
            royalSliderParams.addActiveClass = true;
            royalSliderParams.visibleNearby = {
                enabled: true,
                //centerArea: 0.8,
                center: true,
                breakpoint: 0,
                //breakpointCenterArea: 0.64,
                navigateByCenterClick: true
            };
        }

        if (rs_autoheight) {
            royalSliderParams['autoHeight'] = true;
            royalSliderParams['autoScaleSlider'] = false;
            royalSliderParams['imageScaleMode'] = 'none';
            royalSliderParams['imageAlignCenter'] = false;
        } else {
            royalSliderParams['autoHeight'] = false;
            royalSliderParams['autoScaleSlider'] = true;
        }

        //lets fire it up
        $slider.royalSlider(royalSliderParams);

        //global variable
		royalSlider = $slider.data('royalSlider');

		if (royalSlider) {
			royalSlider.slides[0].holder.on('rsAfterContentSet', function() {
				if (globalDebug) {console.log("Royal Slider - Added first slide to DOM");}
				// fires when first slide content is loaded and added to DOM
				royalSlider_loadedFirstSlide = true;

				//we need to check whether the fonts have been loaded
				if (fontLoader_fontsLoaded === true) {
					coverText.init();
					royalSlider_loadedFirstSlide = false;
				}
			});
		}

        var slidesNumber = royalSlider.numSlides;

	    setTimeout(function() {
		    royalSlider.ev.trigger('rsAfterSlideChange');
	    }, 1);

        $('.rsVideoContainer').bind('DOMNodeInserted', function(){
            royalSlider.ev.trigger('rsVideoPlay');
        });

        royalSlider.ev.on('rsVideoPlay', function() {
            $('.js-slider-toggle-fullscreen').hide();
            $('.gallery-infobox').hide();

            var $frameHolder = null,
                top = '';


            // because of some firefox voodoo shit error
            setTimeout(function(){

                if(rs_imageScale == 'fill'){

                    var frHeight = royalSlider.height;

                    $frameHolder = $('.rsVideoFrameHolder');

                    top = Math.abs(royalSlider.height - $frameHolder.closest('.rsVideoContainer').height())/2;

                    $frameHolder.css('height', frHeight + 'px');
                    $frameHolder.css('width', '100%');
                    $frameHolder.css('margin-top', top+'px');
                    $frameHolder.css('margin-bottom', '42px');

                } else {
                    var $videoContainer = $('.rsVideoFrameHolder').closest('.rsVideoContainer');

                    $frameHolder = $('.rsVideoFrameHolder');
                    top = parseInt($frameHolder.closest('.rsVideoContainer').css('margin-top'), 10);

                    if(top < 0){
                        top = Math.abs(top);

                        $frameHolder
                            .css('height', royalSlider.height + 'px')
                            .css('width', '100%')
                            .css('top', top + 'px');
                    }
                }

            }, 100);
        });

        royalSlider.ev.on('rsVideoStop', function() {
            $('.js-slider-toggle-fullscreen').show();
            $('.gallery-infobox').show();
        });

        function setCaptionContent(){
            $('.gallery-infobox__data span').html(royalSlider.currSlide.content.data('caption'));

            var itemDescription = royalSlider.currSlide.content.data('description'),
            	infobox = $('.gallery-infobox'),
            	infoboxDesc = $('.gallery-infobox__description');

            if(!empty(itemDescription)){
                infoboxDesc.html(itemDescription);
                infobox.removeClass('no-desc');
            } else {
                infoboxDesc.html('');
                infobox.addClass('no-desc');
            }
        }

        setCaptionContent();

        royalSlider.ev.on('rsBeforeAnimStart', function(event) {
            $('.gallery-infobox').removeClass('js--desc-active');
            setCaptionContent();
        });

        if(slidesNumber == 1) $slider.addClass('single-slide');
        
        if(slidesNumber > 1){
            $('.rsNav.rsBullets').appendTo('.slider-controls')
                .addClass('slider-controls__bullets');

            if($slider.hasClass('pixslider--portfolio') && $(window).width() < 900){
                $('.slider-controls').appendTo($slider);
            }


            $('.js-slider-arrow-prev').on('click', function(event){
                event.preventDefault();
                royalSlider.prev();
            });

            $('.js-slider-arrow-next').on('click', function(event){
                event.preventDefault();
                royalSlider.next();
            });  
        } else {
            $('.slider-controls').hide();
            $('.gallery-controls--fullscreen').hide();
        }

        $slider.addClass('slider--loaded');
		if (globalDebug) {console.log("Royal Slider - Added slider--loaded class");}

        // $(this).mousewheel(function(event, delta, deltaX, deltaY) {
        //     var slider = $(this).data('royalSlider');

        //     if (delta > 0) {
        //         slider.next();
        //     }

        //     if (deltaY < 0){
        //         slider.prev();
        //     }

        //     event.stopPropagation();
        //     event.preventDefault();
        // });

        royalSlider.ev.on('rsBeforeAnimStart', function(event) {
            royalSlider.stopVideo();
        });

	    // auto play video sliders if is set so
	    royalSlider.ev.on('rsAfterSlideChange', function(event) {

		    var $slide_content = $( royalSlider.currSlide.content );

		    // triggers after slide change
		    var rs_videoAutoPlaySlide = typeof $slide_content.data('video_autoplay') !== "undefined";

		    if ( rs_videoAutoPlaySlide ) {
			    royalSlider.stopVideo();
			    royalSlider.playVideo();
		    }

	    });

	    // after destroying a video remove the autoplay class (this way the image gets visible)
	    royalSlider.ev.on('rsOnDestroyVideoElement', function(i ,el){

		    $slide_content = $( this.currSlide.content );

		    $($slide_content).removeClass('video_autoplay');

	    });

    });


}
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
/* === Functions that require jQuery but have no place on this Earth, yet === */


/* --- Social Links Hover Effect (AddThis) --- */
var scl,
	socialLinks = {
		settings: {
			wrapper: $('.social-links'),
			button: $('.share-logo'),
			social_links: $('.social-links a'),
			social_links_list: $('.social-links-list'),
			anim: new TimelineLite({paused:true, onComplete:function(){
				$('.social-links-list').addClass('is-active');
			}, onReverseComplete:function(){
				$('.social-links-list').removeClass('is-active');
			}})
		},

		init: function() {
			if (globalDebug) {console.log("Social Links Hover - INIT");}

			scl = this.settings;
			this.update();


			if (!empty(scl.wrapper)) {
				//the actual animation
				scl.anim
					//.to(scl.button, 0.2, {backgroundColor:"#1a1717"})
					.to(scl.social_links_list, 0.2, {opacity: 1})
					.staggerFromTo(scl.social_links, 0.2, {opacity: 0, x: "24px"}, {opacity: 1, x: 0, ease:Quint.easeOut, onComplete: function(){
						$('.social-links-list').addClass('clickable');
					},
					onReverseComplete: function(){
						$('.social-links-list').removeClass('clickable');	
					}}, -0.02, "-=0.2");

				//toggle play and reverse timeline on hover
				scl.wrapper.hover(this.over, this.out);
			} else {
				if (globalDebug) {console.log("Social Links Hover - SHOW STOPPER - No social links wrapper found");}
			}
		},

		update: function() {
			if (globalDebug) {console.log("Social Links Hover - UPDATE");}

			scl.wrapper = $('.social-links');
			scl.button = $('.share-logo');
			scl.social_links = $('.social-links a');
			scl.social_links_list = $('.social-links-list');
			scl.anim = new TimelineLite({paused:true, onComplete:function(){
				scl.social_links_list.addClass('is-active');
			}, onReverseComplete:function(){
				scl.social_links_list.removeClass('is-active');
			}});
		},

		over: function() {
			if (globalDebug) {console.log("Social Links Hover - OVER");}

			scl.anim.play();
		},

		out: function() {
			if (globalDebug) {console.log("Social Links Hover - OUT");}

			scl.anim.reverse();
		}
	};


//here we change the link of the Edit button in the Admin Bar
//to make sure it reflects the current page
function adminBarEditFix(id) {
	//get the admin ajax url and clean it
	var baseURL = ajaxurl.replace('admin-ajax.php','post.php');

	$('#wp-admin-bar-edit a').attr('href',baseURL + '?post='+ id +'&action=edit');
}

/* --- Load AddThis Async --- */
function loadAddThisScript() {
	if (window.addthis) {
		if (globalDebug) {console.log("AddThis Load Script");}
		// Listen for the ready event
		addthis.addEventListener('addthis.ready', addthisReady);
		addthis.init();
	}
}

/* --- AddThis On Ready - The API is fully loaded --- */
//only fire this the first time we load the AddThis API - even when using ajax
function addthisReady() {
	if (globalDebug) {console.log("AddThis Ready");}
	addThisInit();
}

/* --- AddThis Init --- */
function addThisInit() {
	if (window.addthis) {
		if (globalDebug) {console.log("AddThis Toolbox INIT");}

		addthis.toolbox('.addthis_toolbox');
		socialLinks.init();
	}
}

/* --- Do all the cleanup that is needed when going to another page with dJax --- */
function cleanupBeforeDJax() {
	if (globalDebug) {console.group("CleanUp before dJax");}

	/* --- KILL ROYALSLIDER ---*/
	var sliders = $('.js-pixslider');
	if (!empty(sliders)) {
		sliders.each(function() {
			var slider = $(this).data('royalSlider');
			slider.destroy();
		});
	}

	/* --- KILL MAGNIFIC POPUP ---*/
	//when hitting back or forward we need to make sure that there is no rezidual Magnific Popup
	$.magnificPopup.close(); // Close popup that is currently opened (shorthand)

	infiniteScrollingDestroy();

	isotopeDestroy();

	//reset some vars
	royalSlider_loadedFirstSlide = false;
	fontLoader_fontsLoaded = false;
}

function copyrightOverlayInit(){
	$(document).on('contextmenu', '.pixslider--gallery.js-pixslider, .mfp-container, .mosaic-wrapper, img, a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', function(e){
		if( !empty($('.copyright-overlay'))){
			e.preventDefault();
			e.stopPropagation();

			copyrightOverlayAnimation('in', e.clientX, event.clientY);
		}
	});

	$('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]').bind('click', function(e){
		if (e.ctrlKey || e.metaKey){
			e.preventDefault();
			e.stopPropagation();

			copyrightOverlayAnimation('in', e.clientX, e.clientY);
		}
	});

	$(document).on('mousedown', function(){
		if($('body').hasClass('is--active-copyright-overlay'))
			copyrightOverlayAnimation('out');
	});
}



	// returns the depth of the element "e" relative to element with id=id
	// for this calculation only parents with classname = waypoint are considered
	function getLevelDepth( e, id, waypoint, cnt ) {
		cnt = cnt || 0;
		if ( e.id.indexOf( id ) >= 0 ) return cnt;
		if( $( e).hasClass( waypoint ) ) {
			++cnt;
		}
		return e.parentNode && getLevelDepth( e.parentNode, id, waypoint, cnt );
	}

	// returns the closest element to 'e' that has class "classname"
	function closest( e, classname ) {
		if( $(e).hasClass( classname ) ) {
			return e;
		}
		return e.parentNode && closest( e.parentNode, classname );
	}

})(jQuery, window);

// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data)
{
    if(typeof(data) == 'number' || typeof(data) == 'boolean')
    {
        return false;
    }
    if(typeof(data) == 'undefined' || data === null)
    {
        return true;
    }
    if(typeof(data.length) != 'undefined')
    {
        return data.length === 0;
    }
    var count = 0;
    for(var i in data)
    {
        // if(data.hasOwnProperty(i))
        // 
        // This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
        // http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
        // 
        // for hosts objects we do this
        if(Object.prototype.hasOwnProperty.call(data,i))
        {
            count ++;
        }
    }
    return count === 0;
}

function extend( a, b ) {
    for( var key in b ) {
        if( b.hasOwnProperty( key ) ) {
            a[key] = b[key];
        }
    }
    return a;
}

// taken from https://github.com/inuyaksa/jquery.nicescroll/blob/master/jquery.nicescroll.js
function hasParent( e, id ) {
    if (!e) return false;
    var el = e.target||e.srcElement||e||false;
    while (el && el.id != id) {
        el = el.parentNode||false;
    }
    return (el!==false);
}

function mobilecheck() {
    var check = false;
    (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
  var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
  separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

function is_touch_laptop() {
    return (('ontouchstart' in window)
    || (navigator.MaxTouchPoints > 0)
    || (navigator.msMaxTouchPoints > 0));
    //navigator.msMaxTouchPoints for microsoft IE backwards compatibility
}