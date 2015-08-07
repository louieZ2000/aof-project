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