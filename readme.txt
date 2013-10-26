=== DiaryPress ===
Contributors: tomhowson
Tags: diary,private, private diary,login,access control,force login,rss
Donate Link: http://diarypress.howson.me
Requires at least: 2.6
Tested up to: 3.7
Stable tag: trunk
License: GPLv3
License URI: http://gpl.howson.me

DiaryPress lets you keep a private diary.

== Description ==

DiaryPress is a plugin designed to allow your blog to operate like a private diary. It will ask you to login in order to access the content. This is handy even if you keep a diary on a local web server such as WAMP as it protects your blog against nosey family and friends. Alternatively if you like to write your diary on the go and keep your diary on an internet accessible server the plugin is fully compatible with all WordPress for mobile applications such as WordPress for iPhone.  The plugin is also compatible with the native WordPress e-mail to blog feature.

Key features:

* Keeps your blog private
* Works with all WordPress for mobile applications
* Works with the native e-mail to blog feature
* Works with Mars Edit & Windows Live Writer
* Tested on every new WordPress release to ensure long term support

See installation tab for instructions on how to install.


== Installation ==

There are two installation methods. 

Easy Method:

1. Goto the Plugins section in the Wordpress dashboard and press add

2. Search DiaryPress

3. Click on the DiaryPress result and press install


Manual method:

1. Download from this site

2. Upload the contents of diarypress.zip to the /wp-content/plugins/ directory

3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

=Do you test every version of Wordpress with DiaryPress?=

No. I test every new version released with DiaryPress. I strongly advise you keep Wordpress up-to-date.

=Can I customise the splash page?=

Yes, you can add images or any standard html for that matter. Within the diarypress.php file, find line 58. The not logged in message starts on line 63. 

`wp_die( ('

<!-- we need this so that the xml atom publishing feature will work -->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="'. get_bloginfo('url') .'/xmlrpc.php?rsd" />

<h4><strong>Private Diary</strong></h4>

<p>You must log in to view this diary. If you want to <a href="'. get_bloginfo('url') .'/wp-admin">Click here</a></p>

'), $title, $args );
`

= Custom not logged in message examples =

* Including a image in html - the whole code block is shown for clarity

`wp_die( ('

<!-- we need this so that the xml atom publishing feature will work -->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="'. get_bloginfo('url') .'/xmlrpc.php?rsd" />

<h4><strong>Private Diary</strong></h4>
<img class="alignnone size-medium wp-image-1623" title="" src="http://example.com/wp-content/uploads/2013/04/image.png" alt="image" />
<p>You must log in to view this diary. If you want to <a href="'. get_bloginfo('url') .'/wp-admin">Click here</a></p>

'), $title, $args );
`

=Where can I find advise on running a diary with Wordpress?=

In the next major release I am going to add a information page to the plugin that will live under settings that will contain advise from my experience of 
running a diary on Wordpress for over 5 years. Longer term I plan to create a website to help.


== Screenshots ==

1. The default screen you see when you are not logged in.

2. Example of custom start screen

== Changelog ==
= 4.6 =
* Minor code improvements
* Some server complain of headers already sent - resolved
= 4.5 =
* Login process now returns to home page unless you are admin
* Improved performance
* Code comments improved
= 4.0 =
* Now displays a title in the browser
* Technical change to return HTTP code 200. This stops monitoring systems thinking a internal server error has occurred
* Taken advantage of improvements in Wordpress core
= 3.1 =
* Slight code tweak
= 3.0 =
* Updated to be fully compatible with Wordpress 3.0 and above 
* Cleaned code
* Corrected a url typo
* Corrected a spelling mistake
= 2.0 =
* Improved code quality, should now work with most major hosting providers
* Changed the screen which is shown to a user when they are not logged in. Now uses standard core code
* Made the plugin installation easier - no more messing about with splash.php
= 1.0 =
* First release

== Upgrade Notice ==
= 4.6 =
Code improved, fixed php header message
= 4.5 =

Better login handling. Easier than ever

= 4.0 =
Improved code, added title and returns a correct HTTP 200 response
= 3.1 =
Performance is improved and better login handling 
= 3.0 =
Performance is improved and better login handling
