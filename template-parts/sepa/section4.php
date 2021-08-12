<?php
$sect_title = get_field('sect4_title');
$sect_content = get_field('sect4_content');
?>

<section class="pageSepa_sect4">
    <div class="pageSepa_sect4--cont basic-container">
        <div class="column">
            <h2 class="pageSepa_sect4--title cstTitle">
                <?= $sect_title; ?>
            </h2>
        </div>
        <div class="column">
            <?php
                if ( $sect_content ) {
                    echo '<div class="pageSepa_sect4--content">';
                        echo $sect_content;
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</section>
