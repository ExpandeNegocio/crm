function initializeGantt() {

	$(function() {

		splitDropdown();

		// load templates
		$("#ganttemplates").loadTemplates();

		// here starts gantt initialization
		ge = new GanttMaster();
		var workSpace = $("#workSpace");
		workSpace.css({
			width : $(window).width() - 10,
			height : $(window).height() - 50
		});
		ge.init(workSpace);

		// inject some buttons (for this demo only)
		// $(".ganttButtonBar div").append("");
		// $(".ganttButtonBar div").addClass('buttons');

		// overwrite with localized ones
		loadI18n();

		loadGanttFromServer('read_mode');
		$('#button_actions').html('export');
		$('#button_actions').attr('onclick', "exportGantt();");

		// fill default Teamwork roles if any
		if (!ge.roles || ge.roles.length == 0) {
			setRoles();
		}

		// fill default Resources roles if any
		if (!ge.resources || ge.resources.length == 0) {
			setResource();
		}

		/*/debug time scale
		 $(".splitBox2").mousemove(function(e){
		 var x=e.clientX-$(this).offset().left;
		 var mill=Math.round(x/(ge.gantt.fx) + ge.gantt.startMillis)
		 $("#ndo").html(x+" "+new Date(mill))
		 });*/

		setImportGanttOnServer();

		setDialogForCreateBaseline();

	});
}

function loadGanttFromServer(mode) {
	asolConsoleLog('loadGanttFromServer');

	$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
		async : false,
		dataType : "json",
		type : "POST",
		data : {
			action : "load",
			mode : mode,
			asolProjectId : asolProjectId,
			asolProjectVersionId : asolProjectVersionId
		},
		beforeSend : function() {
			asolConsoleLog('loadGanttFromServer: beforeSend');
			asolAlert('loadGanttFromServer: beforeSend');
			asolAlert('loadGanttFromServer: beforeSend -> antes de bloquear');
			blockUI_type('load');
			asolAlert('loadGanttFromServer: beforeSend -> despues de bloquear');
		},
		success : function(response) {
			asolAlert('loadGanttFromServer: success');
			asolConsoleLog(response);
			if (response.ok) {

				setAsolProjectInfo(response.jsonGanttProject.projectInfo.asolProjectName, response.jsonGanttProject.projectInfo.asolProjectVersionNumber, response.jsonGanttProject.projectInfo.asolProjectVersionName);

				if (!response.jsonGanttProject.canWrite) {
					inactivateAutosave();
					$('#button_save').hide();
					$('#button_autosave').hide();
					$('#button_clearGantt').hide();
					$('#button_importGantt').hide();
				} else {
					$('#button_save').show();
					$('#button_autosave').show();
					$('#button_clearGantt').show();
					$('#button_importGantt').show();
				}

				if (response.jsonGanttProject.projectInfo.asolProjectVersionType == 'working_version') {
					if (isEnterpriseEdition) {
						$('#button_createBaseline').show();
					}
					$('#button_publish').show();
					$('#button_exportGantt').show();
				}

				if (response.jsonGanttProject.projectInfo.asolProjectVersionType == 'baseline') {
					$('#button_publish').show();
					$('#button_editAsWorkingVersion').show();
					$('#button_exportGantt').show();
				}

				if (response.jsonGanttProject.projectInfo.asolProjectVersionType == 'last_published_version') {
					$('#button_editAsWorkingVersion').show();
					$('#button_exportGantt').show();
				}

				ge.loadProject(response.jsonGanttProject);
				ge.checkpoint(); // empty the undo stack

			} else {
				asolAlert('loadGanttFromServer: success -> response.ok==false');
			}
			asolAlert('loadGanttFromServer: success final');
		},
		error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
			var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
			alert("loadGanttFromServer: error -> " + errorMessage);
		},
		complete : function(response) {
			asolConsoleLog('loadGanttFromServer: complete');
			asolAlert('loadGanttFromServer: complete -> antes desbloquear');
			$.unblockUI();
			asolAlert('loadGanttFromServer: complete -> despues desbloquear');
		}
	});
}

var newAsolProjectVersionName = null;
var newAsolProjectVersionDescription = null;

function saveGanttOnServer(action, mode) {
	asolConsoleLog('saveGanttOnServer');

	asolConsoleLog('action=[' + action + ']');

	if (!ge.canEditMode)
		return;

	var ganttProject = ge.saveProject();

	$.ajax(site_url + "/index.php?entryPoint=" + entryPoint, {
		dataType : "json",
		type : "POST",
		data : {
			action : action,
			mode : mode,
			asolProjectId : asolProjectId,
			asolProjectVersionId : asolProjectVersionId,
			newAsolProjectVersionName : newAsolProjectVersionName,
			newAsolProjectVersionDescription : newAsolProjectVersionDescription,
			jsonGanttProject : JSON.stringify(ganttProject)
		},
		beforeSend : function() {
			blockUI_type(action);
		},
		success : function(response) {
			asolConsoleLog('saveGanttOnServer: success');
			if (response.ok) {
				if (response.jsonGanttProject) {

					setAsolProjectInfo(response.jsonGanttProject.projectInfo.asolProjectName, response.jsonGanttProject.projectInfo.asolProjectVersionNumber, response.jsonGanttProject.projectInfo.asolProjectVersionName);

					if (!response.jsonGanttProject.canWrite) {
						inactivateAutosave();
						$('#button_save').hide();
						$('#button_autosave').hide();
						$('#button_clearGantt').hide();
						$('#button_importGantt').hide();
					} else {
						$('#button_save').show();
						$('#button_autosave').show();
						$('#button_clearGantt').show();
						$('#button_importGantt').show();
					}

					$('#button_exportGantt').show();
					if (isEnterpriseEdition) {
						$('#button_createBaseline').show();
					}
					$('#button_publish').show();

					ge.loadProject(response.jsonGanttProject);
					ge.checkpoint(); // empty the undo stack

				} else {
					ge.reset();
					alert('saveGanttOnServer: success -> response.jsonGanttProject==false');
				}
			} else {
				alert('saveGanttOnServer: success -> response.ok==false');
			}
		},
		error : function(xhr, errorType, exception) { // Triggered if an error communicating with server
			var errorMessage = exception || xhr.statusText; // If exception null, then default to xhr.statusText
			alert("saveGanttOnServer: error -> " + errorMessage);
		},
		complete : function(response) {
			asolConsoleLog('saveGanttOnServer: complete');
			$.unblockUI();
		}
	});
}

function clearGantt() {
	ge.reset();
	saveGanttOnServer('clear', 'edit_mode');
}

function exportGantt() {

	if ((ge.__undoStack.length > 0) || (ge.__redoStack.length > 0)) { // Gantt has changes
		alert('Gantt has changes. First, you must perform a save.');
		return false;
	}

	$.exportGantt({
		site_url : site_url,
		entryPoint : entryPoint,
		asolProjectId : asolProjectId,
		asolProjectVersionId : asolProjectVersionId,
		jsonGanttProject : ge.saveProject()
	});

	/*
	$('#exportIframe').contents().find("#gimmeBack_jsonGanttProject").val(JSON.stringify(ge.saveProject()));
	$('#exportIframe').contents().find("#gimmeBack_asolProjectId").val(asolProjectId);
	$('#exportIframe').contents().find("#gimmeBack_asolProjectVersionId").val(asolProjectVersionId);
	$('#exportIframe').contents().find("#gimmeBack").submit();
	$('#exportIframe').contents().find("#gimmeBack_jsonGanttProject").val("");
	*/

	/*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
	 neww=window.open(uriContent,"dl");*/
}
