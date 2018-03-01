<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<label>
    <input id="srt_ad_tag_sticky" type="checkbox" name="sticky"
           aria-describedby="srt_ad_tag_sticky_top_padding_description"/>
<?= esc_html__('Sticky with', 'sortable-ads') ?>
</label>
<input id="srt_ad_tag_sticky_top_padding" type="number" class="small-text srtads-validate"
       name="sticky_top_padding" step="1" min="0" data-check="sticky"/>
<label for="srt_ad_tag_sticky_top_padding"><?= esc_html__('px top padding', 'sortable-ads') ?></label>
<p class="description" id="srt_ad_tag_sticky_top_padding_description">
<?= esc_html__('Sticky ads are ads which are always visible in the viewport. Sticky ads do not scroll with scrolling content. Our sticky functionality allows for a header padding above the ad. Sticky is an advanced feature that may not work with all themes.', 'sortable-ads') ?>
</p>
