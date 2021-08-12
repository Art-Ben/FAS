<?php
get_header();

$blog_small = get_field('blog_small', 'options');
$blog_title = get_field('blog_title', 'options');

switch ( pll_current_language() ) {
    case 'ru':
        $searchInpt = 'Поиск по блогу...';
        $sort = 'Сортировка';
        $sortTitleASC = 'По названию А-Я';
        $sortTitleDesc = 'По названию Я-А';
        $sortDateASC = 'Самые новые';
        $sortDateDesc = 'Самые старые';
        $sortMenuOrder = 'В порядке меню';
        break;

    case 'en':
        $searchInpt = 'Search in blog...';
        $sort = 'SORT';
        $sortTitleASC = 'Title A-Z';
        $sortTitleDesc = 'Title Z-A';
        $sortDateASC = 'Latest';
        $sortDateDesc = 'Oldest';
        $sortMenuOrder = 'Menu order';
        break;

    case 'cs':
        $searchInpt = 'Vyhledávání na blogu...';
        $sort = 'Třídění';
        $sortTitleASC = 'Podle názvu A-Z';
        $sortTitleDesc = 'Podle názvu Z-A';
        $sortDateASC = 'Nejnovější';
        $sortDateDesc = 'Nejstarší';
        $sortMenuOrder = 'V pořadí nabídky';
        break;
}

$orderParameters = array(
    'title-asc' => $sortTitleASC,
    'title-desc' => $sortTitleDesc,
    'date-asc' => $sortDateASC,
    'date-desc' => $sortDateDesc,
    'menu_order' => $sortMenuOrder
);

$blogSpecialsArgs = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'ignore_sticky_posts' => true,
    'meta_query' => array(
        array(
            'key' => 'blog_special',
            'value' => '1',
            'compare' => '=='
        )
    )
);

$blogSpecialsQuery = new WP_Query( $blogSpecialsArgs );
?>

<section class="pageBlog">
    <div class="pageBlog__header">
        <div class="pageBlog__cont basic-container">
            <div class="pageBlog__info">
                <div class="pageBlog__info--small">
                    <?= $blog_small; ?>
                </div>
                <h1 class="pageBlog__info--title">
                    <?= $blog_title; ?>
                </h1>

                <div class="pageBlog__search">
                    <form  role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" class="pageBlog__search--form">
                        <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="inpt" placeholder="<?= $searchInpt; ?>">
                        <button class="sbmt" type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php
        if ( $blogSpecialsQuery->have_posts() ) {
    ?>
    <div class="pageBlog__posts--special">
        <div class="basic-container">
            <?php
                while ( $blogSpecialsQuery->have_posts() ) {
                    $blogSpecialsQuery->the_post();
                    get_template_part('template-parts/blog/blog-big');
                }
            ?>
        </div>
    </div>
    <?php
        }
        wp_reset_postdata();
    ?>

    <div class="pageBlog__sort">
        <div class="basic-container">
            <div class="pageBlog__sort--drops">
                <span class="label">
                    <?= $sort; ?>
                </span>

                <div class="dropsCont">
                    <?php
                        if ( $_GET['blog_order'] ) {
                            foreach ( $orderParameters as $param => $value ) {
                                if( $param == $_GET['blog_order'] ) {
                                    echo '<span class="defaultItem">'. $value .'</span>';
                                }
                            }

                            echo '<div class="hiddenItems">';
                                foreach ( $orderParameters as $param => $value ) {
                                    if( $param != $_GET['blog_order'] ) {
                                        echo '<a href="'. get_permalink(get_option('page_for_posts')) .'/?blog_order='. $param .'" class="lnk">'. $value .'</a>';
                                    }
                                }
                            echo '</div>';
                        } else {
                    ?>
                        <span class="defaultItem"><?= $sortDateASC; ?></span>
                        <div class="hiddenItems">
                            <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>?blog_order=date-desc" class="lnk"><?= $sortDateDesc; ?></a>
                            <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>?blog_order=title-asc" class="lnk"><?= $sortTitleASC; ?></a>
                            <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>?blog_order=title-desc" class="lnk"><?= $sortTitleDesc; ?></a>
                            <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>?blog_order=menu_order" class="lnk"><?= $sortMenuOrder; ?></a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="pageBlog__posts">
        <div class="basic-container">
            <?php
            if ( $_GET['blog_order'] ) {
                $order = $_GET['blog_order'];

                $sortQueryArgs = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                );

                $sortArgs = array();

                switch ( $order ) {
                    case 'title-asc':
                        $sortQueryArgs['order'] = 'DESC';
                        $sortQueryArgs['orderby'] = 'title';
                        $sortArgs['blog_order'] = 'title-asc';
                    break;

                    case 'title-desc':
                        $sortQueryArgs['order'] = 'ASC';
                        $sortQueryArgs['orderby'] = 'title';
                        $sortArgs['blog_order'] = 'title-desc';
                    break;

                    case 'date-asc':
                        $sortQueryArgs['order'] = 'DESC';
                        $sortQueryArgs['orderby'] = 'date';
                        $sortArgs['blog_order'] = 'date-asc';
                    break;

                    case 'date-desc':
                        $sortQueryArgs['order'] = 'ASC';
                        $sortQueryArgs['orderby'] = 'date';
                        $sortArgs['blog_order'] = 'date-desc';
                    break;

                    case 'menu_order':
                        $sortQueryArgs['orderby'] = 'menu_order';
                        $sortArgs['blog_order'] = 'menu_order';
                    break;
                }

                $sortQuery = new WP_Query( $sortQueryArgs );

                if( $sortQuery->have_posts() ) {
                    echo '<div class="pageBlog__posts--items">';

                    while ( $sortQuery->have_posts() ) {
                        $sortQuery->the_post();
                        get_template_part('template-parts/blog/blog-small');
                    }
                    echo '</div>';

                    echo renderPostsPagination( $sortQuery,  $sortArgs );
                }
            } else {
                if( have_posts() ) {
                    echo '<div class="pageBlog__posts--items">';
                    while ( have_posts() ) {
                        the_post();
                        get_template_part('template-parts/blog/blog-small');
                    }
                    echo '</div>';

                    echo renderPostsPagination();
                }
            }
            ?>
        </div>
    </div>

    <?php get_template_part('template-parts/blog/newsletter'); ?>
</section>
<?php
get_footer();