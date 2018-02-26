<fieldset id="srt_ad_tag_refresh">
<legend class="screen-reader-text"><span><?= esc_html_e('ad tag refresh attribute', 'srtads') ?></span></legend>
<table><tbody>
    <tr>
        <td>
            <label>
                <input id="srt_ad_tag_user_refresh" type="checkbox"/>
                <span class="label"><?= esc_html_e('User-triggered refresh', 'srtads') ?></span>
            </label>
        </td>
        <td>
            <label class="screen-reader-text" for="srt_ad_tag_user_refresh_seconds">
                <?= esc_html_e('minimal refresh interval', 'srtads') ?>
            </label>
            <select id="srt_ad_tag_user_refresh_seconds">
                <option value="0"><?= esc_html_e('without limit', 'srtads') ?></option>
                <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
                <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label>
                <input id="srt_ad_tag_event_refresh" type="checkbox"/>
                <span class="label"><?= esc_html_e('Event-triggered refresh', 'srtads') ?></span>
            </label>
        </td>
        <td>
            <label class="screen-reader-text" for="srt_ad_tag_event_refresh_seconds">
                <?= esc_html_e('minimal refresh interval', 'srtads') ?>
            </label>
            <select id="srt_ad_tag_event_refresh_seconds">
                <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
                <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
                <option value="90"><?= esc_html_e('every 90 seconds', 'srtads') ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label>
                <input id="srt_ad_tag_time_refresh" type="checkbox"/>
                <span class="label"><?= esc_html_e('Timer-based refresh', 'srtads') ?></span>
            </label>
        </td>
        <td>
            <label class="screen-reader-text" for="srt_ad_tag_time_refresh_seconds">
                <?= esc_html_e('minimal refresh interval', 'srtads') ?>
            </label>
            <select id="srt_ad_tag_time_refresh_seconds">
                <option value="30"><?= esc_html_e('every 30 seconds', 'srtads') ?></option>
                <option value="60"><?= esc_html_e('every 60 seconds', 'srtads') ?></option>
                <option value="90"><?= esc_html_e('every 90 seconds', 'srtads') ?></option>
                <option value="120"><?= esc_html_e('every 120 seconds', 'srtads') ?></option>
                <option value="180"><?= esc_html_e('every 180 seconds', 'srtads') ?></option>
                <option value="240"><?= esc_html_e('every 240 seconds', 'srtads') ?></option>
                <option value="300"><?= esc_html_e('every 300 seconds', 'srtads') ?></option>
                <option value="360"><?= esc_html_e('every 360 seconds', 'srtads') ?></option>
            </select>
        </td>
    </tr>
</tbody></table>
</fieldset>
