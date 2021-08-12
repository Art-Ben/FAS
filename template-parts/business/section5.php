<?php

$title = get_field('sect5_title');
$desc = get_field('sect5_desc');
$items = get_field('sect5_items');
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
