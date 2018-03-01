<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<label>
    <input id="srt_ad_tag_responsive" type="checkbox" name="responsive"
           aria-describedby="srt_ad_tag_responsive_description"/>
<?= esc_html__('Only available for the ad tags with multiple sizes.', 'sortable-ads') ?>
</label>
<p class="description" id="srt_ad_tag_responsive_description">
<?= esc_html__('Ads that have multiple sizes can be responsive. If this is not checked, the ad will always serve the larger size. Responsive ads will serve the largest size that will fit in the parent container of the ad unit. For example if you are using "Sortable_Leaderboard1" in a full width banner on your page. When the banner\'s inner width is 728px or greater, the 728x90 size will serve. When the banner\'s inner width is less than 728px, the ad will serve a 300x250 creative.', 'sortable-ads') ?>
<p>
