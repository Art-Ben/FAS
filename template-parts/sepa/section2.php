<?php
$sect_title = get_field('sect2_title');
$sect_items = get_field('sect2_flags');
$sect_btn = get_field('sect2_flags_btn');
?>

<section class="pageSepa_sect2">
    <div class="pageSepa_sect2--cont basic-container">
        <h2 class="pageSepa_sect2--title cstTitle">
            <?= $sect_title; ?>
        </h2>

        <?php
            if ( $sect_items  ) {
        ?>
            <div class="pageSepa_sect2--flags_cont">
                <div class="pageSepa_sect2--flags">
                    <?php
                    foreach ( $sect_items as $flag ) {
                        echo '<div class="flag_item"><img src="'. $flag['flag'] .'" class="flag_img"><span class="flag_name">'. $flag['name'] .'</span></div>';
                    }
                    ?>
                </div>
                <div class="pageSepa_sect2--flags_btnLine">
                    <button class="cstBtn cstBtn_blue">
                        <span class="more"><?= $sect_btn['more']; ?></span>
                        <span class="less"><?= $sect_btn['less']; ?></span>
                    </button>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</section>
