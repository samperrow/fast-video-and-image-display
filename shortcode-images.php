<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}
add_filter( 'widget_text', 'do_shortcode' );


function gkt_sc_images() {
	echo '<a href="#" id="gktDeferImage" class="button"><span style="margin: 3px 5px 0 0;" class="dashicons dashicons-images-alt"></span>Defer Image Load</a>';
}

if ( is_admin() ) {
	add_action( 'media_buttons', 'gkt_sc_images', 15, 2 );
}

function gkt_image_sc_create( $atts ) {

	$gkt_image_atts = shortcode_atts(array(
		'src' => '',
		'width' => '',
		'height' => '',
		'id' => '',
		'mobile-friendly' => 'yes',
		'title' => '',
		'alt' => '',
		'class' => ''
		), $atts, 'gkt_image_sc' );

	if ( !empty($gkt_image_atts['src']) ) {

		if ($gkt_image_atts['mobile-friendly'] == 'yes') { ?>
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
		// return '<div id=' . '"' . 'div_' . $gkt_image_atts['id'] . '"' . '></div>' . $script;
		return $script;
}

add_shortcode( 'gkt_image_sc', 'gkt_image_sc_create' );
?>
