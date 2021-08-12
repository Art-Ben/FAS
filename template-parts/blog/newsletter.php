<?php
$newsletter_title = get_field('news_title', 'options');
$newsletter_desc = get_field('news_desc', 'options');

switch ( pll_current_language() ) {
    case 'ru':
        $readMore = 'Введите свой Email';
        break;

    case 'en':
        $readMore = 'Enter your email';
        break;

    case 'cs':
        $readMore = 'Zadejte svůj e-mail';
        break;
}
?>

<div class="pageBlog__newsletter">
    <div class="pageBlog__newsletter--cont basic-container">
        <h2 class="pageBlog__newsletter--title">
            <?= $newsletter_title ; ?>
        </h2>

        <?php
            if ( $newsletter_desc ) {
                echo '<div class="pageBlog__newsletter--desc">'. $newsletter_desc .'</div>';
            }
        ?>

        <form method="post" action="javascript:void(0);" class="pageBlog__newsletter--form">
            <input type="text" class="inpt" id="email" name="email" placeholder="<?= $readMore; ?>">
            <button class="sbmt" type="submit"></button>
        </form>
    </div>
</div>
