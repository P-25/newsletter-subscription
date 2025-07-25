# Newsletter Subscription Plugin

WordPress plugin to collect user emails and subscribe them to third-party newsletter services (like Mailchimp, Sendinblue, ConvertKit, etc.).

## Features

- Newsletter form with email and optional name field
- AJAX form submission
- Admin settings page to configure:
  - API URL
  - API key/token
  - Field name for email and name
- Shortcode : `[newsletter_form]`
- Shows success/error messages after submission

## Installation

1. Add plugin to `/wp-content/plugins/`.
2. Activate the Plugins.
3. Go to **Settings > Configure Newsletter** and configure the API Endpoint and API keys.

## Usage

Add the shortcode `[newsletter_form]` to any post, page, or widget to display the form.

## Notes

- The form uses AJAX to submit data without refreshing the page.
- API requests are made using `wp_remote_post()` with nonce protection.
