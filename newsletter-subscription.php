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
    ob_start(); ?>
    <div class="ns-newsletter-wrapper">
        <h2 class="ns-title">Subscribe to Our Newsletter</h2>
        <p class="ns-subtitle">Stay updated with our latest news and articles.</p>

        <form id="ns-newsletter-form">
            <input type="email" name="email" placeholder="Your email address" required />
            <input type="text" name="name" placeholder="Your name (optional)" />
            <input type="hidden" name="ns_nonce" value="<?php echo wp_create_nonce('ns_ajax_nonce'); ?>" />
            <input type="hidden" name="action" value="ns_newsletter_subscribe" />
            <button type="submit" class="ns-submit-button">Subscribe</button>
        </form>
        <div id="ns-message" class="ns-message"></div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_form', 'ns_newsletter_form');
