let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

window.addEventListener('resize', () => {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
});

var global_markers = [];
var global_infowindows = [];
var infowindow;
/*-- GoogleMapHelper --*/
function initMap($el, useSpecialMarker = 'not_use') {

    var $markers = $el.find('.gmap-marker');

    // Create gerenic map.
    var mapArgs = {
        zoom: $el.data('zoom') || 15,
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

    google.maps.event.addListener(map, 'click', function(event) {
        if (infowindow) {
            infowindow.close();
        }
    } );

    // Add markers.
    map.markers = [];
    $markers.each(function () {
        initMarker($(this), map, useSpecialMarker);
    });

    // Center map based on markers.
    centerMap(map);

    // Return map instance.
    return map;
}

function initMarker($marker, map, useSpecialMarker) {
    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
    };

    let imagePath, markerSize;

    if ( useSpecialMarker === 'use' ) {
        imagePath = '/wp-content/themes/FAS_site/dist/images/mapSpecialMarker.png';
        markerSize = new google.maps.Size(55, 75)

    } else {
        imagePath = '/wp-content/themes/FAS_site/dist/images/mapMarker.svg';
        markerSize = new google.maps.Size(32, 35);
    }


    // Create marker instance.
    var marker = new google.maps.Marker({
        position: latLng,
        icon: {
            url: imagePath,
            scaledSize: markerSize
        },
        map: map
    });

    // Append to reference for later use.
    map.markers.push(marker);
    global_markers.push(marker);

    // If marker contains HTML, add it to an infoWindow.
    if ($marker.html()) {

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function () {
            if (infowindow) {
                infowindow.close();
            }

            infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            infowindow.open(map, marker);

            map.setCenter( marker.getPosition() );

            map.setZoom(16);
        });

        global_infowindows.push(infowindow);
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

jQuery(document).ready(function () {

    /*-- Header when scroll --*/
    if( $(window).scrollTop() > $('.header').innerHeight() ) {
        $('.header').addClass('fixed');
    } else {
        $('.header').removeClass('fixed');
    }

    $(window).scroll( function() {
        if( $(window).scrollTop() > $('.header').innerHeight() ) {
            $('.header').addClass('fixed');
        } else {
            $('.header').removeClass('fixed');
        }
    } );
    /*-- END --*/

    /*-- Header drop menus --*/
    $('.headerNav__list--item.hasDropMenu').click( function() {
        var allDropMenus = $('.headerNav__list--item.hasDropMenu.open .dropMenu');
        var thisDropMenu = $(this).find('.dropMenu');
        var top;

        if( $(window).innerWidth() < 560 ) {
            top = 'calc(100% - 10px)';
        } else {
            top = '110%';
        }

        if( !$(this).hasClass('open') ) {
            $('.headerNav__list--item.hasDropMenu').removeClass('open');

            $(this).addClass('open');

            gsap.fromTo( allDropMenus,
                {
                    opacity: 1,
                    top: top,
                    display: 'flex'
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );


            gsap.fromTo( thisDropMenu,
                {
                    opacity: 0,
                    top: '0',
                    display: 'none'
                },
                {
                    opacity: 1,
                    top: top,
                    display: 'flex',
                    duration: 0.6,
                    delay: 0.3
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo( thisDropMenu,
                {
                    opacity: 1,
                    top: top,
                    display: 'flex',
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );
        }
    } );

    $('.footerNav__list--item.hasDropMenu').click( function() {
        var allDropMenus = $('.footerNav__list--item.hasDropMenu.open .dropMenu');
        var thisDropMenu = $(this).find('.dropMenu');

        if( !$(this).hasClass('open') ) {

            $('.footerNav__list--item.hasDropMenu').removeClass('open');

            $(this).addClass('open');

            gsap.fromTo( allDropMenus,
                {
                    opacity: 1,
                    top: 'calc(110% - 15px)',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );


            gsap.fromTo( thisDropMenu,
                {
                    opacity: 0,
                    top: '0',
                    display: 'none'
                },
                {
                    opacity: 1,
                    top: 'calc(110% - 15px)',
                    display: 'flex',
                    duration: 0.6,
                    delay: 0.3
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo( thisDropMenu,
                {
                    opacity: 1,
                    top: 'calc(110% - 15px)',
                    display: 'flex',
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );
        }
    } )
    /*-- END --*/

    /*-- lang switch --*/
    $('.headerLangSwitch__cont').click( function() {
        var dropMenu = $(this).siblings('.headerLangSwitch__drop');

        if( !$(this).hasClass('open') ) {
            $(this).addClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 0,
                    top: 0,
                    display: 'none'
                },
                {
                    opacity: 1,
                    top: '115%',
                    display: 'flex',
                    duration: .6,
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 1,
                    top: '115%',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    top: 0,
                    display: 'none',
                    duration: .6,
                }
            );

        }
    } );

    $('.footerLangSwitch__cont').click( function() {
        var dropMenu = $(this).siblings('.footerLangSwitch__drop');

        if( !$(this).hasClass('open') ) {
            $(this).addClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 0,
                    top: 0,
                    display: 'none'
                },
                {
                    opacity: 1,
                    top: '115%',
                    display: 'flex',
                    duration: .6,
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 1,
                    top: '115%',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    top: 0,
                    display: 'none',
                    duration: .6,
                }
            );

        }
    } );
    /*-- END --*/

    /*-- Header mobile nav --*/
    $('.btnMenuToggle').click( function() {
        var mobileMenu = $('.header__mobileMenu');
        var allDropMenus = $('.headerNav__list--item.hasDropMenu.open .dropMenu');
        var addHeaderMenu = $('.header__mobileBtns');

        if( !$(this).hasClass('open') ) {
            $(this).addClass('open');

            gsap.fromTo(mobileMenu ,
                {
                    opacity: 0,
                    top: 0,
                    display: 'none'
                },
                {
                    opacity: 1,
                    top: '100%',
                    display: 'flex',
                    duration: .6,
                }
            );

            if( $('.btnAddMenuToggle').hasClass('open') ) {
                $('.btnAddMenuToggle').removeClass('open');

                gsap.fromTo( addHeaderMenu,
                    {
                        opacity: 1,
                        top: '100%',
                        display: 'flex',
                        duration: 0.6
                    },
                    {
                        opacity: 0,
                        top: '0',
                        display: 'none',
                        duration: 0.6
                    }
                );
            }

        } else {
            $(this).removeClass('open');
            $('.headerNav__list--item.hasDropMenu').removeClass('open');
            gsap.fromTo( allDropMenus,
                {
                    opacity: 1,
                    top: 'calc(110% - 15px)',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );

            gsap.fromTo(mobileMenu ,
                {
                    opacity: 1,
                    top: '100%',
                    display: 'flex',

                },
                {
                    opacity: 0,
                    top: 0,
                    display: 'none',
                    duration: .6,
                }
            );
        }
    } );
    /*-- END --*/

    /*-- Header mobile acc / login btn --*/
    $('.btnAddMenuToggle').click( function() {
        var mobileMenu = $('.header__mobileMenu');
        var allDropMenus = $('.headerNav__list--item.hasDropMenu.open .dropMenu');
        var addHeaderMenu = $('.header__mobileBtns');

        if( !$(this).hasClass('open') ) {
            $(this).addClass('open');

            if( $('.btnMenuToggle').hasClass('open') ) {
                $('.btnMenuToggle').removeClass('open');

                gsap.fromTo( allDropMenus,
                    {
                        opacity: 1,
                        top: 'calc(110% - 15px)',
                        display: 'flex'
                    },
                    {
                        opacity: 0,
                        top: '0',
                        display: 'none',
                        duration: 0.6
                    }
                );

                gsap.fromTo(mobileMenu ,
                    {
                        opacity: 1,
                        top: '100%',
                        display: 'flex',

                    },
                    {
                        opacity: 0,
                        top: 0,
                        display: 'none',
                        duration: .6,
                    }
                );
            }

            gsap.fromTo( addHeaderMenu,
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                },
                {
                    opacity: 1,
                    top: '100%',
                    display: 'flex',
                    duration: 0.6
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo( addHeaderMenu,
                {
                    opacity: 1,
                    top: '100%',
                    display: 'flex',
                    duration: 0.6
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );
        }
    } );
    /*-- END --*/

    /*-- scroll next section --*/
    $('.scrollToNextSection ').click( function(){
        var prnt = $(this).parents('section').siblings('section');

        $('html, body').animate({
            'scrollTop':   $(prnt).offset().top - $('.header').innerHeight()
        }, 500);
    } )
    /*-- END --*/

    /*-- Docs drop downs --*/
    $('.legendItem__drop').click( function() {
        var parElem, dropEelem;
        parElem = $(this).parent();
        dropEelem = $(this).siblings('.legendItem__dropLinks');
        if( !parElem.hasClass('open') ) {
            parElem.addClass('open');
            gsap.fromTo( dropEelem ,
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                },
                {
                    opacity: 1,
                    top: '110%',
                    display: 'flex',
                    duration: 0.6
                },

            );
        } else {
            parElem.removeClass('open');
            gsap.fromTo( dropEelem ,
                {
                    opacity: 1,
                    top: '110%',
                    display: 'flex',
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.6
                }
            );
        }
    } );
    /*-- END --*/

    /*-- Tables tabs --*/
    var tableSlider = $('.pagePricing__tableTabs--slider').flickity({
        wrapAround: false,
        draggable: false,
        contain: true,
        prevNextButtons: false,
        pageDots: false,
        adaptiveHeight: true
    });

    $('.pagePricing__tableTabs--nav__item').click(function(){
        var indexSlide = $(this).index() - 1;
        var index = $(this).index();

        tableSlider.flickity('select', indexSlide);

        var decorNavLeft, decorNavLeftNew, decorTriangleLeft, decorTriangleLeftNew;

        var decorNav = $('.pagePricing__tableTabs--nav .activeElemDecor');

        var decorTriangle = $('.pagePricing__tableTabs--items .decorTriangle');

        decorNavLeft = decorNav[0].offsetLeft;
        decorTriangleLeft = decorTriangle[0].offsetLeft;

        switch ( index ) {
            case 1:
                decorTriangleLeftNew = 'calc(33%/2 - 25px)';
                decorNavLeftNew = '0'
                break;

            case 2:
                decorTriangleLeftNew = 'calc((33%/2 - 25px) + 33%)';
                decorNavLeftNew = '33%'
                break;

            case 3:
                decorTriangleLeftNew = 'calc((33%/2 - 25px) + 66%)';
                decorNavLeftNew = '66%'
                break;
        }

        var tab_to_show = $(this).data('tab_to_show');
        var elements = $('.pagePricing__tableTabs--items__tab');
        var elem_to_show = $('.pagePricing__tableTabs--items__tab[data-tab_id='+ tab_to_show +']');

        if( !$(this).hasClass('active') ) {
            $(this).addClass('active');
            elements.removeClass('open');
            $(this).siblings('.pagePricing__tableTabs--nav__item').removeClass('active');

            gsap.fromTo( decorNav , {
                left: decorNavLeft
            }, {
                left: decorNavLeftNew,
                duration: 0.6
            } );

            gsap.fromTo( decorTriangle , {
                left: decorTriangleLeft
            }, {
                left: decorTriangleLeftNew,
                duration: 0.6
            } );
        }
    });
    /*-- END --*/

    /*-- page Business --*/
    var tabsSlider = $('.pageBusiness_sect3--items').flickity({
        wrapAround: false,
        draggable: false,
        contain: true,
        prevNextButtons: false,
        pageDots: false,
        adaptiveHeight: true
    });

    $('.pageBusiness_sect3--items__nav .navItem').click( function() {
        if ( !$(this).hasClass('is_active') ) {
            $(this).addClass('is_active');
            $(this).siblings('.navItem').removeClass('is_active');

            tabsSlider.flickity( 'select', $(this).index() );
        }
    } );

    $('.specials__drop').click( function () {
        var parElem, dropEelem, allElem, allParElem, allDropElem;
        parElem = $(this).parent();
        dropEelem = $(this).siblings('.specials__dropDown');
        allElem = $('.pageBusiness_sect6--items .specials__dropDown.open');
        allParElem = $('.pageBusiness_sect6--items .sub');
        allDropElem = $('.pageBusiness_sect6--items .specials__drop');

        if( !parElem.hasClass('open') ) {
            allElem.removeClass('open');
            allParElem.removeClass('open');
            allDropElem.removeClass('open');

            $(this).addClass('open');
            parElem.addClass('open');
            dropEelem.addClass('open');

            gsap.fromTo( dropEelem ,
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                },
                {
                    opacity: 1,
                    top: '110%',
                    display: 'flex',
                    duration: 0.4,
                    delay: 0.4
                },

            );

            gsap.fromTo( allElem ,
                {
                    opacity: 1,
                    top: '110%',
                    display: 'flex',
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.4
                }
            );
        } else {
            parElem.removeClass('open');
            $(this).removeClass('open');
            dropEelem.removeClass('open');

            gsap.fromTo( dropEelem ,
                {
                    opacity: 1,
                    top: '110%',
                    display: 'flex',
                },
                {
                    opacity: 0,
                    top: '0',
                    display: 'none',
                    duration: 0.4
                }
            );
        }
    } );
    /*-- END --*/

    /*-- Contact form --*/
    function checkEmpty(val) {
        return (!val || 0 === val.length);
    }

    $('.pageBlog__newsletter--form').submit( function (e) {
        var _this = $(this);
        var email, email_elem;
        email_elem = _this.find('#email');
        email = email_elem.val();

        var emailRegExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        var error = false;

        var data = new FormData();
        data.append('action', 'newsletter');
        data.append('email', email);

        function addErrorClass(elem, errorClass) {
            $(elem).addClass(errorClass);
        }

        function removeErrorClass(elem, errorClass) {
            $(elem).removeClass(errorClass);
        }

        if (!email.match(emailRegExp)) {
            error = true;
            addErrorClass($(email_elem).parent(), 'has_error');
        } else {
            removeErrorClass($(email_elem).parent(), 'has_error');
        }

        if (!error) {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: "json",

                success: function (data) {
                    if (data.response == "SUCCESS") {
                        $(email_elem).parent().addClass('success');

                        setTimeout( () => {
                            email_elem.val('');
                            $(email_elem).parent().removeClass('success');
                        }, 3500);
                    } else {
                        console.log(data.error);
                    }
                },
            })
        } else {
            //infoCont.fadeIn(600).removeClass('success').addClass('errors').html(errors);
        }
    });

    $('.contactForm__instance--form').submit( function (e) {
        e.preventDefault();
        var _this = $(this);
        var name, email, msg, name_elem, email_elem, msg_elem, captcha, captcha_elem, infoBlock, thanksmsg;

        infoBlock = _this.parents('.contactForm').find('.infoBlock');
        thanksmsg = _this.data('thanks');

        name_elem = _this.find('#name');
        email_elem = _this.find('#email');
        msg_elem = _this.find('#msg');
        captcha_elem = _this.find('#g-captcha');

        name = name_elem.val();
        email = email_elem.val();
        msg = msg_elem.val();
        captcha = grecaptcha.getResponse();

        var emailRegExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        var error = false;

        var data = new FormData();
        data.append('action', 'sendcontactform');
        data.append('name', name);
        data.append('email', email);
        data.append('message', msg);

        function addErrorClass(elem, errorClass) {
            $(elem).addClass(errorClass);
        }

        function removeErrorClass(elem, errorClass) {
            $(elem).removeClass(errorClass);
        }

        if ( captcha.length === 0 ) {
            error = true;
            addErrorClass(captcha_elem, 'has_error');
        } else {
            removeErrorClass(captcha_elem, 'has_error');
        }

        if (checkEmpty(name)) {
            error = true;
            addErrorClass(name_elem, 'has_error');
        } else {
            removeErrorClass(name_elem, 'has_error');
        }

        if (!email.match(emailRegExp)) {
            error = true;
            addErrorClass(email_elem, 'has_error');
        } else {
            removeErrorClass(email_elem, 'has_error');
        }

        if (!error) {
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: "json",

                success: function (data) {
                    if (data.response == "SUCCESS") {

                        gsap.fromTo( infoBlock,
                            {
                                opacity: 0,
                                display: 'none',
                            },
                            {
                                opacity: 1,
                                display: 'flex',
                                duration: 0.6,
                                onComplete: function() {
                                    infoBlock.text(thanksmsg);
                                }
                            }
                        );

                        setTimeout( () => {


                            gsap.fromTo( infoBlock,
                                {
                                    opacity: 1,
                                    display: 'flex',
                                },
                                {
                                    opacity: 0,
                                    display: 'none',
                                    duration: 0.6
                                }
                            );

                            name_elem.val('');
                            email_elem.val('');
                            msg_elem.val('');
                            grecaptcha.reset();
                        }, 3500);
                    } else {
                        console.log(data.error);
                    }
                },
            })
        } else {
            //infoCont.fadeIn(600).removeClass('success').addClass('errors').html(errors);
        }
    } );
    /*-- END --*/

    $('.pageSepa_sect2--flags_btnLine .cstBtn').click( function() {
        var moreTxt = $(this).find('.more');
        var lessText = $(this).find('.less');

        if( !$(this).hasClass('active') ) {
            $(this).addClass('active');

            gsap.fromTo('.pageSepa_sect2--flags', {
                height: '200px',
            }, {
                height: 'auto',
                duration: 0.6
            });

            gsap.fromTo(moreTxt, {
                display: 'block'
            }, {
                display: 'none',
                duration: 0.4
            });

            gsap.fromTo( lessText, {
                display: 'none'
            }, {
                display: 'block',
                duration: 0.4,
                delay: 0.4
            });

            $('.pageSepa_sect2--flags').addClass('open');
        } else {
            $(this).removeClass('active');

            gsap.fromTo('.pageSepa_sect2--flags', {
                height: $('.pageSepa_sect2--flags').innerHeight(),
            }, {
                height: '200px',
                duration: 0.6
            });

            gsap.fromTo(lessText, {
                display: 'block'
            }, {
                display: 'none',
                duration: 0.4
            });

            gsap.fromTo( moreTxt, {
                display: 'none'
            }, {
                display: 'block',
                duration: 0.4,
                delay: 0.4
            });

            $('.pageSepa_sect2--flags').removeClass('open');
        }
    } );

    /*-- GMAP --*/
    $('.pageCashTrans_sect5--map_instance').each(function() {

        // create map
        map = initMap($(this));

    });

    $('.viewMap').on('click', function() {
        var idx = $(this).data('marker_id') - 1;
        global_infowindows.forEach( (elem) => {
            google.maps.event.trigger(elem, 'close');
        } );
        /*google.maps.event.trigger(global_infowindows, 'close');*/
        google.maps.event.trigger(global_markers[idx], 'click');

    });
    /*-- END --*/

    /*-- QA --*/
    $('.pageQa_sect2 .item .subItem__toggler').click(function(){
        var _this = $(this);
        var parent = _this.parents('.subItem');
        var groupParent = _this.parents('.item');
        var groupItems = groupParent.find('.subItem');
        var color = $(groupParent).find('.item_title').data('color_primary');
        var content = _this.siblings('.hiddenContent');
        var iconMore = _this.find('.icon_more');
        var iconLess = _this.find('.icon_less');
        var txt = _this.find('.txt');
        var bg = parent.find('.subItem_bg');

        if ( !_this.hasClass('is_open') ) {
            groupItems.each( function() {
                var _thisInner = $(this);
                var contentInner = _thisInner.find('.hiddenContent');
                var txtInner = _thisInner.find('.txt');
                var iconMoreInner = _thisInner.find('.icon_more');
                var iconLessInner = _thisInner.find('.icon_less');
                var bgInner = _thisInner.find('.subItem_bg');
                _thisInner.find('.subItem__toggler').removeClass('is_open');

                gsap.fromTo( bgInner[0] , {

                }, {
                    display: 'none',
                    opacity: 0,
                    duration: .4
                });

                gsap.fromTo( txtInner[0] , {

                }, {
                    color: '#2F2F32',
                    duration: .4
                });

                gsap.fromTo( contentInner[0] , {

                }, {
                    display: 'none',
                    opacity: 0,
                    duration: .4
                });

                gsap.fromTo( iconLessInner[0] , {

                }, {
                    display: 'none',
                    duration: .2,
                });

                gsap.fromTo( iconMoreInner[0] , {

                }, {
                    display: 'block',
                    duration: .2,
                });
            } );

            _this.addClass('is_open');

            gsap.fromTo( txt[0] , {
                color: '#2F2F32'
            }, {
                color: color,
                duration: .4
            });

            gsap.fromTo( content[0] , {
                display: 'none',
                opacity: 0,
            }, {
                display: 'block',
                opacity: 1,
                duration: .4
            });

            gsap.fromTo( iconLess[0] , {

            }, {
                display: 'block',
                duration: .2,
                delay: 0.2
            });

            gsap.fromTo( iconMore[0] , {

            }, {
                display: 'none',
                duration: .2,
            });

            gsap.fromTo( bg[0] , {
                display: 'none',
                opacity: 0
            }, {
                display: 'block',
                opacity: 1,
                duration: .4
            });
        } else {
            _this.removeClass('is_open');

            gsap.fromTo( txt[0] , {
                color: color,
            }, {
                color: '#2F2F32',
                duration: .4
            });

            gsap.fromTo( content[0] , {
                display: 'block',
                opacity: 1
            }, {
                display: 'none',
                opacity: 0,
                duration: .4
            });

            gsap.fromTo( iconLess[0] , {

            }, {
                display: 'none',
                duration: .2,
            });

            gsap.fromTo( iconMore[0] , {

            }, {
                display: 'block',
                duration: .2,
                delay: .2
            });

            gsap.fromTo( bg[0] , {
                display: 'block',
                opacity: 1,
            }, {
                display: 'none',
                opacity: 0,
                duration: .4
            });
        }
    })
    /*-- END --*/

    /*-- Contacts Map --*/
    $('.pageContacts .mapInstance').each(function() {
        // create map
        map = initMap($(this), 'use');
    });
    /*-- END --*/

    /*-- Blog sort Drops --*/
    $('.pageBlog .dropsCont').click( function ( ) {
        var _this = $(this);
        var drops = _this.find('.hiddenItems');

        if ( !_this.hasClass('is_open') ) {
            _this.addClass('is_open');
            gsap.fromTo( drops[0], {
                top: '-110%',
                opacity: 0,
                display: 'none'
            },{
                top: '110%',
                display: 'flex',
                opacity: 1,
                duration: 0.4
            })
        } else {
            _this.removeClass('is_open');
            gsap.fromTo( drops[0], {
                top: '110%',
                display: 'flex',
                opacity: 1
            },{
                top: '-110%',
                display: 'none',
                opacity: 0,
                duration: 0.4
            })
        }
    } );
    /*-- END --*/


});

function invalid_empty_str($str) {
    if (!$str || /^\s*$/.test($str) || $str.length === 0) {
        return true;
    } else {
        return false;
    }
}

$('.pageBlog__search--form').submit(function(e){
    e.preventDefault();
    var _this = $(this);
    var inpt = _this.find('#s').val();

    if( invalid_empty_str(inpt) ) {
        _this.addClass('has_error');
    } else {
        e.currentTarget.submit();
    }
})
/*-- Claim form --*/
$(function(){
    function addErrorClass(elem, errorClass) {
        $(elem).addClass(errorClass);
    }

    function removeErrorClass(elem, errorClass) {
        $(elem).removeClass(errorClass);
    }

    function filter(array, value, key) {
        return array.filter(key
            ? a => a[key] === value
            : a => Object.keys(a).some(k => a[k] === value)
        );
    }

    let fileUpload = document.querySelector('.myContactForm .cstFileUpload .cstFileUploadHidden');

    let fileUploadName = document.querySelector(".myContactForm .cstFileUpload .cstFileUpload__files");

    //let removePreview = document.querySelector(".myContactForm .remove-all-preview");

    let filesErr = document.querySelector('.myContactForm .cstFileUpload .uploadedErr');

    if(fileUpload) {
        fileUpload.addEventListener("change", handleFiles, false);
        function handleFiles(e) {
            const fileList = this.files;
            const numFiles = fileList.length;
            filesErr.style.display = 'none';
            filesErr.innerHTML = '';
            for (let i = 0, numFiles = fileList.length; i < numFiles; i++) {
                uploadFile(this.files[i]);
            }
        }
    }

    function uploadFile(file) {
        let reader = new FileReader();

        fileUploadName.innerHTML = '';
        //removePreview.classList.remove('is-active');

        reader.onload = function(e) {
            //removePreview.classList.add('is-active');
            fileUploadName.innerHTML +=  `<div data-file_id="${file.name.toLowerCase().replace(/\s/g, '')}" class="uploadedFile">${file.name}<span class="delete_line">❌</span></div>`;
            let figcaption = document.querySelectorAll('.myContactForm .cstFileUpload .uploadedFile');

            /*removePreview.addEventListener('click', function() {
                figcaption.forEach(function(item) {
                    item.remove();
                });
                removePreview.classList.remove('is-active');
                fileUpload.value = '';
                filesErr.innerHTML = '';
                filesErr.style.display = 'none';
            })*/
        };

        reader.onerror = function(e) {
            alert('An error occurred while uploading the file, please contact the administrator!');
        };

        reader.readAsDataURL(file);
    }

    $('body').on('click', '.cstFileUpload .delete_line', function() {
        $(this).parents('.uploadedFile').remove();
        if( $('.uploadedFile').length == 0 ){
            $('.myContactForm .cstFileUpload .cstFileUpload__files').empty();
            filesErr.innerHTML = '';
            filesErr.style.display = 'none';
            fileUpload.value = '';
        }
    } );

    function invalid_empty_str($str) {
        if (!$str || /^\s*$/.test($str) || $str.length === 0) {
            return true;
        } else {
            return false;
        }
    }

    $('.myContactForm').submit( function() {
        var _this = $(this);
        var formErrors_empty = _this.data('errors_empty');
        var formErrors_validation = _this.data('errors_validation');
        var has_error = false;

        var afterSubmitAction = 'show_message';

        var name, email, phone, client_companyname, client_contract, client_ordernumber, client_desc ,files_invalid, files, files_send, files_send_urls, finale_step, captcha, captcha_elem;
        var  successCount = 0;

        name = _this.find('#client_name').val();
        email = _this.find('#client_email').val();
        phone = _this.find('#client_phone').val();
        captcha_elem = _this.find('#g-captcha');
        captcha = grecaptcha.getResponse();;

        client_companyname = _this.find('#client_companyname').val();
        client_contract = _this.find('#client_contract').val();
        client_ordernumber = _this.find('#client_ordernumber').val();
        client_desc = _this.find('#client_desc').val();

        files = _this.find('#client_files').prop('files');

        files_send = [];

        files_send_urls = [];

        files_invalid = false;

        finale_step = false;

        var data = new FormData();

        if ( invalid_empty_str(name) ) {
            has_error = true;
            _this.find('#client_name').addClass('has_error');
        }

        if ( invalid_empty_str(phone) ) {
            has_error = true;
            _this.find('#client_phone').addClass('has_error');
        }

        if (invalid_empty_str(email)) {
            has_error = true;
            _this.find('#client_email').addClass('has_error');
        } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/)) {
            has_error = true;
            _this.find('#client_email').addClass('has_error');
        }

        if ( captcha.length === 0 ) {
            has_error = true;
            addErrorClass(captcha_elem, 'has_error');
        } else {
            removeErrorClass(captcha_elem, 'has_error');
        }

        if( !has_error ) {
            data.append('action', 'sendclaimform');
            data.append('client_name', name);
            data.append('client_email', email);
            data.append('client_phone', phone);
            data.append('client_companyname', client_companyname);
            data.append('client_contract', client_contract);
            data.append('client_ordernumber', client_ordernumber);
            data.append('client_desc', client_desc);

            if( files.length > 0 ) {
                for( let i = 0; i < files.length; i++ ) {
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;

                    if( files[i].size > 10485760 ) {
                        files_invalid = true;
                        _this.find('.uploadedErr').fadeIn(500).append(`This file ( ${ files[i].name } ) to large, allowed file size is 10MB`);
                    }

                    if( !allowedExtensions.exec(files[i].name) ) {
                        files_invalid = true;
                        _this.find('.uploadedErr').fadeIn(500).append(`This file ( ${ files[i].name } ) has not allowed extension, allowed (jpg,jpeg,png,pdf)`);
                    }

                    if( !files_invalid ) {
                        _this.find('.uploadedErr').fadeOut(500).text('');

                        let data = new FormData();
                        data.append('action', 'fileupload');
                        data.append('file', files[i]);

                        $.ajax({
                            url: '/wp-admin/admin-ajax.php',
                            data: data,
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            dataType: "json",

                            beforeSend : function (){
                                $('.myContactForm').find('.cstSbmt').addClass('loading');
                            },

                            success: function (data) {
                                if (data.response == 'success') {
                                    files_send.push( data.filename );
                                    files_send_urls.push( data.url );
                                    ++successCount;
                                    if( successCount == files.length ) {
                                        sendToServer();
                                    }
                                } else {
                                    console.log(data.error);
                                }
                            },
                            error: function (xhr, status, error) {
                                var errorMessage = xhr.status + ': ' + xhr.statusText + '||' + error + '||' + status;
                                console.log( errorMessage )
                            }
                        });
                    }
                }
            } else {
                sendToServer();
            }

            function sendToServer() {
                var afterSubmit = true;
                files_send = files_send.join(',');
                data.append('client_files', files_send );

                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    data: data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    dataType: "json",

                    beforeSend : function (){
                        $('.myContactForm').find('.cstSbmt').addClass('loading');
                    },

                    success: function (data) {
                        if (data.response == 'success') {

                            if( files.length > 0 ) {
                                for (let i = 0; i < files_send_urls.length; i++) {
                                    var formDataDeleteFile = new FormData();
                                    formDataDeleteFile.append('action', 'filedelete');
                                    formDataDeleteFile.append('fileurl', files_send_urls[i]);

                                    $.ajax({
                                        url: '/wp-admin/admin-ajax.php',
                                        data: formDataDeleteFile,
                                        type: 'POST',
                                        contentType: false,
                                        processData: false,
                                        dataType: "json",

                                        success: function (data, textStatus, xhr) {
                                            if (data.response == 'SUCCESS') {
                                                console.log('File delete success');
                                            } else {
                                                console.log(data.error);
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            var errorMessage = xhr.status + ': ' + xhr.statusText + '||' + error + '||' + status;
                                            console.log( errorMessage )
                                        }
                                    });
                                }
                            }
                        } else {
                            console.log( data.error );
                        }

                        if( afterSubmit ) {
                            setTimeout(function(){
                                useAfterSubmitAction( afterSubmitAction, '.successMessage' , '');
                                $('.myContactForm').find('.cstSbmt').removeClass('loading');
                            }, 500);

                            setTimeout(function(){
                                window.location.reload();
                            }, 2500);
                        }
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText + '||' + error + '||' + status;
                        console.log( errorMessage );
                    }
                });
            }
        }
    } );

    function useAfterSubmitAction( action = '', blockForThanksMessage, redirectUrl = ''  ) {
        switch (action) {
            case "redirect":
                window.location.href = redirectUrl;
                break;

            case "show_message":
                $(blockForThanksMessage).fadeIn(500);
                break;
        }
    }
})
/*-- END --*/