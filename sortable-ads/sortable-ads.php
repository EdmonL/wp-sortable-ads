<?php
/*
 * Plugin Name:       Sortable Ads
 * Description:       This plugin enables setting up Sortable Ads easily on WordPress sites.
 * Version:           0.0.1
 * Author:            Sortable
 * Author URI:        sortable.com
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

function run_sortable_ads() {
    if (is_admin()) {
        require_once plugin_dir_path(__FILE__) . 'admin/SortableAdsAdmin.php';
        (new SortableAdsAdmin())->run();
    }
    require_once plugin_dir_path(__FILE__) . 'includes/SortableAdsWidget.php';
    add_action('widgets_init', function() { register_widget('SortableAdsWidget'); });
}
run_sortable_ads();
