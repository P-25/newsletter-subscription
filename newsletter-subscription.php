<?php
/**
 * Plugin Name: Newsletter Subscription
 * Description: adds a newsletter subscription form and sends the data to a configurable API endpoint.
 * Version: 1.0
 * Author: Prince Sharma
 */

defined('ABSPATH') or exit;
define('NS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NS_PLUGIN_URL', plugin_dir_url(__FILE__));



// Include the functionality file
require_once NS_PLUGIN_DIR . 'includes/admin-configration.php';
require_once NS_PLUGIN_DIR . 'includes/handler.php';


function ns_admin_styles($page)
{
    if ($page === 'settings_page_newsletter-config') {
        wp_enqueue_style('ns-admin-style', NS_PLUGIN_URL . 'assets/css/admin-style.css');
    }
}
add_action('admin_enqueue_scripts', 'ns_admin_styles');

function ns_enqueue_scripts()
{
    wp_enqueue_script('ns-newsletter-subscription-js', NS_PLUGIN_URL . 'assets/js/newsletter-subscription.js', ['jquery'], null, true);
    wp_localize_script('ns-newsletter-subscription-js', 'ns_obj', [
        'ajax_url' => admin_url(path: 'admin-ajax.php'),
    ]);

    wp_enqueue_style('ns-admin-style', src: NS_PLUGIN_URL . 'assets/css/newsletter-subscription.css');
}
add_action('wp_enqueue_scripts', 'ns_enqueue_scripts');


function ns_newsletter_form()
{
    ob_start();

    $template = locate_template('newsletter-subscription/newsletter-form.php');
    if ($template) {
        include $template;
    } else {
        include NS_PLUGIN_DIR . 'templates/newsletter-form.php';
    }

    return ob_get_clean();
}
add_shortcode('newsletter_form', 'ns_newsletter_form');
