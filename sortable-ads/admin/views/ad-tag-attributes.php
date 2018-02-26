<fieldset id="srt_ad_tag_attributes">

<legend class="screen-reader-text"><span>Ad Tag Attributes</span></legend>
<label>
    <input id="srt_ad_tag_responsive" type="checkbox"/>
    <span class="label">Responsive</span>
</label>
<br/>

<label>
    <input id="srt_ad_tag_sticky" type="checkbox"/>
    <span class="label">Sticky</span>
</label>
<br/>

<label>
    <input id="srt_ad_tag_user_refresh" type="checkbox"/>
    <span class="label">User-triggered refresh </span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_user_refresh_seconds">Minimal refresh interval</label>
<select id="srt_ad_tag_user_refresh_seconds">
    <option value="0">without limit</option>
    <option value="30">every 30 seconds</option>
    <option value="60">every 60 seconds</option>
</select>
<br/>

<label>
    <input id="srt_ad_tag_event_refresh" type="checkbox"/>
    <span class="label">Event-triggered refresh </span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_event_refresh_seconds">Minimal refresh interval</label>
<select id="srt_ad_tag_event_refresh_seconds">
    <option value="30">every 30 seconds</option>
    <option value="60">every 60 seconds</option>
    <option value="90">every 90 seconds</option>
</select>
<br/>

<label>
    <input id="srt_ad_tag_time_refresh" type="checkbox"/>
    <span class="label">Timer-based refresh </span>
</label>
<label class="screen-reader-text" for="srt_ad_tag_time_refresh_seconds">Minimal refresh interval</label>
<select id="srt_ad_tag_time_refresh_seconds">
    <option value="30">every 30 seconds</option>
    <option value="60">every 60 seconds</option>
    <option value="90">every 90 seconds</option>
    <option value="120">every 120 seconds</option>
    <option value="180">every 180 seconds</option>
    <option value="240">every 240 seconds</option>
    <option value="300">every 300 seconds</option>
    <option value="360">every 360 seconds</option>
</select>

</fieldset>
