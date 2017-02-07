<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Ads_300 extends WP_Widget {

	function Dahz_Widget_Ads_300() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'ads300-widget',
            'description' => esc_html__( 'Add an Ads300 widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'ads300-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'ads300-widget',
            esc_html__( 'DF Widget - Ads300 Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title'  => esc_html__( 'Advert', 'applique' ),
            'adcode' => '',
            'image'  => '',
            'href'   => '',
            'alt'    => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        /* Make the ad code read-only if the user can't work with unfiltered HTML. */
        $read_only = '';
        if ( !current_user_can( 'unfiltered_html' ) ) {
            $read_only = ' readonly="readonly"';
        } ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <!-- Widget Ad Code: Textarea -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"><?php esc_html_e( 'Ad Code:', 'applique' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'adcode' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"<?php echo esc_attr( $read_only ); ?>><?php print $instance['adcode']; ?></textarea>
        </p>
        <p><strong><?php esc_html_e( 'or', 'applique' ); ?></strong></p>
        <!-- Widget Image: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image URL:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_url( $instance['image'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" />
        </p>
        <!-- Widget Href: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e( 'Link URL:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" value="<?php echo esc_url( $instance['href'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" />
        </p>
        <!-- Widget Alt Text: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'alt' ) ); ?>"><?php esc_html_e( 'Alt text:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'alt' ) ); ?>" value="<?php echo esc_attr( $instance['alt'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alt' ) ); ?>" />
        </p>
        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] 	= strip_tags($new_instance['title']);
        $instance['adcode'] = $new_instance['adcode'];
        $instance['image'] 	= esc_url_raw( $new_instance['image'] );
        $instance['href'] 	= esc_url_raw( $new_instance['href'] );
        $instance['alt'] 	= esc_attr( $new_instance['alt'] );

        if ( !current_user_can( 'unfiltered_html' ) )
            $instance['adcode'] = $old_instance['adcode'];

        return $instance;

    } // End update()

    function widget( $args, $instance ) {

        $html 	= '';

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title  = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Advert', 'applique' );
        $adcode = isset( $instance['adcode'] ) ? $instance['adcode'] : '';
        $image 	= isset( $instance['image'] ) ? $instance['image'] : '';
        $href 	= isset( $instance['href'] ) ? $instance['href'] : '';
        $alt 	= isset( $instance['alt'] ) ? $instance['alt'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

        /* Widget content. */

        // Add actions for plugins/themes to hook onto.
        do_action( 'widget_dahz_adspace_top' );

        if ( $adcode != '' ) {
            $html .= $adcode;
        } else {
            $html .= '<div class="ads300-wrap">';
                if ( $href != '' ) {
                    $html .= '<a href="' . esc_url( $href ) . '">';

                    // If we have an image, display that. Otherwise, use the alt text as a text link.
                    if ( $image != '' ) {
                        $html .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $alt ) . '" />';
                    } else {
                        if ( $alt != '' ) {
                            $html .= esc_attr( $alt );
                        }
                    }

                    $html .= '</a>';
                }
            $html .= '</div>';
        }

        print $html;

        // Add actions for plugins/themes to hook onto.
        do_action( 'widget_dahz_adspace_bottom' );

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

} // End Class
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Ads_300" );' ), 1 );