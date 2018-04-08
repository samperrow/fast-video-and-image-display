=== Fast Video and Image Display ===
Contributors: samperrow
Donate link: https://www.paypal.me/samperrow
Tags: youtube videos, video, image, page speed, media display, web performance, shortcode, widget, web perf, web speed
Requires at least: 4.3
Tested up to: 4.9.5
Stable tag: 2.5.1
Requires PHP: 5.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cut seconds off your load time by deferring the loading of YouTube videos and images, which scale automatically for mobile devices.

== Description ==

Showcasing YouTube videos and images on websites is a great way to draw visitor's attention, however doing so can easily add several seconds to a website's load time. This is bad for user experience, scares away potential customers, and hurts search rankings.

This plugin allows users to upload YouTube videos and images while having zero impact on page load time, easily cutting load time by several seconds.


== Installation ==

1. Upload the entire `fast-video-and-image-display` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. After activating the plugin, go to Appearance -> Widgets, and you will find two widgets that allow you to upload the videos and images you desire.

== Frequently Asked Questions ==

FAQ

YouTube Video Shortcode:

1. On all posts and pages on the WordPress backend, click the media button 'Defer Video Load'. A shortcode will appear on the page.
2. Insert the YouTube URL of the video you want to display.
3. The default width and height values are 560 x 315 pixels, which can be changed to any value. The video will also adjust to fit mobile screens, if you would like that option removed, change the 'yes' option to 'no' or another value.
4. If you would like to insert a CSS class for more customization, enter the class name in the shortcode attribute to modify CSS properties.

Image Shortcode:

1. On all posts and pages, click the media button 'Defer Image Load'. A screen will appear with all images in your WordPress library.
2. Select the image you would like and click 'insert'. The default attributes will be inserted into the shortcode. If you would like to change these you may do so.


I hope you enjoy this plugin and find it will easily and dramatically improve page load time for your website. If you have questions, would like to see more features added on, don't hesitate to send me an email or message me on the forums. Without your input this plugin cannot be improved!


1. [Support Forum](https://wordpress.org/support/plugin/fast-video-and-image-display)
2. Send me an email at sam.perrow399@gmail.com


== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png

== Upgrade Notice ==




== Changelog ==

1. Most recent update: April 7, 2018.
2. Version 2.5.1

April 7, 2018:
1) improved cross browser compatibility (YouTube does not support iframe's for IE8 and below. Images work for all browsers)
2) updated YouTube video play button arrow.
3) fixed bugs on admin side involving inserting the shortcodes into the media editor.

April 3, 2018:
1) vastly improved quality of code and architecture of plugin.
2) removed jquery as a dependency
3) minimized amount of CSS needed.

Nov 16, 2017:
1) tested compat with WP 4.9.


June 11: 1) tested compat with wp 4.8

March 26: 1) cleaned up video modal window;
          2) increased security

Dec 9: 1) improved YouTube ID validation
       2) improved exception handling
       3) updated example YouTube video URL to be more appropriate with current events.

Nov 22: 1) updated jquery check.
        2) added github icon to point to this repo.

Oct 25: Improved check for jQuery script.

Sept 27: 1) Added a check to include jQuery if it hasn't already been included.
         2) improved security on video modal window.

Sept 19: 1) added admin modal box to allow users to input video info.

Aug 30: Fixed problem with image upload.

Aug 27: 1) fixed problem with youtube button showing even if no url given. 2) added dashicons to media buttons.

Aug 10: Updated jQuery to load after document is ready.

July 27: Updated screenshots.

July 26: 1) Improved video loading code to reduce page size. 2) Added mobile responsiveness by default. 3) Removed widgets because they are no longer needed. Use shortcodes in text widgets instead.

July 10: Added shortcode functionality for videos.

July 4: Fixed problem with video playing script.

June 23: Added shortcode functionality for images. This makes it much easier to upload your images onto posts or pages without having to rely on a widget area.
