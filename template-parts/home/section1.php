<?php

$title = get_field('first_title');
$desc = get_field('first_desc');
$items = get_field('first_items');

$btn_lnk = get_field('first_btn_link');
$btn_txt = get_field('first_btn_text');
?>

<section class="pageHome_sect1">
    <div class="basic-container pageHome_sect1__cont">
        <div class="pageHome_sect1--card">
            <h2 class="cstTitle cstTitle_blue">
                <?= $title; ?>
            </h2>

            <div class="cstDesc cstDesc_grey">
                <?= $desc; ?>
            </div>

            <div class="pageHome_sect1--items">
                <?php
                    foreach ( $items as $item ) {
                ?>
                <div class="item">
                    <div class="icon">
                        <img src="<?= $item['icon']; ?>" alt="<?= $item['text']; ?>">
                    </div>
                    <div class="content">
                        <?= $item['text']; ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <?php
            if ( $btn_lnk && $btn_txt ) {
        ?>
        <div class="pageHome_sect1--btns">
            <a href="<?= $btn_lnk; ?>" class="cstBtn cstBtn_blue"><?= $btn_txt; ?></a>
        </div>
        <?php
            }
        ?>
    </div>
</section>
