{{if $customCode }}
	{{sugar_evalcolumn var=$colData.field colData=$colData}}
{{else}}	
	{{sugar_field parentFieldArray='fields' vardef=$fields[$field_name] displayType='DetailView' displayParams=$displayParams typeOverride=$type}}
{{/if}}
