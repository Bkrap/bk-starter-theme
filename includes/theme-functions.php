<?php

/********************************************************************************* */
function debug( $s ) {
	echo "<pre>";
		print_r($s);
	echo "</pre>";
}

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

/**
 * Returns a string with all HTML tags stripped except <strong>.
 *
 * @param mixed $param The input string or array of strings to be stripped.
 * @return string The stripped string.
 */
function wyswig_raw( $param ) {
	return strip_tags( $param, "<strong>, <br>" );
}

/********************************************************************************** */ 

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/
 function my_mce_before_init_insert_formats( $init_array ) {  
 
	// Define the style_formats array
	 
		$style_formats = array(  
	/*
	* Each array child is a format with it's own settings
	* Notice that each array has title, block, classes, and wrapper arguments
	* Title is the label which will be visible in Formats menu
	* Block defines whether it is a span, div, selector, or inline style
	* Classes allows you to define CSS classes
	* Wrapper whether or not to add a new block-level element around any selected elements
	*/
			array(  
				'title' 	=> 'Content Block',  
				'block' 	=> 'span',  
				'classes' 	=> 'content-block',
				'wrapper' 	=> true,
				 
			),  
			array(  
				'title' 	=> 'Blue background wrapper',  
				'block' 	=> 'div',  
				'classes' 	=> 'blue-background',
				'wrapper' 	=> true,
			),
			array(  
				'title' 	=> 'Quote Box',  
				'block' 	=> 'div',  
				'classes' 	=> 'quote',
				'wrapper' 	=> true,
			),
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		 
		return $init_array;  
	   
	} 
	// Attach callback to 'tiny_mce_before_init' 
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/**
 * Generates an inline CSS style string for an image with the specified ID and focus position.
 * @dependency - Focus Point ACF plugin https://github.com/ooksanen/acf-focuspoint
 * @param int $img_id The ID of the image.
 * @param int $left The horizontal percentage of the focus position.
 * @param int $top The vertical percentage of the focus position.
 * @return string The inline CSS style string
 * */
function wp_get_img_focus_inline_style( $img_id = 0, $left = 0, $top = 0 ) {
    return "background-image: url(". wp_get_attachment_image_src( $img_id, 'full' ) ."); background-position: {$left}% {$top}%;";
}

/********************************************************************************** */ 

/**
 * Returns an HTML img element with a specific position and class to focus on a certain area.
 *
 * @dependency - Focus Point ACF plugin https://github.com/ooksanen/acf-focuspoint
 * @param int $img_id The ID of the image attachment.
 * @param int $left The position of the image on the x-axis.
 * @param int $top The position of the image on the y-axis.
 * @param string $class The CSS class to apply to the element.
 * @return string The HTML img element with the specified position and class.
 */
function wp_get_img_focus_element( $img_id = 0, $left = 0, $top = 0, $class = "", $size = 'full' ) {
    return wp_get_attachment_image( $img_id, $size, false, array(
        "class" => $class,
        "style" => "background-position: {$left}% {$top}%"
    ));
}

/********************************************************************************** */ 

/**
 * Returns a button with optional icon if the button should be shown.
 *
 * @param array $button_group An associative array containing a 'show_button' key
 *                            and a 'button' key. The 'show_button' key should be
 *                            a boolean indicating whether the button should be shown.
 *                            The 'button' key should be an array containing the button
 *                            attributes.
 * @param bool $icon Optional. Whether to include an icon with the button. Defaults to false.
 */
function get_btn( $button_group, $icon = false ) {

	if( $button_group['show_button'] ) {

		$button = $button_group['button'];
		include THEME_DIR . '/templates/partials/button.php'; 
		if( $icon ) { ?>
			<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_204_1799)">
				<path d="M7.99984 3.16669L7.05984 4.10669L10.7798 7.83335H2.6665V9.16669H10.7798L7.05984 12.8934L7.99984 13.8334L13.3332 8.50002L7.99984 3.16669Z" fill="#2A807F"/>
				</g>
				<defs>
				<clipPath id="clip0_204_1799">
				<rect width="16" height="16" fill="white" transform="translate(0 0.5)"/>
				</clipPath>
				</defs>
			</svg>
		<?php } 
		
	}

}

/********************************************************************************* */

/**
 * Retrieves a post object by the post title and post type.
 *
 * @param string $page_title The title of the post to retrieve.
 * @param string $post_type The type of post to retrieve. Default is 'post'.
 * @param string $output The output type. Accepts OBJECT, ARRAY_A, ARRAY_N. Default is OBJECT.
 * @throws None
 * @return WP_Post|null WP_Post on success or null on failure.
 */

function get_post_by_title($page_title, $post_type ='post' , $output = OBJECT) {
    global $wpdb;
        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= %s", $page_title, $post_type));
        if ( $post )
            return get_post($post, $output);

    return null;
}
/********************************************************************************* */

/**
 * Checks if the post excerpt is empty and returns the post content trimmed to 20 words and three dots if it is.
 *
 * @param int $post_id The ID of the post to check.
 * @return string The post excerpt if it is not empty, or the post content trimmed to 20 words and three dots if it is.
 */

function check_post_excerpt($post_id) {
    $post = get_post($post_id);
    if (empty($post->post_excerpt)) {
        $content = wp_strip_all_tags($post->post_content);
        $words = wp_trim_words($content, 20, '...');
        return $words;
    }
    return $post->post_excerpt;
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

