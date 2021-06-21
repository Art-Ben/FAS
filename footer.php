<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FAS
 */

?>

        <footer class="footer">
            <div class="footer__cont basic-container">
                <div class="footer__column">
                    <?= renderFooterLogo(); ?>
                    <span class="footerSmallText">
                        <?= get_field('footer_small', 'option'); ?>
                    </span>
                </div>
                <div class="footer__column">
                    <?= renderFooterMenu(); ?>
                </div>
                <div class="footer__column">
                    <?php
                        if ( get_field('footer_links_items', 'option') ) {
                    ?>
                        <div class="footerLinks">
                            <?php
                                foreach ( get_field('footer_links_items', 'option') as $footerLink ) {
                                    echo '<a href="'. $footerLink['link'] .'" class="footerLinks__link">'. $footerLink['label'] .'</a>';
                                }
                            ?>
                        </div>
                    <?php
                        }
                    ?>

                    <div class="footerCopy">
                        <span class="copyright">
                            <?= get_field('footer_copy', 'option').' '. date('Y'); ?>
                        </span>

                        <?= renderFooterLangs(); ?>
                    </div>
                </div>
            </div>
        </footer>

    <?php wp_footer(); ?>

    </body>
</html>
