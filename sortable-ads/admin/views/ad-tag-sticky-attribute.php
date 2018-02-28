<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<label>
    <input id="srt_ad_tag_sticky" type="checkbox" name="sticky"/>
<?= esc_html__('Sticky', 'srtads') ?>
</label>
<label for="srt_ad_tag_sticky_top_padding"><?= esc_html__('with', 'srtads') ?></label>
<input id="srt_ad_tag_sticky_top_padding" type="number" class="small-text srtads-validate"
       name="sticky_top_padding" step="1" min="0" data-check="sticky"/>
<label for="srt_ad_tag_sticky_top_padding"><?= esc_html__('px top padding', 'srtads') ?></label>
