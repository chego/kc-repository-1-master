<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

define( 'DEFAULT_IMAGE', get_template_directory_uri() . '/assets/images/placeholder.png' );

function category_init() {

	$taxonomies = get_taxonomies();

	if ( is_array( $taxonomies ) ) {

		$df_options = get_option( 'df_options' );

		if ( empty( $df_options['excluded_taxonomies'] ) ) {
			$df_options['excluded_taxonomies'] = array();
		}

	    foreach ( $taxonomies as $taxonomy ) {

			if ( in_array( $taxonomy, $df_options['excluded_taxonomies'] ) ) { continue; }

	        add_action( $taxonomy . '_add_form_fields', 'add_texonomy_field' );
			add_action( $taxonomy . '_edit_form_fields', 'edit_texonomy_field' );
			add_filter( 'manage_edit-' . $taxonomy . '_columns', 'taxonomy_columns' );
			add_filter( 'manage_' . $taxonomy . '_custom_column', 'taxonomy_column', 10, 3 );
	    }
	}
}
add_action( 'admin_init', 'category_init' );

function add_style() {
	echo '<style type="text/css" media="screen">
			th.column-thumb { width:60px; }
			.form-field img.taxonomy-image { border:1px solid #eee; max-width:300px; max-height:300px; }
			.inline-edit-row fieldset .thumb label span.title { width:48px; height:48px; border:1px solid #eee; display:inline-block; }
			.column-thumb span { width:48px; height:48px; border:1px solid #eee; display:inline-block; }
			.inline-edit-row fieldset .thumb img, .column-thumb img { width:48px; height:48px; }
		  </style>';
}

// add image field in add form
function add_texonomy_field() {
	if ( get_bloginfo( 'version' ) >= 3.5 ) {
		wp_enqueue_media();
	} else {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
	}

	echo '<div class="form-field">
			<label for="taxonomy_image">' . esc_html__( 'Image', 'applique' ) . '</label>
			<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
			<br/>
			<button class="upload_image_button button">' . esc_html__( 'Upload image', 'applique' ) . '</button>
		  </div>' . script();
}

// add image field in edit form
function edit_texonomy_field( $taxonomy ) {
	if ( get_bloginfo( 'version' ) >= 3.5 ) {
		wp_enqueue_media();
	} else {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
	}

	if ( taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == DEFAULT_IMAGE ) {
		$image_text = "";
	} else {
		$image_text = taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
		echo '<tr class="form-field">
				<th scope="row" valign="top"><label for="taxonomy_image">' . esc_html__('Image', 'applique') . '</label></th>
				<td><img class="taxonomy-image" src="' . esc_url( $image_text ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="' . $image_text . '" /><br />
				<button class="upload_image_button button">' . esc_html__( 'Upload image', 'applique' ) . '</button>
				<button class="remove_image_button button">' . esc_html__( 'Remove image', 'applique' ) . '</button>
				</td>
			  </tr>' . script();
	}
}

// upload using wordpress upload
function script() {
	$taxonomy_images = taxonomy_image( NULL, FALSE );
	return '<script type="text/javascript">
	    jQuery(document).ready(function($) {
			var wordpress_ver = "' . esc_js( get_bloginfo( "version" ) ) . '", upload_button;
			$(".upload_image_button").click(function(event) {
				upload_button = $(this);
				var frame;
				if (wordpress_ver >= "3.5") {
					event.preventDefault();
					if (frame) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on( "select", function() {
						// Grab the selected attachment.
						var attachment = frame.state().get("selection").first();
						frame.close();
						if (upload_button.parent().prev().children().hasClass("tax_list")) {
							upload_button.parent().prev().children().val(attachment.attributes.url);
							upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
						}
						else
							$("#taxonomy_image").val(attachment.attributes.url);
					});
					frame.open();
				}
				else {
					tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
					return false;
				}
			});

			$(".remove_image_button").click(function() {
				$("#taxonomy_image").val("");
				$(this).parent().siblings(".title").children("img").attr("src","' . esc_url( $taxonomy_images ) . '");
				$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				return false;
			});

			if (wordpress_ver < "3.5") {
				window.send_to_editor = function(html) {
					imgurl = $("img",html).attr("src");
					if (upload_button.parent().prev().children().hasClass("tax_list")) {
						upload_button.parent().prev().children().val(imgurl);
						upload_button.parent().prev().prev().children().attr("src", imgurl);
					}
					else
						$("#taxonomy_image").val(imgurl);
					tb_remove();
				}
			}

			$(".editinline").live("click", function(){
			    var tax_id = $(this).parents("tr").attr("id").substr(4);
			    var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
				if (thumb != "' . esc_url( $taxonomy_images ) . '") {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
				} else {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				}
				$(".inline-edit-col .title img").attr("src",thumb);
			    return false;
			});
	    });
	</script>';
}

// save our taxonomy image while edit or save term
add_action( 'edit_term', 'save_taxonomy_image' );
add_action( 'create_term', 'save_taxonomy_image' );
function save_taxonomy_image( $term_id ) {
    if( isset( $_POST[ 'taxonomy_image' ] ) ) {
        update_option( 'taxonomy_image' . $term_id, $_POST[ 'taxonomy_image' ] );
    }
}

// get attachment ID by image url
function get_attachment_id_by_url( $image_src ) {
    global $wpdb;
    $id 	= $wpdb->get_var( $wpdb->prepare(
					"
						SELECT ID
						FROM $wpdb->posts
						WHERE guid = %s
					",
					$image_src
				) );
    return ( !empty( $id ) ) ? $id : NULL;
}

// get taxonomy image url for the given term_id (Place holder image by default)
function taxonomy_image_url( $term_id = NULL, $size = NULL, $return_placeholder = FALSE ) {
	if (!$term_id) {
		if (is_category())
			$term_id = get_query_var( 'cat' );
		elseif (is_tax()) {
			$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$term_id = $current_term->term_id;
		}
	}

    $taxonomy_image_url = get_option( 'taxonomy_image' . $term_id );
    if( !empty( $taxonomy_image_url ) ) {
	    $attachment_id = get_attachment_id_by_url( $taxonomy_image_url );
	    if( !empty( $attachment_id ) ) {
	    	if ( empty( $size ) )
	    		$size = 'full';
	    	$taxonomy_image_url = wp_get_attachment_image_src( $attachment_id, $size );
		    $taxonomy_image_url = $taxonomy_image_url[0];
	    }
	}

    if ( $return_placeholder )
		return ($taxonomy_image_url != '') ? esc_url( $taxonomy_image_url ) : esc_url( DEFAULT_IMAGE );
	else
		return esc_url( $taxonomy_image_url );
}

function quick_edit_custom_box($column_name, $screen, $name) {

	if ($column_name == 'thumb') {
		$taxonomy_images = taxonomy_image( NULL, FALSE );
		echo '<fieldset>
				<div class="thumb inline-edit-col">
					<label>
						<span class="title"><img src="' . esc_url( $taxonomy_images ) . '" alt="Thumbnail"/></span>
						<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
						<span class="input-text-wrap">
							<button class="upload_image_button button">' . esc_html__( 'Upload image', 'applique' ) . '</button>
							<button class="remove_image_button button">' . esc_html__( 'Remove image', 'applique' ) . '</button>
						</span>
					</label>
				</div>
			  </fieldset>';
	}

}

/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function taxonomy_columns( $columns ) {
	$new_columns 	  	  = array();
	$new_columns['cb'] 	  = $columns['cb'];
	$new_columns['thumb'] = esc_html__( 'Image', 'applique' );

	unset( $columns['cb'] );

	return array_merge( $new_columns, $columns );
}

/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function taxonomy_column( $columns, $column, $id ) {
	if ( $column == 'thumb' )
		$columns = '<span><img src="' . taxonomy_image_url($id, NULL, TRUE) . '" alt="' . esc_html__('Thumbnail', 'applique') . '" class="wp-post-image" /></span>';

	return $columns;
}

// change 'insert into post' to 'use this image'
function change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}

// style the image in category list
if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
	add_action( 'admin_head', 'add_style' );
	add_action( 'quick_edit_custom_box', 'quick_edit_custom_box', 10, 3 );
	add_filter( 'attribute_escape', 'change_insert_button_text', 10, 2 );
}

// New menu submenu for plugin options in Settings menu
add_action('admin_menu', 'options_menu');
function options_menu() {
	add_theme_page( esc_html__( 'Categories Images settings', 'applique' ), esc_html__( 'Categories Images', 'applique' ), 'manage_options', 'df-options', 'df_options' );
	add_action( 'admin_init', 'register_settings' );
}

// Register plugin settings
function register_settings() {
	register_setting( 'df_options', 'df_options', 'options_validate' );
	add_settings_section( 'ar_settings', esc_html__( 'Categories Images settings', 'applique' ), 'section_text', 'df-options' );
	add_settings_field( 'excluded_taxonomies', esc_html__( 'Excluded Taxonomies', 'applique' ), 'excluded_taxonomies', 'df-options', 'ar_settings' );
}

// Settings section description
function section_text() {
	echo sprintf( '<p>%1$s</p>', esc_html__( 'Please select the taxonomies you want to exclude it from Categories Images plugin', 'applique' ) );
}

// Excluded taxonomies checkboxs
function excluded_taxonomies() {
	$options = get_option( 'df_options' );
	$disabled_taxonomies = array( 'nav_menu', 'link_category', 'post_format' );
	foreach ( get_taxonomies() as $tax ) : if ( in_array( $tax, $disabled_taxonomies ) ) continue; ?>
		<input type="checkbox" name="df_options[excluded_taxonomies][<?php echo esc_attr( $tax ) ?>]" value="<?php echo esc_attr( $tax ) ?>" <?php checked( isset( $options['excluded_taxonomies'][$tax] ) ); ?> /> <?php echo esc_html( $tax ) ;?><br />
	<?php endforeach;
}

// Validating options
function options_validate( $input ) {
	return $input;
}

// Plugin option page
function df_options() {
	if ( !current_user_can( 'manage_options' ) )
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'applique' ) );
		$options = get_option( 'df_options' );
	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'Categories Images', 'applique' ); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'df_options' ); ?>
			<?php do_settings_sections( 'df-options' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

// get taxonomy image for the given term_id
function taxonomy_image( $term_id = NULL, $echo = TRUE ) {
	if ( !$term_id ) {

		if ( is_category() ) {
			$term_id = get_query_var('cat');
		} elseif ( is_tax() ) {
			$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$term_id = $current_term->term_id;
		} elseif ( is_tag() ) {
			$term_id = get_query_var('tag_id');
		}

	}

    $taxonomy_image_url = get_option( 'taxonomy_image' . $term_id );

	$taxonomy_image = DEFAULT_IMAGE;

    if( !empty( $taxonomy_image_url ) ) {

	    $attachment_id = get_attachment_id_by_url( $taxonomy_image_url );

	    if ( !empty( $attachment_id ) ) {

	    	$taxonomy_image = wp_get_attachment_url( $attachment_id );

	    }

	}

	return esc_url( $taxonomy_image );

	if ( $echo )
		echo esc_url( $taxonomy_image );

}