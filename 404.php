<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FAS
 */

get_header();
?>

	<section class="page404">
        <div class="page404__cont basic-container">
            <div class="page404--big">
                404
            </div>
            <div class="page404--desc">
                <?= get_field('404_desc', 'options'); ?>
            </div>
            <div class="page404--btnLine">
                <a href="<?= get_home_url(); ?>" class="lnk pageTitle_specialbtn">
                    <?= get_field('404_btn', 'options'); ?>
                </a>
            </div>
        </div>
    </section>

<?php
get_footer();
