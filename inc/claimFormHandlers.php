<?php


add_action('wp_ajax_sendclaimform', 'ajaxSendContactForm');
add_action('wp_ajax_nopriv_sendclaimform', 'ajaxSendContactForm');

if (!function_exists('ajaxSendContactForm')) {
    function ajaxSendContactForm()
    {
        $response = array();

        $client_name = !empty($_POST['client_name']) ? $_POST['client_name'] : 'not seted';
        $client_email = !empty($_POST['client_email']) ? $_POST['client_email'] : 'not seted';
        $client_tel = !empty($_POST['client_phone']) ? $_POST['client_phone'] : 'not seted';
        $client_companyname = !empty($_POST['client_companyname']) ? $_POST['client_companyname'] : 'not seted';
        $client_contract = !empty($_POST['client_contract']) ? $_POST['client_contract'] : 'not seted';
        $client_ordernumber = !empty($_POST['client_ordernumber']) ? $_POST['client_ordernumber'] : 'not seted';
        $client_desc = !empty($_POST['client_desc']) ? $_POST['client_desc'] : 'not seted';

        $attachments = array();

        $attachmentsFiles = explode(',', $_POST['client_files']);

        foreach ($attachmentsFiles as $attachFile) {
            array_push($attachments, WP_CONTENT_DIR . '/uploads/' . date('Y') . '/' . date('m') . '/' . $attachFile);
        }

        if (get_field('from_emails', 'options')) {
            $to = get_field('from_emails', 'options');
        } else {
            $to = get_option('admin_email');
        }

        $message = '';
        $site_base = site_url();
        $site_base = preg_replace('#^https?://#', '', $site_base);
        $from = 'admin@' . $site_base;

        $subject = '' . $from . ' "Fasfinance"';
        $sender = 'From: ' . $from . ' <' . $from . '>' . "\r\n";

        $message .= '<p><b>Client name: </b>' . $client_name . '</p>';
        $message .= '<p><b>Email : </b> ' . $client_email . '</p>';
        $message .= '<p><b>Telephone: </b> ' . $client_tel . '</p>';
        $message .= '<p><b>Client or Company Name: </b> ' . $client_companyname . '</p>';
        $message .= '<p><b>Contract Number or Number of Clients Account: </b> ' . $client_contract . '</p>';
        $message .= '<p><b>Payment or Request Order Number </b> ' . $client_ordernumber . '</p>';
        $message .= '<p><b>Claim description: </b> ' . $client_desc . '</p>';

        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = $sender;

        $mail = wp_mail($to, $subject, $message, $headers, $attachments);

        if ($mail) {
            $response['response'] = 'success';
            $response['attaches'] = json_encode($attachments);
        } else {
            $response['response'] = 'error';
            $response['error'] = $mail;
        }

        echo json_encode($response);

        die();
    }
}

if (!function_exists('custom_file_upload')) {
    add_action('wp_ajax_fileupload', 'custom_file_upload');
    add_action('wp_ajax_nopriv_fileupload', 'custom_file_upload');

    function custom_file_upload()
    {

        $fileErrors = array(
            0 => "There is no error, the file uploaded with success",
            1 => "The uploaded file exceeds the upload_max_files in server settings",
            2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
            3 => "The uploaded file uploaded only partially",
            4 => "No file was uploaded",
            6 => "Missing a temporary folder",
            7 => "Failed to write file to disk",
            8 => "A PHP extension stoped file to upload");

        $posted_data = isset($_POST) ? $_POST : array();
        $file_data = isset($_FILES) ? $_FILES : array();

        $data = array_merge($posted_data, $file_data);

        $response = array();

        $uploaded_file = wp_handle_upload($data['file'], array('test_form' => false,
            'mimes' => array(
                'pdf' => 'application/pdf',
                'jpg|jpeg|jpe' => 'image/jpeg',
                'png' => 'image/png',
            )));

        if ($uploaded_file && !isset($uploaded_file['error'])) {
            $response['response'] = "success";

            $response['filename'] = basename($uploaded_file['url']);
            $response['url'] = $uploaded_file['url'];
            $response['type'] = $uploaded_file['type'];

            $file_path = pathinfo($uploaded_file['url']);
            $file_name = $file_path['filename'];
            $uploaded_file_type = $uploaded_file['type'];

            $file_name_and_location = $uploaded_file["file"];
            $file_title_for_media_library = $file_name;
            $attachment = array(
                "post_mime_type" => $uploaded_file_type,
                "post_title" => $file_title_for_media_library,
                "post_content" => "",
                "post_status" => "inherit"
            );

            if (!is_null($post)) {
                if (!is_numeric($post)) {
                    $post = $post->ID;
                }
                $attachment['post_parent'] = $post;
            }
            $id = wp_insert_attachment($attachment, $file_name_and_location);

            require_once(ABSPATH . "wp-admin/includes/image.php");

            $attach_data = wp_generate_attachment_metadata($id, $file_name_and_location);

            wp_update_attachment_metadata($id, $attach_data);

        } else {
            $response['response'] = "ERROR";
            $response['error'] = 'Sorry, but this file type not allowed';
        }

        echo json_encode($response);

        die();
    }
}


if (!function_exists('custom_file_delete')) {
    add_action('wp_ajax_filedelete', 'custom_file_delete');
    add_action('wp_ajax_nopriv_filedelete', 'custom_file_delete');

    function custom_file_delete()
    {
        if (isset($_POST)) {
            global $wpdb;

            $fileurl = $_POST['fileurl'];
            $response = array();

            //$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $fileurl ));
            $attachment_id = attachment_url_to_postid($fileurl);


            if ($attachment_id) {
                //$attachmentID = $attachment[0];
                if (false === wp_delete_attachment($attachment_id, true)) {
                    $response['response'] = "ERROR";
                    $response['error'] = _x('File could not be deleted', 'cv upload ajax', 'metkaspostach');

                } else {
                    $response['response'] = "SUCCESS";
                }
            } else {
                $filename = basename($fileurl);
                $upload_dir = wp_upload_dir();
                $upload_path = $upload_dir["basedir"] . "/custom/";
                $uploaded_file = $upload_path . $filename;
                if (file_exists($uploaded_file)) {
                    @unlink($uploaded_file);
                    $response['response'] = "SUCCESS";

                } else {
                    $response['response'] = "ERROR";
                    $response['error'] = 'File does not exist';
                }
            }

            echo json_encode($response);
        }
        die();
    }
}


