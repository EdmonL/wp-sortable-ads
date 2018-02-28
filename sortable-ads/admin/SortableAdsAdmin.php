<?php
require_once plugin_dir_path(__FILE__) . '../includes/SortableAds.php';

final class SortableAdsAdmin {
    const VIEWS_DIR = __DIR__ . '/views/';

    public function run() {
        add_action('admin_init', [$this, 'initSettings']);
        add_action('admin_menu', [$this, 'initMenus']);
        add_action('admin_enqueue_scripts', [$this, 'loadScripts']);
    }

    public function initSettings() {
        register_setting(
            'srtads',
            'srtads_settings',
            [
                'default' => ['site_domain' => preg_replace('/^http:\\/\\/(www\\.)?/i', '', home_url('', 'http'), 1)],
                'sanitize_callback' => __CLASS__ . '::sanitizeSettings'
            ]
        );
        add_settings_section('srtads_default_section', null, null, 'srtads_settings_page');
        add_settings_field(
            'srtads_site_domain_field',
            __('Site Domain', 'srtads'),
            function () {
                $this->renderView(
                    'site-domain-field',
                    [
                        'name' => 'srtads_settings[site_domain]',
                        'value' => get_option('srtads_settings')['site_domain']
                    ]
                );
            },
            'srtads_settings_page',
            'srtads_default_section',
            ['label_for' => 'srtads_site_domain_field']
        );

        add_settings_section('srtads_default_section', null, null, 'srtads_ad_tags_page');
        add_settings_field(
            'srtads_ad_tag_list',
            __('Ad Tag', 'srtads'),
            function () { $this->renderView('ad-tag-list', ['ad_tags' => SortableAds::groupedAdTags()]); },
            'srtads_ad_tags_page',
            'srtads_default_section',
            ['label_for' => 'srt_ad_tag_list']
        );
        add_settings_field(
            'srtads_ad_tag_responsive_attribute',
            __('Responsive', 'srtads'),
            function () { $this->renderView('ad-tag-responsive-attribute'); },
            'srtads_ad_tags_page',
            'srtads_default_section',
            ['label_for' => 'srt_ad_tag_responsive']
        );
        add_settings_field(
            'srtads_ad_tag_refresh_attribute',
            __('Refresh', 'srtads'),
            function () { $this->renderView('ad-tag-refresh-attribute'); },
            'srtads_ad_tags_page',
            'srtads_default_section'
        );
        add_settings_field(
            'srtads_ad_tag_sticky_attribute',
            __('Siderbar Sticky', 'srtads'),
            function () { $this->renderView('ad-tag-sticky-attribute'); },
            'srtads_ad_tags_page',
            'srtads_default_section',
            ['label_for' => 'srt_ad_tag_sticky']
        );
    }

    public function initMenus() {
        $renderAdTagsPage = function () {
            $this->renderView('ad-tags-page', [
                'page' => 'srtads_ad_tags_page',
                'site_domain' => get_option('srtads_settings')['site_domain'],
                'ad_tags' => SortableAds::adTagList()
            ]);
        };
        $adTagsTitle = __('Sortable Ad Tags', 'srtads');
        add_menu_page(
            $adTagsTitle,
            __('Sortable Ads', 'srtads'),
            'read',
            'srtads_ad_tags_page',
            $renderAdTagsPage
        );
        add_submenu_page(
            'srtads_ad_tags_page',
            $adTagsTitle,
            __('Ad Tags', 'srtads'),
            'read',
            'srtads_ad_tags_page',
            $renderAdTagsPage
        );
        add_submenu_page(
            'srtads_ad_tags_page',
            __('Sortable Ads Settings', 'srtads'),
            __('Settings', 'srtads'),
            'manage_options',
            'srtads_settings_page',
            function () { $this->renderView('settings-page', ['page' => 'srtads_settings_page']); }
        );
        add_submenu_page(
            'srtads_ad_tags_page',
            __('Sortable Ads Help', 'srtads'),
            __('Help', 'srtads'),
            'read',
            'srtads_help_page',
            function () { $this->renderView('help-page'); }
        );
    }

    public function loadScripts($pageHook) {
        switch ($pageHook) {
            case 'toplevel_page_srtads_ad_tags_page':
            case 'widgets.php':
                wp_enqueue_style('srtads_style', plugins_url('css/style.css', __FILE__));
                wp_enqueue_script('jquery');
                break;
            case 'sortable-ads_page_srtads_settings_page':
                wp_enqueue_style('srtads_style', plugins_url('css/style.css', __FILE__));
            default:
                echo '<script>console.log("' . $pageHook . '")</script>';
                break;
        }
    }

    public function renderView($view, array $args = []) {
        require self::VIEWS_DIR . $view . '.php';
    }

    public static function sanitizeSettings(array $settings) {
        $output = get_option('srtads_settings');
        $domain = sanitize_text_field($settings['site_domain']);
        if (preg_match('/^[a-z]([-a-z0-9]*[a-z0-9])?(\\.[a-z]([-a-z0-9]*[a-z0-9])?)+$/i', $domain)) {
            $output['site_domain'] = $domain;
        } else {
            add_settings_error('srtads_settings', 'invalid_site_domain', __('Please enter a valid site domain.', 'srtads'));
        }
        return $output;
    }
}
