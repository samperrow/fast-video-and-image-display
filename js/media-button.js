if (!String.prototype.sanitizeStr) {
	String.prototype.sanitizeURL = function() {
		return this.replace(/[^\_\-.+!*'();,/?:@=$&\w\s]/g, '');
	}
}

if (!String.prototype.sanitizeText) {
	String.prototype.sanitizeText = function() {
		return this.replace(/[^\w]/g, '');
	}
}

// open WP media library, select image, and insert shortcode
jQuery(document).ready(function($) {
	$('#gktDeferImage').click(openMediaWindow);
});

function openMediaWindow() {
	var self = this;
	if (self.window === undefined) {
		self.window = wp.media({
			title: 'Upload an image without slowing down page load time',
			multiple: false,
			button: {text: 'Insert Image'}
		});

	self.window.on('select', function() {
			var newImage = self.window.state().get('selection').first().toJSON();
			wp.media.editor.insert('[gkt_sc_images' + ' src="' + newImage.url + '"' + ' mobile-friendly="yes"' + ' id="' + newImage.id + '"' + ' class=""' + ' width="' + newImage.width + '"' + ' height="' + newImage.height + '"' + ' alt="' + newImage.alt + '"' + ' title="' + newImage.title +'"]');
		});
	}
	self.window.open();
	return false;
}


// display video shortcode
jQuery(document).ready(function($) {
	$('input#gkt-yt-submit-btn').on('click', gktviShowVideoModal);
});

function gktviShowVideoModal() {

	var youtubeUrl = document.getElementById('gkt-video-url');
	var ytVideoWidth = document.getElementById('gkt-video-width');
	var ytVideoHeight = document.getElementById('gkt-video-height');
	var ytVideoRes = document.getElementById('gkt-video-res');
	var ytMobileYesNo = document.getElementById('gkt-video-mobile');
	var ytVideoClass = document.getElementById('gkt-video-class');

	if (ytVideoWidth.value === '') ytVideoWidth.value = '560';
	if (ytVideoHeight.value === '') ytVideoHeight.value = '315';


	wp.media.editor.insert('[gktvideosc youtube-url="' + youtubeUrl.value.sanitizeURL() + '" width="' + ytVideoWidth.value.sanitizeText() + '" height="' + ytVideoHeight.value.sanitizeText() + '" thumbnail-resolution="' + ytVideoRes.value + '" mobile-friendly="' + ytMobileYesNo.value + '" class="' + ytVideoClass.value + '"]');
	youtubeUrl.value = '';
	ytVideoWidth.value = '';
	ytVideoHeight.value = '';
	ytVideoClass.value = '';
	
}
