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