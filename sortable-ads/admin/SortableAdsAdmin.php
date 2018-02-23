<?php
class SortableAdsAdmin {
    protected $viewsDir;

    public function __construct() {
        $this->viewsDir = plugin_dir_path(__FILE__) . 'views/';
    }

    public function run() {
        add_action('admin_init', [$this, 'initSettings']);
        add_action('admin_menu', [$this, 'initMenus']);
    }

    public function initSettings() {
        register_setting(
            'srtads',
            'srtads_settings',
            [
                'default' => ['site_domain' => preg_replace('/^http:\\/\\/(www\\.)?/i', '', home_url('', 'http'), 1)],
                'sanitize_callback' => [$this, 'sanitizeSettings']
            ]
        );
        add_settings_section('srtads_default_section', null, null, 'srtads_settings_page');
        add_settings_field(
            'srtads_site_domain_field',
            __('Site Domain', 'srtads'),
            function () { $this->renderField('srtads_site_domain_field', 'site_domain', 'site-domain-field'); },
            'srtads_settings_page',
            'srtads_default_section',
            ['label_for' => 'srtads_site_domain_field']
        );
    }

    public function initMenus() {
        add_options_page(
            __('Sortable Ads Settings', 'srtads'),
            __('Sortable Ads', 'srtads'),
            'manage_options',
            'srtads_settings_page',
            function () { $this->renderPage('srtads_settings_page', 'settings-page'); }
        );
    }

    public function renderField($id, $name, $view) {
        $settings = get_option('srtads_settings');
        $value = $settings[$name];
        $name = "srtads_settings[$name]";
        require $this->viewsDir . $view . '.php';
    }

    public function renderPage($page, $view) {
        require $this->viewsDir . $view . '.php';
    }

    public function sanitizeSettings($settings) {
        $output = get_option('srtads_settings');
        $domain = sanitize_text_field($settings['site_domain']);
        if (preg_match('/^[a-z](([-a-z0-9])*[a-z0-9])?(\\.[a-z](([-a-z0-9])*[a-z0-9])?)+$/i', $domain)) {
            $output['site_domain'] = $domain;
        } else {
            add_settings_error('srtads_settings', 'invalid_site_domain', __('Please enter a valid site domain.', 'srtads'));
        }
        return $output;
    }
}
