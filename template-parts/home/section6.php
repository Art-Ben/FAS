<?php

$title = get_field('six_title');
$desc = get_field('six_desc');
$items = get_field('six_items');
?>

<section class="pageHome_sect6">
    <div class="basic-container pageHome_sect6__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="cstDesc">
            <?= $desc; ?>
        </div>

        <div class="pageHome_sect6--items">
            <?php
            foreach ( $items as $item ) {
                ?>
                <div class="item">
                    <div class="icon">
                        <img src="<?= $item['icon']; ?>" alt="<?= $item['text']; ?>">
                    </div>
                    <div class="content">
                        <span class="title">
                            <?= $item['title']; ?>
                        </span>
                        <?= $item['text']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
