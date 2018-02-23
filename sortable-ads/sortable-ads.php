<?php
/*
 * Plugin Name:       Sortable Ads
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            Sortable
 * Author URI:        sortable.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

function run_sortable_ads() {
    if (is_admin()) {
        require_once plugin_dir_path(__FILE__) . 'admin/SortableAdsAdmin.php';
        (new SortableAdsAdmin())->run();
    } else {
        //require_once plugin_dir_path(__FILE__) . 'public/SortableAdsPublic.php';
        //(new SortableAdsPublic())->run();
    }
}
run_sortable_ads();
