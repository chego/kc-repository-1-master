<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Social extends WP_Widget {

	function Dahz_Widget_Social() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'social-widget',
            'description' => esc_html__( 'Add Social widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'social-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'social-widget',
            esc_html__( 'DF Widget - Social Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array( 'title' => esc_html__( 'Sosial Media', 'applique' ) );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;

    }

	function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title 	= isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Sosial Media', 'applique' );

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

        $html = print ( df_social_account() );

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Social" );'), 1 );