<div id="srt_ad_tag_refresh">
<label>
    <input id="srt_ad_tag_user_refresh" type="checkbox" name="user_refresh"/>
    <span class="label"><?= esc_html_e('User-triggered refresh', 'srtads') ?></span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_user_refresh_seconds">
    <?= esc_html_e('minimal refresh interval', 'srtads') ?>
</label>
<select id="srt_ad_tag_user_refresh_seconds" name="user_refresh_seconds" data-check="user_refresh">
    <option value="0"><?= esc_html_e('without limit', 'srtads') ?></option>
    <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
    <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
</select>
<br/>
<label>
    <input id="srt_ad_tag_event_refresh" type="checkbox" name="event_refresh"/>
    <span class="label"><?= esc_html_e('Event-triggered refresh', 'srtads') ?></span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_event_refresh_seconds">
    <?= esc_html_e('minimal refresh interval', 'srtads') ?>
</label>
<select id="srt_ad_tag_event_refresh_seconds" name="event_refresh_seconds" data-check="event_refresh">
    <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
    <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
    <option value="90"><?= esc_html_e('every 90 seconds', 'srtads') ?></option>
</select>
<br/>
<label>
    <input id="srt_ad_tag_time_refresh" type="checkbox" name="time_refresh"/>
    <span class="label"><?= esc_html_e('Timer-based refresh', 'srtads') ?></span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_time_refresh_seconds">
    <?= esc_html_e('minimal refresh interval', 'srtads') ?>
</label>
<select id="srt_ad_tag_time_refresh_seconds" name="time_refresh_seconds" data-check="time_refresh">
    <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
    <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
    <option value="90"><?= esc_html_e('every 90 seconds', 'srtads') ?></option>
    <option value="120"><?= esc_html_e('every 120 seconds', 'srtads') ?></option>
    <option value="180"><?= esc_html_e('every 180 seconds', 'srtads') ?></option>
    <option value="240"><?= esc_html_e('every 240 seconds', 'srtads') ?></option>
    <option value="300"><?= esc_html_e('every 300 seconds', 'srtads') ?></option>
    <option value="360"><?= esc_html_e('every 360 seconds', 'srtads') ?></option>
</select>
</div>
