<?php
$sect_items = get_field('sect2_items');
?>

<section class="pageQa_sect2">
    <?php
        foreach ( $sect_items as $item) {
    ?>
        <div class="item">
            <div class="basic-container">
                <h3 class="item_title" data-color_primary="<?= $item['primary_color']; ?>" style="color: <?= $item['primary_color']; ?>"><?= $item['title']; ?></h3>
            </div>


            <?php
                foreach ( $item['items'] as $subItem) {
            ?>
                <div class="subItem">
                    <div class="subItem_bg" style="background-color: <?= $subItem['sub_color']; ?>"></div>

                    <div class="basic-container">
                        <div class="subItem__cont">
                            <div class="subItem__toggler">
                                <span class="icon icon_more" style="color: <?= $item['primary_color']; ?>">+</span>
                                <span class="icon icon_less" style="color: <?= $item['primary_color']; ?>">-</span>
                                <div class="txt"><?= $subItem['toggler']; ?></div>
                            </div>

                            <div class="hiddenContent">
                                <?= $subItem['content']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    <?php
        }
    ?>
</section>
