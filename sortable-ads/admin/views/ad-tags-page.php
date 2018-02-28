<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

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
    <h1><?= esc_html__(get_admin_page_title(), 'srtads') ?></h1>
    <form id="srt_ad_tags_form"><?php do_settings_sections($args['page']); ?></form>
    <button id="srtads_copy_tag_html_code" class="button" style="margin-bottom: 4px; min-width: 16em">
        <?= esc_html__('Copy HTML code to clipboard', 'srtads') ?>
    </button>
    <div class="stuffbox">
        <pre id="srt_ad_tag_code" style="margin: 1em; overflow-x: auto; overflow-y: hidden"></pre>
    </div>
</div>
<script>
jQuery(function() {
    var $ = jQuery;
    var currentData = {};
    var scriptsCode = '<script src="//tags-cdn.deployads.com/a/<?= $siteDomain ?>.js" async></' + 'script>\n' +
                      '<script>(deployads = window.deployads || []).push({});</' + 'script>';
    var adTags = <?= json_encode($adTags) ?>;
    var $form = $('#srt_ad_tags_form');
    $form.on('submit', function (event) { event.preventDefault(); event.stopPropagation(); });

    function tagCode(data) {
        var tagName = data['selected_tag'];
        var tagData = adTags[tagName];
        var code = '<div class="ad-tag" data-ad-name="' + tagData['name'] + '"';
        if (data['responsive'] && tagData['responsive']) {
            code += ' data-ad-size="auto"';
        } else {
            code += ' data-ad-size="' + tagData['size'] + '"';
        }
        var timeRefresh = data['time_refresh'];
        var eventRefresh = data['event_refresh'];
        var userRefresh = data['user_refresh'];
        if (timeRefresh || eventRefresh || userRefresh) {
            code += ' data-ad-refresh="';
            var refresh = '';
            if (timeRefresh) {
                refresh += ' time ' + timeRefresh;
            }
            if (eventRefresh) {
                refresh += ' event ' + eventRefresh;
            }
            if (userRefresh) {
                refresh += ' user ' + userRefresh;
            }
            code += refresh.trim() + '"';
        }
        if (data['sticky']) {
            code += ' data-ad-sticky="sidebar';
            var padding = data['sticky_top_padding'];
            if (padding.valid) {
                padding = Number(padding);
                if (padding) {
                    code += ' ' + padding + 'px'
                }
            }
            code += '"';
        }
        return code + '></div>\n' + scriptsCode;
    }

    function updateData(data) {
        if (currentData === data) {
            return;
        }
        $('input[name][name!=""][type="checkbox"]', $form).each(function () {
            var $this = $(this);
            var name = $this.attr('name');
            var newChecked = data[name];
            if (currentData[name] !== newChecked) {
                $this.prop('checked', Boolean(newChecked));
            }
        });
        $('select[name][name!=""],input[name][name!=""]', $form).each(function () {
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
            'selected_tag': Object.keys(adTags)[0],
            'responsive': true,
            'time_refresh': '',
            'event_refresh': '',
            'user_refresh': '',
            'sticky': false,
            'sticky_top_padding': '0'
        };
    }
    updateData(initData);
    $('input[name][name!=""][type="checkbox"]', $form).each(function () {
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
    $('select[name][name!=""]', $form).each(function () {
        var $this = $(this);
        var name = $this.attr('name');
        $this.on('change', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var data = $.extend({}, currentData); // always create new objects. Consider them as constant.
            data[name] = $this.val();
            updateData(data);
        });
    });
    $('input.srtads-validate[name][name!=""]', $form).each(function () {
        var $this = $(this);
        var name = $this.attr('name');
        var checkName = $this.data('check');
        $this.on('input', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var data = $.extend({}, currentData); // always create new objects. Consider them as constant.
            data[name] = new String($this.val());
            data[name]['valid'] = this.validity.valid;
            if (checkName && !data[checkName]) {
                data[checkName] = true;
            }
            updateData(data);
        });
    });
    var $copyButton = $('#srtads_copy_tag_html_code');
    var copyHTMLcode = (function() {
        var timer = null;
        var text = $copyButton.text();
        return function () {
            var range = window.document.createRange();
            range.selectNodeContents(window.document.getElementById('srt_ad_tag_code'));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            window.document.execCommand('copy');
            if (timer) {
                window.clearTimeout(timer);
            } else {
                $copyButton.text('Copied!');
            }
            timer = window.setTimeout(function() { $copyButton.text(text); timer = null; }, 1000);
        };
    })();
    $copyButton.on('click', copyHTMLcode);
});
</script>
