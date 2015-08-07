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
