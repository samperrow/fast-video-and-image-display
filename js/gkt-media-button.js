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
	self.window.on('select', function() {
			var newImage = self.window.state().get('selection').first().toJSON();
			wp.media.editor.insert('[gkt_image_sc' + ' src="' + newImage.url + '"' + ' mobile-friendly="yes"' + ' id="' + newImage.id + '"' + ' class=""' + ' width="' + newImage.width + '"' + ' height="' + newImage.height + '"' + ' alt="' + newImage.alt + '"' + ' title="' + newImage.title +'"]');
		});
	}
	self.window.open();
	return false;
}

function sanitizeStr(str) {
	var regex = /[\[\]\{\}\<\>\'\"\\(\)\*\+\\^\$\|]/g;
	if (str.match(regex)) {
		return str.replace(regex, '');
	}
}

// display video shortcode
jQuery(document).ready(function($){
	$('a#gktviShowModal').click(function() {
		if (this.window === undefined) {
			this.window = wp.media;
			$('#gkt-yt-submit-btn').click(function() {
				var inputFields = document.getElementsByClassName('gktvi-element');

				var youtubeUrl = $('input#gkt-video-url').val();
				var ytVideoWidth = $('input#gkt-video-width').val();
				var ytVideoHeight = $('input#gkt-video-height').val();
				var ytVideoRes = $('select#gkt-video-res').val();
				var ytMobileYesNo = $('select#gkt-video-mobile').val();
				var ytVideoClass = $('input#gkt-video-class').val();

				if (ytVideoWidth === '') {
					ytVideoWidth = '560';
				}

				if (ytVideoHeight === '') {
					ytVideoHeight = '315';
				}

				for (var i = 0; i < inputFields.length; i++) {
					inputFields[i].value = sanitizeStr(inputFields[i].value);
				}

				wp.media.editor.insert('[gktvideosc youtube-url="' + youtubeUrl + ' width="' + ytVideoWidth + '" height="' + ytVideoHeight + '" thumbnail-resolution="' + ytVideoRes + '" mobile-friendly="' + ytMobileYesNo + '" class="' + ytVideoClass + '"]');
			});
		}
	});
	return false;
});
