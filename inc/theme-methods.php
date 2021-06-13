<?php
if( !function_exists('registerHeaderMenu') ) {
    add_action( 'after_setup_theme', 'registerHeaderMenu' );
    function registerHeaderMenu() {
        register_nav_menu( 'header', 'Header Menu' );
    }
}

if( !function_exists('registerFooterMenu') ) {
    add_action( 'after_setup_theme', 'registerFooterMenu' );
    function registerFooterMenu() {
        register_nav_menu( 'footer', 'Footer Menu' );
    }
}

if( !function_exists('renderHeaderLogo') ) {
    function renderHeaderLogo() {
        $outputHtml = '';
        $headerLogo = get_field('headerLogo', 'option');
        $headerLogoLink = is_front_page() ? 'javascript:void();' : get_home_url();

        $outputHtml.= '<a href="'. $headerLogoLink .'" class="headerLogoLink"><img class="headerLogoImg" src="'. $headerLogo .'" alt="FAS"></a>';

        return $outputHtml;
    }
}

if( !function_exists('renderHeaderMenu') ) {
    function renderHeaderMenu() {
        $menu_name = 'header';
        $locations = get_nav_menu_locations();

        $outputHtml = '';

        if( $locations && isset( $locations[ $menu_name ] ) ){
            $menuItems = wp_get_nav_menu_items( $locations[ $menu_name ] );

            if( $menuItems ) {
                $outputHtml.= '<nav class="headerNav">';
                    $outputHtml.= '<ul class="headerNav__list">';

                    foreach ( (array) $menuItems as $itemArray => $item ) {
                        if( get_field('has_parent', $item->ID) ) {
                            $outputHtml.= '<li class="headerNav__list--item"><a href="'. $item->url .'" class="headerNav__link">'. $item->title .'</a><li>';
                        } else {
                            $outputHtml.= '<li class="headerNav__list--item"><a href="'. $item->url .'" class="headerNav__link">'. $item->title .'</a></li>';
                        }
                    }

                    $outputHtml.= '</ul>';
                $outputHtml.= '</nav>';
            }

            return $outputHtml;
        }
    }
}

if( !function_exists('renderHeaderLangs') ) {
    function renderHeaderLangs() {
        $currentPageID = get_the_ID();
        $currentLang = pll_current_language();
        $langCodes = array('en', 'cs', 'ru');
        $itemCurrent = array();
        $items = array();
        $currentPostTranslate = '';
        $itemClasses = '';
        $item = array();

        $outputHtml = '<div class="headerLangSwitch">';

            foreach ( $langCodes as $lang ) {

                if( $lang == $currentLang ) {
                    $itemClasses = 'current'.' '. $lang;

                    $itemCurrent = array(
                        'classes' => $itemClasses,
                    );

                } else {
                    $currentPostTranslate = pll_get_post( $currentPageID, $lang );

                    if( $currentPostTranslate ) {
                        $itemLink = get_the_permalink( $currentPostTranslate );
                        $itemClasses = $lang;

                    } else {
                        $itemLink ='javascript:void(0);';
                        $itemClasses = 'disable '.$lang;
                    }

                    $item = array(
                        'classes' => $itemClasses,
                        'link' => $itemLink,
                    );

                    array_push( $items,  $item);
                }
            }

            $outputHtml.= '<span class="headerLangSwitch__flag '. $itemCurrent['classes'] .'"></span>';

            $outputHtml.= '<div class="headerLangSwitch__drop">';

                foreach ( $items as $langItem ) {
                    $outputHtml.= '<a href="'. $langItem['link']  .'" class="headerLangSwitch__flag '. $langItem['classes'] .'"></a>';
                }

            $outputHtml.= '</div>';

        $outputHtml.= '</div>';

        return $outputHtml;
    }
}

if( !function_exists('renderHeaderLogin') ) {
    function renderHeaderLogin() {
        $outputHtml = '';

        $loginLink = get_field('headerLoginBtn','option');

        $loginText = get_field('headerLoginBtnTxt', 'option');

        $outputHtml.= '<a href="'. $loginLink .'" class="headerLoginBtn">'. $loginText .'</a>';
        
        return $outputHtml;
    }
}

if( !function_exists('renderHeaderBtn') ) {
    function renderHeaderBtn() {
        $outputHtml = '';

        $btnLink = get_field('headerBtn', 'option');
        $btnText = get_field('headerBtnTxt', 'option');

        $outputHtml.= '<a href="'. $btnLink .'" class="headerLoginBtn">'. $btnText .'</a>';

        return $outputHtml;
    }
}