<?php
$title = get_field('sect4_title');
$items = get_field('sect4_items');
?>

<section class="pageBecomeAnAgent_sect4">
    <div class="basic-container pageBecomeAnAgent_sect4__cont">
        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <?php
        if ( $items ) {
            ?>
            <div class="pageBecomeAnAgent_sect4__items">
                <?php
                    foreach ( $items as $item ) {
                ?>
                    <div class="item">
                        <div class="content">
                            <?= $item['text']; ?>
                        </div>
                        <div class="icon">
                            <img src="<?= $item['icon']; ?>" alt="">
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</section>


