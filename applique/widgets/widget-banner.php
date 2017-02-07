<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Banner extends WP_Widget {

	function Dahz_Widget_Banner() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'banner-widget',
            'description' => esc_html__( 'Add Banner widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'banner-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'banner-widget',
            esc_html__( 'DF Widget - Banner Widget', 'applique'),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title'     => esc_html__( 'Banner', 'applique' ),
            'img_url'   => '',
            'ban_title' => '',
            'ban_sub'   => '',
            'height'    => 100,
            'ban_url'   => '',
            'ban_tgt'   => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <!-- Image Url: Url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>"><?php esc_html_e( 'Image URL:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'img_url' ) ); ?>" value="<?php echo esc_url( $instance['img_url'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>" />
        </p>
        <!-- Banner Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ban_title' ) ); ?>"><?php esc_html_e( 'Banner Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'ban_title' ) ); ?>" value="<?php echo esc_attr( $instance['ban_title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ban_title' ) ); ?>" />
        </p>
        <!-- Banner Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ban_sub' ) ); ?>"><?php esc_html_e( 'Banner Subtitle:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'ban_sub' ) ); ?>" value="<?php echo esc_attr( $instance['ban_sub'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ban_sub' ) ); ?>" />
        </p>
        <!-- Banner Height: Number Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Banner Height (px):', 'applique' ); ?></label>
            <input type="number" min="100" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" value="<?php echo esc_attr( $instance['height'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" />
            <small><?php esc_html_e( 'This value will generate as \'px\' unit.', 'applique' ) ?></small>
        </p>
        <!-- Banner Url: Url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ban_url' ) ); ?>"><?php esc_html_e( 'Banner URL:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'ban_url' ) ); ?>" value="<?php echo esc_url( $instance['ban_url'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ban_url' ) ); ?>" />
        </p>
        <!-- Banner Target: Select Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ban_tgt' ) ); ?>"><?php esc_html_e( 'Banner Target:', 'applique' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'ban_tgt' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'ban_tgt' ) ); ?>">
                <?php $options = array( '_self' => esc_html__( 'Open Current Window', 'applique' ), '_blank' => esc_html__( 'Open New Window', 'applique' ) ); ?>
                <?php foreach ($options as $option => $key) : ?>
                    <option value="<?php echo esc_attr( $option ); ?>"<?php $instance['ban_tgt'] == $option ? selected( $instance['ban_tgt'], $option ) : ''; ?>><?php echo esc_html( $key ); ?></option>
                <?php endforeach; ?>
			</select>
        </p>

        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] 	 	= strip_tags( $new_instance['title'] );
        $instance['img_url'] 	= esc_url_raw( $new_instance['img_url'] );
        $instance['ban_title']  = esc_attr( $new_instance['ban_title'] );
        $instance['ban_sub'] 	= esc_attr( $new_instance['ban_sub'] );
        $instance['height'] 	= esc_attr( $new_instance['height'] );
        $instance['ban_url'] 	= esc_url_raw( $new_instance['ban_url'] );
        $instance['ban_tgt'] 	= esc_attr( $new_instance['ban_tgt'] );

        return $instance;

    }

    function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title      = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Banner', 'applique' );
        $img_url 	= isset( $instance['img_url'] ) ? $instance['img_url'] : '';
        $ban_title  = isset( $instance['ban_title'] ) ? $instance['ban_title'] : '';
        $ban_sub 	= isset( $instance['ban_sub'] ) ? $instance['ban_sub'] : '';
        $height 	= isset( $instance['height'] ) ? $instance['height'] : '';
        $ban_url 	= isset( $instance['ban_url'] ) ? $instance['ban_url'] : '';
        $ban_tgt 	= isset( $instance['ban_tgt'] ) ? $instance['ban_tgt'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ($title) {
            print $before_title . esc_attr( $title ) . $after_title;
        } // End IF Statement

        echo '<div class="df-banner-widget aligncenter" style="height: ' . esc_attr( $height ) . 'px;">';
	        echo '<div class="df-banner-img" style="background-image: url(' . esc_url( $img_url ) . ');"></div>';
	        echo '<a href="' . esc_url( $ban_url ) . '" class="df-cat-link" target="' . esc_attr( $ban_tgt ) . '"></a>';
            if ( $ban_title ) :
                echo '<span>' . esc_attr( $ban_sub ) . '</span>';
    	        echo '<h3>' . esc_attr( $ban_title ) . '</h3>';
            endif;
        echo '</div>';

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Banner" );'), 1 );