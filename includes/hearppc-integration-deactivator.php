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
        self::delete_page();
        self::delete_option('hearppc_landing_page_id');
        self::delete_option('hearppc_options');
	}

    /**
     * Removes provided option from WordPress database if present.
     */
    public static function delete_option($option)
    {
        if (get_option('hearppc_options')) {
            delete_option('hearppc_options');
        }
    }

    /**
     * Removes previously created landing page if present.
     */
    public static function delete_page()
    {
        $lpid = intval(get_option('hearppc_landing_page_id'));
        wp_delete_post($lpid, true);
    }
}
