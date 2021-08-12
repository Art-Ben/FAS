<?php
$sect_table_btn = get_field('cttable_btn');
?>

<section class="pageCashTrans_secttable">
    <div class="pageCashTrans_secttable--cont basic-container">

<?php
$table_cash = get_field('table_cash', 'option');
if ( $table_cash ) {
    ?>
    <div class="pagePricing__tableTabs--items__tab is-selected">
        <?php
        if ( $table_cash['title'] ) {
            echo '<h2 class="item__title">'. $table_cash['title'] .'</h2>';
        }
        ?>

        <?php
        if ( $table_cash['desc'] ) {
            echo '<div class="item__desc">'. $table_cash['desc'] .'</div>';
        }
        ?>

        <?php
        if ( $table_cash['special_blocks'] ) {
            echo '<div class="item__specials">';
            foreach ( $table_cash['special_blocks'] as $specialItem ) {
                echo '<div class="item__specials--single">';
                echo '<span class="item__specials--tit">'. $specialItem['title'] .'</span>';
                echo '<div class="desc">'. $specialItem['desc'] .'</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>

        <?php
        if ( $table_cash['special_legend']['items'] ) {
            echo '<div class="item__docs">';
            echo '<span class="label">' . $table_cash['special_legend']['title'] . '</span>';

            if ( $table_cash['special_legend']['items'] ) {
                foreach ( $table_cash['special_legend']['items'] as $item ) {
                    echo '<div class="legendItem">';
                    echo '<span class="legendItem__drop">' . $item['placeholder'] . '</span>';
                    echo '<div class="legendItem__dropLinks">';
                    foreach ($item['links'] as $link) {
                        echo '<a href="' . $link['lnk'] . '" class="lnk">' . $link['txt'] . '</a>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }

            echo '</div>';
        }
        ?>

        <?php
        if ( $table_cash['table'] ) {
            ?>
            <div class="item__table">
                <div class="item__table--thead">
                    <?php
                    foreach ( $table_cash['table']['thead'] as $thead ) {
                        echo '<div class="item__table--thead_item">'. $thead['name'] .'</div>';
                    }
                    ?>
                </div>

                <div class="item__table--body">
                    <?php
                    foreach ( $table_cash['table']['tbody'] as $item ) {
                        $color = $item['color'] ? 'use_grey' : '';
                        echo '<div class="item__table--body_item '. $color .'">';
                        foreach ( $item['cells'] as $cell ) {
                            echo '<div class="cell">'. $cell['txt'] .'</div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if ( $table_cash['after_table'] || $table_cash['after_table_content'] ) {
            ?>
            <div class="item__afterTable">
                <h2 class="item__afterTable--title">
                    <?= $table_cash['after_table']; ?>
                </h2>
                <div class="item__afterTable--desc">
                    <?= $table_cash['after_table_content']; ?>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if ( $sect_table_btn ) {
            echo '<div class="pageSepa_sectTable--btnLine item__btnLine">';
            echo '<a class="lnk" href="'. $sect_table_btn['lnk'] .'">'. $sect_table_btn['btn'] .'</a>';
            echo '</div>';
        }
        ?>
    </div>
    <?php
}
?>

    </div>
</section>
