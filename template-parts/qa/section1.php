<?php
$sect_title = get_field('sect1_title');
$sect_questions = get_field('sect1_quest');
?>

<section class="pageQa_sect1">
    <div class="pageQa_sect1--cont basic-container">
        <h2 class="pageQa_sect1--title cstTitle">
            <?= $sect_title; ?>
        </h2>

        <?php
            if ( $sect_questions ) {
        ?>
            <div class="pageQa_sect1--populars">
                <?php
                    foreach ( $sect_questions as $quest ) {
                ?>
                    <div class="item" style="background-color: <?= $quest['color']; ?>">
                        <?= $quest['txt']; ?>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>
    </div>
</section>
