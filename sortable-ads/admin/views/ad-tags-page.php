<div class="wrap srtads">
    <h1><?= esc_html(get_admin_page_title()) ?></h1>
    <form><?php do_settings_sections($args['page']); ?></form>
    <h2><?= __('Ad Tags', 'srtads') ?></h2>
    <p>Click an ad tag below to show its HTML code.</p>
    <div id="srt-ad-tags">
        <div id="srt-ad-tag-list">
<?php
foreach ($args['ad_tags'] as $tag) {
    $size = SortableAds::formatSize($tag['size']);
    $responsiveSizes = isset($tag['responsive_sizes']) ? '(' . SortableAds::formatSizes($tag['responsive_sizes']) . ')' : null;
?>
            <div class="tag">
                <div class="menu-item-handle">
                    <div class="title">
                        <h3><?= $tag['name'] ?></h3>
                    </div>
                </div>
                <div class="description">
                    <?= $tag['format'] ?>:
                    <?= $size ?>
                    <?= $responsiveSizes ?>
                </div>
            </div>
<?php
}
?>
        </div>
    </div>
</div>
<?php
