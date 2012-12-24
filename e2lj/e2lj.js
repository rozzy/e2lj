function e2lj(ljPassword, titleSelector, articleSelector, tagsList, otherJSON) {
    var targetUrl = 'e2lj/e2lj.php';

    $.post(
    targetUrl, {
        password: ljPassword.trim(),
        title: $(titleSelector).text().trim(),
        message: $(articleSelector).html().trim(),
        tags: e2parseTags(tagsList),
        otherInfo: (otherJSON || {}),
        currentPage: window.location.href,
        send: 'post'
    },
    function (response) {
        if (response.success) {
            $('.e2lj-fulllink').html('<a href="'+response.url+'" target="blank">'+response.url+'</a>');
            $('.e2lj-fh,.e2lj-fs').toggle(0);
            return true;
        } else {
            $('.e2lj-accent').css('background', '#FA9B9B');
            $('#e2lj-password').focus();
            return false;
        }
    },
    'json');
};

function e2parseTags(selector) {
    var output = '';

	if ($(selector).data('output') != 'line') { // Place data-output="line" to the element for parsing it as line
		var child = $(selector).children().get(0).tagName;

	   	$(child, selector).each(function () {
	        output += $(this).text() + ',';
	    });
    } else output = $(selector).text();

    return output.replace(/\,\s{1,}/gi, ',').replace(/\s{1,}\,/gi, ',').replace(/\,{2,}/, ',').replace(/\.|\,{1,}$/gi,'').trim();
}