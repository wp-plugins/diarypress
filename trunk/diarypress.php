<?php
/*
Plugin Name: Diarypress
Plugin URI: http://www.howson.me.uk/diarypress
Description: Forces a user to login before viewing a blog. Also allows for a custom logo to be used. The custom logo css part of the plugin is based on the work by binary moon. The idea of the plugin is for people who wish to run their wordpress blog as a diary. The plugin also disables wordpress rss feeds.
Version: 1.1
Author: Tom Howson
Author URI: http://www.howson.me.uk
*/
?>

<?php
//for the custom login script
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/diaypress/login.css" />'; 
}
add_action('login_head', 'custom_login');
?>


<?php
	add_action( 'template_redirect', 'force_login' );
	
	function force_login()
	{
		$redirect_to = $_SERVER['REQUEST_URI']; // Change this line to change to where logging in redirects the user, i.e. '/', 'diary/wp-admin', etc.
	
		if ( ! is_user_logged_in() )
		{
		


				if ( is_wp_error( $user ) )
				{
					
					die();
					
				} // if

			
		
			else
			{
			
// start of login page

//include get_bloginfo('wpurl') . '/wp-content/plugins/diaypress/splash.php';
	include "splash.php";	  	






				die();

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