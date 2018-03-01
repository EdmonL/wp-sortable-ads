<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

$id = esc_attr($args['id']);
$name = esc_attr($args['name']);
echo "<select id=\"$id\" name=\"$name\"";
if (!empty($args['class'])) {
    echo ' class="' . esc_attr($args['class']) . '"';
}
if (!empty($args['description'])) {
    echo " aria-describedby=\"${id}_description\"";
}
echo '>';
$value = empty($args['value']) ? null : $args['value'];
foreach ($args['ad_tags'] as $group => $tags) {
    echo '<optgroup label="' . esc_attr__($group, 'sortable-ads') . '">';
    foreach ($tags as $tag) {
        echo '<option value="' . esc_attr($tag) . '"';
        if ($tag === $value) {
           echo ' selected';
        }
        echo '>';
        esc_html_e($tag, 'sortable-ads');
        echo '</option>';
    }
    echo '</optgroup>';
}
echo '</select>';
if (!empty($args['description'])) {
    echo "<p class=\"description\" id=\"${id}_description\">";
    esc_html_e($args['description']);
    echo '</p>';
}
