<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}
?>
<div id="srt_ad_tag_refresh">

<label for="srt_ad_tag_time_refresh">
    <?= esc_html__('Timer-triggered refresh', 'srtads') ?>
</label>
<select id="srt_ad_tag_time_refresh" name="time_refresh">
    <option value=""><?= esc_html__('none', 'srtads') ?></option>
    <option value="30s"><?= esc_html__('every 30 seconds', 'srtads') ?></option>
    <option value="60s"><?= esc_html__('every 60 seconds', 'srtads') ?></option>
    <option value="90s"><?= esc_html__('every 90 seconds', 'srtads') ?></option>
    <option value="120s"><?= esc_html__('every 120 seconds', 'srtads') ?></option>
    <option value="180s"><?= esc_html__('every 180 seconds', 'srtads') ?></option>
    <option value="240s"><?= esc_html__('every 240 seconds', 'srtads') ?></option>
    <option value="300s"><?= esc_html__('every 300 seconds', 'srtads') ?></option>
    <option value="360s"><?= esc_html__('every 360 seconds', 'srtads') ?></option>
</select>
<br/>
<label for="srt_ad_tag_event_refresh">
    <?= esc_html__('Event-triggered refresh', 'srtads') ?>
</label>
<select id="srt_ad_tag_event_refresh" name="event_refresh">
    <option value=""><?= esc_html__('none', 'srtads') ?></option>
    <option value="30s"><?= esc_html__('every 30 seconds', 'srtads') ?></option>
    <option value="60s"><?= esc_html__('every 60 seconds', 'srtads') ?></option>
    <option value="90s"><?= esc_html__('every 90 seconds', 'srtads') ?></option>
</select>
<br/>
<label for="srt_ad_tag_user_refresh">
    <?= esc_html__('User-triggered refresh', 'srtads') ?>
</label>
<select id="srt_ad_tag_user_refresh" name="user_refresh">
    <option value=""><?= esc_html__('none', 'srtads') ?></option>
    <option value="0s"><?= esc_html__('any time', 'srtads') ?></option>
    <option value="30s"><?= esc_html__('every 30 seconds', 'srtads') ?></option>
    <option value="60s"><?= esc_html__('every 60 seconds', 'srtads') ?></option>
</select>

</div>
