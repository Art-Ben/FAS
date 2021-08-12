<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FAS
 */
get_header();

switch ( pll_current_language() ) {
    case 'ru':
        $allNews = 'Ко всем новостям';
        $publishOn = 'Опубликовано';
        $share = 'Поделиться: ';
        break;

    case 'en':
        $allNews = 'Back to all news';
        $publishOn = 'Publish on';
        $share = 'Share: ';
        break;

    case 'cs':
        $allNews = 'Zpět na všechny novinky';
        $publishOn = 'Zveřejnit na';
        $share = 'Sdílet: ';
        break;
}

$post_thumb = get_field('blog_thumb');
?>
    <section class="pageBlog__single">
        <div class="headerBg"></div>

        <?php
            if ( $post_thumb ) {
        ?>
            <div class="pageBlog__single--thumb">
                <img src="<?= $post_thumb; ?>" alt="<?= get_the_title(); ?>">
            </div>
        <?php
            }
        ?>

        <div class="basic-container pageBlog__single--cont">
            <div class="pageBlog__single--header">
                <div class="dateGrp">
                     <?= $publishOn. ' ' .get_the_date('M j, Y' , get_the_ID() ); ?>
                </div>

                <div class="shareGrp">
                    <span class="lbl">
                        <?= $share; ?>
                    </span>
                    <a href="https://www.facebook.com/sharer/sharer.php?title=<?= get_the_title(); ?>&u=<?= get_the_permalink(); ?>" class="shareLink fb"></a>
                    <a href=https://telegram.me/share/url?url=<?= get_the_permalink(); ?>&text=<?= get_the_title(); ?>" class="shareLink telega"></a>
                </div>
            </div>

            <div class="pageBlog__single--content">
                <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();

                            echo '<h1 class="title">'. get_the_title() .'</h1>';

                            the_content();
                        }
                    }
                ?>
            </div>

            <div class="pageBlog__single--all">
                <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>" class="cstBtn cstBtn_blue">
                    <?=  $allNews; ?>
                </a>
            </div>
        </div>

        <?php get_template_part('template-parts/blog/newsletter'); ?>
    </section>
<?php
get_footer();
