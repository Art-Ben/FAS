<?php
?>
<section class="cta">
    <div class="cta__cont basic-container">
        <div class="ctaLeft">
            <span class="cta__title">
                <?= get_field('cta_title', 'option'); ?>
            </span>
        </div>
        <div class="ctaRight">
            <a href="tel:<?= get_field('cta_tel', 'option'); ?>" class="cta_tel"><?= get_field('cta_tel', 'option'); ?></a>
            <a href="mailto:<?= get_field('cta_tel', 'option'); ?>" class="cta_mail"><?= get_field('cta_mail', 'option'); ?></a>
        </div>
    </div>
</section>