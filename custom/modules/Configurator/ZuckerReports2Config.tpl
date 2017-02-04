{*


*}
<BR>
<form name="zuckerReports2Config" id="zuckerReports2Config" method="POST" action="index.php">
<input type="hidden" name="module" value="Configurator"/>
<input type="hidden" name="action" value="ZuckerReports2Config"/>
<input type="hidden" name="runjavatest" value="no"/>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td align="left" style="padding-bottom: 2px;">
		<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" type="submit" name="button" {$saveOnclick|default:"onclick=\"return check_form('BugsQuickCreate');\""} value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >
		<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" type="submit" name="button" {$cancelOnclick|default:"onclick=\"this.form.action.value='$RETURN_ACTION'; this.form.module.value='$RETURN_MODULE';\""} value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  ">
	</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">
<tr>
<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th align="left" scope="row" colspan="3"><h4><slot>{$MOD.LBL_ZUCKERREPORTS2CONFIG_DESC}</slot></h4></th>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_INDEXINCLUDE}</td>
		<td width="35%">{html_options name="index_include" options=$INDEX_INCLUDE_OPTIONS selected=$INDEX_INCLUDE}</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_INDEXINCLUDE_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_SCRIPTENABLED}</td>
		<td width="35%">{html_options name="script_enabled" options=$SCRIPT_ENABLED_OPTIONS selected=$SCRIPT_ENABLED}</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_SCRIPTENABLED_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_DEBUGENABLED}</td>
		<td width="35%">{html_options name="debug_enabled" options=$DEBUG_ENABLED_OPTIONS selected=$DEBUG_ENABLED}</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_DEBUGENABLED_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_CHARSET}</td>
		<td width="35%"><input type="text" size="20" name="charset" value="{$CHARSET}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_CHARSET_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_DEPLOYMENT}</td>
		<td width="35%">{html_options name="deployment" options=$DEPLOYMENT_OPTIONS selected=$DEPLOYMENT}</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_DEPLOYMENT_HELP}</td>
	</tr>	
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th align="left" scope="row" colspan="3"><h4><slot>{$MOD.LBL_ZUCKERREPORTS2_LOCAL}</slot></h4></th>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_LOCALJDKPATH}</td>
		<td width="35%"><input type="text" size="50" name="localjdkpath" value="{$LOCALJDKPATH}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_LOCALJDKPATH_HELP}<br/><br/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td width="35%">
			<input title="{$MOD.LBL_ZUCKERREPORTS2_TESTJAVA}" class="button" type="submit" onclick="this.form.runjavatest.value='yes'"  value="  {$MOD.LBL_ZUCKERREPORTS2_TESTJAVA}  ">
			<br/>{$TESTJAVA_RESULT}
			<br/><pre>{$TESTJAVA_OUTPUT}</pre>
		</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_TESTJAVA_HELP}<br/><br/></td>
	</tr>	
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_LOCALJDK_EXECMODE}</td>
		<td width="35%">{html_options name="execmode" options=$EXECMODE_OPTIONS selected=$EXECMODE}</td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_LOCALJDK_EXECMODE_HELP}</td>
	</tr>	
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_JDBCURLEXTENSION}</td>
		<td width="35%"><input type="text" size="50" name="jdbcurlextension" value="{$JDBCURLEXTENSION}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_JDBCURLEXTENSION_HELP}</td>
	</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th align="left" scope="row" colspan="3"><h4><slot>{$MOD.LBL_ZUCKERREPORTS2_ONDEMAND}</slot></h4></th>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSERVICE}</td>
		<td width="35%"><input type="text" size="50" name="ondemandservice" value="{$ONDEMANDSERVICE}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSERVICE_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDAPPSECRET}</td>
		<td width="35%"><input type="text" size="50" name="ondemandappsecret" value="{$ONDEMANDAPPSECRET}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDAPPSECRET_HELP}</td>
	</tr>
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSUGARSERVICE}</td>
		<td width="35%"><input type="text" size="50" name="ondemandsugarservice" value="{$ONDEMANDSUGARSERVICE}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSUGARSERVICE_HELP}<br/><br/></td>
	</tr>	
	<tr>
		<td valign="top" scope="row" width="15%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSUGARUSER}</td>
		<td width="35%"><input type="text" size="50" name="ondemandsugaruser" value="{$ONDEMANDSUGARUSER}" /></td>
		<td width="50%">{$MOD.LBL_ZUCKERREPORTS2_ONDEMANDSUGARUSER_HELP}</td>
	</tr>	
	</table>	
	
</form>

