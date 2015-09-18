<?php

/**
 * Plugin Name: HearPPC Integration
 * Description: Installs the HearPPC landing page and call tracking
 * Version: 1.0.0
 * Author: JonPerry/PhungTran.
 */
define('HPPC_DIR', plugin_dir_path(__FILE__));
define('HPPC_URL', plugin_dir_url(__FILE__));
define('HPPC_BASE', plugin_basename(__FILE__));

require_once HPPC_DIR.'include/setting.php';

class HPPC_Main
{
    public function __construct()
    {
        // if admin
        if (is_admin()) {
            // include setting page
            $event_widget = new HPPC_Setting();
        }

        // register actions
        add_action('wp_head', array($this, 'add_meta'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), PHP_INT_MAX - 1);
    }

    public function activate()
    {
        $id = intval(get_option('hearppc_landing_page'));
        if ($id == 0) {
            // create page if not existing
            $post = array(
                'post_content' => '<h3 style="color:red;">Plugin not installed correctly</h3>Please make the required edits to the page "Hearing Aids PPC".',
                'post_title' => 'Hearing Aids PPC',
                'post_name' => 'hearingaids-ppc',
                'post_status' => 'publish',
                'post_type' => 'page',
            );
            $id = wp_insert_post($post, false);

            // save page id to use later
            update_option('hearppc_landing_page', $id);
        }
    }

    public function deactivate()
    {
        // get page id saved before
        $id = intval(get_option('hearppc_landing_page'));

        // delete created page
        wp_delete_post($id, true);

        // delete page id option
        delete_option('hearppc_landing_page');

        // delete server setting
        delete_option('hearppc_option');
    }

    public function enqueue_scripts()
    {
        // get server url from setting
        $hearppc_options = get_option('hearppc_option');
        $hearppc_calltracking_script = $hearppc_options['hearppc_calltracking_script'];

        // get page id saved before
        $hearppc_landing_page = intval(get_option('hearppc_landing_page'));

        // insert hearppc script
        if (is_page($hearppc_landing_page)) {
            wp_enqueue_script('hearppc-script', 'https://server.hearppc.com/js/hppc_script.js', false, '', true);
        }

        if (!empty($hearppc_calltracking_script)) {
            // insert call tracking swap code
            wp_enqueue_script('callrail-swap-script', '//calltrk-production.s3.amazonaws.com/custom-swap/trump.ppc.js', false, '', true);

            // insert call tracking script
            wp_enqueue_script('callrail-script', $hearppc_calltracking_script, false, '', true);
        }
    }

    public function add_meta()
    {
        // get page id saved before
        $hearppc_landing_page = intval(get_option('hearppc_landing_page'));

        // insert hearppc script
        if (is_page($hearppc_landing_page)) {
            echo '<meta name="robots" content="noindex, nofollow">';
        }
    }
}

global $hearppc;
$hearppc = new HPPC_Main();

register_activation_hook(__FILE__, array($hearppc, 'activate'));
register_deactivation_hook(__FILE__, array($hearppc, 'deactivate'));

// add settings link to plugin page
add_filter('plugin_action_links_'.HPPC_BASE, 'add_action_links');
function add_action_links($links)
{
    $mylinks = array(
        '<a href="'.admin_url('options-general.php?page=hearppc-options').'">Settings</a>',
        '<a href="'.admin_url('post.php?post='.intval(get_option('hearppc_landing_page')).'&action=edit').'">Edit Page</a>',
    );

    return array_merge($links, $mylinks);
}
