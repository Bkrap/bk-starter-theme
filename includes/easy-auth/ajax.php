<?php

/*************************************************************************************** */
/**
 * Send Magic Login
 */
function sendMagicLogin( $emailTo, $token, $ServerURL, $redirect_link ) {

    $email_group = THEME_OPTIONS['easy_auth']['email_content'];
    // $to = "brunokrapljan97@gmail.com";

    $subject = $email_group['subject'];
    $body =  "{$email_group['body']['body_before_auth_link']}<a href='$ServerURL/login?token=$token&redirectLink=$redirect_link' target='_blank'>{$email_group['body']['auth_link_text']}</a>{$email_group['body']['body_after_auth_link']}";
    $headers = array('Content-Type: text/html; charset=UTF-8');
	$headers[] = "From: {$email_group['sender_email']} <{$email_group['sender_email']}>";

    wp_mail( $emailTo, $subject, $body, $headers );
    die;
}

/********************************************************************************* */
/**
 * Auto Login
 */
function auto_login_new_user( $user, $redirect_path ) {
    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID);
    do_action( 'wp_login', $user->user_login, $user );
    wp_redirect($redirect_path);
    exit();
}

/**************************************************************************************/
/**
 * Create User
 */
function createUser( $emailTo, $user_username, $redirect_link, $token ) {

	//Generate Token
	$ServerURL = home_url('/');
	/********************************************** */
	// create token column in DB
	global $wpdb;
	$queried_table = "{$wpdb->prefix}users";
	$query = $wpdb->get_results("SELECT user_token FROM $queried_table");
	if( empty($query) ){
		$wpdb->query("ALTER TABLE $queried_table ADD user_token TEXT DEFAULT ''");
	}
	/********************************************** */
    $query = $wpdb->get_results( "SELECT * FROM $queried_table WHERE user_email='$emailTo'" );

    if (!empty( $query )) {
        //If the Email is Present
        // Insert Token into User Table
        $wpdb->query( "UPDATE $queried_table SET user_token='$token' WHERE user_email='$emailTo'" );
    } else {
        // Insert User &  Token into User Table
       $user = wp_insert_user(array(
            'user_login'        => $emailTo,
            'user_nicename'     => $user_username,
            'display_name'      => $user_username,
            'user_email'        => $emailTo,
            'first_name'        => $user_username,
            'user_token'        => $token,
            'user_pass'         => $token,
            'role'              => 'subscriber',
            'user_registered'   => date('Y-m-d h:i:s'),
        ));

		$wpdb->query( "UPDATE $queried_table SET user_token='$token' WHERE user_email='$emailTo'" ); // destroy token


		if ( is_wp_error( $user ) ) {
			// There was an error; possibly this user doesn't exist.
			echo 'Error.';
		} else {
			// Success!
			// echo 'User profile updated.';		

			/*
			Sign in user after form submit
			*/
			// print_r($user);
			// auto_login_new_user( $user, $redirect_link );
		
		}

    } 

 ?>
	
<?php } 


/*************************************************************************************** */
/**
 * Check User
 */

function checkUser() {

	$emailTo = $_POST['email'];
	$token_bytes = $_POST['tokenBytes'];
	$redirect_link = $_POST['redirectLink'];
	//Generate Token
	$token = bin2hex(random_bytes(16));
	$ServerURL = home_url('/');
	/********************************************** */
	// create token column in DB
	global $wpdb;
	$queried_table = "{$wpdb->prefix}users";
	$query = $wpdb->get_results("SELECT user_token FROM $queried_table");

	if( empty($query) ){
		$wpdb->query("ALTER TABLE $queried_table ADD user_token TEXT DEFAULT ''");
	}
    $query = $wpdb->get_results( "SELECT * FROM $queried_table WHERE user_email='$emailTo'" );
    if (!empty( $query )) {
        //If the Email is Present
        // Insert Token into User Table
        $wpdb->query( "UPDATE $queried_table SET user_token='$token' WHERE user_email='$emailTo'" );
		// myErr("UPDATE $queried_table SET user_token='$token' WHERE user_email='$emailTo'");
		echo "user-exists";
        sendMagicLogin($emailTo, $token, $ServerURL, $redirect_link); // remove this debug to logic work
    } else {
        $user_username = $emailTo;
        createUser( $emailTo, $user_username, $redirect_link, $token );
		echo "user-not-exists";
		sendMagicLogin($emailTo, $token, $ServerURL, $redirect_link); // remove this debug to logic work
	}

	exit();

}
add_action('wp_ajax_checkUser', 'checkUser');
add_action('wp_ajax_nopriv_checkUser', 'checkUser');

/**************************************************************************************/

