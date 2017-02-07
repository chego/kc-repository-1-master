<?php

$paths = array(
    '/enqueue/style.php', // file to enqueue theme style.
    '/enqueue/script.php', // file to enqueue theme script.
    '/plugins/register-plugin.php', // file to list plugins used in themes.
    '/libraries/attr.php', // file to get microdata.
    '/libraries/theme-setup.php', // file to register the wordPress basic functions that needed by theme.
    '/libraries/category-image.php', // file to register the category image.
    '/libraries/customizer-backup.php', // file to register the category image.
    '/libraries/class-tgm-plugin-activation.php', // file to register used plugins in theme.
    '/customizer/customize-setup.php', // file to build theme customizer.
    '/customizer/customize-custom-field.php', // file to build theme customizer custom field.
    '/functions/custom-attr.php', // file to hook function in `libraries/attr.php`.
    '/functions/title-controller.php', // file to build title in every pages.
    '/functions/content-blog.php', // file to build content blog in post.
    '/functions/content-custom-archive.php', // file to build content custom archive in post.
    '/functions/template-tags.php', // file to build template tags in post.
    '/functions/template-featured.php', // file to build template featured area.
    '/functions/template-comments.php', // file to build template comment in post.
    '/functions/template-woocommerce.php', // file to build template woocommerce.
    '/functions/paginations.php', // file to build theme paginations.
    '/functions/page-load.php', // file to build theme paginations.
    '/meta-box/metabox-setup.php', // file to build metabox settings.
    '/widgets/widget-social.php', // file to build widget social.
    '/widgets/widget-category.php', // file to build widget category.
    '/widgets/widget-banner.php', // file to build widget banner.
    '/widgets/widget-about.php', // file to build widget banner.
    '/widgets/widget-ads-300.php', // file to build widget ads 300.
    '/widgets/widget-ads-125.php', // file to build widget ads 125.
    '/widgets/widget-quote.php', // file to build widget quote.
    '/widgets/widget-recent-small.php', // file to build widget recent post small.
    '/widgets/widget-recent-medium.php', // file to build widget recent post medium.
    '/widgets/widget-recent-big.php', // file to build widget recent post big.
    '/libraries/install-demo.php', // file to register the one click demo install
);

foreach ( $paths as $path ) {
    require_once get_template_directory() . $path;
}

