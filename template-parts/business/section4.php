<?php
$sect_title = get_field('sect4_title');
$sect_desc = get_field('sect4_desc');
$sect_btn = get_field('sect4_btn');
?>

<section class="pageBusiness_sect4">
    <div class="pageBusiness_sect4--cont basic-container">
        <div class="wrapper">
            <div class="column">
                <h2 class="tit">
                    <?= $sect_title; ?>
                </h2>
            </div>
            <div class="column">
                <div class="desc">
                    <div class="cnt">
                        <?= $sect_desc; ?>
                    </div>

                    <div class="btnLine">
                        <a class="lnk" href="<?= $sect_btn['link']; ?>"><?= $sect_btn['txt']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
