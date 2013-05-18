=== DiaryPress ===
Contributors: tomhowson
Tags: diary,login,access control,force login,rss
Donate Link: http://diarypress.howson.me
Requires at least: 2.6
Tested up to: 3.5
Stable tag: trunk
License: GPLv2

DiaryPress is a plugin designed to allow your blog to operate like a diary.

== Description ==

DiaryPress is a plugin designed to allow your blog to operate like a diary. It will disable RSS feeds to keep your blog private and ask you to login in order to access the content. This is handy even if you run your diary on a local web server such as WAMP as it protects your blog against nosey family and friends.

See installation tab for instructions on how to install.


== Installation ==

Installation is simple:

1. Upload the contents of diarypress.zip to the /wp-content/plugins/ directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Enjoy!

== Frequently Asked Questions ==

=Where can I find advise on running a diary with wordpress?=

In the next major release I am going to add a information page to the plugin that will live under settings that will contain advise from my experience of 
running a diary on wordpress for over 5 years. Longer term I plan to create a website to help.

=Can I customise the splash page?=

Yes, you can add images using standard html just add it between line 53 to the } commented with end. I am going to comment
better in the future


== Screenshots ==

The default screen you see when you are not logged in. /assets/diaryshot.png

== Changelog ==
= 4.0 =
* Now displays a title in the browser
* Technical change to return HTTP code 200. This stops monitoring systems thinking a internal server error has occured
* Taken advantage of improvements in wordpress core
= 3.1 =
* Slight code tweak
= 3.0 =
* Updated to be fully compatible with wordpress 3.0 and above 
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
= 4.0 =
Improved code, added title and returns a correct HTTP 200 response