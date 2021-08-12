<?php

$title = get_field('sect6_title');
$items = get_field('sect6_items');
?>

<section class="pageOnlineMoneyTransfer_sect3">
    <div class="basic-container pageOnlineMoneyTransfer_sect3__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="pageOnlineMoneyTransfer_sect3--items">
            <?php
            foreach ( $items as $item ) {
                ?>
                <div class="item">
                    <div class="content">
                        <div class="icon">
                            <img src="<?= $item['icon']; ?>" alt="<?= $item['title']; ?>">
                        </div>

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
    </div>
</section>