<?php

$title = get_field('sect2_title');
$desc = get_field('sect2_desc');
$items = get_field('sect2_items');

$btn_lnk = get_field('sect2_btn_link');
$btn_txt = get_field('sect2_btn_txt');
?>

<section class="pageOnlineMoneyTransfer_sect2">
    <div class="basic-container pageOnlineMoneyTransfer_sect2__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="pageOnlineMoneyTransfer_sect2--items">
            <?php
            foreach ( $items as $item ) {
                ?>
                <div class="item">
                    <div class="content">
                        <span class="title">
                            <?= $item['title']; ?>
                        </span>

                        <?= $item['desc']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
        if ( $btn_lnk && $btn_txt ) {
            ?>
            <div class="pageOnlineMoneyTransfer_sect2--btns">
                <a href="<?= $btn_lnk; ?>" class="cstBtn cstBtn_blue"><?= $btn_txt; ?></a>
            </div>
            <?php
        }
        ?>
    </div>
</section>
