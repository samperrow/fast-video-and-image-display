<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

class GKTVI_Create_Shortcodes {

	public function __construct() {
		// add_filter( 'widget_text', 'do_shortcode' );
		add_shortcode( 'gkt_image_sc', array( $this, 'create_image_shortcode' ) );
		add_shortcode( 'gktvideosc', array( $this, 'create_video_shortcode' ) );
	}

	public function create_video_shortcode( $atts ) {

		$gkt_video_sc_atts = shortcode_atts( array(
			'youtube-url' => '',
			'width' => '',
			'height' => '',
			'thumbnail-resolution' => 'mqdefault',
			'mobile-friendly' => 'Yes',
			'class' => ''
			), $atts );
	
		if ( ! empty( $gkt_video_sc_atts['youtube-url'] ) ) {
	
			$gkt_yt_video_url = $gkt_video_sc_atts['youtube-url'];
			$gkt_yt_id_array = preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $gkt_yt_video_url, $matches);
	
			if ( ! empty( $matches[1] ) ) {
	
				$gkt_yt_video_id = $matches[1];
				$gkt_video_sc_url = 'https://www.youtube.com/embed/' . $gkt_yt_video_id . '?autoplay=1&rel=0&autohide=2&border=0&wmode=opaque&enablejsapi=1&playsinline=1&controls=1&showinfo=1';
				$gkt_video_sc_thumbsrc = 'https://i.ytimg.com/vi/' . $gkt_yt_video_id . '/' . $gkt_video_sc_atts['thumbnail-resolution'] . '.jpg';
	
				$script = '<script>window.onload=gktviLoadVideo("' . $gkt_yt_video_id . '", "' . $gkt_video_sc_thumbsrc . '", "' . $gkt_video_sc_atts['class'] . '", "' . $gkt_video_sc_url . '", ' . $gkt_video_sc_atts['width'] . ', ' . $gkt_video_sc_atts['height'] . ');</script>';
				
				$svg = '<svg id="svg_' . $gkt_yt_video_id . '"' . ' class="yt-svg" version="1.1" viewBox="0 0 68 48">
						<path class="outer-button" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z"></path>
						<path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path>
						<path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path>
					</svg>';
	
				$newElement = '<div onmouseover="gktviChangeSVG(this.getElementsByTagName(\'path\')[0], \'#cc181e\', \'1.0\')" onmouseout="gktviChangeSVG(this.getElementsByTagName(\'path\')[0], \'#1f1f1e\', \'0.81\')" style="max-width: ' . $gkt_video_sc_atts['width'] . 'px; width: ' . $gkt_video_sc_atts['width'] . 'px; max-height: ' . $gkt_video_sc_atts['height'] . 'px; height: ' . $gkt_video_sc_atts['height'] . 'px; " class="gktviDiv" id="div_' . $gkt_yt_video_id . '">' . $svg . '</div>' . $script;
				
				return $newElement;
			}
		}
	}

	public function create_image_shortcode( $atts ) {

		$gkt_image_atts = shortcode_atts(array(
			'src' => '',
			'width' => '',
			'height' => '',
			'id' => '',
			'mobile-friendly' => 'Yes',
			'title' => '',
			'alt' => '',
			'class' => ''
			), $atts, 'gkt_image_sc' );
	
		if ( !empty($gkt_image_atts['src']) ) {
	
			if ($gkt_image_atts['mobile-friendly'] === 'Yes') { ?>
				<style>@media only screen and (max-width: 1200px) {
					#<?php echo $gkt_image_atts['id']; ?> {
						width: 80%;
						max-width: <?php echo $gkt_image_atts['width'] . 'px'; ?>;
						display: block;
						height: auto;
						max-height: <?php echo $gkt_image_atts['height'] . 'px'; ?>;
						margin: 0 auto;}
					}</style>
			<?php }
	
			$script = '<script>window.onload=loadDeferredImage("' . $gkt_image_atts['id'] . '", "' .  $gkt_image_atts['src'] . '", "' .  $gkt_image_atts['class'] . '", "' .  $gkt_image_atts['alt'] . '", "' .  $gkt_image_atts['title'] . '", ' .  $gkt_image_atts['width'] . ', ' .  $gkt_image_atts['height'] . ');</script>';
		}
			return '<div id=' . '"' . 'div_' . $gkt_image_atts['id'] . '"' . '></div>' . $script;
	}
    
}

new GKTVI_Create_Shortcodes();