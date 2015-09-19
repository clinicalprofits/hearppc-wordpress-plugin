<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Your Name <email@example.com>
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
        $this->landing_page_id = intval(get_option('hearppc_landing_page'));
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/plugin-name-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/plugin-name-admin.js', array('jquery'), $this->version, false);
    }

    /**
     * Creates the admin page to configure plugin.
     */
    public function add_admin_page()
    {
        add_options_page(
            'HearPPC Settings', // page_title
            'HearPPC Integration', // menu_title
            'manage_options', // capability
            'hearppc-options', // menu_slug
            array($this, 'create_admin_page') // function
        );
    }

    public function create_admin_page()
    {
        $this->hearppc_options = get_option('hearppc_options');
        include(plugin_dir_path(__FILE__).'partials/hearppc-integration-admin-display.php' );
    }

    public function admin_page_init()
    {
        // register options
        register_setting(
            'hearppc_options_group', // option_group
            'hearppc_options', // option_name
            array($this, 'sanitize_input') // sanitize_callback
        );

        // set up settings section
        add_settings_section(
            'hearppc_settings_section', // id
            'Settings', // title
            array($this, 'settings_section_info'), // callback
            'hearppc-admin' // page
        );

        // set up call tracking script field
        add_settings_field(
            'hearppc_calltracking_script', // id
            'Calltracking Script', // title
            array($this, 'hearppc_calltracking_script_callback'), // callback
            'hearppc-admin', // page
            'hearppc_settings_section' // section
        );
    }

    public function sanitize_input($input)
    {
        $sanitary_values = array();

        if (isset($input['hearppc_calltracking_script'])) {
            $sanitary_values['hearppc_calltracking_script'] = sanitize_text_field($input['hearppc_calltracking_script']);
        }

        return $sanitary_values;
    }

    public function settings_section_info()
    {
        echo 'To get the landing page to function properly, we need to do a little configuration.';
    }

    public function hearppc_calltracking_script_callback($input)
    {
        include(plugin_dir_path(__FILE__).'partials/calltracking-script-field.php' );
    }
}
