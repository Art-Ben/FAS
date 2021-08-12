<?php
$column_left = get_field('sect4_column_send');
$column_right= get_field('sect4_column_receive');
?>

<section class="pageCashTrans_sect4">
    <div class="pageCashTrans_sect4--cont basic-container">
        <?php
            if ( $column_left ) {
        ?>
            <div class="pageCashTrans_sect4--column columnSend">
                <h2 class="pageCashTrans_sect4--title">
                    <?= $column_left['title']; ?>
                </h2>

                <div class="pageCashTrans_sect4--items">
                    <?php
                        if ( $column_left['items'] ) {
                            foreach ( $column_left['items'] as $item ) {
                    ?>
                        <div class="item">
                            <?= $item['text']; ?>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>

        <?php
            if ( $column_right ) {
        ?>
            <div class="pageCashTrans_sect4--column columnReceive">
                <h2 class="pageCashTrans_sect4--title">
                    <?= $column_right['title']; ?>
                </h2>

                <div class="pageCashTrans_sect4--items">
                    <?php
                    if ( $column_right['items'] ) {
                        foreach ( $column_right['items'] as $item ) {
                            ?>
                            <div class="item">
                                <?= $item['text']; ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</section>