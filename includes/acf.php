<?php
defined( 'ABSPATH' ) || exit;

//Save
add_filter('acf/settings/save_json', 'bk_acf_json_save_point');
function bk_acf_json_save_point( $path ) {
    
    // update path
    $path = THEME_DIR . '/acf-json';
    
    // return
    return $path;
}
/********************************************************************************* */
 
//Load
add_filter('acf/settings/load_json', 'bk_acf_json_load_point');
function bk_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = THEME_DIR . '/acf-json';
    
    // return
    return $paths;
}
/********************************************************************************* */

function get_component_template($name, $params = NULL, $folder = "page_builder") {  
	if (is_file(THEME_DIR . '/templates/acf/' . $name . '.php')) {
		require THEME_DIR . '/templates/acf/' . $name . '.php';
	}
}
/********************************************************************************* */

function get_partial($name, $params = NULL) {  
	if (is_file(THEME_DIR . '/templates/partials/' . $name . '.php')) {
		require THEME_DIR . '/templates/partials/' . $name . '.php';
	}
}

/********************************************************************************* */

function FlexibleContent($v, $page_id = "", $return = false) {
	$page = get_field($v, $page_id);
	//debug($page);

	if ($return) {
		ob_start();
	}

	if (is_array($page) and count($page) > 0) {
		foreach ($page as $k => $v) {
			get_component_template($v['acf_fc_layout'], $v);
		}

		if ($return) {
		    $out = ob_get_contents();
		    ob_end_clean();
		    return $out;		
		} else {
			return true;
		}

	} else {
		return false;
	}
}

// function my_acf_google_map_api( $api ){
//     $api['key'] = '{api_key_here}';
//     return $api;
// }
// add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// // Google map api Method 2: Setting. https://www.advancedcustomfields.com/resources/google-map/
// function my_acf_init() {
//     acf_update_setting('google_api_key', '{api_key_here}');
// }
// add_action('acf/init', 'my_acf_init');


