<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Quote extends WP_Widget {

	function Dahz_Widget_Quote() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'quote-widget',
            'description' => esc_html__( 'Add Quote widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'quote-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'quote-widget',
            esc_html__( 'DF Widget - Quote Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title' => esc_html__( 'Quote', 'applique' ),
            'quote' => '',
            'by'    => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <!-- Quote Content: Textarea Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>"><?php esc_html_e( 'Quote:', 'applique' ); ?></label>
            <textarea rows="5" name="<?php echo esc_attr( $this->get_field_name( 'quote' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>"><?php echo esc_textarea( $instance['quote'] ); ?></textarea>
        </p>
		<!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'by' ) ); ?>"><?php esc_html_e( 'By:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'by' ) ); ?>" value="<?php echo esc_attr( $instance['by'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'by' ) ); ?>" />
        </p>

        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['quote'] = esc_textarea( $new_instance['quote'] );
        $instance['by']    = esc_attr( $new_instance['by'] );

        return $instance;

    } // End update()

    function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Quote', 'applique' );
		$quote = isset( $instance['quote'] ) ? $instance['quote'] : '';
        $by    = isset( $instance['by'] ) ? $instance['by'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

        /* Widget content. */
        echo '<blockquote>';
	        echo esc_textarea( $quote );
        echo '</blockquote>';
        echo '<span><strong>' . esc_attr( $by ) . '</strong></span>';

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

} // End Class
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Quote" );' ), 1 );