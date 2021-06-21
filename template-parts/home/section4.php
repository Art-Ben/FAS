<?php

$title = get_field('fourth_title');
$content = get_field('fourth_desc');
$specImage = get_field('fourth_image');
$specImageContent = get_field('fourth_image_custom');
?>

<section class="pageHome_sect4">
    <div class="basic-container pageHome_sect4__cont over-hidd_tabl">
        <div class="pageHome_sect4--column">
            <h2 class="cstTitle">
                <?= $title; ?>
            </h2>
            <div class="desc">
                <?= $content; ?>
            </div>
        </div>
        <div class="pageHome_sect4--column">
            <?php
                if ( get_field('fourth_image_type') == 'custom' ) {
                    echo $specImageContent;
                } else {
                    echo '<img src="'. $specImage .'" alt="'. $title .'">';
                }
            ?>
        </div>
    </div>
</section>
