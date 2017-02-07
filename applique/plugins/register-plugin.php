<?php
/* ----------------------------------------------------------------------------------- */
/* Plugins List Activation                                                             */
/* ----------------------------------------------------------------------------------- */

if ( !function_exists( 'df_register_required_plugins' ) ) {
	function df_register_required_plugins() {
		$plugins = array(
			array(
                'name'                  => 'Dahz DF Shortcodes', // The plugin name
                'slug'                  => 'df-shortcodes', // The plugin slug (typically the folder name)
                'source'                => get_template_directory() . '/plugins/df-shortcodes.zip', // The plugin source
                'version'            	=> '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => 'Envato Wordpress Toolkits', // The plugin name
                'slug'                  => 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
                'source'                => get_template_directory() . '/plugins/envato-wordpress-toolkit-master.zip', // The plugin source
                'version'               => '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => 'Vafpress Post Formats UI', // The plugin name
                'slug'                  => 'vafpress-post-formats-ui-develop', // The plugin slug (typically the folder name)
                'source'                => get_template_directory() . '/plugins/vafpress-post-formats-ui-develop.zip', // The plugin source
                'version'            	=> '1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => 'ZillaLikes', // The plugin name
                'slug'                  => 'zilla-likes', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
                'version'            	=> '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'source'                => get_template_directory() . '/plugins/zilla-likes.zip', // The plugin source
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => 'Contact Form 7', // The plugin name
                'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name'                  => 'Instagram Feed', // The plugin name
                'slug'                  => 'instagram-feed', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name'                  => 'MailChimp for WordPress', // The plugin name
                'slug'                  => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
            ),
		);

		/**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'        => 'applique', // Text domain - likely want to be the same as your theme.
            'default_path' 	=> '', // Default absolute path to pre-packaged plugins
            'parent_slug' 	=> 'themes.php', // Default parent menu slug
            'menu' 			=> 'tgmpa-install-plugins', // Menu slug
            'has_notices' 	=> true, // Show admin notices or not
            'is_automatic' 	=> false, // Automatically activate plugins after installation or not
            'message' 		=> '', // Message to output right before the plugins table
            'strings' 		=> array(
                'page_title' 					  => esc_attr__( 'Install Required Plugins', 'applique' ),
                'menu_title' 					  => esc_attr__( 'Install Plugins', 'applique' ),
                'installing' 					  => esc_attr__( 'Installing Plugin: %s', 'applique' ), // %1$s = plugin name
                'oops' 							  => esc_attr__( 'Something went wrong with the plugin API.', 'applique' ),
                'notice_can_install_required' 	  => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'applique' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'applique' ), // %1$s = plugin name(s)
                'notice_cannot_install' 		  => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'applique' ), // %1$s = plugin name(s)
                'notice_can_activate_required' 	  => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'applique' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'applique' ), // %1$s = plugin name(s)
                'notice_cannot_activate' 		  => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'applique' ), // %1$s = plugin name(s)
                'notice_ask_to_update' 			  => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'applique' ), // %1$s = plugin name(s)
                'notice_cannot_update' 			  => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'applique' ), // %1$s = plugin name(s)
                'install_link' 					  => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'applique' ),
                'activate_link' 				  => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'applique' ),
                'return' 						  => esc_attr__( 'Return to Required Plugins Installer', 'applique' ),
                'plugin_activated' 				  => esc_attr__( 'Plugin activated successfully.', 'applique' ),
                'complete' 						  => esc_attr__( 'All plugins installed and activated successfully. %s', 'applique' ), // %1$s = dashboard link
                'nag_type' 						  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa( $plugins, $config );
	}
}
add_action( 'tgmpa_register', 'df_register_required_plugins' );