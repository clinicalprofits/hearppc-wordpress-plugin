<?php

/**
 * Fired during plugin activation.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @author     Your Name <email@example.com>
 */
class HearPPC_Integration_Activator
{
    /**
     * Creates a new page to serve as the landing page.
     */
    public static function activate()
    {
        // register options
        add_option('hearppc_landing_page_id');
        add_option('hearppc_call_tracking_id');
        add_option('hearppc_call_tracking_key');
        add_option('hearppc_access_key');
        add_option('hearppc_practice_description');

        // create the landing page
        $post = array(
            'post_content' => '[hearppc_landing_page]',
            'post_title' => 'Hearing Aids PPC',
            'post_name' => 'hearingaids-ppc',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        // store landing page id
        $lpid = wp_insert_post($post, false);
        update_option('hearppc_landing_page_id', $lpid);
    }
}
