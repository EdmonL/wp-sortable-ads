<?php
require_once plugin_dir_path(__FILE__) . 'SortableAds.php';

final class SortableAdsWidget extends WP_Widget {
    const REFRESH_OPTIONS = [
        'time_refresh' => [
            '' => 'none',
            '30s' => 'every 30s',
            '60s' => 'every 60s',
            '90s' => 'every 90s',
            '120s' => 'every 120s',
            '180s' => 'every 180s',
            '240s' => 'every 240s',
            '300s' => 'every 300s',
            '360s' => 'every 360s'
        ],
        'event_refresh' => [
            '' => 'none',
            '30s' => 'every 30s',
            '60s' => 'every 60s',
            '90s' => 'every 90s'
        ],
        'user_refresh' => [
            '' => 'none',
            '0s' => 'any time',
            '30s' => 'every 30s',
            '60s' => 'every 60s'
        ]
    ];

    public function __construct() {
        parent::__construct(
            'srtads',
            __('Sortable Ad', 'srtads'),
            [
                'description' => __('Displays a Sortable Ad.', 'srtads'),
                'customize_selective_refresh' => true
            ]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $tagName = $instance['ad_tag'];
        echo '<div class="ad-tag" data-ad-name="' . esc_attr($tagName) . '"';
        if ($instance['responsive']) {
            echo ' data-ad-size="auto"';
        } else {
            echo ' data-ad-size="' . esc_attr(SortableAds::adTagList()[$tagName]['size']) . '"';
        }
        $timeRefresh = $instance['time_refresh'];
        $eventRefresh = $instance['event_refresh'];
        $userRefresh = $instance['user_refresh'];
        if ($timeRefresh || $eventRefresh || $userRefresh) {
            $refresh = '';
            if ($timeRefresh) {
                $refresh .= " time $timeRefresh";
            }
            if ($eventRefresh) {
                $refresh .= " event $eventRefresh";
            }
            if ($userRefresh) {
                $refresh .= " user $userRefresh";
            }
            echo ' data-ad-refresh="' . trim($refresh) . '"';
        }
        if ($instance['sticky']) {
            echo ' data-ad-sticky="sidebar';
            if ($instance['sticky_top_padding']) {
                echo " $instance[sticky_top_padding]px";
            }
            echo '"';
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
        echo '</p><p>';
        $this->renderFormCheckbox('responsive', 'Responsive if available', $instance);
        echo '</p><p>';
        $this->renderFormSelect('time_refresh', 'Timer-triggered refresh', $instance);
        echo '<br/>';
        $this->renderFormSelect('event_refresh', 'Event-triggered refresh', $instance);
        echo '<br/>';
        $this->renderFormSelect('user_refresh', 'User-triggered refresh', $instance);
        echo '</p><p>';
        $this->renderFormCheckbox('sticky', 'Sticky with', $instance);
        $id = esc_attr($this->get_field_id('sticky_top_padding'));
        echo " <input id=\"$id\" type=\"number\" class=\"small-text srtads-validate\" name=\""
            . esc_attr($this->get_field_name('sticky_top_padding'))
            . '" step="1" min="0" value="';
        echo empty($instance['sticky_top_padding']) ? 0 : $instance['sticky_top_padding'];
        echo '"/>';
        echo " <label for=\"$id\">";
        esc_html_e('px top padding', 'srtads');
        echo '</label>';
        echo '</p>';
        $responsiveTags = array_map(
            function () { return true; },
            array_filter(SortableAds::adTagList(), function ($tag) { return $tag['responsive']; })
        );
?>
<script>
(function () {
var widgetContentEl = window.document.scripts[window.document.scripts.length - 1].parentElement;
jQuery(function () {
    var $ = jQuery;
    var responsiveTags = <?= json_encode($responsiveTags) ?>;
    var $responsiveCheckbox = $('input[type=checkbox][name$="[responsive]"]', widgetContentEl);
    $('select[name$="[ad_tag]"]', widgetContentEl).on('change', function () {
        $responsiveCheckbox.prop('disabled', !responsiveTags[$(this).val()]);
    }).change();
    var $stickyCheckbox = $('input[type=checkbox][name$="[sticky]"]', widgetContentEl);
    $('input[name$="[sticky_top_padding]"]', widgetContentEl).on('input', function () {
        $stickyCheckbox.prop('checked', true);
    });
});
})();
</script>
<?php
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
        foreach (array_keys(self::REFRESH_OPTIONS) as $field) {
            $newInstance = self::sanitizeRefresh($field, $newInstance);
        }
        $newInstance['sticky'] = !empty($newInstance['sticky']);
        if (empty($newInstance['sticky_top_padding'])) {
            $newInstance['sticky_top_padding'] = 0;
        } else {
            $newInstance['sticky_top_padding'] = max(0, intval($newInstance['sticky_top_padding']));
        }
        return $newInstance;
    }

    private function renderFormSelect($field, $label, $instance) {
        $value = $instance[$field];
        $id = esc_attr($this->get_field_id($field));
        echo "<label for=\"$id\" style=\"min-width: 11em; display: inline-block\">";
        esc_html_e($label, 'srtads');
        echo '</label>';
        echo "<select id=\"$id\" name=\"" . esc_attr($this->get_field_name($field)) . '" style="min-width: 7em">';
        foreach (self::REFRESH_OPTIONS[$field] as $optVal => $label) {
            echo "<option value=\"$optVal\"";
            if ($value === $optVal) {
                echo ' selected';
            }
            echo '>';
            esc_html_e($label, 'srtads');
            echo '</option>';
        }
        echo '</select>';
    }

    private function renderFormCheckbox($field, $label, $instance) {
        echo '<label>';
        echo '<input type="checkbox" class="checkbox"';
        echo ' id="' . esc_attr($this->get_field_id($field)) . '"';
        echo ' name="' . esc_attr($this->get_field_name($field)) . '"';
        if (!empty($instance[$field])) {
            echo " checked";
        }
        echo '/>';
        esc_html_e($label, 'srtads');
        echo '</label>';
    }

    private static function sanitizeRefresh($field, $instance) {
        $options = self::REFRESH_OPTIONS[$field];
        if (empty($instance[$field]) || !isset($options[$instance[$field]])) {
            $instance[$field] = '';
        }
        return $instance;
    }
}
