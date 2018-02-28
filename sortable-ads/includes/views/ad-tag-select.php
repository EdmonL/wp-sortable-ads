<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

echo '<select id="' . esc_attr($args['id']) . '" name="' . esc_attr($args['name']) . '"';
if (!empty($args['class'])) {
    echo ' class="' . esc_attr($args['class']) . '"';
}
echo '>';
$value = empty($args['value']) ? null : $args['value'];
foreach ($args['ad_tags'] as $group => $tags) {
    echo '<optgroup label="' . esc_attr__($group, 'srtads') . '">';
    foreach ($tags as $tag) {
        echo '<option value="' . esc_attr($tag) . '"';
        if ($tag === $value) {
           echo ' selected';
        }
        echo '>';
        esc_html_e($tag, 'srtads');
        echo '</option>';
    }
    echo '</optgroup>';
}
echo '</select>';
