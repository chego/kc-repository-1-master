<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Ads_125 extends WP_Widget {

	function Dahz_Widget_Ads_125() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'ads125-widget',
            'description' => esc_html__( 'Add an Ads 125px widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'ads125-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'ads125-widget',
            esc_html__( 'DF Widget - Ads125 Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
			'title'  	=> esc_html__( 'Advert', 'applique' ),
			'adcode1' 	=> '',
			'image1'  	=> '',
			'href1' 	=> '',
			'alt1' 	 	=> '',
			'adcode2' 	=> '',
			'image2'  	=> '',
			'href2' 	=> '',
			'alt2' 	 	=> '',
			'adcode3' 	=> '',
			'image3'  	=> '',
			'href3' 	=> '',
			'alt3' 	 	=> '',
			'adcode4' 	=> '',
			'image4'  	=> '',
			'href4' 	=> '',
			'alt4' 	 	=> ''
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

        <?php $i = 0; while ( $i < 4 ) : $i++ ?>
	        <p><strong><?php esc_html_e( 'Ads', 'applique' ) . $i ?></strong></p>

	        <!-- Widget Ad Code: Textarea -->
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'adcode' . $i ) ); ?>"><?php esc_html_e( 'Ad Code', 'applique' ) . $i; ?></label>
	            <textarea rows="5" name="<?php echo esc_attr( $this->get_field_name( 'adcode' . $i ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adcode' . $i ) ); ?>"<?php echo esc_attr( $read_only ); ?>><?php print $instance['adcode' . $i]; ?></textarea>
	        </p>
	        <p><strong><?php esc_html_e( 'or', 'applique' ); ?></strong></p>

	        <!-- Widget Image: Text Input -->
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'image' . $i ) ); ?>"><?php esc_html_e( 'Image URL', 'applique' ) . $i; ?></label>
	            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'image' . $i ) ); ?>" value="<?php echo esc_url( $instance['image' . $i] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' . $i ) ); ?>" />
	        </p>
	        <!-- Widget Href: Text Input -->
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'href' . $i ) ); ?>"><?php esc_html_e( 'Link URL', 'applique' ) . $i; ?></label>
	            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'href' . $i ) ); ?>" value="<?php echo esc_url( $instance['href' . $i] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' . $i ) ); ?>" />
	        </p>
	        <!-- Widget Alt Text: Text Input -->
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'alt' . $i ) ); ?>"><?php esc_html_e( 'Alt text:', 'applique' ) . $i; ?></label>
	            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'alt' . $i ) ); ?>" value="<?php echo esc_url( $instance['alt' . $i] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alt' . $i ) ); ?>" />
	        </p>
        <?php endwhile; ?>

        <?php
    } // End form()

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] 		= strip_tags($new_instance['title']);
        $instance['adcode1'] 	= $new_instance['adcode1'];
        $instance['image1'] 	= esc_url_raw( $new_instance['image1'] );
        $instance['href1'] 		= esc_url_raw( $new_instance['href1'] );
        $instance['alt1'] 		= esc_attr( $new_instance['alt1'] );
        $instance['adcode2'] 	= $new_instance['adcode2'];
        $instance['image2'] 	= esc_url_raw( $new_instance['image2'] );
        $instance['href2'] 		= esc_url_raw( $new_instance['href2'] );
        $instance['alt2'] 		= esc_attr( $new_instance['alt2'] );
        $instance['adcode3'] 	= $new_instance['adcode3'];
        $instance['image3'] 	= esc_url_raw( $new_instance['image3'] );
        $instance['href3'] 		= esc_url_raw( $new_instance['href3'] );
        $instance['alt3'] 		= esc_attr( $new_instance['alt3'] );
        $instance['adcode4'] 	= $new_instance['adcode4'];
        $instance['image4'] 	= esc_url_raw( $new_instance['image4'] );
        $instance['href4'] 		= esc_url_raw( $new_instance['href4'] );
        $instance['alt4'] 		= esc_attr( $new_instance['alt4'] );

        if ( !current_user_can( 'unfiltered_html' ) ) {
            $instance['adcode1'] = $old_instance['adcode1'];
            $instance['adcode2'] = $old_instance['adcode2'];
            $instance['adcode3'] = $old_instance['adcode3'];
            $instance['adcode4'] = $old_instance['adcode4'];
        }

        return $instance;

    } // End update()

    function widget( $args, $instance ) {

        $html 	= '';

        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title   = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Advert', 'applique' );
        $adcode1 = isset( $instance['adcode1'] ) ? $instance['adcode1'] : '';
        $image1  = isset( $instance['image1'] ) ? $instance['image1'] : '';
        $href1   = isset( $instance['href1'] ) ? $instance['href1'] : '';
        $alt1    = isset( $instance['alt1'] ) ? $instance['alt1'] : '';
        $adcode2 = isset( $instance['adcode2'] ) ? $instance['adcode2'] : '';
        $image2  = isset( $instance['image2'] ) ? $instance['image2'] : '';
        $href2   = isset( $instance['href2'] ) ? $instance['href2'] : '';
        $alt2    = isset( $instance['alt2'] ) ? $instance['alt2'] : '';
        $adcode3 = isset( $instance['adcode3'] ) ? $instance['adcode3'] : '';
        $image3  = isset( $instance['image3'] ) ? $instance['image3'] : '';
        $href3   = isset( $instance['href3'] ) ? $instance['href3'] : '';
        $alt3    = isset( $instance['alt3'] ) ? $instance['alt3'] : '';
        $adcode4 = isset( $instance['adcode4'] ) ? $instance['adcode4'] : '';
        $image4  = isset( $instance['image4'] ) ? $instance['image4'] : '';
        $href4   = isset( $instance['href4'] ) ? $instance['href4'] : '';
        $alt4    = isset( $instance['alt4'] ) ? $instance['alt4'] : '';

        /* Before widget (defined by themes). */
        print $before_widget;

        /* Display the widget title if one was input (before and after defined by themes). */
        if ( $title )
            print $before_title . esc_attr( $title ) . $after_title;

        /* Widget content. */

        // Add actions for plugins/themes to hook onto.
        do_action( 'widget_dahz_adspace_top' );

    	echo '<div class="ads125 row">';

	    	echo '<div class="col-md-6">';

		        if ( $adcode1 != '' ) :
		            print $adcode1;
		        else :
		            if ( $href1 != '' ) {
		                echo '<a href="' . esc_url( $href1 ) . '">';

		                // If we have an image, display that. Otherwise, use the alt text as a text link.
		                if ( $image1 != '' ) {
		                    echo '<img src="' . esc_url( $image1 ) . '" alt="' . esc_attr( $alt1 ) . '" />';
		                } else {
		                    if ( $alt1 != '' ) {
		                        echo esc_attr( $alt1 );
		                    }
		                }

		                echo '</a>';
		            }
		        endif;

	    	echo '</div>'; // end .col-md-6

            echo '<div class="col-md-6">';

                if ( $adcode2 != '' ) :
                    print $adcode2;
                else :
                    if ( $href2 != '' ) {
                        echo '<a href="' . esc_url( $href2 ) . '">';

                        // If we have an image, display that. Otherwise, use the alt text as a text link.
                        if ( $image2 != '' ) {
                            echo '<img src="' . esc_url( $image2 ) . '" alt="' . esc_attr( $alt2 ) . '" />';
                        } else {
                            if ( $alt2 != '' ) {
                                echo esc_attr( $alt2 );
                            }
                        }

                        echo '</a>';
                    }
                endif;

            echo '</div>'; // end .col-md-6

            echo '<div class="col-md-6">';

                if ( $adcode3 != '' ) :
                    print $adcode3;
                else :
                    if ( $href3 != '' ) {
                        echo '<a href="' . esc_url( $href3 ) . '">';

                        // If we have an image, display that. Otherwise, use the alt text as a text link.
                        if ( $image3 != '' ) {
                            echo '<img src="' . esc_url( $image3 ) . '" alt="' . esc_attr( $alt3 ) . '" />';
                        } else {
                            if ( $alt3 != '' ) {
                                echo esc_attr( $alt3 );
                            }
                        }

                        echo '</a>';
                    }
                endif;

            echo '</div>'; // end .col-md-6

            echo '<div class="col-md-6">';

                if ( $adcode4 != '' ) :
                    print $adcode4;
                else :
                    if ( $href4 != '' ) {
                        echo '<a href="' . esc_url( $href4 ) . '">';

                        // If we have an image, display that. Otherwise, use the alt text as a text link.
                        if ( $image4 != '' ) {
                            echo '<img src="' . esc_url( $image4 ) . '" alt="' . esc_attr( $alt4 ) . '" />';
                        } else {
                            if ( $alt4 != '' ) {
                                echo esc_attr( $alt4 );
                            }
                        }

                        echo '</a>';
                    }
                endif;

            echo '</div>'; // end .col-md-6

    	echo '</div>'; // end .row


        // Add actions for plugins/themes to hook onto.
        do_action( 'widget_dahz_adspace_bottom' );

        /* After widget (defined by themes). */
        print $after_widget;

    } // End widget()

} // End Class
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Ads_125" );' ), 1 );