<?php
$sect_title = get_field('sect5_title');
$sect_versus_outsider = get_field('sect5_left');
$sect_versus_winner = get_field('sect5_right');
?>

<section class="pageSepa_sect5">
    <div class="pageSepa_sect5--cont basic-container">
        <h2 class="pageSepa_sect5--title cstTitle">
            <?= $sect_title; ?>
        </h2>

        <div class="pageSepa_sect5--versus">
            <div class="column">
                <div class="pageSepa_sect5--versus_outsider pageSepa_sect5--versus_item">
                    <h3 class="tit">
                        <?= $sect_versus_outsider['title']; ?>
                    </h3>

                    <?php
                        if ( $sect_versus_outsider['items'] ) {
                    ?>
                            <div class="items">
                                <?php
                                    foreach ( $sect_versus_outsider['items'] as $item) {
                                        echo '<div class="item">';
                                            echo $item['content'];
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="column">
                <div class="pageSepa_sect5--versus_winner pageSepa_sect5--versus_item">
                    <h3 class="tit">
                        <?= $sect_versus_winner['title']; ?>
                    </h3>

                    <?php
                        if ( $sect_versus_winner['items'] ) {
                    ?>
                        <div class="items">
                            <?php
                                foreach ( $sect_versus_winner['items'] as $item) {
                                    echo '<div class="item">';
                                        echo $item['content'];
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    <?php
                        }
                    ?>

                    <?php
                        if ( $sect_versus_winner['btn'] ) {
                    ?>
                            <div class="btnLine">
                                <a href="<?= $sect_versus_winner['btn']['lnk']; ?>" class="link cstBtn_blue cstBtn"><?= $sect_versus_winner['btn']['txt']; ?></a>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
