<?php
/*
Plugin Name: DiaryPress
Plugin URI: http://diarypress.howson.me
Description: DiaryPress is a plugin designed to allow your blog to operate like a diary. It will disable RSS feeds to keep your blog private and ask you to login in order to access the content. This is handy even if you run your diary on a local web server such as WAMP as it protects your blog against nosey family and friends.
Version: 4.0
Author: Tom Howson
Author URI: http://www.howson.me
*/

// we need this to allow the wp-mail page to run
if ($_SERVER['REQUEST_URI'] == get_bloginfo('url').'/wp-mail.php') {
// Don't go any further as we are checking for new e-mails using the mail2blog feature.
// We would expect most use CRON however for compatibility this is maintained.
}

else {


	add_action( 'template_redirect', 'force_login' );


	
	function force_login()
	{
		$redirect_to = $_SERVER['REQUEST_URI']; 
	
		if ( ! is_user_logged_in() )
		{
		


				if ( is_wp_error( $user ) )
				{
					
					die();
					
				} // if

			
		
			else
			{
			
// die and show error message

// Set title in browser
$title = "Private Diary";
//we know that the page arrived so we need to tell the browser that the status should be http 200 
// Otherwise we would give a false internal server error. Not cool if we use monitoring software

 $args = array( 'response'   => '200', );



// Keep the data in the body instead of a html file and calling it as we want some php variables.
// The first 
wp_die( ('


<link rel="EditURI" type="application/rsd+xml" title="RSD" href="'. get_bloginfo('url') .'/xmlrpc.php?rsd" />

<h4><strong>Private Diary</strong></h4>


<p>You must log in to view this diary. If you want to <a href="'. get_bloginfo('url') .'/wp-login.php">Click here</a></p>


'), $title, $args );


				} // Close die

	  	} // Close use logged in

	} // force_login
	
} // End statement of not logged in and not a mail check

// Setup redirect function

function DiaryPress_login_redirect( $redirect_to, $request, $user ){
    //is there a user to check?
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if( in_array( "administrator", $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
// Interesting bit redirect to the url where the user was when they were asked to login.		
		
           return home_url();
		  
    
	}
	}
    else {
        return $redirect_to;
    }
}
add_filter("login_redirect", "DiaryPress_login_redirect", 10, 3);
// End redirect function

// turn the feeds off for our diary
function norss() {
	wp_die( __('<strong>Error:</strong> No RSS Feed Available, Please visit our <a href="'. get_bloginfo('url') .'">homepage</a>.',$title) );
}
 
add_action('do_feed', 'norss', 1);
add_action('do_feed_rdf', 'norss', 1);
add_action('do_feed_rss', 'norss', 1);
add_action('do_feed_rss2', 'norss', 1);
add_action('do_feed_atom', 'norss', 1);
?>