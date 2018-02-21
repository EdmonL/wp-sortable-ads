<?php

/**
 * The plugin bootstrap file
 *
 * @package           sortable/wp-sortable-ads
 *
 * @wordpress-plugin
 * Plugin Name:       Sortable Ads
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            Sortable
 * Author URI:        https://sortable.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

function activate_sortable_ads() {
    require_once plugin_dir_path(__FILE__) . 'includes/SortableAdsActivator.php';
    SortableAdsActivator::activate();
}

function deactivate_sortable_ads() {
    require_once plugin_dir_path(__FILE__) . 'includes/SortableAdsDeactivator.php';
    SortableAdsDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_sortable_ads');
register_deactivation_hook(__FILE__, 'deactivate_sortable_ads');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/SortableAds.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_sortable_ads() {
    $plugin = new SortableAds();
    $plugin->run();
}
run_sortable_ads();
