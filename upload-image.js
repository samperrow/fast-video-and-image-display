jQuery(document).ready(function($) {
    $('.gkt-select-img').click(function() {
        jQuery.data(document.body, 'prevElement', $(this).next());
        window.send_to_editor = function(html) {
            var imgurl = jQuery(html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');
            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }
            tb_remove();
        };
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
});