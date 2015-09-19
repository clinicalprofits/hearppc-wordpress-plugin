<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Your Name <email@example.com>
 */
class HearPPC_Integration_Public
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
     * Collection of stored settings for the plugin.
     *
     * @var array Collection of stored settings.
     */
    private $options;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->options = get_option('hearppc_options');
        $this->landing_page_id = intval(get_option('hearppc_landing_page'));
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/hearppc-integration-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        // Enqueue HearPPC Landing Page script to landing page ONLY
        if (is_page($this->landing_page_id)) {
            wp_enqueue_script('hearppc-script', 'https://server.hearppc.com/js/hppc_script.js', false, $this->version, true);
        }

        // If set, enqueue the calltracking scripts
        if (!empty($this->options['calltracking_script'])) {
            wp_enqueue_script('callrail-swap-script', '//calltrk-production.s3.amazonaws.com/custom-swap/trump.ppc.js', false, $this->version, true);
            wp_enqueue_script('callrail-script', $this->options['calltracking_script'], false, $this->version, true);
        }

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/hearppc-integration-public.js', array('jquery'), $this->version, false);
    }

    /**
     * Add noindex nofollow meta tag to head of landing page ONLY
     */
    public function add_noindex_nofollow_meta_tag()
    {
        if (is_page($this->landing_page_id)) {
            echo '<meta name="robots" content="noindex, nofollow">';
        }
    }
}
