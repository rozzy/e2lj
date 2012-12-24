function e2lj (ljPassword, titleSelector, articleSelector, tagsList) {
	var targetUrl  = 'e2lj.php';
	$.post(
		targetUrl, 
		{
			password: $(ljPassword).val(),
			title: $(titleSelector).text(),
			message: $(articleSelector).html(),
			tags: e2parseTags(tagsList)
		},
		function (response) {
			console.log(response);
		}, 
		'json'
	);
}

function e2parseTags (selector) {
	return $(selector).text();
}