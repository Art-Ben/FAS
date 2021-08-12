<?php
$sect_table_btn = get_field('omttable_btn');
$sect_table_title = get_field('omttable_title');
$table_onmt = get_field('table_onmt', 'options');

$sect_table_btn = get_field('table_btn');

if ( $table_onmt ) {
    ?>
    <div class="pagePricing__tableTabs--items__tab open is-selected">
        <div class="basic-container">
            <?php
            if ( $table_onmt['title'] ) {
                echo '<h2 class="item__title">'. $table_onmt['title'] .'</h2>';
            }
            ?>

            <?php
            if ( $table_onmt['desc'] ) {
                echo '<div class="item__desc">'. $table_onmt['desc'] .'</div>';
            }
            ?>

            <?php
            if ( $table_onmt['special_blocks'] ) {
                echo '<div class="item__specials">';
                foreach ( $table_onmt['special_blocks'] as $specialItem ) {
                    echo '<div class="item__specials--single">';
                    echo '<span class="item__specials--tit">'. $specialItem['title'] .'</span>';
                    echo '<div class="desc">'. $specialItem['desc'] .'</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>

            <?php
            if ( $table_onmt['special_legend']['items'] ) {
                echo '<div class="item__docs">';
                echo '<span class="label">' . $table_onmt['special_legend']['title'] . '</span>';

                if ( $table_onmt['special_legend']['items'] ) {
                    foreach ($table_onmt['special_legend']['items'] as $item) {
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
            if ( $table_onmt['table'] ) {
                ?>
                <div class="item__table">
                    <div class="item__table--thead">
                        <?php
                        foreach ( $table_onmt['table']['thead'] as $thead ) {
                            echo '<div class="item__table--thead_item">'. $thead['name'] .'</div>';
                        }
                        ?>
                    </div>

                    <div class="item__table--body">
                        <?php
                        foreach ( $table_onmt['table']['tbody'] as $item ) {
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
            if ( $table_onmt['after_table'] || $table_onmt['after_table_content'] ) {
                ?>
                <div class="item__afterTable">
                    <h2 class="item__afterTable--title">
                        <?= $table_onmt['after_table']; ?>
                    </h2>
                    <div class="item__afterTable--desc">
                        <?= $table_onmt['after_table_content']; ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
            if ( $sect_table_btn ) {
                echo '<div class="pageSepa_sectTable--btnLine">';
                echo '<a class="lnk" href="'. $sect_table_btn['lnk'] .'">'. $sect_table_btn['btn'] .'</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <?php
}
?>
