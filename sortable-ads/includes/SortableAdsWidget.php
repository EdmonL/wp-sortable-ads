<?php
require_once plugin_dir_path(__FILE__) . 'SortableAds.php';

class SortableAdsWidget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'srtads',
            __('Sortable Ad', 'srtads'),
            [
                'description' => __('Displays a Sortable Ad.'),
                'customize_selective_refresh' => true
            ]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $tagName = $instance['ag_tag'];
        echo '<div class="ad-tag" data-ad-name="' . esc_attr($tagName) . '"';
        if ($instance['responsive']) {
            echo ' data-ad-size="auto"';
        } else {
            echo ' data-ad-size="' . esc_attr(SortableAds::adTagList()[$tagName]['size']) . '"';
        }
        if ($instance['sticky']) {
            echo ' data-ad-sticky="sidebar"';
        }
        $userRefresh = $instance['user_refresh'];
        $eventRefresh = $instance['event_refresh'];
        $timeRefresh = $instance['time_refresh'];
        if ($userRefresh || $eventRefresh || $timeRefresh) {
            echo ' data-ad-refresh="';
            $refresh = '';
            if ($userRefresh) {
                $refresh .= " user $instance[user_refresh_seconds]s";
            }
            if ($eventRefresh) {
                $refresh .= " event $instance[event_refresh_seconds]s";
            }
            if ($timeRefresh) {
                $refresh .= " time $instance[time_refresh_seconds]s";
            }
            echo trim($refresh) . '"';
        }
        echo '></div><script src="//tags-cdn.deployads.com/a/'
            . esc_attr(rawurlencode(get_option('srtads_settings')['site_domain']))
            . '.js" async></script><script>(deployads = window.deployads || []).push({});</script>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        echo '<p>';
        $args = [
            'id' => $this->get_field_id('ad_tag'),
            'name' => $this->get_field_name('ad_tag'),
            'class' => 'widefat',
            'ad_tags' => SortableAds::groupedAdTags(),
            'value' => empty($instance['ad_tag']) ? null : $instance['ad_tag']
        ];
        require plugin_dir_path(__FILE__) . 'views/ad-tag-select.php';
        echo '</p><p><label><input type="checkbox" class="checkbox" id="'
            . esc_attr($this->get_field_id('responsive')) . '" name="'
            . esc_attr($this->get_field_name('responsive')) . '"';
        if (!empty($instance['responsive'])) {
            echo " checked";
        }
        echo '/>' . esc_html__('Responsive if available', 'srtads') . '</label></p>';
    }

    public function update($newInstance, $oldInstance) {
        $adTags = SortableAds::adTagList();
        $tagName = key($adTags);
        if (!empty($newInstance['ad_tag'])) {
            $newName = $newInstance['ad_tag'];
            if (isset($adTags[$newName])) {
                $tagName = $newName;
            }
        }
        $newInstance['ad_tag'] = $tagName;
        $tag = $adTags[$tagName];
        $newInstance['responsive'] = !empty($newInstance['responsive']) && $tag['responsive'];
        $newInstance['sticky'] = !empty($newInstance['sticky']);
        $newInstance['user_refresh'] = !empty($newInstance['user_refresh']);
        if (!isset($newInstance['user_refresh_seconds'])) {
            $newInstance['user_refresh_seconds'] = '60';
        }
        $newInstance['event_refresh'] = !empty($newInstance['event_refresh']);
        if (!isset($newInstance['event_refresh_seconds'])) {
            $newInstance['event_refresh_seconds'] = '90';
        }
        $newInstance['time_refresh'] = !empty($newInstance['time_refresh']);
        if (!isset($newInstance['time_refresh_seconds'])) {
            $newInstance['time_refresh_seconds'] = '360';
        }
        return $newInstance;
    }
}
