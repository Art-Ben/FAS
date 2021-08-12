<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package FAS
 */
switch ( pll_current_language() ) {
    case 'ru':
        $searchTitle = 'Результатыт поиска для: ';

        break;

    case 'en':
        $searchTitle = 'Search results for: ';

        break;

    case 'cs':
        $searchTitle = 'Výsledky hledání pro: ';
        break;
}
get_header();
?>
    <section class="pageBlog">
        <div class="pageBlog__header">
            <div class="pageBlog__cont basic-container">
                <div class="pageBlog__info">
                    <h1 class="pageBlog__info--title">
                        <?= $searchTitle; ?> <span style="color:#2550E5;font-weight: 700; padding: 5px 25px; background: #fff; border-radius: 10px"> <?= get_search_query(); ?> </span>
                    </h1>
                </div>
            </div>
        </div>
        <?php if ( have_posts() ) { ?>
        <div class="pageBlog__posts">
            <div class="basic-container">
                <div class="pageBlog__posts--items" style="margin: 50px 0;">
                <?php
                    /* Start the Loop */
                    while ( have_posts() ) {


                        the_post();

                        get_template_part('template-parts/blog/blog-small');
                    }

                    echo renderPostsPagination();
                ?>
                </div>
            </div>
        </div>
        <?php
            } else {

            echo '<div class="pageBlog__empty">'. get_field('empty_blog', 'options') .'</div>';
        }
        ?>
    </section>
<?php
get_footer();
