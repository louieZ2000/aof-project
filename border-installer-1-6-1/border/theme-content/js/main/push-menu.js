
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
