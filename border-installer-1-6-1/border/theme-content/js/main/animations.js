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