<?php

$title = get_field('fifth_title');
$desc = get_field('fifth_desc');
$items = get_field('fifth_items');
?>

<section class="pageHome_sect5">
    <div class="basic-container pageHome_sect5__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="cstDesc">
            <?= $desc; ?>
        </div>

        <div class="pageHome_sect5--items">
            <?php
            foreach ( $items as $item ) {
            ?>
                <div class="item">
                    <div class="icon">
                        <img src="<?= $item['icon']; ?>" alt="<?= $item['text']; ?>">
                    </div>
                    <div class="content">
                        <span class="decor">
                            <?= $item['text']; ?>
                        </span>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</section>
