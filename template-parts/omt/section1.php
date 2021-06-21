<?php

$title = get_field('sect1_title');
$desc = get_field('sect1_desc');
$items = get_field('sect1_items');
?>

<section class="pageOnlineMoneyTransfer_sect1">
    <div class="basic-container pageOnlineMoneyTransfer_sect1__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="pageOnlineMoneyTransfer_sect1--items">
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
</section>
