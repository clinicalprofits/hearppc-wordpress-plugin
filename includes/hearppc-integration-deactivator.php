<?php

/**
 * Fired during plugin deactivation
 *
 * @since      1.0.0
 *
 * @package    HearPPC_Integration
 * @subpackage HearPPC_Integration/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * @since      1.0.0
 * @package    HearPPC_Integration
 * @subpackage HearPPC_Integration/includes
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
