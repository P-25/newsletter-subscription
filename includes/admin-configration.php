<?php

function ns_add_new_settings()
{
    add_option('ns_api_url', '');
    add_option('ns_api_key', '');
    add_option('ns_field_email', 'email');
    add_option('ns_field_name', 'name');

    register_setting('ns_setting_page', 'ns_api_url');
    register_setting('ns_setting_page', 'ns_api_key');
    register_setting('ns_setting_page', 'ns_field_email');
    register_setting('ns_setting_page', 'ns_field_name');
}
add_action('admin_init', 'ns_add_new_settings');

function ns_setting_page()
{

    $api_url = get_option('ns_api_url');
    $api_key = get_option('ns_api_key');
    $field_email = get_option('ns_field_email');
    $field_name = get_option('ns_field_name');

    ?>
    <div class="wrap">
        <h1>Newsletter Configuration Settings</h1>
        <form method="post" action="options.php" class="ns-settings-form">
            <?php
            settings_fields('ns_setting_page');

            $api_url = get_option('ns_api_url');
            $api_key = get_option('ns_api_key');
            $field_email = get_option('ns_field_email');
            $field_name = get_option('ns_field_name');
            ?>

            <div class="ns-field">
                <label for="ns_api_url">API Endpoint *</label>
                <input type="text" id="ns_api_url" name="ns_api_url" placeholder="eg. https://mail.example.com"
                    value="<?php echo esc_attr($api_url); ?>" class="regular-text" />
            </div>

            <div class="ns-field">
                <label for="ns_api_key">API Key/Token *</label>
                <input type="text" id="ns_api_key" name="ns_api_key" placeholder="API key/token for the API URl"
                    value="<?php echo esc_attr($api_key); ?>" class="regular-text" />
            </div>

            <div class="ns-field">
                <label for="ns_field_email">Email Field Name *</label>
                <input type="text" id="ns_field_email" name="ns_field_email" value="<?php echo esc_attr($field_email); ?>"
                    class="regular-text" />
            </div>

            <div class="ns-field">
                <label for="ns_field_name">Name Field Name </label>
                <input type="text" id="ns_field_name" name="ns_field_name" value="<?php echo esc_attr($field_name); ?>"
                    class="regular-text" />
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}

function ns_add_admin_menu()
{
    add_options_page('Configure Newsletter API', 'Configure Newsletter', 'manage_options', 'newsletter-config', 'ns_setting_page');
}
add_action('admin_menu', 'ns_add_admin_menu');
