<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class HearPPC_Integration_Deactivator {

	/**
	 * Removes previously create landing page and stored options.
	 */
	public static function deactivate() {
        wp_delete_post(get_option('hearppc_landing_page_id'), true);
        delete_option('hearppc_landing_page_id');
	}
}
