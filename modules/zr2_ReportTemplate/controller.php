<?php
require_once('include/upload_file.php');

class zr2_ReportTemplateController extends SugarController 
{

	public function action_Save()
	{
		$this->bean->set_export_from_checkboxes();
		
		if (empty($this->bean->id)) {
			$this->bean->id = create_guid();
			$this->bean->new_with_id = true;
			$this->bean->fill_in_additional_detail_fields();
		}
		
		$errors = array();

		$success = TRUE;

		$upload_file = new UploadFile('reportfile');
		if (isset($_FILES['reportfile']) && $upload_file->confirm_upload()) {
			$success = $this->bean->set_reportfile($_FILES['reportfile']['tmp_name'], $upload_file->original_file_name);
			if (!$success) {
				$errors[] = "error compiling report ".$upload_file->original_file_name." - ".$this->bean->report_output;
			}
		}

		for ($i = 0; $i < 5; $i++) {
			$paramName = "subreport".$i;
			$upload_file = new UploadFile($paramName);
			if (isset($_FILES[$paramName]) && $upload_file->confirm_upload()) {
				$success = $this->bean->add_subreportfile($_FILES[$paramName]['tmp_name'], $upload_file->original_file_name);
				if (!$success) {
					$errors[] = "error compiling subreport ".$upload_file->original_file_name." - ".$this->bean->report_output;
				}
			}
		}

		for ($i = 0; $i < 5; $i++) {
			$paramName = "resource".$i;
			$upload_file = new UploadFile($paramName);
			if (isset($_FILES[$paramName]) && $upload_file->confirm_upload()) {
				$success = $this->bean->add_resource_file($_FILES[$paramName]['tmp_name'], $upload_file->original_file_name);
				if (!$success) {
					$errors[] = "error adding resource ".$upload_file->original_file_name." - ".$this->bean->report_output;
				}
			}
		}

		if (empty($errors)) 
		{
			$this->bean->error_message = "";
		} 
		else 
		{
			$this->bean->error_message = join("<br/>", $errors);
		}

		parent::action_Save();
		
	}
	
	protected function post_delete()
	{
		$this->bean->unlink_all_files();

		parent::post_delete();
	}
	
	
}



?>
