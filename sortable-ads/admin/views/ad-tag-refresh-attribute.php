<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

function renderSelect($name, $label, array $options, $description) {
    $id = "srt_ad_tag_$name";
    $descId = "${id}_description";
    echo "<label for=\"$id\" style=\"min-width: 11em; display: inline-block\">";
    esc_html_e($label, 'sortable-ads');
    echo '</label>';
    echo "<select id=\"$id\" name=\"$name\" style=\"min-width: 10.5em\" aria-describedby=\"$descId\">";
    foreach ($options as $value => $option) {
        echo "<option value=\"$value\">";
        esc_html_e($option, 'sortable-ads');
        echo '</option>';
    }
    echo '</select>';
    echo "<p class=\"description\" id=\"$descId\">";
    esc_html_e($description, 'sortable-ads');
    echo '</p>';
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
], 'Ad unit will refresh after a certain period of time in the viewport.');
echo '<br/>';
renderSelect('event_refresh', 'Event-triggered refresh', [
    '' => 'none',
    '30s' => 'every 30 seconds',
    '60s' => 'every 60 seconds',
    '90s' => 'every 90 seconds'
], 'This option will allow event refreshes. The refreshes must be triggered with javascript code. See advanced section of help page.');
echo '<br/>';
renderSelect('user_refresh', 'User-triggered refresh', [
    '' => 'none',
    '0s' => 'any time',
    '30s' => 'every 30 seconds',
    '60s' => 'every 60 seconds'
], 'This option will allow user refreshes. The refreshes must be triggered with javascript code. See advanced section of help page.');
echo '<br/>';
echo '<p class="description">';
esc_html_e('Refreshing ads could increase revenue, but it could also cause lower eCPM.', 'sortable-ads');
echo '</p>';
