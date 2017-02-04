/* CONFIG GANTT */

//asolConsoleLog('Date.defaultFormat=['+parent.Date_defaultFormat+']');
Date.defaultFormat = Date_defaultFormat;
/* CONFIG GANTT */

var message_load = "Loading...";
var message_clear = "Clearing...";
var message_save = "Saving...";
var message_import = "Importing...";
var message_publish = "Publishing...";
var message_createBaseline = "Creating Baseline...";
var image_loading = "blockUI_loading.gif";
var message_blocked = "Action not allowed.";
var image_blocked = "blockUI_blocked.gif";

// BEGIN - blockUI
function blockUI(image, message, blockUI_cursor_type) {

	var aux_message = "" + "<table id='blockUI_table'>" + "<tr>" + "<td>" + "<img id='blockUI_image' src='" + image + "'/>" + "</td>" + "</tr>" + "<tr>" + "<td>" + "<h2 id='blockUI_message'>" + message + "</h2>" + "</td>" + "</tr>" + "</table>";

	var v = $.blockUI({
		message : aux_message,
		css : {
			width : 'auto',
			left : '45%',
			top : '35%',
			border : 'none',
			padding : '15px',
			backgroundColor : '#000',
			'-webkit-border-radius' : '10px',
			'-moz-border-radius' : '10px',
			opacity : .5,
			color : '#F15B29',
			cursor : blockUI_cursor_type,
			minWidth : '-moz-fit-content'
		},
		overlayCSS : {
			opacity : .3,
			cursor : blockUI_cursor_type
		},
		baseZ : 10000000
	});
}

function blockUI_type(type) {
	asolConsoleLog('blockUI_type');

	switch (type) {
	case 'load':
		blockUI(image_loading, message_load, 'wait');
		break;
	case 'publish':
		blockUI(image_loading, message_publish, 'wait');
		break;
	case 'createBaseline':
		blockUI(image_loading, message_createBaseline, 'wait');
		break;
	case 'clear':
		blockUI(image_loading, message_clear, 'wait');
		break;
	case 'save':
		blockUI(image_loading, message_save, 'wait');
		break;
	case 'import':
		blockUI(image_loading, message_import, 'wait');
		break;
	case 'blocked':
		blockUI(image_blocked, message_blocked, 'not-allowed');
		break;
	}
}
// END - blockUI

function redrawGantt() {
	var workSpace = $("#workSpace");
	workSpace.css({
		width : $(window).width() - 10,
		height : $(window).height() - 50
	});
}

/*
// blockUI
$(document).ajaxStart(function() {
	//asolConsoleLog('blockUI');
	blockUI_type('loading');
}).ajaxStop(function() {
	//asolConsoleLog('unblockUI');
	$.unblockUI();
});
*/

/*
window.onresize = function(event) {
    //asolConsoleLog('window.onresize iframe');   
};
*/

// Maximize/Minimize
resizeFramesetFull = function() {
	// asolConsoleLog('resizeFramesetFull');

	window.parent.window.scrollTo(0, 0);

	// var height = window.parent.document.body.clientHeight;
	var height = window.parent.window.innerHeight;

	$('#myiframe', window.parent.document).css("position", "absolute");
	$('#myiframe', window.parent.document).css("top", "0px");
	$('#myiframe', window.parent.document).css("left", "0px");
	$('#myiframe', window.parent.document).css("height", height);
	$('#myiframe', window.parent.document).contents().find('#maximize').hide();
	$('#myiframe', window.parent.document).contents().find('#minimize').show();

	$('body', window.parent.document).css("overflow", "hidden");
	$('.clickMenu', window.parent.document).css("visibility", "hidden");// hide sugarcrm-buttons
	$('#myiframe', window.parent.document).css("z-index", "1000000");// avoid problems with templates

	redrawGantt();
	ge.redraw();

};
resetFrameset = function() {
	// asolConsoleLog('resetFrameset');

	$('#myiframe', window.parent.document).css("position", "relative");
	$('#myiframe', window.parent.document).css("height", "302px");
	$('#myiframe', window.parent.document).contents().find('#minimize').hide();
	$('#myiframe', window.parent.document).contents().find('#maximize').show();

	$('body', window.parent.document).css("overflow", "");
	$('.clickMenu', window.parent.document).css("visibility", "");// show sugarcrm-buttons
	$('#myiframe', window.parent.document).css("z-index", "inherit");// avoid problems with templates

	redrawGantt();
	ge.redraw();

};

// Autosave
var timerAutosave;
var intervalAutosave = intervalMinutesAutosave * 60 * 1000;

activateAutosave = function() {
	// asolConsoleLog('activateAutosave');

	$('#autosave_inactive').hide();
	$('#autosave_active').show();

	timerAutosave = setInterval(function() {
		saveGanttOnServer('save', 'edit_mode');
	}, intervalAutosave);
};

inactivateAutosave = function() {
	// asolConsoleLog('inactivateAutosave');

	$('#autosave_active').hide();
	$('#autosave_inactive').show();

	clearInterval(timerAutosave);
};

// Keep alive edit mode
var timerKeepAliveEditMode;
var intervalKeepAliveEditMode = intervalMinutesKeepAliveEditMode * 60 * 1000;

activateEditMode = function() {
	asolConsoleLog('activateEditMode');

	if (ge.canEditMode && (ge.projectInfo.asolProjectVersionType == 'working_version')) {

		loadGanttFromServer('edit_mode'); // ajax(async : false)

		if (ge.canWrite) {

			$('#read_mode').hide();
			$('#edit_mode').show();
			$('#button_actions').html('<span class="ui-button-text">save</span>');
			$('#button_actions').attr('onclick', "saveGanttOnServer('save', 'edit_mode');");

			keepAliveEditMode();

			timerKeepAliveEditMode = setInterval(function() {
				keepAliveEditMode();
			}, intervalKeepAliveEditMode);
		} else {
			alert('You are not allowed to edit this Gantt.');
		}
	} else {
		alert("You are not allowed to edit this Gantt.");
	}
};

inactivateEditMode = function() {
	asolConsoleLog('inactivateEditMode');

	clearInterval(timerKeepAliveEditMode);

	if ((ge.__undoStack.length > 0) || (ge.__redoStack.length > 0)) { // Gantt has changes
		if (confirm('Gantt has changes. Wish to save?')) {
			saveGanttOnServer('save', 'read_mode');
		} else {
			loadGanttFromServer('read_mode');
		}
	} else {
		loadGanttFromServer('read_mode');
	}

	$('#edit_mode').hide();
	$('#read_mode').show();
	$('#button_actions').html('<span class="ui-button-text">export</span>');
	$('#button_actions').attr('onclick', "exportGantt();");
};

function keepAliveEditMode() {
	asolConsoleLog('keepAliveEditMode');

	$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
		dataType : "json",
		data : {
			action : 'keepAliveEditMode',
			asolProjectVersionId : asolProjectVersionId
		},
		type : "POST",
		success : function(response) {
			// asolConsoleLog(response);
			if (response.ok) {
				asolConsoleLog('ok');
			} else {
				var errMsg = "Errors when keepAliveEditMode \n";
				if (response.message) {
					errMsg = errMsg + response.message + "\n";
				}

				if (response.errorMessages.length) {
					errMsg += response.errorMessages.join("\n");
				}

				alert(errMsg);
			}
		},
		error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
			var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
			alert("keepAliveEditMode: error -> " + errorMessage);
		},
		complete : function(response) {
		}
	});
}

//

function setSiteUrl() {
	$('#gimmeBack').attr('action', site_url + $('#gimmeBack').attr('action'));
}

function setEntryPoint() {
	$('#gimmeBack').attr('action', $('#gimmeBack').attr('action') + entryPoint);
}

function buildExportForm() {

	var formHTML;
	formHTML += '<form id="gimmeBack" style="display:none;" action="' + site_url + '/index.php?entryPoint=' + entryPoint + '" method="post" target="_blank">';
	formHTML += '	<input type="hidden" name="action" id="gimmeBack_action" value="export" />';
	formHTML += '	<input type="hidden" name="asolProjectId" id="gimmeBack_asolProjectId" />';
	formHTML += '	<input type="hidden" name="asolProjectVersionId" id="gimmeBack_asolProjectVersionId" />';
	formHTML += '	<input type="hidden" name="jsonGanttProject" id="gimmeBack_jsonGanttProject" />';
	formHTML += '</form>';

	$('#exportIframe').contents().find('body').html(formHTML);
}

function importGantt() {
	// asolConsoleLog('importGantt');

	if (!ge.canWrite)
		return;

	$('#fileToUpload').trigger('click'); // setImportGanttOnServer
}

function setImportGanttOnServer() {
	// asolConsoleLog('setImportGanttOnServer');

	uploader = document.getElementById('uploader');

	upclick({
		dataid : 'fileToUpload',
		element : uploader,
		action : site_url + "/index.php?entryPoint=" + entryPoint + "&action=import&asolProjectVersionId=" + asolProjectVersionId,
		onstart : function(filename) {
			// alert('Start upload: ' + filename);
			blockUI_type('import');
		},
		error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
			var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
			alert("importGantt: error -> " + errorMessage);
		},
		oncomplete : function(response_data) {
			// //asolConsoleLog(response_data);
			var response;
			try {
				response = JSON.parse(response_data);
			} catch (e) {
				response = false;
				// asolConsoleLog('Invalid JSON');
			}

			if (response) {
				// asolConsoleLog(response);
				if (response.ok) {
					if (response.jsonGanttProject) {
						ge.loadProject(response.jsonGanttProject);
						ge.checkpoint(); // empty the undo stack
					} else {
						ge.reset();
						alert('importGantt: oncomplete -> response.jsonGanttProject==false');
					}

				} else {
					alert('importGantt: oncomplete -> response.ok==false');
				}
			}

			$.unblockUI();
		}
	});
}

function resizeWorkspace() {

	var workspaceMargin = 10;

	var tableWidthPercentage = 0.60;
	var separatorWidth = 5;

	// ///////////////

	var workspace = new Object();
	workspace.element = $('#workSpace');
	workspace.width = $(window).width() - workspaceMargin;
	workspace.height = $(window).height() - workspace.element.offset().top; // fixs buttons fluid layout

	var table = new Object();
	table.element = $('.splitBox1');

	var separator = new Object();
	separator.element = $('.vSplitBar');

	var diagram = new Object();
	diagram.element = $('.splitBox2');

	table.left = 0;
	table.width = workspace.width * tableWidthPercentage;

	var tableMaxWidth = $('.gdfTable.fixHead').width();
	if (table.width > tableMaxWidth) {
		table.width = tableMaxWidth;
	}

	separator.left = table.width;
	separator.width = separatorWidth;

	diagram.left = table.width + separatorWidth;
	diagram.width = workspace.width - diagram.left - 2;

	workspace.element.css({
		width : workspace.width,
		height : workspace.height
	});
	table.element.css({
		left : table.left,
		width : table.width
	});
	separator.element.css({
		left : separator.left,
		width : separator.width
	});
	diagram.element.css({
		left : diagram.left,
		width : diagram.width
	});

}

$(window).resize(function() {
	clearTimeout(window.resizeWorkspaceTimeout);
	window.resizeWorkspaceTimeout = setTimeout(resizeWorkspace, 100);
});

// AUX FUNCTIONS
function asolAlert(message) {
	var alertIsActive = false;

	if (alertIsActive) {
		alert(message);
	}
}

function asolConsoleLog(message) {
	var consoleIsActive = true;

	if (consoleIsActive) {
		console.log(message);
	}
}

function setAsolProjectInfo(projectName, versionNumber, versionName) {

	var versionInfo = '';

	if ((projectName == undefined) || (projectName == null)) {
		projectName = '';
	}

	if ((versionNumber == undefined) || (versionNumber == null) || (versionNumber < 0)) {
		versionInfo = '';
	} else {
		versionInfo = 'v' + versionNumber;
	}

	if ((versionName != undefined) || (versionName != null)) {
		if (versionInfo != '') {
			versionInfo += ': ';
		}
		versionInfo += versionName;
	}

	$('#projectName').text(projectName);
	$('#projectName').attr('title', projectName);
	$('#projectVersion').text(versionInfo);
	$('#projectVersion').attr('title', projectName);
}

function getAsolProjectInfo(asolProjectId, asolProjectVersionId) {
	asolConsoleLog('getAsolProjectInfo');

	$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
		async : true,
		dataType : "json",
		type : "POST",
		data : {
			action : "getAsolProjectInfo",
			asolProjectId : asolProjectId,
			asolProjectVersionId : asolProjectVersionId
		},
		beforeSend : function() {
		},
		success : function(response) {
			asolAlert('getAsolProjectInfo: success');
			if (response.ok) {
				setAsolProjectInfo(response.asolProjectName, response.asolProjectVersionNumber, response.asolProjectVersionName);
			} else {
				asolAlert('getAsolProjectInfo: success -> response.ok==false');
			}
		},
		complete : function(response) {
		}
	});
}

function setDialogForCreateBaseline() {

	$("#dialog-form").dialog({
		autoOpen : false,
		height : 'auto',
		width : 'auto',
		zIndex : 4000,
		show : {
			effect : "slide",
			duration : 400
		},
		hide : {
			effect : "slide",
			duration : 400
		},
		modal : true,
		buttons : {
			"Create" : function() {

				newAsolProjectVersionName = $('#name').val();
				newAsolProjectVersionDescription = $('#description').val();

				var mode = (ge.canWrite) ? 'edit_mode' : 'read_mode';
				saveGanttOnServer('createBaseline', mode);

				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		},
		close : function() {

		}
	});
}

function createBaseline() {

	if (!ge.canEditMode) {
		alert('You are not allowed to create a baseline.');
		return false;
	}

	if ((ge.__undoStack.length > 0) || (ge.__redoStack.length > 0)) { // Gantt has changes
		alert('Gantt has changes. First, you must perform a save.');
		return false;
	}

	$("#dialog-form").dialog("open");
}

function publish() {

	if (!ge.canEditMode) {
		alert('You are not allowed to publish.');
		return false;
	}

	if ((ge.__undoStack.length > 0) || (ge.__redoStack.length > 0)) { // Gantt has changes
		alert('Gantt has changes. First, you must perform a save.');
		return false;
	}

	if (confirm("Wish to publish this version?")) {

		$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
			async : true,
			dataType : "json",
			type : "POST",
			data : {
				action : "publish",
				mode : (ge.canWrite) ? 'edit_mode' : 'read_mode',
				asolProjectVersionId : asolProjectVersionId
			},
			beforeSend : function() {
				blockUI_type('publish');
			},
			success : function(response) {
				asolAlert('publish: success');
				if (response.ok) {
					if (response.jsonGanttProject) {
						ge.loadProject(response.jsonGanttProject);
						ge.checkpoint(); // empty the undo stack
					} else {
						alert('Error when publishing');
					}
				} else {
					asolAlert('publish: success -> response.ok==false');
				}
			},
			error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
				var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
				alert("publish: error -> " + errorMessage);
			},
			complete : function(response) {
				$.unblockUI();
			}
		});
	}
}

function editAsWorkingVersion() {

	if (!ge.canEditMode) {
		alert('You are not allowed to edit as working-version.');
		return false;
	}

	if (confirm("Wish to override this AsolProject's working-version with this version?")) {

		$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
			async : true,
			dataType : "json",
			type : "POST",
			data : {
				action : "editAsWorkingVersion",
				asolProjectId : asolProjectId,
				asolProjectVersionId : asolProjectVersionId
			},
			beforeSend : function() {
			},
			success : function(response) {
				asolAlert('editAsWorkingVersion: success');
				if (response.ok) {
					if (response.canEditWorkingVersion) {
						alert("You are going to be redirected to this AsolProject's working-version");
						parent.document.location = site_url + "/index.php?module=asol_ProjectVersion&action=DetailView&record=" + response.workingVersionId;
					} else {
						alert("You are not allowed to edit this AsolProject's working-version");
					}
				} else {
					asolAlert('editAsWorkingVersion: success -> response.ok==false');
				}
			},
			complete : function(response) {
			},
			error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
				var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
				alert("editAsWorkingVersion: error -> " + errorMessage);
			}
		});

	}
}

function splitDropdown() {
	$(function() {
		$("#button_actions").button().click(function() {
			// alert("Running the last action");
		}).next().button({
			text : false,
			icons : {
				primary : "ui-icon-triangle-1-s"
			}
		}).click(function() {
			var menu = $(this).parent().next().show().position({
				my : "right top",
				at : "left bottom",
				of : $("#select_action")
			});

			menu.css({
				"position" : "absolute", // needed to hover the gantt
				"z-index" : "4000",
				"top" : "",
				"left" : "",
				"right" : "29px", // position absolute messed up the position set by jquery menu()
				"width" : "150px"
			});

			$(document).one("click", function() {
				menu.hide();
			});
			$('body', window.parent.document).one("click", function() {
				menu.hide();
			});

			return false;
		}).parent().buttonset().next().hide().menu();

		$("#button_actions, #select_action").css({
			'visibility' : ""
		});
	});
}

function buttonsLeftVisibility(canWrite) {

	if (!canWrite) {
		$("#undo, #redo, #addAboveCurrentTask, #addBelowCurrentTask, #indentCurrentTask, #outdentCurrentTask, #moveUpCurrentTask, #moveDownCurrentTask, #deleteCurrentTask").css({
			'color' : '#bbbbbb'
		});
	} else {
		$("#undo, #redo, #addAboveCurrentTask, #addBelowCurrentTask, #indentCurrentTask, #outdentCurrentTask, #moveUpCurrentTask, #moveDownCurrentTask, #deleteCurrentTask").css({
			'color' : '#617777'
		});
	}
}
