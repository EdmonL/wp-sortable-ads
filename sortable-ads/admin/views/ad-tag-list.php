<select id="srt_ad_tag_list">
<?php
foreach ($args['ad_tags'] as $group => $tags) {
    echo '<optgroup label="' . esc_attr($group) . '">';
    foreach ($tags as $tag) {
        echo '<option value="' . esc_attr($tag) . '">' . esc_html($tag) . '</option>';
    }
    echo '</optgroup>';
}
?>
</select>
<p class="description" id="srt_ad_tag_list_description"></p>
