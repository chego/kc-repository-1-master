<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Category extends WP_Widget {

	function Dahz_Widget_Category() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'category-widget',
            'description' => esc_html__( 'Add Category widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'category-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'category-widget',
            esc_html__( 'DF Widget - Category Widget', 'applique'),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title'     => esc_html__( 'Category Banner', 'applique' ),
            'cat_count' => 3,
            'cat_inc'   => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title (optional):', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cat_count' ) ); ?>"><?php esc_html_e( 'Category Count:', 'applique' ); ?></label>
            <input type="number" min="1" max="5" name="<?php echo esc_attr( $this->get_field_name( 'cat_count' ) ); ?>" value="<?php echo esc_attr( $instance['cat_count'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_count' ) ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cat_inc' ) ); ?>"><?php esc_html_e( 'Category Include:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'cat_inc' ) ); ?>" value="<?php echo esc_attr( $instance['cat_inc'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_inc' ) ); ?>" />
            <small><?php esc_html_e( 'This parameter takes a comma-separated list of categories by unique ID, in ascending order.', 'applique' ); ?></small>
        </p>
        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] 		= strip_tags( $new_instance['title'] );
        $instance['cat_count']  = esc_attr( $new_instance['cat_count'] );
        $instance['cat_inc']  	= esc_attr( $new_instance['cat_inc'] );

        return $instance;

    }

    function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Category Banner', 'applique' );
        $cat_count = isset( $instance['cat_count'] ) ? $instance['cat_count'] : '3';
        $cat_inc   = isset( $instance['cat_inc'] ) ? $instance['cat_inc'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

		$categories = get_categories( array(
			'number'  => esc_attr( $cat_count ),
			'include' => esc_attr( $cat_inc )
		) );

		foreach ( $categories as $category ) {
			echo '<div class="cat-banner-' . $category->term_id . ' df-category-widget aligncenter" style="background-image: url(' . taxonomy_image( $category->term_id, TRUE ) . ');">';

				echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="df-cat-link"></a>';
				echo '<h3>' . $category->name . '</h3>';

			echo '</div>'; // end .cat-banner-
		}

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Category" );'), 1 );