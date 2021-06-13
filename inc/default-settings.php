<?php
/**
 * FAS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FAS
 */
if ( ! function_exists( 'fas_setup' ) ) :
    function fas_setup() {
        load_theme_textdomain( 'fas', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support(
            'custom-background',
            apply_filters(
                'fas_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action( 'after_setup_theme', 'fas_setup' );

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';