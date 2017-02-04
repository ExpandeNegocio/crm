{if $fields.syno_reports_type.value == 'matrix'}
	<h4 class="dataLabel">{sugar_translate label='LBL_RESULTAT_MATRICE' module='{{$module}}'}</h4><br>

	{if $MATRICE_OK == 1}
		<table width='100%' border='0' cellspacing='{$gridline}' cellpadding='0'  class='listView'>
		<tr>
			{foreach name=sqlHeaderColumnIteration from=$SQL_HEADER_MATRICE item=sqlHeaderColumn}
			<td nowrap="" valign="middle" align="center" class="listViewThS1" scope="col">
				{$sqlHeaderColumn}
			</td>
			{/foreach}
		</tr>
		{foreach name=sqlResulstRowIteration from=$SQL_RESULT_MATRICE item=sqlResulstRow}
		<tr  onmousedown="setPointer(this, '', 'click', '#ffffff', '#f6f6f6', '');" onmouseout="setPointer(this, '', 'out', '#ffffff', '#f6f6f6', '');" onmouseover="setPointer(this, '', 'over', '#ffffff', '#f6f6f6', '');">
			{foreach name=sqlResulstColumnIteration from=$sqlResulstRow item=sqlResulstColumn}
				<td valign="top" align="left" bgcolor="#ffffff" scope="row" class="evenListRowS1">{$sqlResulstColumn}</td>
			{/foreach}
		</tr>
		{/foreach}
		</table>
	{else}
		{sugar_translate label='LBL_MATRICE_ERROR' module='{{$module}}'}
	{/if}
{/if}

<h4 class="dataLabel">{sugar_translate label='LBL_RESULTAT' module='{{$module}}'}</h4><br>
<table width='100%' border='0' cellspacing='{$gridline}' cellpadding='0'  class='listView'>
<tr>
	{foreach name=sqlHeaderColumnIteration from=$SQL_HEADER item=sqlHeaderColumn}
	<td nowrap="" valign="middle" align="center" class="listViewThS1" scope="col">
		{$sqlHeaderColumn}
	</td>
	{/foreach}
</tr>
{foreach name=sqlResulstRowIteration from=$SQL_RESULT item=sqlResulstRow}
<tr  onmousedown="setPointer(this, '', 'click', '#ffffff', '#f6f6f6', '');" onmouseout="setPointer(this, '', 'out', '#ffffff', '#f6f6f6', '');" onmouseover="setPointer(this, '', 'over', '#ffffff', '#f6f6f6', '');">
	{foreach name=sqlResulstColumnIteration from=$sqlResulstRow item=sqlResulstColumn}
		<td valign="top" align="left" bgcolor="#ffffff" scope="row" class="evenListRowS1">{$sqlResulstColumn}</td>
	{/foreach}
</tr>
{/foreach}
</table>
