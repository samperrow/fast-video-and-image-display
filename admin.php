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

define( 'GKT_VIDEO_IMAGE_PLUGIN', __FILE__ );
define( 'GKT_VIDEO_IMAGE_PLUGIN_DIR', untrailingslashit( dirname( GKT_VIDEO_IMAGE_PLUGIN ) ) );
require_once GKT_VIDEO_IMAGE_PLUGIN_DIR . '/shortcode-images.php';
require_once GKT_VIDEO_IMAGE_PLUGIN_DIR . '/shortcode-videos.php';

// load modal CSS and admin js
add_action('wp_enqueue_media', 'gkt_load_admin_stuff');
function gkt_load_admin_stuff() {
	wp_register_style( 'gkt_formTable_stylesheet', plugin_dir_url(__FILE__) . 'styles.css');
	wp_register_script( 'gkt_media_button', plugin_dir_url(__FILE__) . 'gkt-media-button.js', array('jquery'), '1.0', true);

	wp_enqueue_style( 'gkt_formTable_stylesheet');
	wp_enqueue_script('gkt_media_button');
}


add_action('wp_head', 'gktvi_check_jquery', 10, 0);
function gktvi_check_jquery() {
	?>
	<script>if (typeof jQuery == 'undefined' || (!window.jQuery)) {var script = document.createElement('script');script.src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js';document.getElementsByTagName('head')[0].appendChild(script);}</script>
	<?php
}

?>
