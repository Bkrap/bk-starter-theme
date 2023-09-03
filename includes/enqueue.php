<?php

/**
 * Enqueue / import CSS & JS main script (builded from webpack.config.js)
 * @since 1.0.0.
 * Author: Bruno Krapljan
 */

 
add_action( 'wp_enqueue_scripts', 'generic_theme_scripts' );

function generic_theme_scripts() {
    $the_theme = wp_get_theme();
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true );
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '3.6.0', true );
    // wp_enqueue_script( 'bootstrap-js', BK_STARTER_THEME_PATH . '/build/bootstrap.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'generic-main-js', BK_STARTER_THEME_PATH . '/build/main.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), $the_theme->get( 'Version' ), 'all' );
    wp_enqueue_style( 'generic-styles-css', BK_STARTER_THEME_PATH . '/build/styles.css', array(), $the_theme->get( 'Version' ), 'all' );

      // Localized script
    wp_localize_script( 'generic-main-js', 'generic_ajax_object', array(
        'ajax_url'                => admin_url( 'admin-ajax.php' ),
        'realPath'                => get_site_url(),
    ));
}


add_image_size( 'card-slider', 350, 380 );

/***** */

