<?php
$adTags = [];
foreach ($args['ad_tags'] as $name => $tag) {
    $tag['size'] = esc_attr($tag['size']);
    $tag['group'] = __($tag['group'], 'srtads');
    $tag['name'] = esc_attr($name);
    $adTags[$name] = $tag;
}
$siteDomain = esc_attr(rawurlencode($args['site_domain']));
?>
<div class="wrap srtads">
    <h1><?= esc_html_e(get_admin_page_title(), 'srtads') ?></h1>
    <form id="srt_ad_tags_form"><?php do_settings_sections($args['page']); ?></form>
    <button class="button" style="margin-bottom: 4px">
        <?= esc_html_e('Copy HTML code to clipboard', 'srtads') ?>
    </button>
    <div class="stuffbox"><pre id="srt_ad_tag_code"></pre></div>
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
        var code = '<div class="ad-tag" data-ad-name="' + tagData['name'] + '"';
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

    function updateData(data) {
        if (currentData === data) {
            return;
        }
        var $form = $('#srt_ad_tags_form');
        $('input[name][name!=""][type="checkbox"]').each(function () {
            var $this = $(this);
            var name = $this.attr('name');
            var newChecked = data[name];
            if (currentData[name] !== newChecked) {
                $this.prop('checked', Boolean(newChecked));
            }
        });
        $('select[name][name!=""]').each(function () {
            var $this = $(this);
            var name = $this.attr('name');
            var newVal = data[name];
            if (currentData[name] !== newVal) {
                $this.val(newVal);
            }
        });
        var tagName = data['selected_tag'];
        var tagData = adTags[tagName];
        if (currentData['selected_tag'] !== tagName) {
            $('#srt_ad_tag_list_description').text(tagData['group']);
            $('#srt_ad_tag_responsive').prop('disabled', !tagData['responsive']);
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
            'responsive': true,
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
    $('input[name][name!=""][type="checkbox"]').each(function () {
        var $this = $(this);
        var name = $this.attr('name');
        $this.on('change', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var data = $.extend({}, currentData); // always create new objects. Consider them as constant.
            data[name] = !currentData[name];
            updateData(data);
        });
    });
    $('select[name][name!=""]').each(function () {
        var $this = $(this);
        var name = $this.attr('name');
        var checkName = $this.data('check');
        $this.on('change', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var data = $.extend({}, currentData); // always create new objects. Consider them as constant.
            data[name] = $this.val();
            if (checkName) {
                data[checkName] = true;
            }
            updateData(data);
        });
    });
});
</script>
