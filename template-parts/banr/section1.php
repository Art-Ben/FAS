<?php
    $items = get_field('sect1_items');
    $title = get_field('sect1_title');
?>

<section class="pageBecomeAnReferral_sect1">
    <div class="pageBecomeAnReferral_sect1--cont basic-container">

        <h2 class="cstTitle">
            <?= $title; ?>
        </h2>

        <div class="pageBecomeAnReferral_sect1--items">
            <?php
                if ( $items ) {
                    $counter = 0;
                    foreach ( $items as $item ) {
                        $counter++;
            ?>
                <div class="item">
                    <div class="content">
                        <div class="content__item">
                            <?= $item['desc']; ?>
                        </div>
                    </div>
                    <div class="number_cont">
                        <div class="number">
                            <span class="number__item">
                                <?= $counter; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>
