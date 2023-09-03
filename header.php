<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php generic_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="<?php if (is_single()) {
    echo esc_html(wp_strip_all_tags(get_the_excerpt(), true));
} else {
    bloginfo('description');
} ?>" />
<meta name="keywords" content="<?php echo esc_html(implode(', ', wp_get_post_tags(get_the_ID(), array( 'fields' => 'names' )))); ?>" />
<link rel="canonical" href="<?php echo esc_url('https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="application/ld+json">
{
"@context": "https://www.schema.org/",
"@type": "WebSite",
"name": "<?php bloginfo('name'); ?>",
"url": "<?php echo esc_url(home_url()); ?>/"
}
</script>
<script type="application/ld+json">
{
"@context": "https://www.schema.org/",
"@type": "Organization",
"name": "<?php bloginfo('name'); ?>",
"url": "<?php echo esc_url(home_url()); ?>/",
"logo": "<?php if (has_custom_logo()) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    echo esc_url($logo[0]);
} ?>",
"image": "<?php if (has_site_icon()) {
    echo esc_url(get_site_icon_url());
} ?>",
"description": "<?php bloginfo('description'); ?>"
}
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php //wp_body_open(); ?>
    <div id="wrapper" class="hfeed">

        <header id="header" role="banner">
        </header>
        <div id="container">
        <main id="content" role="main">