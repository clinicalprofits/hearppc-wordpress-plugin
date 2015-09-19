<?php

/**
 * @wordpress-plugin
 * Plugin Name:     HearPPC Integration
 * Plugin URI:      https://github.com/Hipp04/hearppc-integration/
 * Description:     Sets up the HearPPC landing page, call tracking, and script dependencies.
 * Version:         1.0.0
 * Author:          Clinical Profits, LLC
 * Author URI:      http://www.clinicalprofits.com/
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     hearppc-integration
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_hearppc_integration()
{
    require_once plugin_dir_path(__FILE__).'includes/hearppc-integration-activator.php';
    HearPPC_Integration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_hearppc_integration()
{
    require_once plugin_dir_path(__FILE__).'includes/hearppc-integration-deactivator.php';
    HearPPC_Integration_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_hearppc_integration');
register_deactivation_hook(__FILE__, 'deactivate_hearppc_integration');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__).'includes/hearppc-integration.php';

/**
 * Begins execution of the plugin.
 */
function run_hearppc_integration()
{
    $plugin = new HearPPC_Integration();
    $plugin->run();
}
run_hearppc_integration();
