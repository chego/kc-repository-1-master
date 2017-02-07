<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_About extends WP_Widget {

	function Dahz_Widget_About() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'about-widget',
            'description' => esc_html__( 'Add About Me widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'about-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'about-widget',
            esc_html__( 'DF Widget - About Me Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
          	'title'   		=> esc_html__( 'About Me', 'applique' ),
          	'img_url' 		=> '',
          	'desc' 	  		=> '',
          	'twitter' 		=> '',
          	'facebook' 		=> '',
          	'gplus' 		=> '',
          	'instagram'		=> '',
          	'pinterest'		=> '',
          	'bloglovin'		=> '',
          	'rss'			=> ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
        </p>
        <!-- Image Url: Url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>"><?php esc_html_e( 'Avatar URL:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'img_url' ) ); ?>" value="<?php echo esc_url( $instance['img_url'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>" />
        </p>
        <!-- About Description: Textarea Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'applique' ); ?></label>
            <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" rows="5"><?php echo wp_kses( $instance['desc'], $this->df_html_allowed() ); ?></textarea>
            <small><?php esc_html_e( 'You can input tag \'<img>\' and \'<a>\'.', 'applique' ) ?></small>
        </p>
        <!-- Twitter: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" />
        </p>
        <!-- Facebook: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" />
        </p>
        <!-- Google+: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>"><?php esc_html_e( 'Google+:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'gplus' ) ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gplus' ) ); ?>" />
        </p>
        <!-- Instagram: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_url( $instance['instagram'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" />
        </p>
        <!-- Pinterest: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_url( $instance['pinterest'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" />
        </p>
        <!-- Bloglovin: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>"><?php esc_html_e( 'Bloglovin:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'bloglovin' ) ); ?>" value="<?php echo esc_url( $instance['bloglovin'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bloglovin' ) ); ?>" />
        </p>
        <!-- RSS: url Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e( 'RSS:', 'applique' ); ?></label>
            <input type="url" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" value="<?php echo esc_url( $instance['rss'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" />
        </p>


        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] 	 	= strip_tags( $new_instance['title'] );
        $instance['img_url'] 	= esc_url_raw( $new_instance['img_url'] );
        $instance['desc'] 		= wp_kses( $new_instance['desc'], $this->df_html_allowed() );
        $instance['twitter'] 	= esc_url_raw( $new_instance['twitter'] );
        $instance['facebook'] 	= esc_url_raw( $new_instance['facebook'] );
        $instance['gplus'] 		= esc_url_raw( $new_instance['gplus'] );
        $instance['instagram'] 	= esc_url_raw( $new_instance['instagram'] );
        $instance['pinterest'] 	= esc_url_raw( $new_instance['pinterest'] );
        $instance['bloglovin'] 	= esc_url_raw( $new_instance['bloglovin'] );
        $instance['rss'] 		= esc_url_raw( $new_instance['rss'] );

        return $instance;

    }

    function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title      = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'About Me', 'applique' );
        $img_url 	= isset( $instance['img_url'] ) ? $instance['img_url'] : '';
        $desc 		= isset( $instance['desc'] ) ? $instance['desc'] : '';
        $twitter 	= isset( $instance['twitter'] ) ? $instance['twitter'] : '';
        $facebook 	= isset( $instance['facebook'] ) ? $instance['facebook'] : '';
        $gplus 		= isset( $instance['gplus'] ) ? $instance['gplus'] : '';
        $instagram 	= isset( $instance['instagram'] ) ? $instance['instagram'] : '';
        $pinterest 	= isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
        $bloglovin 	= isset( $instance['bloglovin'] ) ? $instance['bloglovin'] : '';
        $rss 		= isset( $instance['rss'] ) ? $instance['rss'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

    	/* Content */
        echo '<div class="about-content aligncenter">';

        	/* Avatar */
	        echo '<div class="about-avatar">';
	        	echo '<img src="' . esc_url( $img_url ) . '" alt="About Me" />';
	        echo '</div>'; // end .about-avatar

        	/* Content */
	        echo '<div class="content-wrap">';
	        	echo '<p>' . wp_kses( $desc, $this->df_html_allowed() ) . '</p>';

	        	/* Social Account */
	        	echo '<ul>';
		        	/* Twitter */
		        	if ( $twitter != '' )
			        	echo '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';

			        /* Facebook */
		        	if ( $facebook != '' )
			        	echo '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';

			        /* Google+ */
		        	if ( $gplus != '' )
			        	echo '<li><a href="' . esc_url( $gplus ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';

			        /* Instagram */
		        	if ( $instagram != '' )
			        	echo '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>';

			        /* Pinterest */
		        	if ( $pinterest != '' )
			        	echo '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';

			        /* Pinterest */
		        	if ( $bloglovin != '' )
			        	echo '<li><a href="' . esc_url( $bloglovin ) . '" target="_blank"><i class="fa fa-heart"></i></a></li>';

			        /* RSS */
		        	if ( $rss != '' )
			        	echo '<li><a href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>';

	        	echo '</ul>';

	        echo '</div>'; // end .about-avatar

        echo '</div>'; // end .about-content

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

    private function df_html_allowed() {
        $html_allowed = array(
            'img' => array(
                'src'   => array(),
                'alt'   => array(),
                'class' => array()
            ),
            'a' => array(
                'href'  => array(),
                'title' => array(),
                'class' => array(),
            )
        );

        return $html_allowed;
    }
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_About" );'), 1 );