<?php
$nav_pos = get_theme_mod( 'df_nav_pos', 'nav_top' );
?>

<?php
/**
 * `dahz_attr( 'header' )` are function to print attribute and microdata in header element.
 * This function locate in `libraries/attr.php` under function named `dahz_attr_header`.
 */ ?>
<div class="df-mobile-menu">
	<div class="inner-wrapper container">
		<div class="df-ham-menu">
			<div class="col-left">
				<a href="#">
					<span class="df-top"></span>
					<span class="df-middle"></span>
					<span class="df-bottom"></span>
				</a>
			</div>
			<div class="col-right">
				<a href="#" class="mobile-subs"><i class="ion-ios-email-outline"></i></a>
				<a href="#" class="mobile-search"><i class="ion-ios-search-strong"></i></a>
			</div>
		</div>
		<div class="df-menu-content">
			<div class="content-wrap">
				<?php get_template_part( 'templates/menus/primary' ); ?>
				<?php echo df_social_account(); ?>
			</div>
		</div>
	</div>
</div>

<div <?php dahz_attr( 'header' ); ?>>

	<div class="df-header-inner">

		<?php if ( $nav_pos == 'nav_top' ) : ?>

			<?php get_template_part( 'templates/menus/primary' ); ?>

		<?php endif; ?>

		<?php
		/**
		 * `dahz_attr( 'branding' )` are function to print attribute and microdata in site identity element.
		 * This function locate in `libraries/attr.php` under function named `dahz_attr_branding`.
		 */ ?>
		<div <?php dahz_attr( 'branding' ); ?>>

			<?php if ( get_theme_mod( 'df_logo', get_template_directory_uri() . '/assets/images/main-logo.png' ) != '' ) : ?>

				<?php get_template_part( 'templates/headers/logo', 'img' ); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/headers/logo', 'text' ); ?>

			<?php endif; ?>

		</div>

		<?php if ( $nav_pos == 'nav_btm' || $nav_pos == 'nav_btm_logo_left' ) : ?>

			<?php get_template_part( 'templates/menus/primary' ); ?>

		<?php endif; ?>

	</div>

	<?php get_template_part( 'templates/headers/head-ads' ); ?>

</div>