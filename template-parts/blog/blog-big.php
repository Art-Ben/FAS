<?php
$post_title = get_the_title();
$post_desc = get_field('blog_short');
$post_url = get_the_permalink();
$post_thumb = get_field('blog_thumb');

switch ( pll_current_language() ) {
    case 'ru':
        $readMore = 'Читать полностью';
        break;

    case 'en':
        $readMore = 'Read more';
        break;

    case 'cs':
        $readMore = 'Čtěte více';
        break;
}
?>

<div class="pageBlog__post_item big">
    <?php
    if ( $post_thumb ) {
        ?>
        <div class="thumb">
            <div class="postDate"><?= get_the_date('F j' , get_the_ID() ); ?></div>
            <img src="<?= $post_thumb ;?>" alt="<?= $post_title; ?>">
        </div>
        <?php
    } else {
        echo '<div class="postDate relative">'. get_the_date('F j' , get_the_ID() ) .'</div>';
    }
    ?>

    <div class="infoGrp">
        <h3 class="tit">
            <?= $post_title; ?>
        </h3>

        <?= $post_desc ? '<div class="desc">'. $post_desc .'</div>' : ''; ?>

        <a href="<?= $post_url;?>" class="lnk cstBtn cstBtn_blue">
            <?= $readMore; ?>
        </a>
    </div>
</div>
