<?php

class HPPC_Setting
{
    private $hearppc_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'hppc_add_plugin_page'));
        add_action('admin_init', array($this, 'hppc_page_init'));
    }

    //
    public function hppc_add_plugin_page()
    {
        add_options_page(
            'HearPPC Settings', // page_title
            'HearPPC', // menu_title
            'manage_options', // capability
            'hearppc-options', // menu_slug
            array($this, 'hppc_create_admin_page') // function
        );
    }

    public function hppc_create_admin_page()
    {
        $this->hearppc_options = get_option('hearppc_option');
        ?>

		<div class="wrap">
			<h2>HearPPC Settings</h2>
			<p></p>

			<form method="post" action="options.php">
				<?php
                    settings_fields('hearppc_option_group');
                    do_settings_sections('hearppc-admin');
                    submit_button();
        ?>
			</form>
		</div>
	<?php

    }

    public function hppc_page_init()
    {
        register_setting(
            'hearppc_option_group', // option_group
            'hearppc_option', // option_name
            array($this, 'hppc_sanitize') // sanitize_callback
        );

        add_settings_section(
            'hppc_setting_section', // id
            'Settings', // title
            array($this, 'hppc_section_info'), // callback
            'hearppc-admin' // page
        );

        add_settings_field(
            'hearppc_calltracking_script', // id
            'Calltracking Script', // title
            array($this, 'hearppc_calltracking_script_callback'), // callback
            'hearppc-admin', // page
            'hppc_setting_section' // section
        );
    }

    public function hppc_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['hearppc_calltracking_script'])) {
            $sanitary_values['hearppc_calltracking_script'] = sanitize_text_field($input['hearppc_calltracking_script']);
        }

        return $sanitary_values;
    }

    public function hppc_section_info()
    {
    }

    public function hearppc_calltracking_script_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="hearppc_option[hearppc_calltracking_script]" id="hearppc_calltracking_script" value="%s">',
            isset($this->hearppc_options['hearppc_calltracking_script']) ? esc_attr($this->hearppc_options['hearppc_calltracking_script']) : ''
        );
    }
}

/*
 * Retrieve this value with:
 * $hearppc_options = get_option('hearppc_option'); // Array of All Options
 * $server_url = $hearppc_options['server_url']; // Server URL
 */
