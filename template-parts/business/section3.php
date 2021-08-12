<?php
$sect_title = get_field('sect3_title');
$sect_items = get_field('sect3_items');
?>

<section class="pageBusiness_sect3">
    <div class="pageBusiness_sect3--cont basic-container">
        <h2 class="pageBusiness_sect3__title">
            <?= $sect_title; ?>
        </h2>

        <?php
            if ( $sect_items ) {
        ?>
            <div class="pageBusiness_sect3--items--cont">
                <div class="pageBusiness_sect3--items__nav">
                    <?php
                        $navCounter = 0;
                        foreach ( $sect_items as $item ) {
                            $navCounter++;
                            if( $navCounter == 1 ) {
                                $itemClasses = 'is_active';
                            } else {
                                $itemClasses = '';
                            }
                    ?>
                        <button class="navItem <?= $itemClasses; ?>">
                            <?= $item['title']; ?>
                        </button>
                    <?php
                        }
                    ?>
                </div>

                <div class="pageBusiness_sect3--items">
                    <?php
                        $itemCounter = 0;
                        foreach ( $sect_items as $item ) {
                            $itemCounter++;
                            if( $itemCounter == 1 ) {
                                $itemClasses = 'is_show';
                            } else {
                                $itemClasses = '';
                            }
                    ?>
                        <div class="item <?= $itemClasses; ?>">
                            <?php
                                if ( $item['thumb'] ) {
                                    echo '<div class="item__thumb">';
                                        echo '<img src="'. $item['thumb'] .'" alt="'. $item['title'] .'">';
                                    echo '</div>';
                                }

                                if ( $item['content'] ) {
                                    echo '<div class="item__content">';
                                        echo '<div class="content">';
                                            echo $item['content'];
                                        echo '</div>';

                                        if ( $item['btn']['btn_txt'] and $item['btn']['btn_link'] ) {
                                            echo '<div class="btnLine">';
                                                echo '<a href="'. $item['btn']['btn_link'] .'" class="lnk">'. $item['btn']['btn_txt'] .'</a>';
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</section>
