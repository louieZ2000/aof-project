
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
