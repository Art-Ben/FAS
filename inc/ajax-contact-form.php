<?php
/**
 * Custom contact form ajax handler function
 */

if( !function_exists('ajax_contact_form') ) {
    add_action( 'wp_ajax_sendcontactform', 'ajax_contact_form' );
	add_action( 'wp_ajax_nopriv_sendcontactform', 'ajax_contact_form' );

    function ajax_contact_form() {
        if( isset($_POST) ) {
            $client_name = $_POST['name'];
            $client_email = $_POST['email'];
            $client_message = $_POST['message'];

            $response = array();

            if(get_field('from_emails','options')) {
				$to = get_field('from_emails','options');
			} else {
				$to = get_option('admin_email');
			}
			
			$message = '';
			$site_base = site_url();
			$site_base = preg_replace('#^https?://#', '', $site_base);
			$from = 'noreply@'.$site_base;
						
			$subject = 'Fasfinance request from cf';
			$sender = 'From: Fasfinance <'.$from.'>' . "\r\n";
				
			$message.='<p><b>Name: </b> '. $client_name .'</p>';
			$message.='<p><b>E-mail: </b> '. $client_email .'</p>';
                
            if( $client_message ) {
                $message.='<p><b>Message. : </b> '. $client_message  .'</p>';
			}
			
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = $sender;
							
            $mail = wp_mail( $to, $subject, $message, $headers );

			if( $mail ) {
				$response['response'] = 'SUCCESS';
			} else {
				$response['response'] = 'ERROR';
				$response['error'] = $mail;
			}
			
            echo json_encode( $response );
        }

        die();
    }
}

if( !function_exists('ajax_newsletter_form') ) {
    add_action( 'wp_ajax_newsletter', 'ajax_newsletter_form' );
    add_action( 'wp_ajax_nopriv_newsletter', 'ajax_newsletter_form' );

    function ajax_newsletter_form() {
        if( isset($_POST) ) {
            $client_email = $_POST['email'];

            $response = array();

            if(get_field('from_emails','options')) {
                $to = get_field('from_emails','options');
            } else {
                $to = get_option('admin_email');
            }

            $message = '';
            $site_base = site_url();
            $site_base = preg_replace('#^https?://#', '', $site_base);
            $from = 'noreply@'.$site_base;

            $subject = 'Fasfinance Newsletter Email';
            $sender = 'From: Fasfinance <'.$from.'>' . "\r\n";

            $message.='<p><b>E-mail: </b> '. $client_email .'</p>';

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;

            $mail = wp_mail( $to, $subject, $message, $headers );

            if( $mail ) {
                $response['response'] = 'SUCCESS';
            } else {
                $response['response'] = 'ERROR';
                $response['error'] = $mail;
            }

            echo json_encode( $response );
        }

        die();
    }
}