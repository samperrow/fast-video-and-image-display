<?php
/**
* Plugin Name: Fast Video and Image Display
* Plugin URI: https://www.linkedin.com/in/sam-perrow-53782b10b?trk=hp-identity-name
* Description: Cut seconds off your load time by deferring the loading of YouTube videos and images, which scale automatically for mobile devices.
* Version: 2.5.0
* Author: Sam Perrow
* Author URI: https://www.linkedin.com/in/sam-perrow-53782b10b?trk=hp-identity-name
* License: GPL2
* last edited March 31, 2018
*
* Copyright 2018  Sam Perrow  (email : sam.perrow399@gmail.com)
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*    the Free Software Foundation; either version 2 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*   You should have received a copy of the GNU General Public License
*   along with this program; if not, write to the Free Software
*   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// prevent direct file access
if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

define( 'GKTVI_PLUGIN', __FILE__ );
define( 'GKTVI_PLUGIN_DIR', untrailingslashit( dirname( GKTVI_PLUGIN ) ) );


if ( is_admin() ) {
	require_once GKTVI_PLUGIN_DIR . '/class-gktvi-media-buttons.php';
} else {
	require_once GKTVI_PLUGIN_DIR . '/class-gktvi-create-shortcodes.php';
}


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'gktvi_set_admin_links' );
function gktvi_set_admin_links( $links ) {
	$gktvi_links = array(
		'<a href="https://github.com/sarcastasaur/fast-video-and-image-display">View on GitHub</a>',
		'<a href="https://www.paypal.me/samperrow">Donate</a>' );
	return array_merge( $links, $gktvi_links );
}


// load modal CSS and admin js
add_action('wp_enqueue_media', 'gkt_load_admin_stuff');
function gkt_load_admin_stuff() {
	wp_register_style( 'gkt_formTable_stylesheet', plugin_dir_url(__FILE__) . '/css/admin.css');
	wp_register_script( 'gkt_media_button', plugin_dir_url(__FILE__) . 'js/media-button.js', array('jquery'), '1.0', true);

	wp_enqueue_style( 'gkt_formTable_stylesheet');
	wp_enqueue_script('gkt_media_button');
}


add_action('wp_enqueue_scripts', 'gktvi_load_js_css');
function gktvi_load_js_css() {
	wp_register_style( 'gktvi_styles', plugin_dir_url(__FILE__) . '/css/styles.css');
	wp_register_script( 'gktvi_js', plugin_dir_url(__FILE__) . 'js/execute-shortcodes.js', null, null, false);

	wp_enqueue_style( 'gktvi_styles');
	wp_enqueue_script( 'gktvi_js' );
}	


// add_action('wp_head', 'gktvi_load_video', 10, 0);
function gktvi_load_video() { ?>
	<style type='text/css'>div.gktviDiv{position:relative}img.gktviVideoThumb{width:100%;height:100%;max-height:100%}iframe.gktviIframe{width:100%;height:100%;margin:0 auto}img.gktviVideoThumb:hover,svg.yt-svg:hover{cursor:pointer}path.outer-button:hover{fill:#cc181e;fill-opacity:1}svg.yt-svg{position:absolute;display:block;font:13.33px Arial;z-index:1000;background-color:inherit;border:0;width:15%;height:15%;left:42.5%;right:42.5%;top:42.5%;bottom:42.5%}@media only screen and (max-width:1180px){div.gktviDiv{width:inherit;max-width:80%!important;height:auto!important;max-height:inherit;margin:0 auto}img.gktviVideoThumb{width:100%;height:auto;display:block;margin:0 auto}iframe.gktviIframe{display:block;height:inherit}</style>

	<?php
}

?>