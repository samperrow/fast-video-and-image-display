<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'widget_text', 'do_shortcode' );

function gkt_sc_videos() {

	echo '<a href="#TB_inline?width=900&height=500&inlineId=gktDeferVideo" id="gktviShowModal" class="thickbox button" title="Enter the YouTube video information to generate a shortcode."><span style="margin: 3px 5px 0 0;" class="dashicons dashicons-video-alt3"></span>Defer YouTube Video</a>';

	?>
	<div class="hidden" id="gktDeferVideo" width="500">
		<table class="gkt-form-table">
			<tbody>
				<tr>
					<td>
						<p>YouTube Video URL:</p>
					</td>
					<td>
						<label>
							<input type="text" id="gkt-video-url" class="widefat gktvi-element" />
						</label>
						<i>"https://www.youtube.com/watch?v=sGUNPMPrxvA", for example</i>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video Width (px):</p>
					</td>
					<td>
						<label>
							<input size="20" type="text" id="gkt-video-width" class="gktvi-element" />
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video Height (px):</p>
					</td>
					<td>
						<label>
							<input size="20" type="text" id="gkt-video-height" class="gktvi-element" />
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video Thumbnail Resolution:</p>
					</td>
					<td>
						<select id="gkt-video-res" class="gktvi-element">
							<option value="hqdefault">High Quality</option>
							<option value="mqdefault">Medium Quality</option>
							<option value="sddefault">Standard Quality</option>
							<option value="maxresdefault">Maximum Resolution</option>
						</select>

					</td>
				</tr>
				<tr>
					<td>
						<p>Mobile Friendly?</p>
					</td>
					<td>
						<select id="gkt-video-mobile" class="gktvi-element">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video CSS Class:</p>
						<i style="display: block; margin-top: -18px;">(optional)</i>
					</td>
					<td>
						<label>
							<input type="text" id="gkt-video-class" class="widefat" class="gktvi-element" />
						</label>
					</td>
				</tr>
			</tbody>
		</table>
		<input id="gkt-yt-submit-btn" type="button" class="button button-primary gkt-ytvideo-insert" value="Insert Shortcode" />
		<a href="https://github.com/sarcastasaur/fast-video-and-image-display"><img alt="link to github repo" src="<?php echo plugin_dir_url(__FILE__) . 'images/github.png'; ?>" width="32" height="32"></a>
	</div>

	<?php
}

if ( is_admin() ) {
	add_action( 'media_buttons', 'gkt_sc_videos', 15, 2 );
}

function gkt_video_sc_create( $atts ) {

	$gkt_video_sc_atts = shortcode_atts( array(
		'youtube-url' => '',
		'width' => '',
		'height' => '',
		'thumbnail-resolution' => 'mqdefault',
		'mobile-friendly' => '',
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
					<path class="outer-button" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e" fill-opacity="0.81"></path>
					<path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path>
					<path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path>
				</svg>';

			$newElement = '<div style="max-width: ' . $gkt_video_sc_atts['width'] . 'px; width: ' . $gkt_video_sc_atts['width'] . 'px; max-height: ' . $gkt_video_sc_atts['height'] . 'px; height: ' . $gkt_video_sc_atts['height'] . 'px; " class="gktviDiv" id="div_' . $gkt_yt_video_id . '">' . $svg . '</div>' . $script;
			
			return $newElement;
		}
	}
}


add_shortcode( 'gktvideosc', 'gkt_video_sc_create' );

?>
