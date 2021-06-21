<?php
    $title = get_field('sect1_title');
    $items = get_field('sect1_items');
?>

<section class="pageBecomeAnAgent_sect1">
    <div class="basic-container pageBecomeAnAgent_sect1__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="pageBecomeAnAgent_sect1--items">
            <?php
            foreach ( $items as $item ) {
                $bg = $item['color_block'];
                $color_title = $item['color_title'];
            ?>
                <div class="item" style="background: <?= $bg; ?>">
                    <div class="icon">
                        <img src="<?= $item['icon']; ?>" alt="<?= $item['text']; ?>">
                    </div>

                    <span class="title" style="color: <?= $color_title; ?>">
                        <?= $item['title']; ?>
                    </span>

                    <div class="content">
                        <?= $item['desc']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>


