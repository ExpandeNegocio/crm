<?php 
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

wfm_utils::wfm_log('debug', "ENTRY", __FILE__);

global $mod_strings, $timedate; 

$scheduled_tasks = (isset($_REQUEST['scheduled_tasks_hidden'])) ? $_REQUEST['scheduled_tasks_hidden'] : $focus->scheduled_tasks;

$scheduled_tasks = wfm_utils::wfm_prepareTasks_fromDB_toSugar($scheduled_tasks);

?>

<div id="scheduledTasks" style="display: block">

	<input type="hidden" value="" id="scheduled_tasks_hidden" name="scheduled_tasks_hidden">
	
	<h4><?php echo $mod_strings['LBL_SCH_EV_TASKS']; ?></h4>

	<table id="tasks_Table" class="edit view">
		<tr>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_TASK_NAME']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_EXECUTION_RANGE']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_DAY_VALUE']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_TIME_VALUE']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_EXECUTION_END_DATE']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="left" width="100%" style="white-space: nowrap;">
				<?php echo $mod_strings['LBL_SCH_EV_TASK_STATE']; ?>
				</div>
			</th>

			<th nowrap="nowrap" scope="col">
				<div align="right" width="100%" style="white-space: nowrap;">
					<input type="button" class="button" value='<?php echo $mod_strings['LBL_SCH_EV_ADD_TASK']; ?>' onClick="insert_Task('tasks_Table', '<?php echo $timedate->get_cal_date_format(); ?>')">
					<input type='hidden' id='tasksGlobalIndex' value='0'>
				</div>
			</th>

		</tr>
	
				<!-- Seccion que contendr�as tareas programadas de los Reports -->

				<!-- Seccion que contendr� las tareas programadas de los Reports -->

	</table>

</div>
