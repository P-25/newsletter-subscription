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