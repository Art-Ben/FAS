<?php
$title = get_field('sect3_title');
$items = get_field('sect3_items');
?>

<section class="pageBecomeAnAgent_sect3">
    <div class="basic-container pageBecomeAnAgent_sect3__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <?php
            if ( $items ) {
        ?>
        <div class="pageBecomeAnAgent_sect3__items">
            <?php
                $counter = 0;
                foreach ( $items as $item ) {
                    $counter++;
            ?>
            <div class="item" id="item<?= $counter; ?>">
                <?= $item['content']; ?>
            </div>
            <style>
                #item<?= $counter;?> {
                    background-image: <?= $item['border']; ?>
                }
            </style>
            <?php
                }
            ?>
        </div>
        <?php
            }
        ?>
    </div>
</section>


