<?php
$sect_table_btn = get_field('sepatable_btn');
$sect_table_title = get_field('sepatable_title');
$table_sepa = get_field('table_sepa', 'option');

if ( $table_sepa ) {
?>
    <div class="pagePricing__tableTabs--items__tab open is-selected pageSepa_sectTable">
        <div class="basic-container">
            <?php
                if ( $sect_table_title ) {
                    echo '<h2 class="cstTitle">'. $sect_table_title  .'</h2>';
                }
            ?>

            <?php
                if ( $table_sepa['title'] ) {
                    echo '<span class="item__title">'. $table_sepa['title'] .'</span>';
                }
            ?>

            <?php
                if ( $table_sepa['desc'] ) {
                    echo '<div class="item__desc">'. $table_sepa['desc'] .'</div>';
                }
            ?>

            <?php
                if ( $table_sepa['special_blocks'] ) {
                    echo '<div class="item__specials">';
                    foreach ( $table_sepa['special_blocks'] as $specialItem ) {
                        echo '<div class="item__specials--single">';
                        echo '<span class="item__specials--tit">'. $specialItem['title'] .'</span>';
                        echo '<div class="desc">'. $specialItem['desc'] .'</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            ?>

            <?php
                if ( $table_sepa['special_legend']['items'] ) {
                    echo '<div class="item__docs">';
                    echo '<span class="label">' . $table_sepa['special_legend']['title'] . '</span>';

                    if ( $table_sepa['special_legend']['items'] ) {
                        foreach ($table_sepa['special_legend']['items'] as $item) {
                            echo '<div class="legendItem">';
                            echo '<div class="legendItem__drop">' . $item['placeholder'] . '<span class="arrow"></span></div>';
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
                if ( $table_sepa['table'] ) {
                    ?>
                    <div class="item__table">
                        <div class="item__table--thead">
                            <?php
                            foreach ( $table_sepa['table']['thead'] as $thead ) {
                                echo '<div class="item__table--thead_item">'. $thead['name'] .'</div>';
                            }
                            ?>
                        </div>

                        <div class="item__table--body">
                            <?php
                            foreach ( $table_sepa['table']['tbody'] as $item ) {
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
            if ( $sect_table_btn ) {
                echo '<div class="pageSepa_sectTable--btnLine">';
                echo '<a class="lnk" href="'. $sect_table_btn['lnk'] .'">'. $sect_table_btn['txt'] .'</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
<?php
}
?>
