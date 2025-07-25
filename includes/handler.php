<?php

function ns_handle_newsletter_submission()
{

    check_ajax_referer('ns_ajax_nonce', 'ns_nonce');

    $email = $_POST['email'];
    $name = $_POST['name'];

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email address']);
    }

    $api_url = get_option('ns_api_url');
    $api_key = get_option('ns_api_key');
    $field_email = get_option('ns_field_email');
    $field_name = get_option('ns_field_name');

    if (empty($api_url) || empty($api_key) || empty($field_email) || empty($field_name)) {
        error_log("Newsletter Plugin is not configured correctly.");
        wp_send_json_error([
            'message' => 'Something went wrong. Please try again later.'
        ]);
    }

    $body = [
        $field_email => $email,
    ];

    if (!empty($name)) {
        $body[$field_name] = $name;
    }

    $response = wp_remote_post($api_url, [
        'headers' => [
            'Authorization' => $api_key,
        ],
        'body' => json_encode($body),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => 'Something went wrong. Please try again later.']);
    }

    $code = wp_remote_retrieve_response_code($response);
    if ($code === 200 || $code === 201) {
        wp_send_json_success(['message' => 'Subscribed successfully!']);
    } else {
        wp_send_json_error(['message' => 'Something went wrong. Please try again later.']);
    }
}

add_action('wp_ajax_ns_newsletter_subscribe', 'ns_handle_newsletter_submission');
add_action('wp_ajax_nopriv_ns_newsletter_subscribe', 'ns_handle_newsletter_submission');
