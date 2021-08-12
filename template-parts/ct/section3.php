<?php
    $sect3_title = get_field('sect3_title');
    $sect3_items = get_field('sect3_items');
?>

<section class="pageCashTrans_sect3">
    <div class="pageCashTrans_sect3--cont basic-container">
        <h2 class="pageCashTrans_sect3--title cstTitle">
            <?= $sect3_title; ?>
        </h2>

        <?php
        if ( $sect3_items ) {
            ?>
            <div class="pageCashTrans_sect3--items">
                <?php
                foreach ( $sect3_items as $item ) {
                    ?>
                    <div class="item">
                         <div class="logo">
                             <img src=" <?= $item['logo']; ?>" alt="">
                         </div>
                        <div class="name">
                            <?= $item['name']; ?>
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
