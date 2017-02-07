<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/**
 * If the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title display-4">

            <?php 
                if ( get_comments_number() == '1' ) {

                    esc_html_e( 'One comment', 'applique' );
                    
                } else {

                    esc_html_e( number_format_i18n( get_comments_number() ) . ' comments', 'applique' );
                    
                }
            ?>

        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>

            <div id="comment-nav-above" class="comment-navigation" role="navigation">

                <div class="nav-prev">
                	<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'applique' ) ); ?>
                </div>

                <div class="nav-next">
                	<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'applique' ) ); ?>
                </div>

                <div class="clear"></div>

            </div><!-- #comment-nav-below -->

        <?php endif; // check for comment navigation  ?>

		<?php
			/**
			 * Loop through and list the comments. Tell wp_list_comments() to use dahz_comment() to format the comments.
			 * If you want to override this in a child theme, then you can define dahz_comment() and that will be used instead.
			 * See dahz_comment() in includes/admin/theme-comments.php for more.
			 */
			wp_list_comments( array(
				'style'       => 'div',
				'type'        => 'comment',
				'callback' 	  => 'dahz_comment',
				'avatar_size' => 60
			) );
		?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>

            <div id="comment-nav-below" class="comment-navigation" role="navigation">

                <div class="nav-prev">
                	<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'applique' ) ); ?>
                </div>

                <div class="nav-next">
                	<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'applique' ) ); ?>
                </div>

                <div class="clear"></div>

            </div><!-- #comment-nav-below -->

        <?php endif; // check for comment navigation  ?>

	<?php endif; // have_comments() ?>

	<?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'applique' ); ?></p>

	<?php endif; ?>

	<?php
		$commenter      = wp_get_current_commenter();
        $req            = get_option( 'require_name_email' );
        $aria_req       = ( $req ? ' aria-required="true"' : '' );
        $required_text  = ' ' . wp_kses( __( 'Required fields are marked <span class="required">*</span>', 'applique' ), array( 'span' => array( 'class' => array() ) ) );

        $args = array(
            'title_reply'           => esc_html__( 'Leave a Reply', 'applique' ),
            'title_reply_to'        => esc_html__( 'Leave a Reply to %s', 'applique' ),
            'cancel_reply_link'     => esc_html__( 'Cancel Reply', 'applique' ),
            'label_submit'          => esc_html__( 'Submit Your Comment', 'applique' ),
            'class_submit'          => 'submit',
            'fields'                => apply_filters( 'comment_form_default_fields', array(
					                        'author' => '<div class="form-fields row"><span class="comment-form-author col-md-4">' . '<label class="assistive-text" for="author">' . esc_html__( 'Name &#42;', 'applique' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></span>',
					                        'email'  => '<span class="comment-form-email col-md-4"><label class="assistive-text" for="email">' . esc_html__( 'Email &#42;', 'applique' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></span>',
					                        'url'    => '<span class="comment-form-url col-md-4"><label class="assistive-text" for="url">' . esc_html__( 'Website', 'applique' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></span></div>'
									   ) ),
            'comment_field'         => '<p class="comment-form-comment"><label class="assistive-text" for="comment">' . esc_html__( 'Comment &#42;', 'applique' ) . '</label><textarea class="u-full-width" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
            'comment_notes_after'   => '<span></span>',
            'must_log_in'           => '<p class="must-log-in text-small"><span class="df-comments-meta">' . esc_html__( 'You must be', 'applique' ) . '</span><a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">' . esc_html__( 'logged in', 'applique' ) . '</a>' . esc_html__( 'to post a comment.', 'applique' ) . '</p>',
            'logged_in_as'          => '<p class="logged-in-as text-small"><span class="df-comments-meta">' . esc_html__( 'Logged in as', 'applique' ) . '</span> <a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>. <a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">' . esc_html__( 'Log out?' ,'applique' ) . '</a></p>',
            'comment_notes_before'  => '<p class="comment-notes text-small">' . esc_html__( 'Your email address will not be published.', 'applique' ) . ( $req ? $required_text : '' ) . '</p>',
        ); ?>

	<?php comment_form( $args ); ?>

</div><!-- .comments-area -->