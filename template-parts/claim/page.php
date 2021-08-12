<?php
$page_title = get_field('form_title','option');
$page_form_name = get_field('name_field','option');
$page_form_email = get_field('email_field','option');
$page_form_phone = get_field('phone_field','option');
$page_form_clientname = get_field('clientname_field','option');
$page_form_contract = get_field('contract_field','option');
$page_form_ordernumber = get_field('ordernumber_field','option');
$page_form_desc = get_field('desc_field','option');
$page_form_attach = get_field('attach_field','option');
$page_form_captcha = get_field('captcha_field','option');
$page_form_submit = get_field('submit_field','option');

$page_placeholder_form_name = get_field('name_placehold_field','option');
$page_placeholder_form_email = get_field('email_placehold_field','option');
$page_placeholder_form_phone = get_field('phone_placehold_field','option');
$page_placeholder_form_clientname = get_field('clientname_placehold_field','option');
$page_placeholder_form_contract = get_field('contract_placehold_field','option');
$page_placeholder_form_ordernumber = get_field('ordernumber_placehold_field','option');
$page_placeholder_form_desc = get_field('desc_placehold_field','option');
$page_placeholder_form_attach = get_field('attach_placehold_field','option');
$page_placeholder_form_captcha = get_field('captcha_placehold_field','option');

$error_empty = get_field('error_empty', 'options');
$error_valid = get_field('error_valid', 'options');
$form_success = get_field('form_success', 'options');
?>

<section class="pageClaim">
    <div class="menuDecor"></div>

    <div class="pageClaim__cont basic-container">
        <h1 class="pageClaim__title">
            <?= $page_title; ?>
        </h1>
        <form action="javascript:void(0);"  data-errors_empty="<?= $error_empty; ?>" data-errors_validation="<?= $error_valid; ?>" method="post" class="pageClaim__form myContactForm" enctype="multipart/form-data">
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_name; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_name; ?>" id="client_name" name="client_name">
                </div>
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_email; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_email; ?>" id="client_email" name="client_email">
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_phone; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_phone; ?>" id="client_phone" name="client_phone">
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_clientname; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_clientname; ?>" id="client_companyname" name="client_companyname">
                </div>
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_contract; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_contract; ?>" id="client_contract" name="client_contract">
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_ordernumber; ?>
                    </label>
                    <input type="text" class="cstInpt" placeholder="<?= $page_placeholder_form_ordernumber; ?>" id="client_ordernumber" name="client_ordernumber">
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_desc; ?>
                    </label>
                    <textarea class="cstTxtArea" placeholder="<?= $page_placeholder_form_desc; ?>" id="client_desc" name="client_desc"></textarea>
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_attach; ?>
                    </label>
                    <div class="cstFileUpload">
                        <?= $page_placeholder_form_attach ; ?>

                        <?php
                            switch ( pll_current_language() ) {
                                case 'ru':
                                    echo 'Прикрепить файлы';

                                    break;

                                case 'en':
                                    echo 'Attach files';

                                    break;

                                case 'cs':
                                    echo 'Připojení souborů';
                                    break;
                            }
                        ?>
                        <input type="file" class="cstFileUploadHidden" id="client_files" name="client_files" multiple>
                        <div class="cstFileUpload__files">

                        </div>
                        <div class="uploadedErr"></div>
                    </div>
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_half">
                    <label class="lbl">
                        <?= $page_form_captcha; ?>
                    </label>
                    <div class="g-recaptcha" name="g-captcha" id="g-captcha" data-sitekey="6LepMHgbAAAAAHqCVyuQyIBij7Kr-Bqxynz7eBj7"></div>
                </div>
            </div>
            <div class="form_row">
                <div class="formGroup formGroup_full">
                    <button class="cstSbmt cstBtn cstBtn_blue">
                        <?= $page_form_submit; ?>
                    </button>
                </div>
            </div>

            <div class="form_row">
                <div class="formGroup formGroup_full">
                    <div class="successMessage">
                        <?= $form_success; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
