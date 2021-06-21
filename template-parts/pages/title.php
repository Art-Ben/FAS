<?php

$pageTitleFields = get_field('pageTitle');
$pageTitleTypeClass = get_field('pageTitleTypeClass') ? get_field('pageTitleTypeClass') : '';
$pageTitleClass = get_field('pageTitleClass') ? get_field('pageTitleClass') : '';
$pageTitlePlanet = get_field('pageTitlePlanet');
$use_special_btn = get_field('pageSpecialBtn');
$special_btn_txt = get_field('pageSpecialBtn_txt');
$special_btn_lnk = get_field('pageSpecialBtn_lnk');
$special_btn_type = get_field('pageSpecialBtn_type');
?>

<section class="pageTitle <?= $pageTitleClass . ' ' . $pageTitleTypeClass; ?>">
    <div class="pageTitle__cont basic-container">
        <div class="pageTitle__content">
            <?php
                foreach ( $pageTitleFields as $field ) {
                    switch ( $field['type_of_field'] ) {
                        case 'primary':
                            echo '<h1 class="pageTitle__title">'. $field['title'] .'</h1>';
                        break;

                        case 'sub_content':
                            echo '<div class="pageTitle__content--line">'. $field['content'] .'</div>';
                        break;

                        case 'btn':
                            $lnk = $field['button_link'] ? $field['button_link'] : 'javascript:void(0)';
                            echo '<a href="'. $lnk .'" class="pageTitle__btn">'. $field['button_text'] .'</a>';
                        break;
                    }
                }
            ?>
        </div>

        <div class="pageTitle__planet">
            <?= $pageTitlePlanet; ?>
        </div>

        <?php
            if ( $use_special_btn ) {
                $output = '';
                switch ( $special_btn_type ) {
                    case 'scroll':
                        $output = '<button class="scrollToNextSection pageTitle_specialbtn">'. $special_btn_txt .'</button>';
                    break;

                    case 'link':
                        $output = '<a href="'. $special_btn_lnk .'" class="pageTitle_specialbtn">'. $special_btn_txt .'</a>';
                    break;
                }

                echo $output;
            }
        ?>
    </div>
</section>
