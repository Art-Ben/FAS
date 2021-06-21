<?php

$title = get_field('third_title');
$desc = get_field('third_desc');
$items = get_field('third_items');
$items_title = get_field('third_items_title');
$items_smalltitle = get_field('third_items_smalltitle');

$btn_lnk = get_field('third_btn_link');
$btn_txt = get_field('third_btn_text');
?>

<section class="pageHome_sect3">
    <div class="basic-container pageHome_sect3__cont">
        <h2 class="cstTitle cstTitle_blue">
            <?= $title; ?>
        </h2>

        <div class="cstDesc cstDesc_grey">
            <?= $desc; ?>
        </div>

        <h3 class="pageHome_sect3--items--title">
            <?= $items_title; ?>
        </h3>

        <div class="pageHome_sect3--items">
        <?php
                $counter = 0;
                foreach ( $items as $item ) {
                    $counter++;
        ?>
                <div class="item item_<?= $counter; ?>">
                    <div class="icon">
                        <img src="<?= $item['icon']; ?>" alt="<?= $item['text']; ?>">
                    </div>
                    <div class="content">
                        <span class="decor" style="background: <?= $item['color']; ?>">
                            <?= $item['text']; ?>
                        </span>
                    </div>
                </div>
        <?php
            }
        ?>

        </div>

        <div class="pageHome_sect3--items--small">
            <?= $items_smalltitle; ?>
        </div>

        <?php
        if ( $btn_lnk && $btn_txt ) {
            ?>
            <div class="pageHome_sect3--btns">
                <a href="<?= $btn_lnk; ?>" class="cstBtn cstBtn_blue"><?= $btn_txt; ?></a>
            </div>
        <?php
        }
        ?>
    </div>
</section>
