<?php
$cf_title = get_field('cf_title', 'options');
$cf_thanks = get_Field('cf_thanks', 'options');
$cf_policy = get_field('cf_policy', 'options');

switch ( pll_current_language() ) {
    case 'ru':
        $pl_name = 'Ваше Ф.И.О';
        $pl_email = 'Ваш E-mail';
        $pl_msg = 'Ваше сообщение';
        $sbmt = 'Отправить';
    break;

    case 'en':
        $pl_name = 'Full Name';
        $pl_email = 'Email address';
        $pl_msg = 'Your message';
        $sbmt = 'Send Inquiry';
    break;

    case 'cs':
        $pl_name = 'Celé jméno';
        $pl_email = 'Váš e-mail';
        $pl_msg = 'Vaše zpráva';
        $sbmt = 'Poslat poptávku';
    break;
}
?>

<section class="contactForm">
    <div class="contactForm__cont basic-container">
        <div class="contactForm__instance">
            <div class="infoBlock"></div>

            <h2 class="contactForm__title">
                <?= $cf_title; ?>
            </h2>

            <form action="javascript:void(0);" method="post" class="contactForm__instance--form" data-thanks="<?= $cf_thanks; ?>">
                <div class="formItem w_50">
                    <input type="text" class="inpt" name="name" id="name" placeholder="<?= $pl_name; ?>">
                </div>
                <div class="formItem w_50">
                    <input type="text" class="inpt" name="email" id="email" placeholder="<?= $pl_email; ?>">
                </div>
                <div class="formItem w_100">
                    <textarea name="msg" id="msg" class="txtarea" placeholder="<?= $pl_email; ?>"></textarea>
                </div>

                <div class="formItem w_100">
                    <div class="g-recaptcha" name="g-captcha" id="g-captcha" data-sitekey="6LepMHgbAAAAAHqCVyuQyIBij7Kr-Bqxynz7eBj7"></div>
                </div>

                <div class="formItem w_100">
                    <button class="sbmt cstBtn cstBtn_blue" type="submit">
                        <?= $sbmt; ?>
                    </button>
                    <div class="policy">
                        <?= $cf_policy; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
