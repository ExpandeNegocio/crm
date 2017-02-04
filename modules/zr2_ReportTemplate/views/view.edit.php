<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class zr2_ReportTemplateViewEdit extends ViewEdit
{
 	public function __construct()
 	{
 		parent::ViewEdit();
 	}
	
 	public function display()
 	{
        $this->ev->process();

		$this->ss->assign("EXPORT_TYPES", join("<br/>", $this->bean->get_export_checkbox_array()));
		
		echo $this->ev->display($this->showTitle);
		
?>
<script type="text/javascript" language="JavaScript">
	function setvalue(source) {
		src= new String(source.value);
		target = new String(source.form.name.value);

		if (target.length == 0) {
			lastindex=src.lastIndexOf("/");
			if (lastindex == -1) {
				lastindex=src.lastIndexOf("\\");
			} 
			if (lastindex == -1) {
				filename = src;
			} else {
				filename = src.substr(++lastindex, src.length);
			}			
			lastindex = filename.lastIndexOf(".");
			if (lastindex == -1) {
				source.form.name.value=filename;
			} else {
				source.form.name.value=filename.substr(0, lastindex);
			}
		}			
	}
</script>
<?php
 	}
}
?>
