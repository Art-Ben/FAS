<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FAS
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/<?= get_template_directory_uri(); ?>/dist/images/faviconapple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= get_template_directory_uri(); ?>/dist/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= get_template_directory_uri(); ?>/dist/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= get_template_directory_uri(); ?>/dist/images/favicon/favicon.ico" type="image/x-icon">

	<?php wp_head(); ?>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body <?php body_class( get_field('page_css_classes') ); ?>>
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="header__cont basic-container">
            <?php
                echo renderHeaderLogo();

                echo renderHeaderMenu();

                echo renderHeaderMenuBtn();

                echo renderHeaderLangs();

                echo renderHeaderMobileBtnToggler();

                echo renderHeaderLogin();

                echo renderHeaderBtn();
            ?>
        </div>

        <div class="header__mobileMenu">
            <?php
                echo renderHeaderMenu();
            ?>
        </div>

        <div class="header__mobileBtns">
            <?php
                echo renderHeaderMobileBtns();
            ?>
        </div>
    </header>
