<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Define content width */
if ( ! isset( $content_width ) ) {
    $content_width = 780;
}

if ( !function_exists( 'applique_setup' ) ) {

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function applique_setup() {

        /* Load theme translation file */
        load_theme_textdomain( 'applique', get_template_directory() . '/langs' );

        /* This theme styles the visual editor with editor-style.css to match the theme style. */
        add_editor_style();

        /* Add default posts and comments RSS feed links to head. */
        add_theme_support( 'automatic-feed-links' );

        /* The get thumbnail/image. */
        add_theme_support( 'post-thumbnails' );

        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /* Adds core WordPress HTML5 support. */
        add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

        /**
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );

        /* This theme uses wp_nav_menu() in one location. */
        register_nav_menus( array(
            'primary-menu' => esc_attr__( 'Primary Menu', 'applique' ),
            'footer-menu'  => esc_attr__( 'Footer Menu', 'applique' )
        ) );

        /**
         * Woocommerce compatibilty
         */
        add_theme_support( 'woocommerce' );

    }

}

add_action( 'after_setup_theme', 'applique_setup', 5 );

if ( !function_exists( 'dahz_widget_setup' ) ) {

    /**
     * Sets up widget theme defaults.
     *
     * Note that this function is hooked into the widget_init hook.
     */
    function dahz_widget_setup() {

        $df_skin = get_theme_mod( 'df_skin', 'df-skin-boxed' );

        /* This theme dynamic_sidebar() in one location. */
        register_sidebar( array(
            'name'          => esc_html__( 'Primary', 'applique' ),
            'id'            => 'primary',
            'description'   => esc_html__( 'The default primary sidebar for your website, used in two layouts.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4><span>' : '<h4>',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>'
        ) );

        /* This theme blog page. */
        register_sidebar( array(
            'name'          => esc_html__( 'Blog - First Column', 'applique' ),
            'id'            => 'blog-first',
            'description'   => esc_html__( 'Add widget on first column of blog page.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4><span>' : '<h4>',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>'
        ) );

        /* This theme blog page. */
        register_sidebar( array(
            'name'          => esc_html__( 'Blog - Second Column', 'applique' ),
            'id'            => 'blog-second',
            'description'   => esc_html__( 'Add widget on second column of blog page.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4><span>' : '<h4>',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>'
        ) );

        /* This theme blog page. */
        register_sidebar( array(
            'name'          => esc_html__( 'Blog - Third Column', 'applique' ),
            'id'            => 'blog-third',
            'description'   => esc_html__( 'Add widget on third column of blog page.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4><span>' : '<h4>',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>'
        ) );

        /* This theme instagram sidebar in footer location. */
        register_sidebar( array(
            'name'          => esc_html__( 'Instagram Footer', 'applique' ),
            'id'            => 'instagram',
            'description'   => esc_html__( 'Use the "Instagram Feed" plugin, then paste the shortcode using widget text here. IMPORTANT: For best result, select 6 columns and set number of photo to 12.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ) );

        /* This theme front page container in Front Page Template. */
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - First Row', 'applique' ),
            'id'            => 'front-first',
            'description'   => esc_html__( 'This widget appear on the top of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );

        /* This theme front page container in Front Page Template. */
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Second Row, Column 1', 'applique' ),
            'id'            => 'front-second-1',
            'description'   => esc_html__( 'This widget appear at the second of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Second Row, Column 2', 'applique' ),
            'id'            => 'front-second-2',
            'description'   => esc_html__( 'This widget appear at the third of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Second Row, Column 3', 'applique' ),
            'id'            => 'front-second-3',
            'description'   => esc_html__( 'This widget appear at the fourth of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );

        /* This theme front page container in Front Page Template. */
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Third Row, Column 1', 'applique' ),
            'id'            => 'front-third-1',
            'description'   => esc_html__( 'This widget appear at the fifth of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Third Row, Column 2', 'applique' ),
            'id'            => 'front-third-2',
            'description'   => esc_html__( 'This widget appear at the sixth of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );

        /* This theme front page container in Front Page Template. */
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Fourth Row, Column 1', 'applique' ),
            'id'            => 'front-fourth-1',
            'description'   => esc_html__( 'This widget appear at the seventh of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Fourth Row, Column 2 ', 'applique' ),
            'id'            => 'front-fourth-2',
            'description'   => esc_html__( 'This widget appear at the eighth of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );

        /* This theme front page container in Front Page Template. */
        register_sidebar( array(
            'name'          => esc_html__( 'Front Page - Last Row', 'applique' ),
            'id'            => 'front-last',
            'description'   => esc_html__( 'This widget appear at the lowermost of widget area in the Front Page template.', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4 class="aligncenter"><span>' : '<h4 class="aligncenter">',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>',
        ) );

      /* This theme dynamic_sidebar() in one location. */
        register_sidebar( array(
            'name'          => esc_html__( 'Shop', 'applique' ),
            'id'            => 'shop',
            'description'   => esc_html__( 'The default primary sidebar for your shop', 'applique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $df_skin == 'df-skin-light' ? '<h4><span>' : '<h4>',
            'after_title'   => $df_skin == 'df-skin-light' ? '</span></h4>' : '</h4>'
        ) );

    }

}

add_action( 'widgets_init', 'dahz_widget_setup', 5 );

/**
 * Function to register image size of theme.
 *
 * @return void
 */
if ( !function_exists( 'df_img_size' ) ) {

    function df_img_size() {
        add_image_size( 'feat-slider', '1140', '641', true );
        add_image_size( 'feat-grid', '1250', '980', true );
        add_image_size( 'rel-post', '250', '250', true );
        add_image_size( 'loop-blog', '600', '600', true );
        add_image_size( 'recent-small', '80', '80', true );
        add_image_size( 'recent-medium1', '330', '330', true );
        add_image_size( 'recent-medium2', '160', '160', true );
        add_image_size( 'recent-medium3', '700', '403', true );
        add_image_size( 'recent-big1', '570', '428', true );
        add_image_size( 'recent-big2', '330', '248', true );
        add_image_size( 'template-archive', '293', '293', true );
        add_image_size( 'sticky-img', '600', '800', true );
        add_image_size( 'recent-image-medium', '180', '129', true );
    }

    add_action( 'init', 'df_img_size' );
}