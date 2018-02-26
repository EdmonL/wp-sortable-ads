<select id="srt_ad_tag_list" name="selected_tag">
<?php
foreach ($args['ad_tags'] as $group => $tags) {
    echo '<optgroup label="' . esc_attr(__($group, 'srtads')) . '">';
    foreach ($tags as $tag) {
        echo '<option value="' . esc_attr($tag) . '">' . esc_html(__($tag, 'srtads')) . '</option>';
    }
    echo '</optgroup>';
}
?>
</select>
<p class="description" id="srt_ad_tag_list_description"></p>
