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
            ['default' => ['site_domain' => home_url()]]
        );
        add_settings_field(
            'srtads_site_domain_field',
            __('Site Domain', 'srtads'),
            function () { $this->renderField('srtads_site_domain_field', 'site_domain', 'site-domain-field'); },
            'srtads_settings_page',
            'default',
            ['label_for' => 'srtads_site_domain_field']
        );
    }

    public function initMenus() {
        add_options_page(
            __('Sortable Ads Settings', 'srtads'),
            __('Sortable Ads', 'srtads'),
            'manage_options',
            'srtads_settings_page',
            function() { $this->renderPage('srtads_settings_page', 'settings-page'); }
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
}
