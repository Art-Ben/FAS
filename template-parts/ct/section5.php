<?php
$sect_title = get_field('sect5_title');
$sect_desc = get_field('sect5_desc');
$sect_partners = get_field('sect5_partners');

switch ( pll_current_language() ) {
    case 'ru':
        $viewOnMap= 'Посмотреть на карте';
        $partner = 'Название партнёра';
        $location = 'Расположение';
        break;

    case 'en':
        $viewOnMap= 'View on the map';
        $partner = 'Partner';
        $location = 'Location';
        break;

    case 'cs':
        $viewOnMap= 'Zobrazit na mapě';
        $partner = 'Partneři';
        $location = 'Umístění';
        break;
}
?>

<section class="pageCashTrans_sect5" id="branches">
    <div class="pageCashTrans_sect5--cont basic-container">

        <?php
            if ( $sect_title ) {
        ?>
        <h2 class="pageCashTrans_sect5--title cstTitle">
            <?= $sect_title; ?>
        </h2>
        <?php
            }
        ?>

        <?php
            if ( $sect_desc ) {
        ?>
        <div class="pageCashTrans_sect5--desc">
            <?= $sect_desc; ?>
        </div>
        <?php
            }
        ?>

        <?php
            if ( $sect_partners ) {
        ?>
        <div class="pageCashTrans_sect5--map_cont">
            <div class="pageCashTrans_sect5--map_items">
                <div class="columnsNav">
                    <div class="columnsNav_item"><?= $partner; ?></div>
                    <div class="columnsNav_item"><?= $location; ?></div>
                </div>
                <?php
                    $mark_id = 0;
                    foreach ( $sect_partners as $partner ) {
                        $mark_id++;
                ?>
                  <div class="item">
                      <div class="name">
                        <?= $partner['name_of_partner'];?>
                      </div>
                      <div class="location">
                          <?= $partner['location'];?>
                      </div>
                      <button class="viewMap" data-marker_id="<?= $mark_id; ?>"><?= $viewOnMap; ?></button>
                  </div>
                <?php
                    }
                ?>
            </div>

            <div class="pageCashTrans_sect5--map_instance">
                <?php
                    foreach ( $sect_partners as $partner ) {
                        echo '<div class="gmap-marker" data-lat="'. $partner['marker_location']['lat'] .'" data-lng="'.$partner['marker_location']['lng'].'">';
                            echo '<div class="cstMarker">';
                                echo '<span class="partName">'. $partner['name_of_partner'] .'</span>';
                                if ( $partner['marker_content'] ) {
                                    foreach ( $partner['marker_content'] as $marker_content ) {
                                        echo '<div class="line"> <img src="'. $marker_content['icon'] .'" alt="icon" class="icon"><span class="content">'. $marker_content['content'] .'</span></div>';
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>
