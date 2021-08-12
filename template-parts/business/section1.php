<?php
$title = get_field('sect1_title');
$items = get_field('sect1_items');
?>

<section class="pageHome_sect1">
    <div class="basic-container pageHome_sect1__cont">
        <div class="pageHome_sect1--card">
            <h2 class="cstTitle">
                <?= $title; ?>
            </h2>

            <div class="pageHome_sect1--items">
                <?php
                foreach ( $items as $item ) {
                    ?>
                    <div class="item">
                        <div class="icon">
                            <img src="<?= $item['icon']; ?>" alt="business" class="lazy-load">
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
    </div>
</section>