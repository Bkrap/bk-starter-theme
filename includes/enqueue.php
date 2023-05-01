<?php

/**
 * Enqueue / import CSS & JS main script (builded from webpack.config.js)
 * @since 1.0.0.
 * Author: Bruno Krapljan
 */

 
add_action( 'wp_enqueue_scripts', 'generic_theme_scripts' );

function generic_theme_scripts() {
    wp_enqueue_script( 'generic-main-js', BK_STARTER_THEME_PATH . '/build/main.js', array(), '1.0.0', true );
    wp_enqueue_style( 'generic-styles-css', BK_STARTER_THEME_PATH . '/build/styles.css', array(), '1.0.0', 'all' );

      // Localized script
    wp_localize_script( 'generic-main-js', 'generic_ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ));
}

/***** */
