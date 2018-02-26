<?php
$adTags = [];
foreach ($args['ad_tags'] as $name => $tag) {
    $tag['size'] = esc_attr($tag['size']);
    $adTags[esc_attr($name)] = $tag;
}
$siteDomain = esc_attr(rawurlencode($args['site_domain']));
?>
<div class="wrap srtads">
    <h1><?= esc_html(get_admin_page_title()) ?></h1>
    <?php do_settings_sections($args['page']); ?>
    <button class="button">Copy HTML code to clipboard</button>
    <pre id="srt_ad_tag_code"></pre>
</div>
<script>
jQuery(function() {
    var $ = jQuery;
    var currentData = {};
    var scriptsCode = '<script src="//tags-cdn.deployads.com/a/<?= $siteDomain ?>.js" async></' + 'script>\n' +
                      '<script>(deployads = window.deployads || []).push({});</' + 'script>';
    var adTags = <?= json_encode($adTags) ?>;

    function tagCode(data) {
        var tagName = data['selected_tag'];
        var tagData = adTags[tagName];
        var code = '<div class="ad-tag" data-ad-name="' + tagName + '"';
        if (data['responsive'] && tagData['responsive']) {
            code += ' data-ad-size="auto"';
        } else {
            code += ' data-ad-size="' + tagData['size'] + '"';
        }
        if (data['sticky']) {
            code += ' data-ad-sticky="sidebar"';
        }
        var userRefresh = data['user_refresh'];
        var eventRefresh = data['event_refresh'];
        var timeRefresh = data['time_refresh'];
        if (userRefresh || eventRefresh || timeRefresh) {
            code += ' data-ad-refresh="';
            var refresh = '';
            if (userRefresh) {
                refresh += ' user ' + data['user_refresh_seconds'] + 's';
            }
            if (eventRefresh) {
                refresh += ' event ' + data['event_refresh_seconds'] + 's';
            }
            if (timeRefresh) {
                refresh += ' time ' + data['time_refresh_seconds'] + 's';
            }
            code += refresh.trim() + '"';
        }
        return code + '></div>\n' + scriptsCode;
    }

    function renderCheckbox(id, oldChecked, newChecked) {
        if (oldChecked !== newChecked) {
            $('#' + id).prop('checked', Boolean(newChecked));
        }
    }

    function renderInput(id, oldValue, newValue) {
        if (oldValue !== newValue) {
            $('#' + id).val(newValue);
        }
    }

    function updateData(data) {
        if (currentData === data) {
            return;
        }
        var responsive = data['responsive'];
        var tagName = data['selected_tag'];
        var tagData = adTags[tagName];
        var currentTagName = currentData['selected_tag'];
        if (responsive !== currentData['responsive'] || tagName !== currentTagName) {
            var enabled = tagData['responsive'];
            $('#srt_ad_tag_responsive').prop({
                disabled: !enabled,
                checked: Boolean(enabled && responsive)
            });
        }
        renderCheckbox('srt_ad_tag_sticky', currentData['sticky'], data['sticky']);
        renderCheckbox('srt_ad_tag_user_refresh', currentData['user_refresh'], data['user_refresh']);
        renderInput('srt_ad_tag_user_refresh_seconds', currentData['user_refresh_seconds'], data['user_refresh_seconds']);

        renderCheckbox('srt_ad_tag_event_refresh', currentData['event_refresh'], data['event_refresh']);
        renderInput('srt_ad_tag_event_refresh_seconds', currentData['event_refresh_seconds'], data['event_refresh_seconds']);
        renderCheckbox('srt_ad_tag_time_refresh', currentData['time_refresh'], data['time_refresh']);
        renderInput('srt_ad_tag_time_refresh_seconds', currentData['time_refresh_seconds'], data['time_refresh_seconds']);
        if (currentTagName !== tagName) {
            $('#srt_ad_tag_list').val(tagName);
            $('#srt_ad_tag_list_description').text(tagData['group']);
        }
        $('#srt_ad_tag_code').text(tagCode(data));
        currentData = data;
        window.sessionStorage.setItem('srt_ad_tag_data', JSON.stringify(data));
    }

    var initData = window.sessionStorage.getItem('srt_ad_tag_data');
    if (initData) {
        initData = JSON.parse(initData);
    } else {
        initData = {
            'responsive': false,
            'sticky': false,
            'user_refresh': false,
            'user_refresh_seconds': '60',
            'event_refresh': false,
            'event_refresh_seconds': '90',
            'time_refresh': false,
            'time_refresh_seconds': '360',
            'selected_tag': 'Sortable_Banner1'
        };
    }
    updateData(initData);


  //  $('#srt_ad_tag_list').on('change', function () {
   // }).change();
});
</script>
