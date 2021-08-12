<?php
$sect_title = get_field('sect6_title');
$sect_items = get_field('sect6_items');
$sect_btn = get_field('sect6_btn');
?>

<section class="pageBusiness_sect6">
    <div class="pageBusiness_sect6--cont basic-container">
        <div class="column">
            <h2 class="pageBusiness_sect6--title cstTitle">
                <?= $sect_title; ?>
            </h2>
        </div>
        <div class="column">
            <div class="pageBusiness_sect6--items">
                <?php
                $itemsCounter = 0;
                foreach ( $sect_items as $item ) {
                    $itemsCounter++;
                ?>
                    <div class="item">
                        <div class="itemNumber">
                            <span class="itemNumber__item">
                                <?= $itemsCounter; ?>
                            </span>
                        </div>

                        <?php
                            if ( $item['title'] ) {
                                echo '<span class="item__title">'. $item['title'] .'</span>';
                            }

                            if ( $item['desc'] ) {
                                echo '<div class="item__desc">'. $item['desc'] .'</div>';
                            }

                            if( $item['subs'] ) {
                                echo '<div class="item__subs">';
                                foreach ( $item['subs'] as $sub ) {
                                    if ( $sub['specials'] ) {
                                        echo '<div class="sub__specials">';
                                            foreach ( $sub['specials'] as $special ) {
                                                echo '<div class="sub">';

                                                    echo '<span class="specials__drop">'. $special['title'] .'</span>';
                                                    echo '<div class="specials__dropDown">';
                                                        foreach ( $special['items'] as $item ) {
                                                           echo '<a href="'. $item['lnk'] .'" class="lnk">'. $item['txt'] .'</a>';
                                                        }
                                                    echo '</div>';
                                                echo '</div>';
                                            }
                                        echo '</div>';
                                    }
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <?php
            if ( $sect_btn ) {
        ?>
        <div class="btnLine">
            <a href="<?= $sect_btn['lnk']; ?>" class="link cstBtn cstBtn_blue"><?= $sect_btn['txt']; ?></a>
        </div>
        <?php
            }
        ?>
    </div>
</section>
