<?php
/*
Plugin Name: DiaryPress
Plugin URI: http://diarypress.howson.me
Description: DiaryPress is a plugin designed to allow your blog to operate like a diary. It will disable RSS feeds to keep your blog private and ask you to login in order to access the content. This is handy even if you run your diary on a local web server such as WAMP as it protects your blog against nosey family and friends.
Version: 5.0
Author: Tom Howson
Author URI: http://www.howson.me
*/




// we need this to allow the wp-mail page to run
if ($_SERVER['REQUEST_URI'] == get_bloginfo('url').'/wp-mail.php') {
// Don't go any further as we are checking for new e-mails using the mail2blog feature.
// We would expect most to use CRON however for compatibility this is maintained.
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
//$title = "Private Diary";


//we know that the page arrived so we need to tell the browser that the status should be http 200 
// Otherwise we would give a false internal server error. Not cool if we use monitoring software

 $args = array( 'response'   => '200', );



// Keep the data in the body instead of a html file and calling it as we want some php variables.
// The default values if none present in database

$dp_ops = array ('dppagetitle' =>'Private Diary', 'title'=>'Private Diary','dpimg'=>'none');
?>
</br>
<?php $options = get_option('DiaryPress_options',$dp_ops); ?><h4><strong><?php echo $options['title']; ?></strong></h4>

<?php $title = $options['dppagetitle']; ?>

<img class="alignnone size-medium wp-image-1623" title="" src="<?php echo $options['dpimg'];?>" alt="" />

<?php
wp_die( ('

<p>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="'. get_bloginfo('url') .'/xmlrpc.php?rsd" />
</p>

<p>You must log in to view this diary. If you want to <a href="'. get_bloginfo('url') .'/wp-login.php">Click here</a></p>


'), $title, $args );


				} // Close die

	  	} // Close user logged in

	} // force_login
	
} // End statement of not logged in and not a mail check

// Setup redirect function
// This function checks to see if its an admin user, if they are you go to the wordpress dashboard, if not you go to the previous page
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

//Make the settings link appear on the plugin page to get people up and running quickly
function your_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=diarypress-setting-admin">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );

// Now lets do the settings page
// Requires 3.5.1 and above

class DiaryPressSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'DiaryPress', 
            'manage_options', 
            'diarypress-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'DiaryPress_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>DiaryPress Settings</h2>
            <p>Here you can adjust DiaryPress settings such as the splash screen</p>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'DiaryPress_option_group' );   
                do_settings_sections( 'diarypress-setting-admin' );
                submit_button(); 
            ?>
            </form>
			<h3>Where can I get more information about running a diary?</h3>
			<p>You can get more information on the plugin website by visiting <a href="http://diarypress.howson.me">diarypress.howson.me</a>. This is a dedicated micro site where
I share tips </br> on my 9 years of experience. Including tips for both people who keep their diary on their local machine and those who keep it on a web </br> accessible server.			
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'DiaryPress_option_group', // Option group
            'DiaryPress_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Manage Splash Screen', // Title
            array( $this, 'print_section_info' ), // Callback
            'diarypress-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            //'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'diarypress-setting-admin', // Page
            'setting_section_id' // Section           
        );  

 add_settings_field(
            'dppagetitle', 
            'Webpage Title', 
            array( $this, 'dppagetitle_callback' ), 
            'diarypress-setting-admin', 
            'setting_section_id'
        ); 		

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'diarypress-setting-admin', 
            'setting_section_id'
        );      
    

	     add_settings_field(
            'dpimg', 
            'Custom Image URL', 
            array( $this, 'dpimg_callback' ), 
            'diarypress-setting-admin', 
            'setting_section_id'
        );

	         		
    }
	
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );
			
		if( isset( $input['dpimg'] ) )
            $new_input['dpimg'] = sanitize_text_field( $input['dpimg'] );
			
		if( isset( $input['dppagetitle'] ) )
            $new_input['dppagetitle'] = sanitize_text_field( $input['dppagetitle'] );
		
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="hidden" id="id_number" name="DiaryPress_options[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
       );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="DiaryPress_options[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }



public function dpimg_callback()
    {
        printf(
            '<input type="text" id="dpimg" cols="30" row="5" name="DiaryPress_options[dpimg]" value="%s"/>',
            isset( $this->options['dpimg'] ) ? esc_attr( $this->options['dpimg']) : ''
			
        );
    }

	
public function dppagetitle_callback()
    {
        printf(
            '<input type="text" id="dppagetitle" cols="30" row="5" name="DiaryPress_options[dppagetitle]" value="%s"/>',
            isset( $this->options['dppagetitle'] ) ? esc_attr( $this->options['dppagetitle']) : ''
			
        );
    }
}

if( is_admin() )
    $my_settings_page = new DiaryPressSettingsPage();
