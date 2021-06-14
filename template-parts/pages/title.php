<?php

$pageTitleFields = get_field('pageTitle');
$pageTitleClass = get_field('pageTitleClass') ? get_field('pageTitleClass') : '';
?>

<section class="pageTitle <?= $pageTitleClass; ?>">
    <div class="pageTitle__cont basic-container">
        <div class="pageTitle__content">
            <?php
                foreach ( $pageTitleFields as $field ) {
                    switch ( $field['type_of_field'] ) {
                        case 'primary':
                            echo '<h1 class="pageTitle__title">'. $field['title'] .'</div>';
                        break;

                        case 'sub_content':
                            echo '<div class="pageTitle__content">'. $field['content'] .'</div>';
                        break;

                        case 'btn':
                            $lnk = $field['button_link'] ? $field['button_link'] : 'javascript:void(0)';
                            echo '<a href="'. $lnk .'" class="pageTitle__btn">'. $field['button_text'] .'</a>';
                        break;
                    }
                }
            ?>
        </div>
    </div>
</section>
