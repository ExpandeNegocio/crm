(function($) {

	// Creating a jQuery plugin:

	$.exportGantt = function(options) {

		// console.log('options=['+JSON.stringify(options)+']');

		options = options || {};

		if (!options.jsonGanttProject) {
			throw new Error("Please enter all the required config options!");
		}

		// Creating a 1 by 1 px invisible iframe:
		var iframe = $('<iframe>', {
			width : 1,
			height : 1,
			frameborder : 0,
			css : {
				display : 'none'
			}
		}).appendTo('body');

		var formHTML;
		formHTML += '<form target="_parent" id="gimmeBack" style="display:none;" action="' + options.site_url + '/index.php?entryPoint=' + options.entryPoint + '" method="post" target="_blank">';
		formHTML += '	<input type="hidden" name="action" id="gimmeBack_action" value="export" />';
		formHTML += '	<input type="hidden" name="asolProjectId" id="gimmeBack_asolProjectId" value="' + options.asolProjectId + '" />';
		formHTML += '	<input type="hidden" name="asolProjectVersionId" id="gimmeBack_asolProjectVersionId" value="' + options.asolProjectVersionId + '" />';
		formHTML += '	<input type="hidden" name="jsonGanttProject" id="gimmeBack_jsonGanttProject" value="" />';
		formHTML += '</form>';

		setTimeout(function() { // Giving IE a chance to build the DOM in the iframe with a short timeout:

			var body = (iframe.prop('contentDocument') !== undefined) ? iframe.prop('contentDocument').body : iframe.prop('document').body; // IE

			body = $(body);

			body.html(formHTML);

			var form = body.find('form');
			body.find("#gimmeBack_jsonGanttProject").val(JSON.stringify(options.jsonGanttProject));
			form.submit();

			iframe.remove();
		}, 50);
	};

})(jQuery);