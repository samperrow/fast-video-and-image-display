// open WP media library, select image, and insert shortcode
jQuery(document).ready(function($){
	$('#gktDeferImage').click(open_media_window);
});

function open_media_window() {
	if (this.window === undefined) {
		this.window = wp.media({
			title: 'Upload an image without slowing down page load time',
			library: {type: 'image'},
			multiple: false,
			button: {text: 'Insert Image'}
		});

	var self = this;
	this.window.on('select', function() {
			var newImage = self.window.state().get('selection').first().toJSON();
			wp.media.editor.insert('[gkt_image_sc' + ' src="' + newImage.url + '"' + ' mobile-friendly="yes"' + ' id="deferImage_' + newImage.id + '"' + ' class=""' + ' width="' + newImage.width + '"' + ' height="' + newImage.height + '"' + ' alt="' + newImage.alt + '"' + ' title="' + newImage.title +'"]');
		});
	}
	this.window.open();
	return false;
}

// display video shortcode
jQuery(document).ready(function($){
	$('#showmodal').click(function() {
		if (this.window === undefined) {
			this.window = wp.media;
			$('#gkt-yt-submit-btn').click(function() {
				var tagsOrQuotes = /[<>'"]/g;
				var chars = /[^0-9]/g;
				var youtubeUrl = $('input#gkt-video-url').val();
				var ytVideoWidth = $('input#gkt-video-width').val();
				var ytVideoHeight = $('input#gkt-video-height').val();
				var ytVideoRes = $('select#gkt-video-res :selected').val();
				var ytMobileYesNo = $('select#gkt-video-mobile :selected').val();
				var ytVideoClass = $('input#gkt-video-class').val();
				var inputArray = [youtubeUrl, ytVideoWidth, ytVideoHeight, ytVideoRes, ytMobileYesNo, ytVideoClass];

				for (var i = 0; i < inputArray.length; i++) {
					if ( inputArray[i].match(tagsOrQuotes)) {
						inputArray[i] = inputArray[i].replace( tagsOrQuotes, '');
					}
				}

				if (ytVideoWidth == '' || ytVideoWidth.match(chars)) {
					inputArray[1] = '560';
				}

				if (ytVideoHeight == '' || ytVideoHeight.match(chars)) {
					inputArray[2] = '315';
				}
			wp.media.editor.insert('[gktvideosc youtube-url="' + inputArray[0] + '"' + ' width="' + inputArray[1] + '"' + ' height="' + inputArray[2] + '"' + ' thumbnail-resolution="' + inputArray[3] + '"' + ' mobile-friendly="' + inputArray[4] + '"' + ' class="' + inputArray[5] + '"]');
			});
		}
	});
	return false;
});
