// letrium yura

if(typeof sqs_objects == 'undefined'){
	var sqs_objects = new Array;			
}		


YAHOO.util.Event.onDOMReady(function(){
	dom_loaded = true;
});		
function check_edv_loaded(){
	if(typeof EDV != 'undefined' && typeof dom_loaded != 'undefined' && dom_loaded == true){
		dom_loaded = false;
		return true;
	}
}

// init for editable detail view	
SUGAR.util.doWhen(check_edv_loaded, function(){
	
	var nodes = YAHOO.util.Selector.query('.detail span');
	for(var i in nodes){
		if(nodes[i].nodeName == 'SPAN'){
			var old_id = nodes[i].getAttribute("id");
			nodes[i].setAttribute("id",old_id+"_span");
		}
	}	
	var nodes = YAHOO.util.Selector.query('.sugar_field, .div_value .checkbox');
	for(var i in nodes){
		if(nodes[i].nodeName == 'INPUT'){
			var old_id = nodes[i].getAttribute("id");
			nodes[i].setAttribute("id",old_id+"_span");
		}
	}	
	var nodes = YAHOO.util.Selector.query('.dateTime');	
	for(var i in nodes){
		if(nodes[i].nodeName == 'TABLE'){
			nodes[i].style.width = "230px";
		}
	}	
	var node = YAHOO.util.Dom.get("email1_span_span");
	if(node){
		var elm = YAHOO.util.Dom.get("email1");
		var nodes = YAHOO.util.Selector.query('#email1_span_span a');
		if(nodes[0] != undefined){
			var val = nodes[0].innerHTML;
			elm.setAttribute("value",val);
		}else
			elm.setAttribute("value","");		
	}

	EDV.is_editable = document.getElementById("is_editable").value;
	
	EDV.current_module = EDV.getCurrentModule();
	

	
	// close editing
	document.onkeydown = function(e){ 
				if (e == null) { // ie 
					keycode = event.keyCode; 
				} else { // mozilla 
					keycode = e.which; 
				} 
				if(keycode == 27){ // escape key

					var elm = YAHOO.util.Dom.get(EDV.field_edited);
					if(elm && elm.nodeName != "SELECT")
						elm.value = EDV.current_value;
					EDV.close_edit(EDV.field_edited);
				} 
	};	
});


//** Editable DetailView Object
EDV = function(){

	return {
	
		field_edited: "",
		current_module: "",
		current_value: "",
		is_editable: false,
		calendar_format: "",

		show_edit: function (field,type){

			if(!this.is_editable)
				return;


			var elm = YAHOO.util.Dom.get(field);	
			if(!elm)
				return;
			if(field == 'date_entered' || field == 'date_modified' || field == 'case_number' || field == 'bug_number' || type == 'file' || field == 'reminder_checked' || field == 'email_opt_out' || field == 'filename' || field == 'created_by_name' || field == 'modified_by_name')
				return;

			if(this.field_edited != field){
				this.close_edit(this.field_edited);
			}
			this.field_edited = field;

			

			elm.style.backgroundColor = "";
			if(type == 'fullname'){
				document.getElementById('last_name').style.backgroundColor = "";
			}else if(type == 'datetimecombo'){
				document.getElementById(field+"_date").style.backgroundColor = "";
			}else if(type == 'relate'){
				var id_name = YAHOO.util.Dom.get(field+"_id_name").value;
				var module_name = YAHOO.util.Dom.get(field+"_module").value;

				if(field == 'assigned_user_name'){
					sqs_objects['DetailView_assigned_user_name']={
								"form":"DetailView",
								"method":"get_user_array",
								"field_list":["user_name","id"],
								"populate_list":["assigned_user_name","assigned_user_id"],
								"required_list":["assigned_user_id"],
								"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],
								"limit":"30",
								"no_match_text":"No Match"
					};
				}else{
					sqs_objects['DetailView_'+field]={
							"form":"DetailView",
							"method":"query",
							"modules":[module_name],
							"group":"or",
							"field_list":["name","id"],
							"populate_list":[field,id_name],
							"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],
							"required_list":[id_name],
							"order":"name",
							"limit":"30",
							"no_match_text":"No Match"
					};
				}
				enableQS(true);
			}

			if(type == 'relate' || type == 'parent'){
				if(type == 'relate')
					var id_name = YAHOO.util.Dom.get(field+"_id_name").value;
				else
					var id_name = 'parent_id';		
	
				YAHOO.util.Dom.get('btn_clr_'+field).onclick = function (){
					YAHOO.util.Dom.get(field).value = "";
					YAHOO.util.Dom.get(id_name).value = "";
					EDV.updateField(field,YAHOO.util.Dom.get(field),type);			
				}
			}


			if(this.current_module == 'Calls' && field == 'direction'){
				this.add_save_button(field,type);
			}
			else if(type == 'enum'){	
				elm.onchange = function(){ EDV.updateField(field,this,type); }
				elm.onblur = function(){ EDV.updateField(field,this,type); }
			}
			else if(type == 'radioenum'){	

			}
			else if(type == 'date' || type == 'datetime'){
				this.set_calendar(field,"");
				elm.onblur = function(){ EDV.updateField(field,this,type); }
			}
			else if(type == 'bool'){
				elm.onclick = function(){ EDV.updateField(field,this,type); }
				elm.onblur = function(){ EDV.updateField(field,this,type); }
			}
			else if(type == 'datetimecombo'){

			}
			else if(field == 'duration_hours'){

			}
			else if(type == 'multienum'){

			}
			else if(type == 'fullname'){
				elm.onclick = function(){ EDV.updateField(field,this,type); }
			}
			else if(this.check_address_type(field)){
				this.add_save_button(field,type);
				this.add_close_button(field,type);			
			}
			else if(type == 'relate' || type == 'parent'){
			
				if (YAHOO.util.Dom.get("DetailView_"+field+"_results"))				
					YAHOO.util.Dom.get("DetailView_"+field+"_results").onclick = function(){ EDV.updateField(field,this,type); };			
			}
			else{
				elm.onblur = function(){ EDV.updateField(field,this,type); }					
			}
			this.current_value = elm.value;
			YAHOO.util.Dom.get(field+"_detailblock").style.display = "none";	
			YAHOO.util.Dom.get(field+"_editblock").style.display = "block";

			if(type != 'date')
				elm.focus();			
		
		},
		
		getCurrentModule: function () {
			if (typeof document.forms["DetailView"].elements["module"][0] != 'undefined') {		
				return document.forms["DetailView"].elements["module"][0].value;
			} else {
				return document.forms["DetailView"].elements["module"].value;
			}
		},
		
		getRecord: function () {
			if (typeof document.forms["DetailView"].elements["record"][0] != 'undefined') {		
				return document.forms["DetailView"].elements["record"][0].value;
			} else {
				return document.forms["DetailView"].elements["record"].value;
			}
		},

		updateField: function (field,elm,type){
			
			if(elm.nodeName == "BUTTON")
				elm = YAHOO.util.Dom.get(field);

			if(this.checkRequired(field,elm,type)){
				return;
			}
	
			
			elm.onclick = "";
			elm.onblur = "";

			var v = new Array();
	
			if(type == 'multienum'){
				var opt = new Array();
				var c = 0;
				for(var i = 0; i < elm.options.length; i++) 
					if(elm.options[i].selected){
						opt[c] = elm.options[i].value;
						c++;	
					}		
				if(c > 0)				
					v[field] = opt;
				else
					v[field] = "";
				EDV.sendValues(v,field);
			}
			else if(field == 'sales_stage' && type == 'enum'){
				var prob = SUGAR.language.languages.app_list_strings["sales_probability_dom"][elm.value];
				YAHOO.util.Dom.get('probability').value = prob;
				YAHOO.util.Dom.get('probability_detailblock').innerHTML = "<span>"+prob+"</span>";

				v["probability"] = prob;
				v[field] = elm.value;			
				EDV.sendValues(v,field);	
			}
			else if(type == 'fullname'){
				EDV.sendValues(
					{
						'first_name': YAHOO.util.Dom.get("first_name").value,
						'last_name': YAHOO.util.Dom.get("last_name").value
					},
					field
				);
			}
			else if(this.current_module == 'Calls' && field == 'direction'){
				v["direction"] = YAHOO.util.Dom.get('direction').value;
				v["status"] = YAHOO.util.Dom.get('status').value;
				EDV.sendValues(v,field);
			}
			else if(this.check_address_type(field)){
				var group_name = field.replace("_street","");
				v[group_name+'_street'] = YAHOO.util.Dom.get(group_name+'_street').value;
				v[group_name+'_city'] = YAHOO.util.Dom.get(group_name+'_city').value;
				v[group_name+'_state'] = YAHOO.util.Dom.get(group_name+'_state').value;
				v[group_name+'_postalcode'] = YAHOO.util.Dom.get(group_name+'_postalcode').value;
				v[group_name+'_country'] = YAHOO.util.Dom.get(group_name+'_country').value;
				EDV.sendValues(v,field);
			}
			else if(field == 'duration_hours'){
				v['duration_hours'] = YAHOO.util.Dom.get('duration_hours').value;
				v['duration_minutes'] = YAHOO.util.Dom.get('duration_minutes').value;
				EDV.sendValues(v,field);
			}
			else if(type == 'relate' || type == 'parent'){
				if(type == 'relate')
					var id_name = YAHOO.util.Dom.get(field+"_id_name").value;		
				else{
					id_name = "parent_id";
					v['parent_type'] = YAHOO.util.Dom.get('parent_type').value;
				}				
				
				setTimeout(
					function(){
						v[id_name] = YAHOO.util.Dom.get(id_name).value;
						EDV.sendValues(v,field);
					},500
				);
			}
			else if(type == 'bool'){
				setTimeout(
					function(){		
						if(elm.checked)
							v[field] = 1;
						else
							v[field] = 0;		
						EDV.sendValues(v,field);
					},200
				);		
			}
			else if(type == 'radioenum'){
				setTimeout(
					function(){
						v[field] = elm.value;			
						EDV.sendValues(v,field);
					},200
				);		
			}
			else{
				v[field] = elm.value;			
				EDV.sendValues(v,field);		
			}
		
		},		

		close_edit: function (field){
			if(field == "")
				return;
			this.field_edited = "";
				
			YAHOO.util.Dom.get(field+"_editblock").style.display = "none";			
			YAHOO.util.Dom.get(field+"_detailblock").style.display = "block";
			var elm = YAHOO.util.Dom.get(field);	
			if(!elm)
				return;
			elm.onclick = "";
			elm.onblur = "";		
		},

		update_cal_val: function (cal){
				if(typeof cal != 'undefined'){
					if(cal.dateClicked){
						var v = new Array();
						var field = cal.inputField.getAttribute('id');
						v[field] = YAHOO.util.Dom.get(field).value;
						EDV.sendValues(v,field);
					}
				}else{		
					var v = new Array();
					var field = EDV.field_edited;
					v[field] = YAHOO.util.Dom.get(field).value;
					EDV.sendValues(v,field);
				}
		},
	
		set_calendar: function (idname,date_value){		
								
			Calendar.setup ({
				inputField : idname,
				daFormat : this.calendar_format,
				ifFormat : this.calendar_format,
				button : idname+"_trigger",
				singleClick : true,
				dateStr : date_value,
				step : 1,
				weekNumbers: false,
				onUpdate: EDV.update_cal_val				
			});	
			
			YAHOO.util.Event.removeListener(idname, "change");			
			YAHOO.util.Event.addListener(idname,"change",EDV.update_cal_val);
		},			

		sendValues: function (v,field){

			var url = 'index.php?module=Home&action=eSave&sugar_body_only=true'
						+'&field='		 + field
						+'&current_module='	 + EDV.getCurrentModule()
						+'&record='		 + EDV.getRecord();
			var vURI = this.toURI(v);			
			YAHOO.util.Connect.asyncRequest('POST',url,this.saveCallback,vURI);

			YAHOO.util.Dom.get(field+"_editblock").style.display = "none";
			var img = document.createElement("img");
			img.setAttribute("src",'themes/default/images/loading.gif');
			img.style.width = "18px";
			img.style.height = "18px";
			img.setAttribute("id",field+'_img');
			YAHOO.util.Dom.get(field+"_editblock").parentNode.appendChild(img);
	
			return;
		},

		saveCallback: {
			success: function(o){

				obj = eval('('+o.responseText+')');		
				EDV.remove_img(obj.field);		
				if(obj.success == 'no_access'){
					alert(SUGAR.language.languages.app_strings["LBL_EDV_ACCESS_ERROR"]);
					return;
				}						
				YAHOO.util.Dom.get(obj.field+"_detailblock").innerHTML = obj.content;		
				YAHOO.util.Dom.get(obj.field+"_editblock").style.display = "none";			
				YAHOO.util.Dom.get(obj.field+"_detailblock").style.display = "block";	

				if(EDV.field_edited == obj.field)
					EDV.field_edited = "";
			},
			failure: function(o){
				alert(SUGAR.language.languages.app_strings["LBL_EDV_SAVING_ERROR"]);
			},
			scope: function(o){
			}
		},

		remove_img: function (field){
			var img = YAHOO.util.Dom.get(field+'_img');
			img.parentNode.removeChild(img);		
		},

		checkRequired: function (field,elm,type){
			if(document.getElementById(field+"_required").value == 'true' || type == 'fullname'){
				if(type == 'fullname')
					var e = document.getElementById("last_name");
				else if(type == 'datetimecombo')
					var e = document.getElementById(field+"_date");
				else
					e = elm; 		
				if(e.value == ""){
					e.focus();
					e.style.backgroundColor = "red";
					return true;
				}		
			}
		},

		check_address_type: function (field){
			if(field == "primary_address_street" || field == "alt_address_street" || field == "billing_address_street" || field == "shipping_address_street")
				return true;
			else 
				return false;	
		},

		toURI: function (a){
			t=[];
			for(x in a){			
				if(!(a[x].constructor.toString().indexOf('Array') == -1)){
					for(i in a[x])
						t.push(x+"[]="+encodeURIComponent(a[x][i]));
				}else			
					t.push(x+"="+encodeURIComponent(a[x]));
			}
			return t.join("&");
		},

		add_save_button: function (field,type){
				if(YAHOO.util.Dom.get(field+"_save") == undefined){
					var n = document.createElement("button");
					n.setAttribute("id",field+"_save");
					n.setAttribute("type","button");
					n.innerHTML = SUGAR.language.languages.app_strings["LBL_EDV_SAVE"];
					n.onclick = function(){ EDV.updateField(field,this,type); }
					YAHOO.util.Dom.get(field+"_editblock").appendChild(n);	

					var n = document.createElement("span");
					n.innerHTML = " ";
					YAHOO.util.Dom.get(field+"_editblock").appendChild(n);	
				}
		},
		
		add_close_button: function (field,type){
				if(YAHOO.util.Dom.get(field+"_close") == undefined){
					var n = document.createElement("button");
					n.setAttribute("id",field+"_close");
					n.setAttribute("type","button");
					n.setAttribute("field",field);
					n.innerHTML = SUGAR.language.languages.app_strings["LBL_EDV_CLOSE"];
					n.onclick = function(){
						YAHOO.util.Dom.get(this.getAttribute("field")+"_editblock").style.display = "none";	
						YAHOO.util.Dom.get(this.getAttribute("field")+"_detailblock").style.display = "block";		
					}
					YAHOO.util.Dom.get(field+"_editblock").appendChild(n);	
				}
		}
	}
	
}(); // end EDV


// redeclaring sugar's "set_return" function
function set_return(popup_reply_data){	
		from_popup_return=true;
		var form_name = popup_reply_data.form_name + "";
		var name_to_value_array=popup_reply_data.name_to_value_array;
		if(typeof name_to_value_array!='undefined'&&name_to_value_array['account_id'])
		{var label_str='';var label_data_str='';var current_label_data_str='';
		for(var the_key in name_to_value_array){
			if(the_key=='toJSON'){}
			else{
				var displayValue=name_to_value_array[the_key].replace(/&amp;/gi,'&').replace(/&lt;/gi,'<').replace(/&gt;/gi,'>').replace(/&#039;/gi,'\'').replace(/&quot;/gi,'"');
				if(window.document.forms[form_name]&&document.getElementById(the_key+'_label')&&!the_key.match(/account/)){
					var data_label=document.getElementById(the_key+'_label').innerHTML.replace(/\n/gi,'');
					label_str+=data_label+' \n';
					label_data_str+=data_label+' '+displayValue+'\n';
					if(window.document.forms[form_name].elements[the_key]){
						current_label_data_str+=data_label+' '+window.document.forms[form_name].elements[the_key].value+'\n';
					}
				}
			}
		}
		if(label_data_str!=label_str&&current_label_data_str!=label_str){if(confirm(SUGAR.language.get('app_strings','NTC_OVERWRITE_ADDRESS_PHONE_CONFIRM')+'\n\n'+label_data_str))
		{set_return_basic(popup_reply_data,/\S/);}else{set_return_basic(popup_reply_data,/account/);}}else if(label_data_str!=label_str&&current_label_data_str==label_str){set_return_basic(popup_reply_data,/\S/);}else if(label_data_str==label_str){set_return_basic(popup_reply_data,/account/);}}else{set_return_basic(popup_reply_data,/\S/);}
		var i = 0;
		for(var key in name_to_value_array){		
			if(i == 0){
				var field = key;
				var id_val = name_to_value_array[key];		
			}if(i == 1)
				var field_name = key;		
			document.forms[form_name].elements[key].value = name_to_value_array[key];
			i++;
		}
		if(form_name == 'DetailView'){	 
			var v = new Array();
			v[field] = id_val;

			if(field == 'parent_id'){
				if(document.forms[form_name].elements['parent_type'] != undefined)
					v['parent_type'] = document.forms[form_name].elements['parent_type'].value;	
			}
			EDV.sendValues(v,field_name);
		}			
}

