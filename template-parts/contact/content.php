<?php
$sect_title = get_field('sect_title');
$sect_info_title = get_field('sect_info_title');
$sect_info = get_field('sect_info');
$sect_socials = get_field('sect_socials');
$sect_map = get_field('sect_map');
?>

<section class="pageContacts">
    <div class="pageContacts--line"></div>
    <div class="pageContacts--cont">
        <div class="column">
            <h1 class="pageContacts--title cstTitle">
                <?= $sect_title; ?>
            </h1>

            <div class="infoGrp">
                <h2 class="infoGrp__title"><?= $sect_info_title; ?></h2>

                <?php
                    if ( $sect_info ) {
                ?>
                <div class="infoGrp__items">
                    <?php
                        foreach ( $sect_info as $info ) {
                    ?>
                        <div class="item">
                            <img src="<?= $info['icon']; ?>" alt="" class="icon">
                            <div class="txt">
                                <?= $info['txt']; ?>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <?php
                    }
                ?>

                <?php
                if ( $sect_socials ) {
                    ?>
                    <div class="infoGrp__socials">
                        <?php
                        foreach ( $sect_socials as $social ) {
                            ?>
                            <a href="<?= $social['url']; ?>" class="social">
                                <img src="<?= $social['icon']; ?>" alt="" class="icon">
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="column">
            <div class="mapInstance" data-zoom="10">
                <div class="gmap-marker" data-lat="<?= $sect_map['marker_location']['lat'];?>" data-lng="<?= $sect_map['marker_location']['lng']?>">
                    <div class="cstMarker">
                        <span class="partName">Head office</span>
                        <div class="line">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/iconSmallmarker.png" alt="icon" class="icon">
                            <span class="content"><?= $sect_map['map_address']; ?></span>
                        </div>
                        <div class="line">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/iconClock.png" alt="icon" class="icon">
                            <span class="content"><?= $sect_map['map_workTime']; ?></span>
                        </div>
                        <div class="line">
                            <img src="<?= get_template_directory_uri(); ?>/dist/images/iconPhone.png" alt="icon" class="icon">
                            <span class="content"><?= $sect_map['map_workPhone']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>