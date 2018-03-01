<?php
if (!defined('SORTABLE_ADS')) {
    exit;
}

$args['id'] = 'srt_ad_tag_list';
$args['name'] = 'selected_tag';
$args['description'] = 'There is preset list of ad units available. Each ad name has a specified size or sizes available. The names in this list will be the same names that are used in the reporting dashboard. Multiple ads of the same name can be used on the same page.';
require plugin_dir_path(__FILE__) . '../../includes/views/ad-tag-select.php';
?>
