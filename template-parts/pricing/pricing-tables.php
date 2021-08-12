<?php
    $table_onmt = get_field('table_onmt', 'option');
    $table_sepa = get_field('table_sepa', 'option');
    $table_cash = get_field('table_cash', 'option');
?>
<section class="pagePricingInstance">
    <div class="pagePricing__tableTabs">
        <div class="basic-container">
            <div class="pagePricing__tableTabs--nav">
                <div class="activeElemDecor"></div>
                <?php
                    if ( $table_onmt['thead'] ) {
                        echo '<button data-tab_to_show="'.str_replace(' ', '_', mb_strtolower( $table_onmt['thead'] ) ).'" class="pagePricing__tableTabs--nav__item active">'. $table_onmt['thead'] .'</button>';
                    }

                    if ( $table_sepa['thead'] ) {
                        echo '<button data-tab_to_show="'.str_replace(' ', '_', mb_strtolower( $table_sepa['thead'] ) ).'" class="pagePricing__tableTabs--nav__item">'. $table_sepa['thead'] .'</button>';
                    }

                    if ( $table_cash['thead'] ) {
                        echo '<button data-tab_to_show="'.str_replace(' ', '_', mb_strtolower( $table_cash['thead'] ) ).'" class="pagePricing__tableTabs--nav__item">'. $table_cash ['thead'] .'</button>';
                    }
                ?>
            </div>
        </div>

        <div class="pagePricing__tableTabs--items">
            <div class="basic-container">
                <div class="decorTriangle"></div>

                <div class="pagePricing__tableTabs--slider">
                <?php
                    if ( $table_onmt ) {
                ?>
                    <div data-tab_id="<?= str_replace(' ', '_', mb_strtolower( $table_onmt['thead'] ) ) ; ?>" class="pagePricing__tableTabs--items__tab open">
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
                            if ( $table_onmt['button_lnk'] || $table_onmt['button_txt'] ) {
                        ?>
                            <div class="item__btnLine">
                                <a href="<?= $table_onmt['button_lnk']; ?>" class="cstBtn cstBtn_blue">
                                    <?= $table_onmt['button_txt']; ?>
                                </a>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                <?php
                    }
                ?>

                <?php
                    if ( $table_sepa ) {
                ?>
                    <div data-tab_id="<?= str_replace(' ', '_', mb_strtolower( $table_sepa['thead'] ) ) ; ?>" class="pagePricing__tableTabs--items__tab">
                            <?php
                            if ( $table_sepa['title'] ) {
                                echo '<h2 class="item__title">'. $table_sepa['title'] .'</h2>';
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
                            if ( $table_sepa['after_table'] || $table_sepa['after_table_content'] ) {
                                ?>
                                <div class="item__afterTable">
                                    <h2 class="item__afterTable--title">
                                        <?= $table_sepa['after_table']; ?>
                                    </h2>
                                    <div class="item__afterTable--desc">
                                        <?= $table_sepa['after_table_content']; ?>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>

                        <?php
                            if ( $table_sepa['button_lnk'] || $table_sepa['button_txt'] ) {
                                ?>
                                <div class="item__btnLine">
                                    <a href="<?= $table_sepa['button_lnk']; ?>" class="cstBtn cstBtn_blue">
                                        <?= $table_sepa['button_txt']; ?>
                                    </a>
                                </div>
                                <?php
                            }
                        ?>
                        </div>
                <?php
                    }
                ?>

                <?php
                    if ( $table_cash ) {
                ?>
                    <div data-tab_id="<?= str_replace(' ', '_', mb_strtolower( $table_cash['thead'] ) ) ; ?>" class="pagePricing__tableTabs--items__tab">
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
                                if ( $table_cash['button_lnk'] || $table_cash['button_txt'] ) {
                                    ?>
                                    <div class="item__btnLine">
                                        <a href="<?= $table_cash['button_lnk']; ?>" class="cstBtn cstBtn_blue">
                                            <?= $table_cash['button_txt']; ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
