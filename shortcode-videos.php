<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'widget_text', 'do_shortcode' );

function gkt_sc_videos() {

	echo '<a href="#TB_inline?width=900&height=500&inlineId=gktDeferVideo" id="showmodal" class="thickbox button" title="Enter the YouTube video information to generate a shortcode."><span style="margin: 3px 5px 0 0;" class="dashicons dashicons-video-alt3"></span>Defer YouTube Video</a>';

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
							<input type="text" id="gkt-video-url" class="widefat" />
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
							<input size="20" type="text" id="gkt-video-width" />
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video Height (px):</p>
					</td>
					<td>
						<label>
							<input size="20" type="text" id="gkt-video-height" />
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<p>Video Thumbnail Resolution:</p>
					</td>
					<td>
						<select id="gkt-video-res">
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
						<select id="gkt-video-mobile">
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
							<input type="text" id="gkt-video-class" class="widefat" />
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

			if ( ( $gkt_video_sc_atts['mobile-friendly'] === 'yes' ) ) {

				?>
				<style>
					@media only screen and ( max-width: 1200px ) {
						div#div_<?php echo $gkt_yt_video_id; ?> {
							margin: 0 auto;width: <?php echo $gkt_video_sc_atts['width'] . 'px' ?>;
							max-width: 80%;height: auto;
							max-height: <?php echo $gkt_video_sc_atts['height'] . 'px' ?>
							}
							img#img_<?php echo $gkt_yt_video_id; ?>,
							iframe#iframe_<?php echo $gkt_yt_video_id; ?> {
								margin: 0 auto;
							}
							img#img_<?php echo $gkt_yt_video_id; ?> {
								width: 100%;
								height: auto;
							}
							iframe#iframe_<?php echo $gkt_yt_video_id; ?> {
								max-width: 80%;
							}
						}
				</style>
			<?php }
			if ( $gkt_yt_video_id !== null && ( strlen( $gkt_yt_video_id ) < 15) ) { ?>
				<style>
					#div_<?php echo $gkt_yt_video_id; ?> {
						position: relative;
						display: block;
						width: <?php echo $gkt_video_sc_atts['width'] . 'px' ?>;
						height: <?php echo $gkt_video_sc_atts['height'] . 'px' ?>
						}
						#img_<?php echo $gkt_yt_video_id; ?>,
						#iframe_<?php echo $gkt_yt_video_id; ?> {
							position: relative;
							display: block;
							max-height: <?php echo $gkt_video_sc_atts['height'] . 'px' ?>;
							max-width: 100%;
						}
						#img_<?php echo $gkt_yt_video_id; ?> {
							width: <?php echo $gkt_video_sc_atts['width'] . 'px' ?>;
							height: <?php echo $gkt_video_sc_atts['height'] . 'px' ?>;
						}
						#iframe_<?php echo $gkt_yt_video_id; ?> {
							width: <?php echo $gkt_video_sc_atts['width'] . 'px;' ?>
						}
						#img_<?php echo $gkt_yt_video_id; ?>:hover,
						.yt-svg<?php echo $gkt_yt_video_id; ?>:hover,
						#path1_<?php echo $gkt_yt_video_id; ?>:hover,
						#path2_<?php echo $gkt_yt_video_id; ?>:hover,
						#path3_<?php echo $gkt_yt_video_id; ?>:hover,
						#iframe_<?php echo $gkt_yt_video_id; ?>:hover {
							cursor: pointer;
						}
						.outer-button:hover {
							fill: #cc181e;
							fill-opacity: 1.0;
						}
						.yt-svg {
							position: absolute;
							display: block;
							font: 13.3333px Arial;
							z-index: 1000;
							background-color: inherit;
							border: 0;
							width: 15%;
							height: 15%;
							left: 42.5%;
							right: 42.5%;
							top: 42.5%;
							bottom: 42.5%;
						}
					</style>

					<script>
						function loadThumbAndVideo() {
							if (typeof window.jQuery === 'function') {
								jQuery(function($) {
									var findOldDiv = $('#div_<?php echo $gkt_yt_video_id; ?>').append('<img src="<?php echo $gkt_video_sc_thumbsrc; ?>" id="img_<?php echo $gkt_yt_video_id; ?>" class="<?php echo $gkt_video_sc_atts['class']; ?>" />');
									$('#img_<?php echo $gkt_yt_video_id; ?>').load(function() {
										var imageHeight = $(this).height();
										var imageWidth = $(this).width();
										var createIframe = ('<iframe src="<?php echo $gkt_video_sc_url; ?>" id="iframe_<?php echo $gkt_yt_video_id; ?>" width="' + imageWidth + '" height="' + imageHeight + '" allowfullscreen></iframe>');
										var loadVideo = $('#img_<?php echo $gkt_yt_video_id; ?>, #svg_<?php echo $gkt_yt_video_id; ?>').click(function() {
											$('#div_<?php echo $gkt_yt_video_id; ?>').replaceWith(createIframe);
										});
									});
									clearInterval(checkjQuery_<?php echo $gkt_yt_video_id; ?>);
								});
							}
							else {
								return;
							}
						}
						var checkjQuery_<?php echo $gkt_yt_video_id; ?> = setInterval(loadThumbAndVideo, 250);
					</script>
			<?php


		return '<div id="div_' . $gkt_yt_video_id . '" >' .
				'<svg id="svg_' . $gkt_yt_video_id . '"' . ' class="yt-svg" version="1.1" viewBox="0 0 68 48">
					<path id="path1_' . $gkt_yt_video_id . '"' . ' class="outer-button" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e" fill-opacity="0.81"></path>
					<path id="path2_' . $gkt_yt_video_id . '"' . ' d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path>
					<path id="path3_' . $gkt_yt_video_id . '"' . ' d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path>
				</svg></div>';
			}
		}
	}
}

add_shortcode( 'gktvideosc', 'gkt_video_sc_create' );

?>
