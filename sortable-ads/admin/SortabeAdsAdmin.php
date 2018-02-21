<?php
class SortableAdsAdmin {
    const SETTINGS_PAGE_VIEW = plugin_dir_path(__FILE__) . 'views/settings-page.php',

    public function run() {
        add_action('admin_init', [$this, 'initSettings']);
        add_action('admin_menu', [$this, 'initMenus']);
    }

    public function initSettings() {
        register_setting(
            'srtads',
            'srtads_options',
            ['default' => ['srtads_field_site_domain' => home_url()]]
        );
        add_settings_field(
            'srtads_field_site_domain',
            __('Site Domain', 'srtads'),
            [$this, 'renderSiteDomainField'],
            static::SETTINGS_PAGE_VIEW,
            'default',
            ['label_for' => 'srtads_field_site_domain']
        );
    }

    public function renderSiteDomainField($args) {
        $settings = get_option('srtads_options');
        $key = $args['label_for'];
        $value = $settings[$key];
?>
<input type="text" name="srtads_options[<?= $key ?>]" value="<?= esc_attr($value) ?>"/>
<p class="description">Sortable uses this domain to identify the site. It may be different from the real domain of the site</p>
<?php
    }

    public function initMenus() {
        add_options_page(
            __('Sortable Ads Settings', 'srtads'),
            __('Sortable Ads', 'srtads'),
            'manage_options',
            static::SETTINGS_PAGE_VIEW,
            null
        );
    }
}
