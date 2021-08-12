<?php
$sect1_title = get_field('sect1_title');
$sect1_items = get_field('sect1_items');
?>

<section class="pageCashTrans_sect1">
    <div class="pageCashTrans_sect1--cont basic-container">
        <h2 class="pageCashTrans_sect1--title cstTitle">
            <?= $sect1_title; ?>
        </h2>

        <?php
            if ( $sect1_items ) {
        ?>
            <div class="pageCashTrans_sect1--items">
                <?php
                    foreach ( $sect1_items as $item ) {
                ?>
                    <div class="item">
                        <div class="thumb">
                            <img src="<?= $item['icon']; ?>" alt="item">
                        </div>

                        <div class="desc">
                            <?= $item['text']; ?>
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
