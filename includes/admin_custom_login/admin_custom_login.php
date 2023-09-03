<?php

function custom_login_logo() {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/includes/admin_custom_login/admin_login.css' );
  }
  add_action('login_enqueue_scripts', 'custom_login_logo');
