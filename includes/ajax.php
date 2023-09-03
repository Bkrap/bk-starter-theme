<?php
defined( 'ABSPATH' ) || exit;

/**
 * Filter posts 
 */

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

function filter_posts() {

    /**
     * Post WP Query
     */

    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => get_option('posts_per_page'),
        'category__in'      => $_POST['category_id'],
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => $_POST['order'],
    );
    $query = new WP_Query( $args );

    $counter = 0; 
    $iteration = 1;
    foreach( $query->posts as $k => $v ) {
        $c = $k + 1;
        if( $counter == 13 ) {
            $counter = 0;
        }
        $counter++;

        $v->primary_category = get_the_category( $v->ID )[0]->name;
        $v->category_id      = get_the_category( $v->ID )[0]->term_id;

        if( $counter == 1 || $counter == 5 || $counter == 12 ) {
            get_partial('card-full', (array)$v);
        } else {
            get_partial('card', (array)$v);
        }

    }

    die;


}

/**************************************************************************************************/

/**
 * Load more
 */

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts() {

    /**
     * Post WP Query
     */

    $args = array(
        'post_type'         => 'post',
        'posts_per_page'    => get_option('posts_per_page'),
        'category__in'      => $_POST['activeID'],
        'post_status'       => 'publish',
        'offset'            => $_POST['offset'],
    );

    // debug($args);
    
    $query = new WP_Query( $args );

    $counter = 0; 
    $iteration = 1;
    foreach( $query->posts as $k => $v ) {
        $c = $k + 1;
        if( $counter == 13 ) {
            $counter = 0;
        }
        $counter++;

        $v->primary_category = get_the_category( $v->ID )[0]->name;
        $v->category_id      = get_the_category( $v->ID )[0]->term_id;

        if( $counter == 1 || $counter == 5 || $counter == 12 ) {
            get_partial('card-full', (array)$v);
        } else {
            get_partial('card', (array)$v);
        }

    }

    die;


}

/**************************************************************************************************/
