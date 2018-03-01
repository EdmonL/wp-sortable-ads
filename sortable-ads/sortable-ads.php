<?php
/*
 * Plugin Name:       Sortable Ads
 * Description:       The Sortable Ads Plugin is an interface that makes it easy for a WordPress administrator to put ads onto their website. This plugin by itself is not enough to serve ads, you will have to also have an active account with Sortable in order for this to work. There are a set on ad units included with this plugin, they are designed to fit all of the most common ad placement sizes.  When setting up your account with Sortable you will need to make sure that the Sortable representative knows you are using this plugin.
 * Version:           0.1.0
 * Author:            Sortable
 * Author URI:        sortable.com
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}
define('SORTABLE_ADS', true);

function run_sortable_ads() {
    if (is_admin()) {
        require_once plugin_dir_path(__FILE__) . 'admin/SortableAdsAdmin.php';
        (new SortableAdsAdmin())->run();
    }
    require_once plugin_dir_path(__FILE__) . 'includes/SortableAdsWidget.php';
    add_action('widgets_init', function() { register_widget('SortableAdsWidget'); });
}
run_sortable_ads();
