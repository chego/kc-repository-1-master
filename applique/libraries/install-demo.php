<?php
/**
 * Build One Click Demo Install.
 *
 * @package Apllique
 * @subpackage libraries
 * @since 1.2.0
 * @version 0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
add_action( 'wp_ajax_df_install_demo', 'df_install_demo' );

// New menu submenu for one click demo Install in Appereance Menu
add_action('admin_menu', 'demo_install');
function demo_install() {
		add_theme_page(esc_html__( 'One Click Demo Install', 'applique' ), esc_html__( 'Demo Install', 'applique' ), 'manage_options', 'df_demo_install', 'df_demo_install');

}

function df_demo_install() {
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'applique' ) );
	}
	$df_appliqeu_demo_url 	= "http://dahz.daffyhazan.com/applique/";
	$df_demos 				= array(
								'fashion' 			=> array(),
								'art' 				=> array(),
								'food' 				=> array(),
								'summer' 			=> array(),
								'beauty' 			=> array(),
								'outfit' 			=> array(),
								'travel' 			=> array(),
								'inspiration'		=> array(),
								'inspired' 			=> array(),
								'shopping' 			=> array(),
								'looks' 			=> array(),
								'craft' 			=> array(),
								'makeup' 			=> array(),
								'menswear' 			=> array(),
								);

	?>
	<div class="df-container-wrapp">
    	<div class="df-about-wrapp">
        	<h1>Applique Quick Demo Installer</h1>
            <div class="df-dahz-logo">
            	<span class="df-magazine-version"></span>
            </div>
			<div class="df-updated df-error">
				<p><strong>Failed to import. please check your server requirement and demo files, learn more <a href="http://support.daffyhazan.com/knowledgebase/how-to-fix-failed-to-import/" target="_blank"> here </a></strong></p>
			</div>
			<div class="df-updated df-success" id="success-message">
				<p><strong>Import Successful</strong></p>
			</div>
			<div class="df-dahz-important-notice">
				<p class="df-about-description">You are just a few clicks away from replicating our demo content and start building your blog. by installing the the demo content you will get the demo layout along with the sliders, pages, posts, customizer settings, widgets, sidebars and other settings in your site. to ensure a successful import, please do the following steps :  
				<br>
					<br>1. Export Customizer Setting to <a href="themes.php?page=tgmpa-install-plugins"> backup </a> your current setting. 
					<br>2. Install the <a href="themes.php?page=tgmpa-install-plugins"> required plugins  </a>
					<br>3. set your server memory limit to 256M and Max Execution Time (php time limit) to 600 Seconds. 
				<br>
				<br>
				<strong>Your Server Status</strong>
				<br>Max Execution Time is <span style="color: #ff0000;"><?php echo ini_get('max_execution_time');  ?></span>  seconds. 
				<br>Server Memory limit is <span style="color: #ff0000;"> <?php echo ini_get('memory_limit');  ?></span> 
				<br>
				<br>Done all that? choose the one you like, and just click install!
				</p>
			</div>
            <div class="df-dahz-demo-themes">
		  	<?php
			// Loop through all demos
			foreach ( $df_demos as $demo => $demo_details ) { ?>
			<div class="df-theme">
				<div class="df-theme-wrapper">
					<div class="df-theme-screenshot">
						<?php printf("<img src='%s/assets/images/demo-%s.jpg'/>",esc_attr( get_template_directory_uri() ), esc_attr( $demo ) ); ?>  
					</div>
						<?php //printf("<div class='df_progressbar %s'></div>",$demo); ?> 
					<h3 class="df-theme-name">
						<?php printf("<span class='df-theme-name-edit'>%s</span>", esc_attr( $demo ) ); ?> 
					</h3>
					<div class="df-theme-action">
						<?php printf("<a class='df-button df-button-primary install-button' href='#' data-demo-name='%s'> Install </a>",esc_attr( $demo ) ); ?> 
						<?php printf("<a class='df-button df-button-primary' href='%s%s' target='_blank'>Preview</a>", esc_html( $df_appliqeu_demo_url ), esc_attr( $demo ) ); ?> 
					</div>    
					               
					<div class="df-demo-import-loader <?php echo esc_attr( $demo );  ?>">
						<div class="df-words-loading <?php echo esc_attr( $demo );  ?>">
							<span>Importing....</span>
							<br>
							<span>Please do NOT close this window or click the Back button on your browser.</span>
						</div>
						<div class="meter  <?php echo esc_attr( $demo ); ?> ">
							<span></span>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
<?php }

function df_install_demo() {
	
	if ( current_user_can( 'manage_options' ) ) {
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // load importer

		if ( ! class_exists( 'WP_Importer' ) ) { // cek if main importer class doesn't exist
			$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			include $wp_importer;
		}

		if ( ! class_exists('WP_Import') ) { // cek if WP importer plugins doesn't exist
			$wp_import =  get_template_directory() . '/assets/demo/wordpress-importer.php';
			include $wp_import;
		}
		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class
			if( ! isset($_POST['demo_name']) || trim($_POST['demo_name']) == '' ) {
				$demo_name = 'fashion';
			} else {
				$demo_name = $_POST['demo_name'];
			}

			$process = $_POST['process'];

			switch( $process ) {
				case 'install_xml' :
					$importer = new WP_Import();
					$data_file		= get_template_directory() . '/assets/demo/xml/' . $demo_name .'.xml';
					//Import Data Demo
					$importer->fetch_attachments = true;
					ob_start();
					$importer->import( $data_file );
					ob_end_clean();

					flush_rewrite_rules();

					echo "successful";		
					exit;
				break;
				case 'install_customizer' :
					$options_file 	= get_template_directory() . '/assets/demo/customizer/' . $demo_name .'.json';
					//Import Widgets
					$remove_options = get_theme_mods();
					//unset( $remove_options['nav_menu_locations'] );
					foreach ( $remove_options as $key => $value ) {
					  remove_theme_mod( $key );
					}

					/* Save new settings */
					$encode_options = file_get_contents( $options_file );
					$options        = json_decode( $encode_options, true );
					foreach ( $options as $key => $value ) {
					  $value = maybe_unserialize( $value );
					  set_theme_mod( $key, $value );
					}

					echo "successful";		
					exit;
				break;
				case 'install_widgets' :
					$widgets_file 	= get_template_directory() . '/assets/demo/widget/' . $demo_name .'.wie';
					// Import Widgets
					if( isset( $widgets_file ) && $widgets_file ) {
						$widgets_json = $widgets_file; // widgets data file
						$widgets_json = file_get_contents( $widgets_json );
						$widget_data = json_decode( $widgets_json );
						//thanks to Steven Gliebe for this widget importer 
						//adapt from wordpress import export plugin visit http://wordpress.org/plugins/widget-importer-exporter
						$import_widgets = df_import_widget_data( $widget_data ); 
					}

					echo "successful";		
					exit;	
				break;
				default :
					echo "successful";		
					exit;	

			}	
			
		}
	}

}


function df_import_widget_data( $data ) {

	global $wp_registered_sidebars;

	// Have valid data?
	// If no data or could not decode
	if ( empty( $data ) || ! is_object( $data ) ) {
		wp_die(
			__( 'Import data could not be read. Please try a different file.', 'widget-importer-exporter' ),
			'',
			array( 'back_link' => true )
		);
	}

	// Hook before import
	do_action( 'df_before_import' );
	$data = apply_filters( 'df_import_widget_data', $data );

	// Get all available widgets site supports
	$available_widgets = get_available_widgets();

	// Get all existing widget instances
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}

	// Begin results
	$results = array();

	// Loop import data's sidebars
	foreach ( $data as $sidebar_id => $widgets ) {

		// Skip inactive widgets
		// (should not be in export file)
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}

		// Check if sidebar is available on this site
		// Otherwise add widgets to inactive, and say so
		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
			//$sidebar_available = true;
			$use_sidebar_id = $sidebar_id;
			//$sidebar_message_type = 'success';
			//$sidebar_message = '';
		} else {
			//$sidebar_available = false;
			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			//$sidebar_message_type = 'error';
			//$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'widget-importer-exporter' );
		}

		// Loop widgets
		foreach ( $widgets as $widget_instance_id => $widget ) {

			$fail = false;

			// Get id_base (remove -# from end) and instance ID number
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

			// Does site support this widget?
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = __( 'Site does not support widget', 'widget-importer-exporter' ); // explain why widget not imported
			}

			// Filter to modify settings object before conversion to array and import
			// Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
			// Ideally the newer wie_widget_settings_array below will be used instead of this
			$widget = apply_filters( 'df_widget_settings', $widget ); // object

			// Convert multidimensional objects to multidimensional arrays
			// Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
			// Without this, they are imported as objects and cause fatal error on Widgets page
			// If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
			// It is probably much more likely that arrays are used than objects, however
			$widget = json_decode( json_encode( $widget ), true );

			// Filter to modify settings array
			// This is preferred over the older wie_widget_settings filter above
			// Do before identical check because changes may make it identical to end result (such as URL replacements)
			$widget = apply_filters( 'df_widget_settings_array', $widget );

			// Does widget with identical settings already exist in same sidebar?
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

				// Get existing widgets in this sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

				// Loop widgets with ID base
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
				foreach ( $single_widget_instances as $check_id => $check_widget ) {

					// Is widget in same sidebar and has identical settings?
					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

						$fail = true;
						$widget_message_type = 'warning';
						$widget_message = __( 'Widget already exists', 'widget-importer-exporter' ); // explain why widget not imported

						break;

					}

				}

			}

			// No failure
			if ( ! $fail ) {

				// Add widget instance
				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
				$single_widget_instances[] = $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

				// Assign widget instance to sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				// After widget import action
				$after_widget_import = array(
					'sidebar'           => $use_sidebar_id,
					'sidebar_old'       => $sidebar_id,
					'widget'            => $widget,
					'widget_type'       => $id_base,
					'widget_id'         => $new_instance_id,
					'widget_id_old'     => $widget_instance_id,
					'widget_id_num'     => $new_instance_id_number,
					'widget_id_num_old' => $instance_id_number
				);
				do_action( 'df_after_widget_import', $after_widget_import );

			}

		}

	}

	// Hook after import
	do_action( 'df_after_import' );

}

function get_available_widgets() {

	global $wp_registered_widget_controls;

	$widget_controls = $wp_registered_widget_controls;

	$available_widgets = array();

	foreach ( $widget_controls as $widget ) {

		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];

		}

	}

	return apply_filters( 'get_available_widgets', $available_widgets );

}