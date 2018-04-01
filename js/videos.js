// video js below
function gktviLoadVideo( videoID, videoThumbSrc, videoClass, videoSrc, width, height ) {
    var divElem = document.getElementById('div_' + videoID);
    var svg = document.getElementById('svg_' + videoID);

    var videoThumb = document.createElement('img');
        videoThumb.src = videoThumbSrc;
        videoThumb.id = 'img_' + videoID;
        videoThumb.className = 'gktviVideoThumb ' + videoClass;
        videoThumb.style.maxHeight = height + 'px';
        divElem.appendChild(videoThumb);

    var iframe = document.createElement('iframe');
        iframe.src = videoSrc;
        iframe.id = 'iframe_' + videoID;
        iframe.className = 'gktviIframe ' + videoClass;
        iframe.setAttribute('allowfullscreen', true);

    [svg, videoThumb].forEach(function(elem) {
        elem.addEventListener('click', function() {
            replaceThumbWithVideo(iframe, videoThumb);
            svg.style.display = 'none';
        });
    });
}

function replaceThumbWithVideo(iframe, videoThumb) {
    iframe.style.width = videoThumb.offsetWidth + 'px';
    iframe.style.height = videoThumb.offsetHeight + 'px';
    videoThumb.replaceWith(iframe);		
}


// js used for images
function loadDeferredImage( imageID, imageSrc, imageClass, imageAlt, imageTitle, imageWidth, imageHeight ) {
    var oldDiv = document.getElementById('div_' + imageID);
    var newImage = document.createElement('img');
        newImage.id = imageID;
        newImage.src = imageSrc;
        newImage.class = imageClass;
        newImage.alt = imageAlt;
        newImage.title = imageTitle;
        newImage.width = imageWidth;
        newImage.height = imageHeight;

    oldDiv.replaceWith(newImage);
}