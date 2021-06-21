<?php

$title = get_field('second_title');
$desc = get_field('second_desc');
$items = get_field('second_items');

$btn_lnk = get_field('second_btn_link');
$btn_txt = get_field('second_btn_text');
?>

<section class="pageHome_sect2">
    <div class="basic-container pageHome_sect2__cont">
        <h2 class="cstTitle cstTitle_blue">
            <?= $title; ?>
        </h2>

        <div class="cstDesc">
            <?= $desc; ?>
        </div>

        <div class="pageHome_sect2--items">
            <?php
            foreach ( $items as $item ) {
                ?>
                <div class="item" style="background:<?= $item['color']; ?>">
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

        <?php
            if ( $btn_lnk && $btn_txt ) {
                ?>
                <div class="pageHome_sect2--btns">
                    <a href="<?= $btn_lnk; ?>" class="cstBtn cstBtn_blue"><?= $btn_txt; ?></a>
                </div>
                <?php
            }
        ?>
    </div>
</section>
