<?php

/********************************************************************************* */
function debug( $s ) {
	echo "<pre>";
		print_r($s);
	echo "</pre>";
}

/********************************************************************************* */
function get_post_by_title($page_title, $post_type ='post' , $output = OBJECT) {
    global $wpdb;
        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= %s", $page_title, $post_type));
        if ( $post )
            return get_post($post, $output);

    return null;
}
/********************************************************************************* */

/**
 * TAKE EACH FEATURED IMAGE AND INSERT IT INTO FIELD -> POST_FEATURED_IMAGE | Uncomment setFeaturedImage(), run it only once
 */

function setFeaturedImage() {
	$q = new WP_Query([
		'post_type' => array('post', 'page', 'quiz-statements'),
		'posts_per_pagessssss' => -1,
	]);

	if ($q->found_posts > 0) {
		foreach ($q->posts as $k => $v) {
			$attachment_id = get_post_thumbnail_id( $v->ID );
			if ($attachment_id > 0) {
				update_field('post_featured_image', array('id'=>$attachment_id, 'left'=>50, 'top'=>50), $v);
			}
		}
	}

// myErr($q->posts[0], true);
}
// setFeaturedImage();

/********************************************************************************* */

/**
 * SAVE ACF FIELD TO FEATURED IMAGE
 */

function my_acf_after_save_post( $post_id ) {
	$cpt = get_post_type($post_id);

	if( $cpt == 'post' ) {

		$values = get_fields( $post_id );
	
		if( isset( $values['post_featured_image']['id'] ) ) {
    		set_post_thumbnail($post_id, $values['post_featured_image']['id']);
		} else {
            delete_post_thumbnail($post_id);
		}	
	}
}
if( function_exists( get_fields() ) ) {
    // add_action('acf/save_post', 'my_acf_after_save_post');
}


/********************************************************************************* */
