<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

class GKTVI_Create_Shortcodes {

	public function __construct() {
		add_shortcode( 'gkt_sc_images', array( $this, 'create_image_shortcode' ) );
		add_shortcode( 'gktvideosc', array( $this, 'create_video_shortcode' ) );
	}

	public function create_video_shortcode( $atts ) {

		$video_shortcode = shortcode_atts( array(
			'youtube-url' => '',
			'width' => '',
			'height' => '',
			'thumbnail-resolution' => 'mqdefault',
			'mobile-friendly' => 'yes',
			'class' => ''
			), $atts );
	
		if ( ! empty( $video_shortcode['youtube-url'] ) ) {
	
			$video_url = $video_shortcode['youtube-url'];
			$video_id_array = preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video_url, $video_id);
	
			if ( ! empty( $video_id[1] ) ) {

				$video_id = $video_id[1];
				$div_class = $video_shortcode['mobile-friendly'] === 'yes' ? 'gktviDiv mobile' : 'gktviDiv';
				$video_url = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=1&rel=0&autohide=2&border=0&wmode=opaque&enablejsapi=1&playsinline=1&controls=1&showinfo=1';
				$video_thumbsrc = 'https://i.ytimg.com/vi/' . $video_id . '/' . $video_shortcode['thumbnail-resolution'] . '.jpg';
				$script = '<script>gktviTriggerVideos("' . $video_id . '", "' . $video_thumbsrc . '", "' . $video_shortcode['class'] . '", "' . $video_url . '", ' . $video_shortcode['width'] . ', ' . $video_shortcode['height'] . ');</script>';

				$svg = '<svg id="svg_' . $video_id . '"' . ' class="yt-svg" version="1.1" viewBox="0 0 68 48">
							<path class="outer-button" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
							<path d="M 45,24 27,14 27,34" fill="#fff"></path>
						</svg>';

				$showRedSvgJS = "gktviChangeSVG(this.getElementsByTagName('path')[0], '#ff0000', '1.0')";
				$showNormalSvgJS = "gktviChangeSVG(this.getElementsByTagName('path')[0], '#1f1f1e', '0.81')";
				$style = 'max-width: ' . $video_shortcode['width'] . 'px; width: ' . $video_shortcode['width'] . 'px; max-height: ' . $video_shortcode['height'] . ' px; height: ' . $video_shortcode['height'] . 'px;';
	
				$newElement = "<div class=\"$div_class\" onmouseover=\"$showRedSvgJS\" onmouseout=\"$showNormalSvgJS\" style=\"$style\" id=\"div_$video_id\">" . $svg . '</div>' . $script;
				
				return $newElement;
			}
		}
	}

	public function create_image_shortcode( $atts ) {

		$image_shortcode = shortcode_atts(array(
			'src' => '',
			'width' => '',
			'height' => '',
			'id' => '',
			'mobile-friendly' => 'yes',
			'title' => '',
			'alt' => '',
			'class' => ''
			), $atts, 'gkt_image_sc' );
	
		if ( !empty($image_shortcode['src']) ) {
			$image_class = $image_shortcode['mobile-friendly'] === 'yes' ? 'gktviImage mobile ' : 'gktviImage ';
			$script = '<script>window.onload=loadDeferredImage("' . $image_shortcode['id'] . '", "' .  $image_shortcode['src'] . '", "' . $image_class . $image_shortcode['class'] . '", "' .  $image_shortcode['alt'] . '", "' .  $image_shortcode['title'] . '", ' .  $image_shortcode['width'] . ', ' .  $image_shortcode['height'] . ');</script>';
			return '<div id="div_' . $image_shortcode['id'] . '"></div>' . $script;
		}
	}
}

new GKTVI_Create_Shortcodes();