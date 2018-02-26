<?php
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
            function () { $this->renderSetting('site-domain-field', 'site_domain', ['id' => 'srtads_site_domain_field']); },
            'srtads_settings_page',
            'srtads_default_section',
            ['label_for' => 'srtads_site_domain_field']
        );

        add_settings_section('srtads_default_section', null, null, 'srtads_ad_tags_page');
        add_settings_field(
            'srtads_ad_tag_attributes',
            __('Attributes', 'srtads'),
            function () { $this->renderView('ad-tag-attributes'); },
            'srtads_ad_tags_page',
            'srtads_default_section'
        );
        add_settings_field(
            'srtads_ad_tag_list',
            __('Ad Tag', 'srtads'),
            function () { $this->renderView('ad-tag-list', ['ad_tags' => $this->groupedAdTags()]); },
            'srtads_ad_tags_page',
            'srtads_default_section'
        );
    }

    public function initMenus() {
        $renderAdTagsPage = function () {
            require_once __DIR__ . '/../includes/SortableAds.php';
            $this->renderView('ad-tags-page', [
                'page' => 'srtads_ad_tags_page',
                'site_domain' => get_option('srtads_settings')['site_domain'],
                'ad_tags' => $this->adTagList()
            ]);
        };
        $adTagsTitle = __('Sortable Ad Tags', 'srtads');
        add_menu_page(
            $adTagsTitle,
            __('Sortable Ads', 'srtads'),
            'administrator',
            'srtads_ad_tags_page',
            $renderAdTagsPage
        );
        add_submenu_page(
            'srtads_ad_tags_page',
            $adTagsTitle,
            __('Ad Tags', 'srtads'),
            'administrator',
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
    }

    public function loadScripts($pageHook) {
        switch ($pageHook) {
            case 'toplevel_page_srtads_ad_tags_page':
                wp_enqueue_script('jquery');
                wp_enqueue_style('srtads_admin_style', plugins_url('css/style.css', __FILE__));
                break;
            default:
                break;
        }
    }

    public function renderSetting($view, $name, array $args = []) {
        $args['name'] = "srtads_settings[$name]";
        $args['value'] = get_option('srtads_settings')[$name];
        $this->renderView($view, $args);
    }

    public function renderView($view, array $args = []) {
        require self::VIEWS_DIR . $view . '.php';
    }

    public static function sanitizeSettings(array $settings) {
        $output = get_option('srtads_settings');
        $domain = sanitize_text_field($settings['site_domain']);
        if (preg_match('/^[a-z](([-a-z0-9])*[a-z0-9])?(\\.[a-z](([-a-z0-9])*[a-z0-9])?)+$/i', $domain)) {
            $output['site_domain'] = $domain;
        } else {
            add_settings_error('srtads_settings', 'invalid_site_domain', __('Please enter a valid site domain.', 'srtads'));
        }
        return $output;
    }

    public function groupedAdTags() {
        require_once __DIR__ . '/../includes/SortableAds.php';

        $adTags = [];
        foreach (SortableAds::AD_TAGS as $format => $tags) {
            $adTags[self::adTagGroup($format, $tags)] = $tags['names'];
        }
        return $adTags;
    }

    public function adTagList() {
        require_once __DIR__ . '/../includes/SortableAds.php';

        $adTags = [];
        foreach (SortableAds::AD_TAGS as $format => $tags) {
            $group = self::adTagGroup($format, $tags);
            $size = SortableAds::formatSize($tags['size']);
            $responsive = isset($tags['responsive_sizes']);
            foreach ($tags['names'] as $name) {
                $adTags[$name] = [
                    'group' => $group,
                    'size' => $size,
                    'responsive' => $responsive
                ];
            }
        }
        return $adTags;
    }

    private function adTagGroup($format, array $formatData) {
        require_once __DIR__ . '/../includes/SortableAds.php';

        return "$format - " . SortableAds::formatSize($formatData['size'])
            . (isset($formatData['responsive_sizes'])
            ? ' (mobile size ' . SortableAds::formatSizes($formatData['responsive_sizes']) . ')'
            : '');
    }
}
