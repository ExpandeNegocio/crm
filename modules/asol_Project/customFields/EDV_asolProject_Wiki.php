<?php

global $mod_strings;

$bean = $GLOBALS['FOCUS'];
$action = $_REQUEST['action'];
$wikiHtml = "";

$wikiUrl = (empty($bean->wiki_link)) ? "" : $bean->wiki_link;
$wikiAlias = (empty($bean->wiki_link_alias)) ? $wikiUrl : $bean->wiki_link_alias;

if ($action == "DetailView") {
	
	$wikiHtml = "<a href='".$wikiUrl."' target='_blank'>".$wikiAlias."</a>";
	
} else if ($action == "EditView") {
	
	$wikiHtml = "<input type='text' value='".$wikiUrl."' maxlength='255' size='30' id='wiki_link' name='wiki_link'>  ".$mod_strings['LBL_WIKI_LINK_ALIAS'].": <input type='text' value='".$wikiAlias."' maxlength='255' size='30' id='wiki_link_alias' name='wiki_link_alias'>";
	
}

echo $wikiHtml;

?>