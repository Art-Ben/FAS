<?php
$docs_files = get_field('docs_group');
?>

<section class="pageDocs">
    <div class="pageDocs__cont basic-container">
        <?php
            if ( $docs_files ) {

                foreach ( $docs_files as $group  ) {
        ?>
                <div class="pageDocs__group">
                    <?php
                        if ( $group['title'] ) {
                    ?>
                    <h3 class="pageDocs__group--title">
                        <?= $group['title']; ?>
                    </h3>
                    <?php
                        }
                    ?>

                    <?php
                        if( $group['docs'] ) {
                            foreach ( $group['docs'] as $file ) {
                                $file_name = $file['add_name'] ? $file['add_name'] : $file['file']['title'];

                                echo '<div class="pageSepa_sectTable--btnLine">';
                                echo '<a class="lnk" target="_blank" href="'. $file['file']['url'] .'">';
                                echo '<span class="name">'. $file_name .'</span>';
                                echo '<div class="infoLine">'.bcdiv($file['file']['filesize'], 1048576, 2) . 'Mb | '. $file['file']['subtype'].'</div>';
                                echo '</a>';
                                echo '</div>';
                            }
                        }

                    ?>
                </div>
        <?php
                }


            } else {

            }
        ?>
    </div>
</section>
