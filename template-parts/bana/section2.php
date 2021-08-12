<?php
$title = get_field('sect2_title');
$smalltitle = get_field('sect2_smalltitle');
$content = get_field('sect2_content');
?>

<section class="pageBecomeAnAgent_sect2">
    <div class="basic-container pageBecomeAnAgent_sect2__cont">
        <div class="column">
            <h2 class="cstTitle">
                <?= $title; ?>
            </h2>
            <span class="pageBecomeAnAgent__smalltitle">
                <?= $smalltitle; ?>
            </span>
        </div>
        <div class="column">
            <div class="pageBecomeAnAgent__content">
                <?= $content; ?>
            </div>
        </div>
    </div>
</section>


