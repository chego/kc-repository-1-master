<?php
// File Security Check
if (!defined('ABSPATH')) { exit; }

class Dahz_Widget_Recent_Big extends WP_Widget {

	function Dahz_Widget_Recent_Big() {

        /* Widget settings. */
        $widget_ops = array(
            'classname'   => 'recent-big-widget',
            'description' => esc_html__( 'Add Recent Big widget to your sidebar or frontpage.', 'applique' )
        );

        /* Widget control settings. */
        $control_ops = array(
            'width'   => 250,
            'height'  => 350,
            'id_base' => 'recent-big-widget'
        );

        /* Create the widget. */
        WP_Widget::__construct(
            'recent-big-widget',
            esc_html__( 'DF Widget - Recent Big Widget', 'applique' ),
            $widget_ops,
            $control_ops
        );

    } // End Constructor

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title'      => esc_html__( 'Recent Post Big', 'applique' ),
            'version'    => '',
            'post_shown' => 3,
            'post_id'    => '',
            'cat_inc'    => '',
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
                <?php foreach ( $options as $option => $key ) : ?>
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
        global $post;
        extract( $args, EXTR_SKIP );

        /* Our variables from the widget settings. */
        $title      = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : esc_html__( 'Recent Post Big', 'applique' );
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

		$size = 'recent-big1';
		$col  = 'class=aligncenter';

		if ( $version != 'ver1' )
            $size = 'recent-big2';

        if ( is_page_template( 'template-front-page.php' ) ) {
            $size = 'full';
            $col = '';
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

                        <?php if ( is_page_template( 'template-front-page.php' ) && $version == 'ver2' ) : ?>
                            <div class="float-wrap col-md-6">
                        <?php endif; ?>
    						<?php if ( $version == 'ver1' ) : ?>
                                <div class="inner-wrap">
    							<span class="separator"></span>
    							<?php echo sprintf( '<div class="df-single-category">%s</div>', df_category_blog() ); ?>
    						<?php else : ?>
    							<?php echo sprintf( '<div class="df-single-category">%s</div>', df_category_blog() ); ?>
    						<?php endif; ?>

                            <?php if ( $version == 'ver1' ) : ?>
                                <h3 class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), '4' ) ?></a></h3>
                            <?php else : ?>
        						<h3 class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                            <?php endif; ?>

    						<?php if ( $version == 'ver2' ) : ?>
    							<?php echo sprintf( '<div class="df-post-on">%1$s, %2$s</div>', get_the_time( 'l' ), df_posted_on() ); ?>
    						<?php endif; ?>

                        <?php if ( is_page_template( 'template-front-page.php' ) && $version == 'ver2' ) : ?>
                            </div>
                        <?php endif; ?>

						<?php if ( $version == 'ver2' ) :
                            $length = is_page_template( 'template-front-page.php' ) && $version == 'ver2' ? '110' : '26'; ?>
							<p>
								<?php echo wp_trim_words( get_the_content(), $length ); ?>
							</p>
						<?php endif; ?>

						<?php if ( $version == 'ver1' ) : ?>
							<div class="df-post-on"><?php echo df_posted_on() ?></div>
                            <span class="separator"></span>
                            </div>
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
add_action( 'widgets_init', create_function( '', 'return register_widget( "Dahz_Widget_Recent_Big" );'), 1 );