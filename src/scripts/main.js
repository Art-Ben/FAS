let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

window.addEventListener('resize', () => {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
});

/*-- GoogleMapHelper --*/
function initMap($el) {

    var $markers = $el.find('.marker');

    // Create gerenic map.
    var mapArgs = {
        zoom: $el.data('zoom') || 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        zoomControl: true,
        styles: [
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#e9e9e9"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f5f5f5"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#dedede"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#333333"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f2f2f2"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#fefefe"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            }
        ]
    };
    var map = new google.maps.Map($el[0], mapArgs);

    // Add markers.
    map.markers = [];
    $markers.each(function () {
        initMarker($(this), map);
    });

    // Center map based on markers.
    centerMap(map);

    // Return map instance.
    return map;
}

function initMarker($marker, map) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
    };

    const imagePath = '/wp-content/themes/sandler/dist/images/';

    // Create marker instance.
    var marker = new google.maps.Marker({
        position: latLng,
        icon: {
            url: imagePath + 'mapMarker.png',
            /*origin: new google.maps.Point(62, 82),
            size: new google.maps.Size(62, 82),*/
            scaledSize: new google.maps.Size(62, 82)
        },
        map: map
    });

    // Append to reference for later use.
    map.markers.push(marker);

    // If marker contains HTML, add it to an infoWindow.
    if ($marker.html()) {

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
    }
}

function centerMap(map) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function (marker) {
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());

        // Case: Multiple markers.
    } else {
        map.fitBounds(bounds);
    }
}
/*-- END --*/
Object.defineProperty(HTMLMediaElement.prototype, 'playing', {
    get: function () {
        return !!(this.currentTime > 0 && !this.paused && !this.ended && this.readyState > 2);
    }
});


jQuery(document).ready(function () {

    var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    var video;

    if( !isIOS ) {
        var media = $('.heroSectionBg__video.notIos').get(0);
        video = document.querySelector('.heroSectionBg video.notIos');
        $('.heroSectionBg__video.istIos').hide();
    } else {
        var media = $('.heroSectionBg__video.istIos').get(0);
        video = document.querySelector('.heroSectionBg video.isIos');
        $('.heroSectionBg__video.notIos').hide();
    }

    var videoHeader = new MediaElementPlayer(media, {
        alwaysShowControls: false,
        autoplay: true,
        loop: true,
        features: [],
        poster: false,
        success: function (mediaElement, originalNode, instance) {
            mediaElement.addEventListener('canplay', function () {
                mediaElement.play();
            }, false);
        }
    });

    if( $('.heroSectionBg__video').length > 0 ) {
        setTimeout(function () {
            videoHeader.pause();
        }, 500);
    }

    if( $('.heroSectionBg__video').length > 0 ) {
        setTimeout(function () {
            if(videoHeader.paused){
                videoHeader.play();
                /*if( isIOS ) {
                    autoplayVideo();
                }*/
            }
        }, 3000);
    }

    function autoplayVideo() {
        $('.heroSection').on('click touchstart touchend', function () {
            if (video.playing) {

            } else {
                video.play();
            }
        });
        var event = $.Event( "touchend", { pageX:1, pageY:1 } );
        $(".heroSection").trigger( event );
    }

    if( $('#fullpage') || $('#fullpage').length > 0 ) {
        $('#fullpage').fullpage({
            autoScrolling:true,
            normalScrollElements: '.acf-map',
            scrollOverflow: false,
            responsiveWidth: 1025,

            onLeave: function(origin, destination, direction){
                var leavingSection = this;

                if( destination.index == 0 ) {
                    videoHeader.play();
                    $('.header').removeClass('dark');
                    $('.specialBottomLine').removeClass('filled');
                } else if( destination.index == 3 ) {
                    $('.header').removeClass('dark');
                    $('.specialBottomLine').removeClass('filled');
                    videoHeader.pause();
                }  else {
                    videoHeader.pause();
                    $('.header').addClass('dark');
                    $('.specialBottomLine').addClass('filled');
                }

                if( destination.index == 5 ) {
                    $('.specialBottomLine').addClass('hide');
                } else {
                    $('.specialBottomLine').removeClass('hide');
                }

                if( $(window).innerWidth < 560 ) {
                    if (destination.index == 0) {
                        videoHeader.play();
                        $('.header').removeClass('dark');
                    } else {
                        videoHeader.pause();
                        $('.header').addClass('dark');
                    }
                }
            }
        });
    }

    if($(window).innerWidth() < 560) {
        $(window).scroll(function(){
            if( $(window).scrollTop() > ($('.heroSection').innerHeight() / 2 ) ) {
                $('.header').addClass('dark');
                $('.specialBottomLine').addClass('filled');
            } else {
                $('.header').removeClass('dark');
                $('.specialBottomLine').removeClass('filled');
            }

            if( $(window).scrollTop() > ( $('.footer').offset().top - $('.footer').innerHeight() ) ) {
                $('.specialBottomLine').addClass('hide');
            } else {
                $('.specialBottomLine').removeClass('hide');
            }
        });
    }


    function initFlickitySlider(selector, prev, next, currentSlideMarker, options) {

        if( $(selector) ||  $(selector).length > 0) {
            var slideInstance = $(selector).flickity(options);

            if( prev !== null ) {
                $(prev).click(function(){
                    slideInstance.flickity('previous');
                });
            }

            if( next !== null ) {
                $(next).click(function(){
                    slideInstance.flickity('next');
                });
            }

            var slideInstanceData = slideInstance.data('flickity');

            if( currentSlideMarker !== null ) {
                function updateStatus() {
                    if ($(selector).length > 0) {
                        var cellNumber = slideInstanceData.selectedIndex + 1;
                        $(currentSlideMarker).text(cellNumber);
                    } else {
                        return false;
                    }
                }

                updateStatus();
                slideInstance.on('change.flickity', updateStatus);
            }
        } else {
            return false;
        }

        return slideInstance;
    }

    function useProgressBar(time, slider, progressbarElem, stopElem, elemContainer) {
        var time = time;
        var $bar,
            $slider,
            isPause,
            tick,
            percentTime,
            value;
        $slider = slider;

        $(progressbarElem).circleProgress({
            value: 0,
            max: 100
        });

        if( Array.isArray(stopElem) ) {
            stopElem.forEach( function (elem) {
                $(elem).on({
                    mouseenter: function() {
                        isPause = true;
                    },
                    mouseleave: function() {
                        isPause = false;
                    }
                });
            } )
        } else {
            $(stopElem).on({
                mouseenter: function() {
                    isPause = true;
                },
                mouseleave: function() {
                    isPause = false;
                }
            });
        }


        function startProgressbar() {
            resetProgressbar();
            percentTime = 0;
            isPause = false;
            tick = setInterval(interval, 50);
        }
        function interval() {
            if(isPause === false) {
                percentTime += 1 / (time+0.1);
                $(progressbarElem).circleProgress({
                    value: percentTime
                });
                if(percentTime >= 100)
                {
                    $slider.flickity('next', true);
                    value = 0;
                    startProgressbar();
                }
            }
        }
        function resetProgressbar() {
            $(progressbarElem).circleProgress({
                value: 0
            });
            clearTimeout(tick);
        }
        startProgressbar();
    }

    /*-- servicesSlider --*/

    if(
        $('.servicesSection__secondary--slider') || $('.servicesSection__secondary--slider').length > 0 &&
        $('.servicesSection__primary--slider') || $('.servicesSection__primary--slider').length > 0
    ) {
        $('.servicesSection__secondary--slider').flickity({
            asNavFor: '.servicesSection__primary--slider',
            prevNextButtons: false,
            draggable: false,
            pageDots: false,
            contain: false,
            cellAlign: 'left',
            wrapAround: true,
        });

        setTimeout(function(){
            $('.servicesSection__secondary--slider').flickity('resize');
        }, 100)

        var servicesSlider = initFlickitySlider(
            '.servicesSection__primary--slider',
            '.servicesSection .slidersNav .prev',
            '.servicesSection .slidersNav .next',
            '.servicesSection .slidersNavItems .current',
            {
                asNavFor: '.servicesSection__primary--slider',
                prevNextButtons: false,
                draggable: false,
                pageDots: false,
                contain: false,
                cellAlign: 'left',
                wrapAround: true,
            }
        )
        useProgressBar(
            1,
            servicesSlider ,
            '.servicesSection__cont .slidersNav .slidersNavBtn.next',
            '.servicesSection__cont .slidersNav, .servicesSection__secondary--slider__slide .title, .servicesSection .servicesSection__secondary--slider__slide .desc'
        );
    }
    /*-- END --*/


    /*-- sandlerStarsSlider --*/

    if( $('.starsSection__slider--instance') || $('.starsSection__slider--instance').length > 0 ) {
        var starsSlider = initFlickitySlider(
            '.starsSection__slider--instance',
            '.starsSection .slidersNav .prev',
            '.starsSection .slidersNav .next',
            '.starsSection .slidersNavItems .current',
            {
                prevNextButtons: false,
                pageDots: false,
                contain: true,
                cellAlign: 'left',
                wrapAround: true,
            }
        );

        useProgressBar(
            1,
            starsSlider ,
            '.starsSection .slidersNav .next',
            '.starsSection .slidersNav, .starsSection__slider--instance'
        );

        setTimeout( function () {
            starsSlider.flickity( 'resize' );
        }, 200 )
    }

    /*-- END --*/

    /*-- Footer gMap --*/
    if( $('.acf-map') || $('.acf-map').length > 0 ) {
        $('.acf-map').each(function () {
            var map = initMap($(this));
        });
    }
    /*-- END --*/

    /*-- Basic contact form --*/
    $('.basicContactForm #tel').mask('+38 (999) - 999 - 99 - 99');

    $('.basicContactForm .lbl').click(function(){
        $(this).prev('.inpt').focus();
        $(this).prev('.inpt').focus();
    });

    $('.basicContactForm .inpt').blur(function(){
        if( $(this).val() != '' || $(this).val() != undefined || $(this).val() != null) {
            $(this).next('.lbl').addClass('active');
        } else {
            $(this).next('.lbl').removeClass('active');
            console.log($(this).val());
        }
        console.log($(this).val());
    });

    function isEmptyStr(str) {
        return (!str || 0 === str.length);
    }

    $('.basicContactForm__instance').submit(function (e) {
        e.preventDefault();

        const _this = $(this);
        const name = _this.find('#fullname').val();
        const phone = _this.find('#tel').val();

        const utm_source = _this.find('#utm_source').val();
        const utm_medium = _this.find('#utm_medium').val();
        const utm_company = _this.find('#utm_campaign').val();
        const utm_content = _this.find('#utm_content').val();
        const utm_terms = _this.find('#utm_term').val();

        let error = false;
        const errors_texts = _this.data('errors');

        let err_txt = '';
        let err_elem = '';

        _this.find('.contactForm__err').remove();

        if (isEmptyStr(name)) {
            error = true;
            err_txt = errors_texts.empty;
            _this.find('#tel').siblings('.err').text(err_txt).fadeIn(600);
        }

        if (isEmptyStr(phone)) {
            error = true;
            err_txt = errors_texts.empty;
            _this.find('#fullname').siblings('.err').text(err_txt).fadeIn(600);
        }


        if (!error) {
            const data = new FormData();
            data.append('action', 'contactform');
            data.append('name', name);
            data.append('phone', phone);
            data.append('utm_source', utm_source);
            data.append('utm_medium', utm_medium);
            data.append('utm_content', utm_content);
            data.append('utm_terms', utm_terms);
            data.append('utm_company', utm_company);

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function (xhr) {

                },
                success: function (data) {
                    if (data.response == "SUCCESS") {
                        _this.find('.thanksMessage').fadeIn(600);
                    } else {
                        console.log(data.error);
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error - ' + errorMessage);
                }
            })
        }
    })

    /*-- END --*/

    /*-- Services primary --*/
    $('.pageServicesItems .imageGrp').hover(function(){
        $(this).parents('.pageServices__column').siblings('.pageServices__column').addClass('hovered');
    }, function(){
        $(this).parents('.pageServices__column').siblings('.pageServices__column').removeClass('hovered');
    });

    /*- Services lozad images -*/
    lozad('.servicesImagesLozad', {
        load: function(el) {
            el.src = el.dataset.src;
            el.onload = function() {
                setTimeout(function () {
                    $(el).parents('.pageServices__column').addClass('loaded');
                }, 500);
            }
        }
    }).observe();
    /*- END -*/

    /*-- END --*/

    /*-- Services Level2 --*/
    if( $('.subServicesItems__items--slider').length > 0 ) {
        initFlickitySlider(
            '.subServicesItems__items--slider',
            '.subServicesItems__items--nav .prev',
            '.subServicesItems__items--nav .next',
            '.subServicesItems__items--nav .current',
            {
                prevNextButtons: false,
                pageDots: false,
                contain: true,
                cellAlign: 'left',
                wrapAround: false,
                adaptiveHeight: true,
                draggable: false
            }
        );
    }

    $('.subServicesLinks .item').click(function(){
        var _this = $(this);
        var index = _this.index();
        _this.addClass('active');
        _this.siblings('.item').removeClass('active');
        $('.subServicesItems__items--slider').flickity('select', index ,true);
    });

    $('.subServicesItems__items--nav .slidersNavBtn').click(function(){
        var indx = $('.subServicesLinks .item.active').index();

        if( $(this).hasClass('prev') ) {
            if( indx !== 0 ) {
                indx--;
                $('.subServicesLinks .item').removeClass('active');
                $('.subServicesLinks .item').eq(indx).addClass('active');
            }
        } else if( $(this).hasClass('next') ) {
            if( indx < $('.subServicesItems__items--slider .item').length - 1 ) {
                indx++;
                $('.subServicesLinks .item').removeClass('active');
                $('.subServicesLinks .item').eq(indx).addClass('active');
            }
        }
    });

    setTimeout( function(){
        $('.subServicesItems__items--slider').flickity('resize');
    }, 500 );
    /*-- END --*/

    /*-- Services Level2 --*/
    if( $('.pageServices__level3 .subServicesItems__items--slider').length > 0 ) {
        initFlickitySlider(
            '.pageServices__level3 .subServicesItems__items--slider',
            '.pageServices__level3 .subServicesItems__items--nav .prev',
            '.pageServices__level3 .subServicesItems__items--nav .next',
            '.pageServices__level3 .subServicesItems__items--nav .current',
            {
                prevNextButtons: false,
                pageDots: false,
                contain: true,
                cellAlign: 'left',
                wrapAround: false,
                adaptiveHeight: true,
                draggable: false
            }
        );
    }

    $('.pageServices__level3 .subServicesItems__nav .item').click(function(){
        var _this = $(this);
        var index = _this.index();
        _this.addClass('active');
        _this.siblings('.item').removeClass('active');
        $('.subServicesItems__items--slider').flickity('select', index ,true);
    });

    setTimeout(function(){
        $('.pageServices__level3 .subServicesItems__items--slider').flickity('resize');
    }, 100)
    /*-- END --*/

    $('.menuToggler').click(function(){
        $(this).toggleClass('active');
        $('.modalMenu').toggleClass('show');
        //$.scrollLock(true);
    });

    $('.menuTogglerActive').click(function(){
        $('.menuToggler').toggleClass('active');
        $('.modalMenu').toggleClass('show');
        //$.scrollLock(false);
    });

    /* fix slider */
    if( $(window).innerWidth() < 560 ) {
        $('.starsSection__slider--slide .contentGrpPrime .desc, .footer__slogan.mobile').find('br').remove();
    }
    /*-- END --*/

    /*-- Page about --*/
    if( $('.pageAboutUs__services--slider__instance').length > 0 ) {
        if( $(window).innerWidth() > 1025 ) {
            var aboutServiceSlider = initFlickitySlider(
                '.pageAboutUs__services--slider__instance.notMobile',
                '.pageAboutUs__services--slider .slidersNav .prev',
                '.pageAboutUs__services--slider .slidersNav .next',
                '.pageAboutUs__services--slider .slidersNavItems .current',
                {
                    prevNextButtons: false,
                    draggable: true,
                    pageDots: false,
                    contain: false,
                    cellAlign: 'left',
                    wrapAround: true,
                    adaptiveHeight: true
                }
            )
            useProgressBar(
                1,
                aboutServiceSlider ,
                '.pageAboutUs__services--slider .slidersNav .next',
                '.pageAboutUs__services--slider .superSlide, .pageAboutUs__services--slider .slidersNav'
            );
        } else {
            $('.pageAboutUs__services--slider .slidersNavItems .all').text('7');

            var aboutServiceSliderMobile = initFlickitySlider(
                '.pageAboutUs__services--slider__instance.isMobile',
                '.pageAboutUs__services--slider .slidersNav .prev',
                '.pageAboutUs__services--slider .slidersNav .next',
                '.pageAboutUs__services--slider .slidersNavItems .current',
                {
                    prevNextButtons: false,
                    draggable: true,
                    pageDots: false,
                    contain: false,
                    cellAlign: 'left',
                    wrapAround: true,
                    adaptiveHeight: true
                }
            )
            useProgressBar(
                1,
                aboutServiceSliderMobile ,
                '.pageAboutUs__services--slider .slidersNav .next',
                '.pageAboutUs__services--slider .superSlide, .pageAboutUs__services--slider .slidersNav'
            );
        }
    }

    if( $('.pageAboutUs__proposition--slider__instance').length > 0 ) {
        var aboutPropositionSlider = initFlickitySlider(
            '.pageAboutUs__proposition--slider__instance',
            '.pageAboutUs__proposition--slider .slidersNav .prev',
            '.pageAboutUs__proposition--slider .slidersNav .next',
            '.pageAboutUs__proposition--slider .slidersNavItems .current',
            {
                prevNextButtons: false,
                draggable: true,
                pageDots: false,
                contain: false,
                cellAlign: 'left',
                wrapAround: true,
                adaptiveHeight: true
            }
        )
        useProgressBar(
            1,
            aboutPropositionSlider ,
            '.pageAboutUs__proposition--slider .slidersNav .next',
            '.pageAboutUs__proposition--slider .sliderItem, .pageAboutUs__proposition--slider .slidersNav'
        );
    }


    if( $(window).innerWidth() > 1025 ) {
        $('.cardsGrp .cardItem').hover( function () {
            var cardToShowId = $(this).data('card');
            var title = $(this).data('title');
            $('.txtGrp .txtItem').removeClass('show');
            $('.txtGrp .txtItem[data-txt="'+ cardToShowId+'"]').addClass('show');

        }, function () {
            $('.txtGrp .txtItem').removeClass('show');
            $('.txtGrp .txtItem.txtBasic').addClass('show');

        } );
    } else {
        $('.cardsGrp .cardItem').click( function() {
            var _this = $(this);
            var id = _this.data('card');
            var modalContent = $('.specialModal').find('.specialModalContent');
            var modal = $('.specialModal');
            var txtContent = $('.pageAboutUs__sClub .txtCont .txtItem[data-txt="'+ id +'"]').html();

            modalContent.html( txtContent );

            TweenLite.from( modal, {
                opacity: 0,
                visibility: 'hidden',
                display: 'none'
            });

            TweenLite.to( modal, 0.6, {
                opacity: 1,
                visibility: 'visible',
                display: 'flex'
            });

            TweenLite.to( $('.pageAboutUs'), 0.6, {
                filter: 'blur(5px)'
            });

            $.scrollLock(true);

        } );

        $('.specialModal__close').click( function() {
            var modal = $('.specialModal');

            TweenLite.from( modal, {
                filter: 'blur(5px)'
            });

            TweenLite.to( $('.pageAboutUs'), 0.6, {
                filter: 'unset'
            });

            TweenLite.from( modal, {
                opacity: 1,
                visibility: 'visible',
                display: 'flex'
            });

            TweenLite.to( modal, 0.6, {
                opacity: 0,
                visibility: 'hidden',
                display: 'none'
            });

            $.scrollLock(false);
        } )

    }

    if( $('.pageAboutUs__specialists__items').length > 0 ) {
        var aboutSpecialistsSlider = initFlickitySlider(
            '.pageAboutUs__specialists__items',
            '.pageAboutUs__specialists--cont .slidersNav .prev',
            '.pageAboutUs__specialists--cont .slidersNav .next',
            '.pageAboutUs__specialists--cont .slidersNavItems .current',
            {
                prevNextButtons: false,
                draggable: true,
                pageDots: false,
                contain: false,
                cellAlign: 'left',
                wrapAround: true,
                adaptiveHeight: true
            }
        )
        useProgressBar(
            1,
            aboutSpecialistsSlider ,
            '.pageAboutUs__specialists--cont .slidersNav .next',
            '.pageAboutUs__specialists__items .pageSpecialists__item, .pageAboutUs__specialists--cont .slidersNav'
        );

        setTimeout( function() {
            aboutSpecialistsSlider.flickity('resize');
        }, 100 );
    }
    /*-- END --*/

    /*-- Sandler Home --*/
    if( $('.pageHomeProducts__items').length > 0 ) {
        var pageSandlerHomeProducts = initFlickitySlider(
            '.pageHomeProducts__items',
            null,
            null,
            null,
            {
                prevNextButtons: false,
                draggable: false,
                pageDots: false,
                contain: false,
                cellAlign: 'left',
                wrapAround: false,
                adaptiveHeight: true,
                fade: true
            }
        );

        setTimeout( function() {
            pageSandlerHomeProducts.flickity('resize');
        }, 50 );
    }



    if( $('.pageHomeProducts__items--inner_items').length > 0 ) {
        var i = 0;
        $('.pageHomeProducts__items--inner_items').each( function () {
            i++;
            window['pageHomeProductsCatSlider_item_inner' + i] = initFlickitySlider(
                $(this),
                $(this).parents('.pageHomeProducts__items--inner').find('.prev'),
                $(this).parents('.pageHomeProducts__items--inner').find('.next'),
                $(this).parents('.pageHomeProducts__items--inner').find('.current'),
                {
                    prevNextButtons: false,
                    draggable: true,
                    pageDots: false,
                    contain: false,
                    cellAlign: 'left',
                    wrapAround: true,
                    adaptiveHeight: true,
                }
            );

            useProgressBar(
                1,
                window['pageHomeProductsCatSlider_item_inner' + i] ,
                $(this).parents('.pageHomeProducts__items--inner').find('.next'),
                [ $(this), $(this).siblings('.slidersNav') ]
            );
        } );
    }

    $('.pageHomeProducts__navs .pageHomeProducts__navs--item').click( function () {
        var _this = $(this);
        var sliderNeededIndex  = _this.index();
        _this.siblings('.pageHomeProducts__navs--item').removeClass('active');

        if( !_this.hasClass('active') ) {
            _this.addClass('active');
            pageSandlerHomeProducts.flickity('select', sliderNeededIndex);
            window['pageHomeProductsCatSlider_item_inner' + (sliderNeededIndex + 1)].flickity('select', 0);
        } else {
            return;
        }
    } );

    /*-- END --*/

    /*-- Page Specialists --*/

    function useHoverEffect( selector, parentSelector ,decorCircle ) {
        var $parent = document.querySelector(parentSelector);
        var parentPos = $parent.getBoundingClientRect();
        var $circle = $(decorCircle);

        $('body').on('mousemove', selector, moveCircle);
        $('body').on('mouseleave', selector, unhoverFunc);

        function moveCircle(e) {
            parentPos = $parent.getBoundingClientRect();
            TweenLite.to($circle, 0.3, {
                top: e.clientY - parentPos.y - ($circle.innerHeight() / 2),
                left: e.clientX - parentPos.x - ($circle.innerWidth() / 2 ),
                background: 'rgba(98, 41, 59, 0.4)'
            });
        }

        function unhoverFunc(e) {
            TweenLite.to($circle, 0.3, {
                top: 0,
                left: 0,
                background: 'transparent'
            });
        }
    }

    if( $('.pageSpecialistsMoreButton').length > 0 ) {
        useHoverEffect(
            '.pageSpecialistsMoreButton',
            '.btnAnimationCont',
            '.btnAnimationCont .decorCircle'
        );
    }


    $('body').on('click', '.pageSpecialistsMoreButton', function(){
        var _this = $(this);
        var specialistsCont = $('.pageSpecialists__items');
        var filterCat = _this.data('filter') ? _this.data('filter') : 'not_use';
        var curPage = parseInt(_this.prop('dataset').page);
        var nextPage = ++curPage;
        var maxPage = _this.data('max_page');

        var data = new FormData();
        data.append('action', 'ld_specialists');
        data.append('category', filterCat);
        data.append('paged', nextPage);

        console.log(filterCat, curPage, nextPage, maxPage);

        if( nextPage > maxPage ) {
            TweenLite.to( _this, 0.6, {
                opacity: 0,
            });

            TweenLite.to( _this.siblings('.decorCircle'), 0.6, {
                width: 0,
                height: 0,
                opacity: 0,
            });
        } else {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function (xhr) {

                },

                success: function ( data ) {
                    if ( data.status == "success") {
                        var curYpos = $('html,body').scrollTop();
                        _this.parents('.btnLine').before(data.output);
                        _this.prop('dataset').page++;

                        setTimeout(function(){
                            $('.pageSpecialists__item').addClass('show');

                            useHoverEffect(
                                '.pageSpecialistsMoreButton',
                                '.btnAnimationCont',
                                '.btnAnimationCont .decorCircle'
                            );
                        }, 300);

                        if( _this.prop('dataset').page >= maxPage ) {
                            TweenLite.to( _this, 0.6, {
                                opacity: 0,
                            });

                            TweenLite.to( _this.siblings('.decorCircle'), 0.8, {
                                opacity: 0,
                                width: 0,
                                height: 0
                            });
                        }

                        setTimeout(() => {
                            $('html,body').scrollTop(curYpos);
                        }, 100);
                    } else {
                        console.log(data.error);
                    }
                },

                error: function (xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    console.log('Error - ' + errorMessage);
                }
            })
        }
    });

    $('body').on('click', '.pageSpecialists__navs--item', function(){
        var _this = $(this);
        var specialistsCont = $('.pageSpecialists__items');
        var filterCat = _this.data('filter');

        console.log(filterCat);

        var data = new FormData();
        data.append('action', 'fl_specialists');
        data.append('category', filterCat);

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: data,
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function (xhr) {

            },

            success: function ( data ) {
                _this.addClass('active');
                _this.siblings('.pageSpecialists__navs--item').removeClass('active');

                if ( data.status == "success") {
                    specialistsCont.html(data.output);
                    setTimeout(function(){
                        $('.pageSpecialists__item').addClass('show');

                        useHoverEffect(
                            '.pageSpecialistsMoreButton',
                            '.btnAnimationCont',
                            '.btnAnimationCont .decorCircle'
                        );
                    }, 300);

                    var curYpos = $('html,body').scrollTop();

                    setTimeout(() => {
                        $('html,body').scrollTop(curYpos);
                    }, 100);
                } else {
                    console.log(data.error);
                }
            },

            error: function (xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + errorMessage);
            }
        })
    });
    /*-- END --*/



    /*-- smooth scroll link --*/
    setTimeout(function () {
        if (location.hash) {
            window.scrollTo(0, 0);
            target = location.hash.split('#');
            smoothScrollTo($('#' + target[1]));
        }
    }, 1000);

    function smoothScrollTo(target) {
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - $('.header').innerHeight()
            }, 1000);
        }
    }
    /*-- end --*/

    /*-- Specialist Services Links --*/
    if( $('.singleSpecialist__services--slider').length > 0 ) {
        var aboutSpecialistsSlider = initFlickitySlider(
            '.singleSpecialist__services--slider',
            '.singleSpecialist__services .slidersNav .prev',
            '.singleSpecialist__services .slidersNav .next',
            '.singleSpecialist__services .slidersNavItems .current',
            {
                prevNextButtons: false,
                draggable: true,
                pageDots: false,
                contain: false,
                cellAlign: 'left',
                wrapAround: true,
                adaptiveHeight: true
            }
        )
        useProgressBar(
            1,
            aboutSpecialistsSlider ,
            '.singleSpecialist__services .slidersNav .next',
            '.singleSpecialist__services .serviceItem, .singleSpecialist__services .slidersNav'
        );

        setTimeout( function() {
            aboutSpecialistsSlider.flickity('resize');
        }, 100 );
    }

    $('.singleSpecialist__bio--more .btnAnimationCont').click( function() {
        var moreLine = $('.singleSpecialist__bio--more');
        var moreContent = $('.singleSpecialist__bio--after');

        TweenLite.from( moreLine, {
            opacity: 1,
            display: 'flex'
        });

        TweenLite.to( moreLine, 0.6, {
            opacity: 0,
            display: 'none'
        });

        TweenLite.from( moreContent, {
            opacity: 0,
            display: 'none'
        });

        TweenLite.to( moreContent, 0.6, {
            opacity: 1,
            display: 'block',
            delay: 0.8
        });
    });

    jQuery('.singleSpecialist__right').theiaStickySidebar({
        containerSelector: '.singleSpecialist__cont',
        additionalMarginTop: 5,
        updateSidebarHeight: false,
        defaultPosition: 'relative'
    });

    $(window).scroll(function(){
        var decorCircle = $('.singleSpecialist__right .thumb .decorCircle');

       if( $(window).scrollTop() > ( $('.singleSpecialist__left').scrollTop()) ) {
           decorCircle.addClass('fixed');
       } else {
           decorCircle.removeClass('fixed');
       }
    });

    /*-- END --*/
});