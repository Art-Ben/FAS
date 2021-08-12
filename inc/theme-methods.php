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
        $headerLogoLink = is_front_page() ? 'javascript:void();' : get_home_url('/');

        $outputHtml.= '<a href="'. $headerLogoLink .'" class="headerLogoLink"><img class="headerLogoImg" src="'. $headerLogo .'" alt="FAS"></a>';

        return $outputHtml;
    }
}

if( !function_exists('renderHeaderMenuBtn') ) {
    function renderHeaderMenuBtn() {
        $outputHtml = '';
        $outputHtml.= '<button class="btnMenuToggle"><span class="line"></span><span class="line"></span><span class="line"></span></button>';
        return $outputHtml;
    }
}

if( !function_exists('renderHeaderMobileBtnToggler') ) {
    function renderHeaderMobileBtnToggler() {
        $outputHtml = '';
        $outputHtml.= '<button class="btnAddMenuToggle"></button>';
        return $outputHtml;
    }
}

if( !function_exists('renderFooterLogo') ) {
    function renderFooterLogo() {
        $outputHtml = '';
        $headerLogo = get_field('footerLogo', 'option');
        $headerLogoLink = is_front_page() ? 'javascript:void();' : get_home_url();

        $outputHtml.= '<a href="'. $headerLogoLink .'" class="footerLogoLink"><img class="footerLogoImg" src="'. $headerLogo .'" alt="FAS"></a>';

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
                            $outputHtml.= '<li class="headerNav__list--item hasDropMenu">';
                            $outputHtml.= '<div class="headerNav__link">'. $item->title .'<span class="arrow"></span></div>';
                                $outputHtml.='<div class="dropMenu">';

                                if ( get_field('sub_items', $item->ID) ) {
                                    foreach ( get_field('sub_items', $item ) as $subItem ) {
                                        $outputHtml.= '<a href="'. $subItem['link'] .'" class="dropMenu__link">'. $subItem['label'] .'</a>';
                                    }
                                }

                                $outputHtml.='</div>';
                            $outputHtml.='</li>';
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

if( !function_exists('renderFooterMenu') ) {
    function renderFooterMenu() {
        $menu_name = 'footer';
        $locations = get_nav_menu_locations();

        $outputHtml = '';

        if( $locations && isset( $locations[ $menu_name ] ) ){
            $menuItems = wp_get_nav_menu_items( $locations[ $menu_name ] );

            if( $menuItems ) {
                $outputHtml.= '<nav class="footerNav">';
                $outputHtml.= '<ul class="footerNav__list">';

                foreach ( (array) $menuItems as $itemArray => $item ) {
                    if( get_field('has_parent', $item->ID) ) {
                        $outputHtml.= '<li class="footerNav__list--item hasDropMenu">';
                            $outputHtml.= '<div class="footerNav__link">'. $item->title .'<span class="arrow"></span></div>';

                            $outputHtml.='<div class="dropMenu">';

                            if ( get_field('sub_items', $item->ID) ) {
                                foreach ( get_field('sub_items', $item ) as $subItem ) {
                                    $outputHtml.= '<a href="'. $subItem['link'] .'" class="dropMenu__link">'. $subItem['label'] .'</a>';
                                }
                            }

                            $outputHtml.='</div>';
                        $outputHtml.='</li>';
                    } else {
                        $outputHtml.= '<li class="footerNav__list--item"><a href="'. $item->url .'" class="footerNav__link">'. $item->title .'</a></li>';
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
        $langCodes = array('en' => 'English', 'cs' => 'Čeština');//array('en', 'cs', 'ru');
        $itemCurrent = array();
        $items = array();
        $currentPostTranslate = '';
        $itemClasses = '';
        $item = array();

        $outputHtml = '<div class="headerLangSwitch">';

            foreach ( $langCodes as $langCode => $langName ) {

                if( $langCode == $currentLang ) {
                    $itemClasses = 'current'.' '. $langCode;

                    $itemCurrent = array(
                        'classes' => $itemClasses,
                    );

                } else {
                    $currentPostTranslate = pll_get_post( $currentPageID, $langCode );

                    if( $currentPostTranslate ) {
                        $itemLink = get_the_permalink( $currentPostTranslate );
                        $itemClasses = $langCode;

                    } else {
                        $itemLink ='javascript:void(0);';
                        $itemClasses = 'disable '.$langCode;
                    }

                    $item = array(
                        'classes' => $itemClasses,
                        'link' => $itemLink,
                        'name' => $langName
                    );

                    array_push( $items,  $item);
                }
            }

            $outputHtml.= '<div class="headerLangSwitch__cont"><span class="headerLangSwitch__flag '. $itemCurrent['classes'] .'"></span><span class="arrow"></span></div>';

            $outputHtml.= '<div class="headerLangSwitch__drop">';

                foreach ( $items as $langItem ) {
                    $outputHtml.= '<a class="headerLangSwitch__flag--cont" href="'. $langItem['link']  .'"><span class="headerLangSwitch__flag '. $langItem['classes'] .'"></span>'. $langItem['name'] .'</a>';
                }

            $outputHtml.= '</div>';

        $outputHtml.= '</div>';

        return $outputHtml;
    }
}

if( !function_exists('renderFooterLangs') ) {
    function renderFooterLangs() {
        $currentPageID = get_the_ID();
        $currentLang = pll_current_language();
        $langCodes = array('en' => 'English', 'cs' => 'Čeština');//array('en', 'cs', 'ru');
        $itemCurrent = array();
        $items = array();
        $currentPostTranslate = '';
        $itemClasses = '';
        $item = array();

        $outputHtml = '<div class="footerLangSwitch">';

        foreach ( $langCodes as $langCode => $langName ) {

            if( $langCode == $currentLang ) {
                $itemClasses = 'current'.' '. $langCode;

                $itemCurrent = array(
                    'classes' => $itemClasses,
                );

            } else {
                $currentPostTranslate = pll_get_post( $currentPageID, $langCode );

                if( $currentPostTranslate ) {
                    $itemLink = get_the_permalink( $currentPostTranslate );
                    $itemClasses = $langCode;
                } else {
                    $itemLink ='javascript:void(0);';
                    $itemClasses = 'disable '.$langCode;
                }

                $item = array(
                    'classes' => $itemClasses,
                    'link' => $itemLink,
                    'name' => $langName
                );

                array_push( $items,  $item);
            }
        }

        $outputHtml.= '<div class="footerLangSwitch__cont"><span class="footerLangSwitch__flag '. $itemCurrent['classes'] .'"></span><span class="arrow"></span></div>';

        $outputHtml.= '<div class="footerLangSwitch__drop">';

        foreach ( $items as $langItem ) {
            $outputHtml.= '<a class="footerLangSwitch__flag--cont" href="'. $langItem['link']  .'"><span class="footerLangSwitch__flag '. $langItem['classes'] .'"></span>'. $langItem['name'] .'</a>';
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

        $outputHtml.= '<a href="'. $btnLink .'" class="headerAccBtn">'. $btnText .'</a>';

        return $outputHtml;
    }
}
if( !function_exists('renderHeaderMobileBtns') ) {
    function renderHeaderMobileBtns() {
        $outputHtml = '';

        $outputHtml.= renderHeaderLogin();
        $outputHtml.= renderHeaderBtn();

        return $outputHtml;
    }
}

if( !function_exists('renderPostsPagination') ) {
    function renderPostsPagination( $custom_query = null, $sortArgs = null ) {
        global  $wp_query;
        $big = 999999999;
        $outputHtml = '';
        $paginationArgs = array(
            'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'current' => max( 1, get_query_var('paged') ),
            'show_all' => true,
            'prev_next' => false,
            'type' => 'array',
            'before_page_number' => '',
            'after_page_number' => ''
        );

        if ( $custom_query ) {
            $paginationArgs['total'] = $custom_query->max_num_pages;
        } else {
            $paginationArgs['total'] = $wp_query->max_num_pages;
        }

        if ( $sortArgs  ) {
            $paginationArgs['add_args'] = $sortArgs;
        }

        $pagination = paginate_links( $paginationArgs );

        if ( !is_null( $pagination ) ) {
            $outputHtml.= '<div class="pageBlog__pagination">';
            foreach ( $pagination as $pagItem ) {
                $outputHtml.= '<div class="pagItem">';
                $outputHtml.= $pagItem;
                $outputHtml.= '</div>';
            }
            $outputHtml.= '</div>';
        }

        return $outputHtml;
    }
}
