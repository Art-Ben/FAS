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
    /*-- Footer gMap --*/
    if( $('.acf-map') || $('.acf-map').length > 0 ) {
        $('.acf-map').each(function () {
            var map = initMap($(this));
        });
    }
    /*-- END --*/

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
                    bottom: 0,
                    display: 'none'
                },
                {
                    opacity: 1,
                    bottom: 'calc(-200% - 10px)',
                    display: 'flex',
                    duration: .6,
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 1,
                    bottom: 'calc(-200% - 10px)',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    bottom: 0,
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
                    bottom: 0,
                    display: 'none'
                },
                {
                    opacity: 1,
                    bottom: 'calc(-200% - 10px)',
                    display: 'flex',
                    duration: .6,
                }
            );
        } else {
            $(this).removeClass('open');

            gsap.fromTo(dropMenu,
                {
                    opacity: 1,
                    bottom: 'calc(-200% - 10px)',
                    display: 'flex'
                },
                {
                    opacity: 0,
                    bottom: 0,
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
});