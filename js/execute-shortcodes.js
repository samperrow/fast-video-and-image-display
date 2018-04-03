function gktviChangeSVG(elem, fill, opacity) {
    elem.style.fill = fill;
    elem.style.fillOpacity = opacity;
}

// generic element creation js below
function gktviCreateElement( type, elemID, elemSrc, elemClass, width, height, alt, title ) {
    var elem = document.createElement(type);
        elem.id = type + '_' + elemID;
        elem.src = elemSrc;
        elem.className = elemClass;
        elem.style.width = width + 'px';
        elem.style.height = height + 'px';
        elem.alt = alt ? alt : '';
        elem.title = title ? title : '';
    return elem;
}


// video js 
function gktviLoadVideo( videoID, videoThumbSrc, videoClass, videoSrc, width, height ) {
    var divElem = document.getElementById('div_' + videoID);
    var svg = document.getElementById('svg_' + videoID);

    var videoThumb = gktviCreateElement('img', videoID, videoThumbSrc, videoClass, width, height);
    divElem.appendChild(videoThumb);

    var iframe = gktviCreateElement('iframe', videoID, videoSrc, videoClass, width, height);
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


// image js
function loadDeferredImage( imageID, imageSrc, imageClass, imageAlt, imageTitle, imageWidth, imageHeight ) {
    var oldDiv = document.getElementById('div_' + imageID);
    var newImage = gktviCreateElement('img', imageID, imageSrc, imageClass, imageWidth, imageHeight, imageAlt, imageTitle);
    oldDiv.replaceWith(newImage);
}