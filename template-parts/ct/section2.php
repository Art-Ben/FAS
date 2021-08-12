<?php
$sect2_title = get_field('sect2_title');
$sect2_items = get_field('sect2_items');
?>

<section class="pageCashTrans_sect2">
    <div class="pageCashTrans_sect2--cont basic-container">
        <div class="column">
            <h2 class="pageCashTrans_sect2--title cstTitle">
                <?= $sect2_title; ?>
            </h2>
        </div>

        <?php
            if ( $sect2_items ) {
        ?>
        <div class="column">
            <div class="pageCashTrans_sect2--items">
                <?php
                    foreach ( $sect2_items as $item ) {
                ?>
                     <div class="item">
                         <span class="tit">
                            <?= $item['title']; ?>
                         </span>
                         <div class="desc">
                             <?= $item['content']; ?>
                         </div>
                     </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>
