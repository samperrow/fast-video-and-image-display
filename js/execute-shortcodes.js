function gktviChangeSVG(elem, fill, opacity) {
    elem.style.fill = fill;
    elem.style.fillOpacity = opacity;
}

// generic element creation js
function gktviCreateElement( type, elemID, elemSrc, elemClass, width, height, alt, title ) {
    var elem = document.createElement(type);
        elem.id = type + '_' + elemID;
        elem.src = elemSrc;
        elem.className = elemClass;
        elem.style.width = width + 'px';
        elem.style.height = height + 'px';
        if (alt) elem.alt = alt;
        if (title) elem.title = title;
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
        window.addEventListener 
        ? elem.addEventListener('click', replaceThumbWithVideo(iframe, videoThumb, svg)) 
        : elem.attachEvent('onclick', replaceThumbWithVideo(iframe, videoThumb, svg));
    });
}

function replaceThumbWithVideo(iframe, videoThumb, svg) {
    return function() {
        iframe.style.width = videoThumb.offsetWidth + 'px';
        iframe.style.height = videoThumb.offsetHeight + 'px';
        videoThumb.replaceWith(iframe);
        svg.style.display = 'none';
    }
}


// image js
function loadDeferredImage( imageID, imageSrc, imageClass, imageAlt, imageTitle, imageWidth, imageHeight ) {
    var oldDiv = document.getElementById('div_' + imageID);
    var newImage = gktviCreateElement('img', imageID, imageSrc, imageClass, imageWidth, imageHeight, imageAlt, imageTitle);
    oldDiv.replaceWith(newImage);
}