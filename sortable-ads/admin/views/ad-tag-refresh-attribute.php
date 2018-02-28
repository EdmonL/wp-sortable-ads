<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

function renderSelect($name, $label, array $options) {
    $id = "srt_ad_tag_$name";
    echo "<label for=\"$id\" style=\"min-width: 11em; display: inline-block\">";
    esc_html_e($label, 'srtads');
    echo '</label>';
    echo "<select id=\"$id\" name=\"$name\" style=\"min-width: 10.5em\">";
    foreach ($options as $value => $option) {
        echo "<option value=\"$value\">";
        esc_html_e($option, 'srtads');
        echo '</option>';
    }
    echo '</select>';
}

renderSelect('time_refresh', 'Timer-triggered refresh', [
    '' => 'none',
    '30s' => 'every 30 seconds',
    '60s' => 'every 60 seconds',
    '90s' => 'every 90 seconds',
    '120s' => 'every 120 seconds',
    '180s' => 'every 180 seconds',
    '240s' => 'every 240 seconds',
    '300s' => 'every 300 seconds',
    '360s' => 'every 360 seconds'
]);
echo '<br/>';
renderSelect('event_refresh', 'Event-triggered refresh', [
    '' => 'none',
    '30s' => 'every 30 seconds',
    '60s' => 'every 60 seconds',
    '90s' => 'every 90 seconds'
]);
echo '<br/>';
renderSelect('user_refresh', 'User-triggered refresh', [
    '' => 'none',
    '0s' => 'any time',
    '30s' => 'every 30 seconds',
    '60s' => 'every 60 seconds'
]);
