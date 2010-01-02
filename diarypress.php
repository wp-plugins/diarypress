<?php
/*
Plugin Name: Diarypress
Plugin URI: http://diarypress.howson.me.uk/
Description: DiaryPress is a plugin designed to allow your blog to operate like a diary. It will disable RSS feeds to keep your blog private and ask you to login in order to access the content. This is handy even if you run your diary on a local web server such as WAMP as it protects your blog against nosey family and friends.
Version: 2.1
Author: Tom Howson
Author URI: http://www.howson.me.uk
*/
?>
<?php
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
	wp_die( __('<h4><strong>Sorry....</strong></h4> </br><p>You must log in to view this blog. If you want to <a href="'. get_bloginfo('url') .'/wp-admin">Click here</a></p>') );



				} // else

	  	} // if

	} // force_login
	
	?>
<?php
// turn the feeds off for our diary
function norss() {
	wp_die( __('<strong>Error:</strong> No RSS Feed Available, Please visit our <a href="'. get_bloginfo('url') .'">homepage</a>.') );
}
 
add_action('do_feed', 'norss', 1);
add_action('do_feed_rdf', 'norss', 1);
add_action('do_feed_rss', 'norss', 1);
add_action('do_feed_rss2', 'norss', 1);
add_action('do_feed_atom', 'norss', 1);
?>