<?php
if( function_exists('acf_add_options_page') ) {
    $acfSettingsPage = '';

    switch ( pll_current_language() ) {
        case 'ru':
            $acfSettingsPage = 'Дополнительные настройки сайта';
        break;

        case 'en':
            $acfSettingsPage = 'Additional Theme Settings';
        break;

        case 'cs':
            $acfSettingsPage = 'Další nastavení webu';
        break;
    }

    acf_add_options_page(array(
        'page_title' 	=> $acfSettingsPage,
        'menu_title'	=> $acfSettingsPage,
        'menu_slug' 	=> 'option',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    function my_acf_google_map_api( $api ){
        $api['key'] = 'AIzaSyALRpSOsAHc6NbSvk8Dgs0mrpSIr_yJSvQ';
        return $api;
    }
    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
}
