<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class HearPPC_Integration_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * The post id for the landing page.
     *
     * @var int The ID for the landing page.
     */
    private $landing_page_id;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        // wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/plugin-name-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        // wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/plugin-name-admin.js', array('jquery'), $this->version, false);
    }

    /**
     * Creates the admin page to configure plugin.
     *
     * @since    1.0.0
     */
    public function add_admin_page()
    {
        add_options_page(
            'HearPPC Settings', // page_title
            'HearPPC Integration', // menu_title
            'manage_options', // capability
            'hearppc-settings', // menu_slug
            array($this, 'add_options_page') // function
        );
    }

    public function add_options_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }
        include plugin_dir_path(__FILE__).'partials/hearppc-integration-admin-display.php';
    }

    /**
     * Add links to plugin listing
     *
     * @since 1.1.0
     */
    public function add_action_links($links, $file)
    {
        if (strpos($file, $this->plugin_name) !== false) {
            array_unshift($links, '<a target="_blank" href="'.get_site_url().'/hearingaids-ppc/?ag=test">Test</a>');
            array_unshift($links, '<a href="options-general.php?page=hearppc-settings">Settings</a>');
        }

        return $links;
    }

    /**
     * Sets up the admin page.
     *
     * @since 1.0.0
     */
    public function admin_page_init()
    {
        // register call tracking options
        register_setting('hearppc_options_group', 'hearppc_call_tracking_id', 'sanitize_text_field');
        register_setting('hearppc_options_group', 'hearppc_call_tracking_key', 'sanitize_text_field');

        // register practice description option
        register_setting('hearppc_options_group', 'hearppc_practice_description', 'sanitize_text_field');
        register_setting('hearppc_options_group', 'hearppc_access_key', 'sanitize_text_field');

        // set up settings section
        add_settings_section(
            'hearppc_settings_section',
            'Settings',
            array($this, 'settings_text'),
            'hearppc-admin'
        );

        // set up call tracking section
        add_settings_section(
            'hearppc_call_tracking_section',
            'Call Tracking',
            array($this, 'call_tracking_text'),
            'hearppc-admin'
        );

        // set up HearPPC key field
        add_settings_field(
            'hearppc_access_key',
            'Access Key',
            array($this, 'access_key_field'),
            'hearppc-admin',
            'hearppc_settings_section'
        );

        // set up practice description field
        add_settings_field(
            'hearppc_practice_description',
            'Practice Description',
            array($this, 'practice_description_field'),
            'hearppc-admin',
            'hearppc_settings_section'
        );


        // set up call tracking id field
        add_settings_field(
            'hearppc_call_tracking_id',
            'Call Tracking Id',
            array($this, 'call_tracking_id_field'),
            'hearppc-admin',
            'hearppc_call_tracking_section'
        );

        // set up call tracking key field
        add_settings_field(
            'hearppc_call_tracking_key',
            'Call Tracking Key',
            array($this, 'call_tracking_key_field'),
            'hearppc-admin',
            'hearppc_call_tracking_section'
        );
    }

    public function settings_text()
    {
        echo '<p>In order for the landing page to function properly, we need you to provide your <strong>access key</strong> and <strong>practice description</strong>.</p>';
    }

    public function call_tracking_text()
    {
        echo 'To set up call tracking, we need you to provide your <strong>Call Tracking Id</strong> and <strong>Call Tracking Key</strong>.';
    }

    public function access_key_field()
    {
        include plugin_dir_path(__FILE__).'partials/hearppc-access-key-field.php';
    }

    public function practice_description_field()
    {
        include plugin_dir_path(__FILE__).'partials/practice-description-field.php';
    }

    public function call_tracking_id_field()
    {
        include plugin_dir_path(__FILE__).'partials/call-tracking-id-field.php';
    }

    public function call_tracking_key_field()
    {
        include plugin_dir_path(__FILE__).'partials/call-tracking-key-field.php';
    }
}
