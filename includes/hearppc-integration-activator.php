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
        add_option('');

        // create the landing page
        $post = array(
            'post_content' => self::content(),
            'post_title' => 'Hearing Aids PPC',
            'post_name' => 'hearingaids-ppc',
            'post_status' => 'publish',
            'post_type' => 'page',
        );

        // store landing page id
        $lpid = wp_insert_post($post, false);
        update_option('hearppc_landing_page_id', $lpid);
    }

    /**
     * The content to load into the landing page
     */
    public static function content()
    {
        $content =  '<div id="hearppc_content">';
        $content .=     '<p id="hearppc_practice_description">This is the default content.</p>';
        $content .= '</div>';

        return $content;
    }

    public static function add_options()
    {
        add_option('hearppc_landing_page_id');
        add_option('hearppc_calltracking_script');
        add_option('hearppc_practice_description');
    }
}
