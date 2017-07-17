=== Recommend to a friend ===
Contributors: Cocola, benjaminniess, momo360modena, Rahe
Donate link: http://beapi.fr/donate
Tags: share, facebook, email, recommend, widget
Requires at least: 3.1
Tested up to: 4.7
Stable tag: 2.2.1

== Description ==

Plugin that add a share to friends jQuery Lightbox to your pages or posts. Users will be able to share your content using 2 ways :

1. Writing email addresses manually
2. Using Facebook and Twitter sharing feature


== Installation ==

1. Upload and activate the plugin
2. Go to the Recommend a friend option page

- Choose the feature you want to enable
- You can auto add the button after your posts content by checking the box
 
3. Add the Recommend a Friend widget or use the php function  
`<?php echo recommend_a_friend_link( $permalink, $image_url, $text_link ); ?>`

- $premalink is the URL you want to be shared
- $image_url (optional) the image url used instead of the default one
- $text_link(optional) the text you want to display instead the image (you need to choose between display an image or a text)


== Frequently Asked Questions ==

= How can I add a custom po/mo translation file =

Create your po translation file from the default.po file and keep the prefix (eg. raf-us_US.po)
Paste the po and mo files into your wp-content/languages/plugins/ folder


== Screenshots ==

1. Front office view
2. Backoffice view

== Changelog ==

* 2.2.1
    * Fixed email sent to last email address only
    * Fixed success page loaded as a 404
* 2.2
    * WARNING: REMOVED OPEN INVITER OPTION. This service no longer exists so I had to remove it from the plugin.
    * Added google recaptcha option to avoid spam
    * Global code refactoring + applied WordPress coding standards
* 2.1
    * Added the ability to load a mo (translation) file from wp-content/languages/plugins/ folder
* 2.0.4
	* Fix double MIME-type in email headers
* 2.0.3
	* Add german translation thanks to Sebastian Maar
	* Add portuguese (BR) translation thanks to Alexandre Ruoso
	* Allow to load a custom CSS stylesheet in theme thanks to Emmanuel Hesry 
	* Use the official wp color picker thanks to me :)
* 2.0.2
	* Add nofollow tag to the form
* 2.0.1 
	* Encode URL to the RAF link
* 2.0
	* Code refactoring
	* Fix bug with homepage link
* 1.0.6
	* Security update thanks to http://secu.boiteaweb.fr/
	* Change plugin name Recommend a friend > Recommend to a friend
	
* 1.0.4
	* Cleanup CSS
	* Add new widget image	
	
* 1.0.3
	* Remove font-face
	* Use wp_redirect after sending mail
	
* 1.0.1 
	* Change readme file
	
* 1.0
	* First release