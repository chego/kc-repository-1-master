<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS - CORE/ADMIN-CUSTOMIZER-BACKUP.PHP

- Import Page
- Export Page

-----------------------------------------------------------------------------------*/
add_action( 'admin_menu', 'dahz_register_customizer_admin_menu' );
/**
 * @return void
 */
function dahz_register_customizer_admin_menu() {
    add_theme_page( 'Import Customizer', 'Import Customizer', 'edit_theme_options', 'customizer-import.php', 'dahz_customizer_import_option_page' );
    add_theme_page( 'Export Customizer', 'Export Customizer', 'edit_theme_options', 'customizer-export.php', 'dahz_customizer_export_option_page' );
}

ob_start();

// Import Page
// =============================================================================

    function dahz_customizer_import_option_page() {
    ?>
      <div class="col two-col import">
      <div class="stuffbox">
        <h4 class="title"><span class="dashicons dashicons-upload"></span><?php esc_html_e('Restore/Import', 'applique'); ?></h4>
        <div class="padded">
        <?php
        if ( isset( $_FILES['import'] ) && check_admin_referer( 'dahz-customizer-import' ) ) {
          if ( $_FILES['import']['error'] > 0 ) {
            wp_die( 'An error occured.' );
          } else {
            WP_Filesystem();
            global $wp_filesystem;
            $file_name  = $_FILES['import']['name'];
            $file_array = explode( '.', $file_name );
            $file_ext   = strtolower( end( $file_array ) );
            $file_size  = $_FILES['import']['size'];
            if ( ( $file_ext == 'json' ) && ( $file_size < 500000 ) ) {
              /* Remove old settings */
              $remove_options = get_theme_mods();
              unset( $remove_options['nav_menu_locations'] );
              foreach ( $remove_options as $key => $value ) {
                  remove_theme_mod( $key );
              }
              /* Save new settings */
              $encode_options = $wp_filesystem->get_contents( $_FILES['import']['tmp_name'] );
              $options        = json_decode( $encode_options, true );
              foreach ( $options as $key => $value ) {
                  $value = maybe_unserialize( $value );
                  set_theme_mod( $key, $value );
              }

              $import_notice = sprintf( '<div class="updated"><p>%s</p></div>', esc_html__( 'All options were restored successfully!', 'applique' ) );
              print $import_notice;
            } else {
              $import_notice = sprintf( '<div class="error"><p>%s</p></div>', esc_html__( 'Invalid file or file size too big.', 'applique' ) );
              print $import_notice;
            }
          }
        }
        ?>
        <form method="post" enctype="multipart/form-data">
          <?php wp_nonce_field( 'dahz-customizer-import' ); ?>
          <p><?php esc_html_e( 'If you have settings in a backup file on your computer, the customizer can import those into this site. To get started, upload your backup file to import from below.', 'applique' ); ?></p>
          <p>Choose a file from your computer: <input type="file" id="customizer-upload" name="import"></p>
          <p class="submit">
            <input type="submit" name="submit" id="customizer-submit" class="button button-primary" value="<?php esc_attr_e( 'Upload File and Run Import', 'applique'); ?>" disabled>
          </p>
        </form>
        </div>
        </div>
      </div>
    <?php
    }


    // Export Page
    // =============================================================================

    function dahz_customizer_export_option_page() {
      if ( ! isset( $_POST['export'] ) ) {
      ?>
        <div class="col two-col export">
        <div class="stuffbox">
          <h4 class="title"><span class="dashicons dashicons-download"></span><?php esc_html_e('Backup/Export', 'applique'); ?></h4>
          <div class="padded">
          <form method="post">
            <?php wp_nonce_field( 'dahz-customizer-export' ); ?>
            <p><?php _e( 'When you click the button below, the Customizer will create a text file for you to save to your computer.', 'applique' ); ?></p>
            <p><?php echo sprintf( esc_html__( 'This text file can be used to restore your settings here on "%s", or to easily setup another website with the same settings".', 'applique' ), get_bloginfo( 'name' ) ); ?></p>
            <p class="submit"><input type="submit" name="export" class="button button-primary" value="<?php esc_attr_e('Download Export File', 'applique'); ?>"></p>
          </form>
          </div>
          </div>
        </div>
      <?php
      } elseif ( check_admin_referer( 'dahz-customizer-export' ) ) {

        $blogname  = strtolower( str_replace( ' ', '', get_option( 'blogname' ) ) );
        $date      = date( 'm-d-Y' );
        $json_name = $blogname . '-dahz-customizer-' . $date;
        $options   = get_theme_mods();

        unset( $options['nav_menu_locations'] );

        foreach ( $options as $key => $value ) {
            $value              = maybe_unserialize( $value );
            $need_options[$key] = $value;
        }

        $json_file = json_encode( $need_options );

        ob_clean();

        print $json_file;

        header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
        header( 'Content-Disposition: attachment; filename="' . $json_name . '.json"' );

        exit();

      }
    }