<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

if ( !class_exists( 'Dahz_Widget_Recent_Medium' ) ) {
    
    class Dahz_Widget_Recent_Medium extends WP_Widget {

    	function Dahz_Widget_Recent_Medium() {

            /* Widget settings. */
            $widget_ops = array(
                'classname'   => 'recent-medium-widget',
                'description' => esc_html__( 'Add Recent Medium widget to your sidebar or frontpage.', 'applique' )
            );

            /* Widget control settings. */
            $control_ops = array(
                'width'   => 250,
                'height'  => 350,
                'id_base' => 'recent-medium-widget'
            );

            /* Create the widget. */
            WP_Widget::__construct(
                'recent-medium-widget',
                esc_html__( 'DF Widget - Recent Medium Widget', 'applique' ),
                $widget_ops,
                $control_ops
            );

        } // End Constructor

        function form( $instance ) {

            /* Set up some default widget settings. */
            $defaults = array(
                'title'      => esc_html__( 'Recent Post Medium', 'applique' ),
                'version'    => '',
                'post_shown' => 3,
                'post_id'    => '',
                'cat_inc'    => ''
            );
            $instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <!-- Widget Title: Text Input -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'applique' ); ?></label>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
            </p>
            <!-- Banner Target: Select Input -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'version' ) ); ?>"><?php esc_html_e( 'Version:', 'applique' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'version' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'version' ) ); ?>">
                    <?php $options = array(
                            'ver1' => esc_html__( 'Version 1', 'applique' ),
                            'ver2' => esc_html__( 'Version 2', 'applique' )
                          ); ?>
                    <?php foreach ($options as $option => $key) : ?>
                        <option value="<?php echo esc_attr( $option ); ?>"<?php $instance['version'] == $option ? selected( $instance['version'], $option ) : ''; ?>><?php echo esc_html( $key ); ?></option>
                    <?php endforeach; ?>
    			</select>
            </p>
            <!-- Post Shown: Number Input -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_shown' ) ); ?>"><?php esc_html_e( 'Post Shown:', 'applique' ); ?></label>
                <input type="number" min="1" max="12" name="<?php echo esc_attr( $this->get_field_name( 'post_shown' ) ); ?>" value="<?php echo esc_attr( $instance['post_shown'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_shown' ) ); ?>" />
            </p>
            <!-- Post ID: Text Input -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>"><?php esc_html_e( 'Post ID Include:', 'applique' ); ?></label>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>" value="<?php echo esc_attr( $instance['post_id'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_id' ) ); ?>" />
                <small><?php esc_html_e( 'Insert the post id separate with \' , \'. ', 'applique' ); ?></small>
            </p>
            <!-- Post Category: Text Input -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat_inc' ) ); ?>"><?php esc_html_e( 'Category Include:', 'applique' ); ?></label>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'cat_inc' ) ); ?>" value="<?php echo esc_attr( $instance['cat_inc'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_inc' ) ); ?>" />
                <small><?php esc_html_e( 'Insert category slug separate with \' , \'. e.g. \'post-format,hello\'.', 'applique' ); ?></small>
            </p>
            <?php
        } // End form()

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            /* Strip tags for title and name to remove HTML (important for text inputs). */
            $instance['title'] 	 	= strip_tags( $new_instance['title'] );
            $instance['version'] 	= esc_attr( $new_instance['version'] );
            $instance['post_shown'] = esc_attr( $new_instance['post_shown'] );
            $instance['post_id']    = esc_attr( $new_instance['post_id'] );
            $instance['cat_inc']    = esc_attr( $new_instance['cat_inc'] );

            return $instance;

        }

        function widget( $args, $instance ) {

            extract( $args, EXTR_SKIP );

            /* Our variables from the widget settings. */
            $title      = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Recent Post Medium', 'applique' );
            $version 	= isset( $instance['version'] ) ? $instance['version'] : 'ver1';
            $post_shown = isset( $instance['post_shown'] ) ? $instance['post_shown'] : '3';
            $post_id    = isset( $instance['post_id'] ) ? $instance['post_id'] : '';
            $cat_inc    = isset( $instance['cat_inc'] ) ? $instance['cat_inc'] : '';

            /* Before widget (defined by themes). */
            print $before_widget;

            /* Display the widget title if one was input (before and after defined by themes). */
            if ($title) {
                print $before_title . esc_attr( $title ) . $after_title;
            } // End IF Statement
            if ( $post_id != '' ) {
                $post_id = array_map('intval', explode(',', $post_id));
            }
            $args = array(
                'post__in'              => $post_id,
    			'posts_per_page'        => esc_attr( $post_shown ),
                'no_found_rows'         => true,
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => true,
                'category_name'         => esc_attr( $cat_inc )
    		);

    		$new = new WP_Query( $args );

    		$size 	 = 'recent-medium1';
    		$heading = 'h3';
    		$col 	 = is_page_template( 'template-front-page.php' ) && $version == 'ver1' ? 'class=col-md-6' : 'class=aligncenter';
    		if ( $version != 'ver1' ) {
    			$size 	 = is_page_template( 'template-front-page.php' ) ? 'recent-medium3' : 'recent-medium2';
    			$heading = is_page_template( 'template-front-page.php' ) ? 'h3' : 'h5';
    			$col 	 = is_page_template( 'template-front-page.php' ) && $version == 'ver2' ? '' : 'class=col-md-6';
    		}

    		if ( $new->have_posts() ) : ?>

    			<ul class="recent-wrapper <?php echo esc_attr( $version ) ?>">

    			<?php while ( $new->have_posts() ) : $new->the_post(); ?>
    				<li <?php echo esc_attr( $col ) ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="featured-media">
                                <a href="<?php the_permalink() ?>">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), $size ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

    					<div class="recent-content">

                            <?php if ( $version == 'ver1' ) : ?>
                                <div class="inner-wrap">
                                <span class="separator"></span>
                                <?php echo sprintf( '<div class="df-single-category">%s</div>', df_category_blog() ); ?>
                            <?php else : ?>
                                <?php echo sprintf( '<div class="df-single-category">%s</div>', df_category_blog() ); ?>
                            <?php endif; ?>

    						<<?php echo esc_attr( $heading ) ?> class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), '3' ) ?></a></<?php echo esc_attr( $heading ) ?>>

    						<?php if ( $version == 'ver1' ) : ?>
                                <?php echo '<div class="df-post-on">' . df_posted_on() . '</div>'; ?>
                            <?php endif; ?>

    						<?php if ( $version == 'ver2' ) : ?>
    							<div class="df-post-on"><?php echo df_posted_on() ?></div>
    						<?php endif; ?>

                            <?php if ( $version == 'ver1' || ( is_page_template( 'template-front-page.php' ) && $version == 'ver2' ) ) : ?>
                                <p>
                                    <?php echo wp_trim_words( get_the_content(), '20' ); ?>
                                </p>
                                <a href="<?php the_permalink() ?>" class="more-link outline small"><?php esc_html_e( 'Continue Reading', 'applique' ) ?></a>
                            <?php endif; ?>

    					</div>

    				</li>
    			<?php endwhile; ?>
    			</ul>
    		<?php endif;

    		wp_reset_postdata();

            /* After widget (defined by themes). */
            print $after_widget;

        } // End widget()

    }
    add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Recent_Medium" );'), 1 );

}
