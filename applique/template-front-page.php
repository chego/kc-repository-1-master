<?php
/**
 * Template Name: Front Page
 *
 * The Front Page Template.
 *
 */
?>

<?php get_header(); ?>

	<div id="content-wrap">

		<div class="main-sidebar-container container">

			<div class="row">

				<?php get_sidebar( 'front-first' ); ?>
				<?php get_sidebar( 'front-second' ); ?>
				<?php get_sidebar( 'front-third' ); ?>
				<?php get_sidebar( 'front-fourth' ); ?>
				<?php get_sidebar( 'front-last' ); ?>

			</div>

		</div>

		<?php echo df_social_account(); ?>
		<?php echo df_miscellaneous();	?>

	</div>

<?php get_footer(); ?>