<?php
$docs_files = get_field('docs');
// $file['add_name'] ? $file['add_name'] :  ' | ' . bcdiv($file['file']['filesize'], 1048576, 2) . 'MB|'. $file['file']['subtype'] .'
?>

<section class="pageDocs">
    <div class="pageDocs__cont basic-container">
        <?php
            if ( $docs_files ) {
                foreach ( $docs_files as $file ) {
                    $file_name = $file['add_name'] ? $file['add_name'] : $file['file']['title'];

                    echo '<div class="pageSepa_sectTable--btnLine">';
                    echo '<a class="lnk" download href="'. $file['file']['url'] .'">';
                    echo '<span class="name">'. $file_name .'</span>';
                    echo '<div class="infoLine">'.bcdiv($file['file']['filesize'], 1048576, 2) . 'Mb | '. $file['file']['subtype'].'</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {

            }
        ?>
    </div>
</section>
