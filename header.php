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

	<?php wp_head(); ?>
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
