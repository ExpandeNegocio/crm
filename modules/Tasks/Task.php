<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


// Task is used to store customer information.
class Task extends SugarBean {
        var $field_name_map;

	// Stored fields
	var $id;
	var $date_entered;
	var $date_modified;
	var $assigned_user_id;
	var $modified_user_id;
	var $created_by;
	var $created_by_name;
	var $modified_by_name;
	var $description;
	var $name;
	var $status;
	var $date_due_flag;
	var $date_due;
	var $time_due;
	var $date_start_flag;
	var $date_start;
	var $time_start;
	var $priority;
	var $parent_type;
	var $parent_id;
	var $contact_id;

	var $parent_name;
	var $contact_name;
	var $contact_phone;
	var $contact_email;
	var $assigned_user_name;

//bug 28138 todo
//	var $default_task_name_values = array('Assemble catalogs', 'Make travel arrangements', 'Send a letter', 'Send contract', 'Send fax', 'Send a follow-up letter', 'Send literature', 'Send proposal', 'Send quote', 'Call to schedule meeting', 'Setup evaluation', 'Get demo feedback', 'Arrange introduction', 'Escalate support request', 'Close out support request', 'Ship product', 'Arrange reference call', 'Schedule training', 'Send local user group information', 'Add to mailing list');

	var $table_name = "tasks";

	var $object_name = "Task";
	var $module_dir = 'Tasks';

	var $importable = true;
	// This is used to retrieve related fields from form posts.
	var $additional_column_fields = Array('assigned_user_name', 'assigned_user_id', 'contact_name', 'contact_phone', 'contact_email', 'parent_name');


	function Task() {
		parent::SugarBean();
	}

	var $new_schema = true;

    function save($check_notify = FALSE)
    {
        if (empty($this->status) ) {
            $this->status = $this->getDefaultStatus();
        }
        return parent::save($check_notify);
    }

	function get_summary_text()
	{
		return "$this->name";
	}

    function create_export_query(&$order_by, &$where, $relate_link_join='')
    {
        $custom_join = $this->getCustomJoin(true, true, $where);
        $custom_join['join'] .= $relate_link_join;
                $contact_required = stristr($where,"contacts");
                if($contact_required)
                {
                        $query = "SELECT tasks.*, contacts.first_name, contacts.last_name, users.user_name as assigned_user_name ";
                        $query .= $custom_join['select'];
                        $query .= " FROM contacts, tasks ";
                        $where_auto = "tasks.contact_id = contacts.id AND tasks.deleted=0 AND contacts.deleted=0";
                }
                else
                {
                        $query = 'SELECT tasks.*, users.user_name as assigned_user_name ';
                        $query .= $custom_join['select'];
                        $query .= ' FROM tasks ';
                        $where_auto = "tasks.deleted=0";
                }


        $query .= $custom_join['join'];
		$query .= "  LEFT JOIN users ON tasks.assigned_user_id=users.id ";

                if($where != "")
                        $query .= "where $where AND ".$where_auto;
                else
                        $query .= "where ".$where_auto;

        $order_by = $this->process_order_by($order_by);
        if (empty($order_by)) {
            $order_by = 'tasks.name';
        }
        $query .= ' ORDER BY ' . $order_by;

                return $query;

        }



	function fill_in_additional_list_fields()
	{

	}

	function fill_in_additional_detail_fields()
	{
        parent::fill_in_additional_detail_fields();
		global $app_strings;

		if (isset($this->contact_id)) {

			$contact = new Contact();
			$contact->retrieve($this->contact_id);

			if($contact->id != "") {
				$this->contact_name = $contact->full_name;
				$this->contact_name_owner = $contact->assigned_user_id;
				$this->contact_name_mod = 'Contacts';
				$this->contact_phone = $contact->phone_work;
				$this->contact_email = $contact->emailAddress->getPrimaryAddress($contact);
			} else {
				$this->contact_name_mod = '';
				$this->contact_name_owner = '';
				$this->contact_name='';
				$this->contact_email = '';
				$this->contact_id='';
			}

		}

		$this->fill_in_additional_parent_fields();
	}

	function fill_in_additional_parent_fields()
	{

		$this->parent_name = '';
		global $app_strings, $beanFiles, $beanList, $locale;
		if ( ! isset($beanList[$this->parent_type]))
		{
			$this->parent_name = '';
			return;
		}

	    $beanType = $beanList[$this->parent_type];
		require_once($beanFiles[$beanType]);
		$parent = new $beanType();

		if (is_subclass_of($parent, 'Person')) {
			$query = "SELECT first_name, last_name, assigned_user_id parent_name_owner from $parent->table_name where id = '$this->parent_id'";
		}
		else if (is_subclass_of($parent, 'File')) {
			$query = "SELECT document_name, assigned_user_id parent_name_owner from $parent->table_name where id = '$this->parent_id'";
		}
		else {

			$query = "SELECT name ";
			if(isset($parent->field_defs['assigned_user_id'])){
				$query .= " , assigned_user_id parent_name_owner ";
			}else{
				$query .= " , created_by parent_name_owner ";
			}
			$query .= " from $parent->table_name where id = '$this->parent_id'";
		}
		$result = $this->db->query($query,true," Error filling in additional detail fields: ");

		// Get the id and the name.
		$row = $this->db->fetchByAssoc($result);

		if ($row && !empty($row['parent_name_owner'])){
			$this->parent_name_owner = $row['parent_name_owner'];
			$this->parent_name_mod = $this->parent_type;
		}
		if (is_subclass_of($parent, 'Person') and $row != null)
		{
			$this->parent_name = $locale->getLocaleFormattedName(stripslashes($row['first_name']), stripslashes($row['last_name']));
		}
		else if (is_subclass_of($parent, 'File') && $row != null) {
			$this->parent_name = $row['document_name'];
		}
		elseif($row != null)
		{
			$this->parent_name = stripslashes($row['name']);
		}
		else {
			$this->parent_name = '';
		}
	}


    protected function formatStartAndDueDates(&$task_fields, $dbtime, $override_date_for_subpanel)
    {
        global $timedate;

        if(empty($dbtime)) return;

        $today = $timedate->nowDbDate();

        $task_fields['TIME_DUE'] = $timedate->to_display_time($dbtime);
        $task_fields['DATE_DUE'] = $timedate->to_display_date($dbtime);

        $date_due = $task_fields['DATE_DUE'];

        $dd = $timedate->to_db_date($date_due, false);
        $taskClass = 'futureTask';
		if ($dd < $today){
            $taskClass = 'overdueTask';
		}else if( $dd	== $today ){
            $taskClass = 'todaysTask';
		}
        $task_fields['DATE_DUE']= "<font class='$taskClass'>$date_due</font>";
        if($override_date_for_subpanel){
            $task_fields['DATE_START']= "<font class='$taskClass'>$date_due</font>";
        }
    }

	function get_list_view_data(){
		global $action, $currentModule, $focus, $current_module_strings, $app_list_strings, $timedate;

		$override_date_for_subpanel = false;
		if(!empty($_REQUEST['module']) && $_REQUEST['module'] !='Calendar' && $_REQUEST['module'] !='Tasks' && $_REQUEST['module'] !='Home'){
			//this is a subpanel list view, so override the due date with start date so that collections subpanel works as expected
			$override_date_for_subpanel = true;
		}

		$today = $timedate->nowDb();
		$task_fields = $this->get_list_view_array();
		$dbtime = $timedate->to_db($task_fields['DATE_DUE']);
		if($override_date_for_subpanel){
			$dbtime = $timedate->to_db($task_fields['DATE_START']);
		}

        if(!empty($dbtime))
        {
            $task_fields['TIME_DUE'] = $timedate->to_display_time($dbtime);
            $task_fields['DATE_DUE'] = $timedate->to_display_date($dbtime);
            $this->formatStartAndDueDates($task_fields, $dbtime, $override_date_for_subpanel);
        }

		if (!empty($this->priority))
			$task_fields['PRIORITY'] = $app_list_strings['task_priority_dom'][$this->priority];
		if (isset($this->parent_type))
			$task_fields['PARENT_MODULE'] = $this->parent_type;
		if ($this->status != "Completed" && $this->status != "Deferred" )
		{
			$setCompleteUrl = "<a id='{$this->id}' onclick='SUGAR.util.closeActivityPanel.show(\"{$this->module_dir}\",\"{$this->id}\",\"Completed\",\"listview\",\"1\");'>";
		    $task_fields['SET_COMPLETE'] = $setCompleteUrl . SugarThemeRegistry::current()->getImage("close_inline","title=".translate('LBL_LIST_CLOSE','Tasks')." border='0'",null,null,'.gif',translate('LBL_LIST_CLOSE','Tasks'))."</a>";
		}

        // make sure we grab the localized version of the contact name, if a contact is provided
        if (!empty($this->contact_id))
        {
            $contact_temp = BeanFactory::getBean("Contacts", $this->contact_id);
            if (!empty($contact_temp))
            {
                // Make first name, last name, salutation and title of Contacts respect field level ACLs
                $contact_temp->_create_proper_name_field();
                $this->contact_name = $contact_temp->full_name;
                $this->contact_phone = $contact_temp->phone_work;
            }
        }

		$task_fields['CONTACT_NAME']= $this->contact_name;
		$task_fields['CONTACT_PHONE']= $this->contact_phone;
		$task_fields['TITLE'] = '';
		if (!empty($task_fields['CONTACT_NAME'])) {
			$task_fields['TITLE'] .= $current_module_strings['LBL_LIST_CONTACT'].": ".$task_fields['CONTACT_NAME'];
		}
		if (!empty($this->parent_name)) {
			$task_fields['TITLE'] .= "\n".$app_list_strings['parent_type_display'][$this->parent_type].": ".$this->parent_name;
			$task_fields['PARENT_NAME']=$this->parent_name;
		}

		return $task_fields;
	}

	function set_notification_body($xtpl, $task)
	{
		global $app_list_strings;
        global $timedate;
        $notifyUser = $task->current_notify_user;
        $prefDate = $notifyUser->getUserDateTimePreferences();
		$xtpl->assign("TASK_SUBJECT", $task->name);
		//MFH #13507
		$xtpl->assign("TASK_PRIORITY", (isset($task->priority)?$app_list_strings['task_priority_dom'][$task->priority]:""));

        if(!empty($task->date_due))
        {
		    $duedate = $timedate->fromDb($task->date_due);
            $xtpl->assign("TASK_DUEDATE", $timedate->asUser($duedate, $notifyUser)." ".TimeDate::userTimezoneSuffix($duedate, $notifyUser));
        } else {
            $xtpl->assign("TASK_DUEDATE", '');
        }

		$xtpl->assign("TASK_STATUS", (isset($task->status)?$app_list_strings['task_status_dom'][$task->status]:""));
		$xtpl->assign("TASK_DESCRIPTION", $task->description);

		return $xtpl;
	}

	function bean_implements($interface){
		switch($interface){
			case 'ACL':return true;
		}
		return false;
	}
	function listviewACLHelper(){
		$array_assign = parent::listviewACLHelper();
		$is_owner = false;
		if(!empty($this->parent_name)){
			if(!empty($this->parent_name_owner)){
				global $current_user;
				$is_owner = $current_user->id == $this->parent_name_owner;
			}
		}

			if(!ACLController::moduleSupportsACL($this->parent_type) || ACLController::checkAccess($this->parent_type, 'view', $is_owner)){
				$array_assign['PARENT'] = 'a';
			}else{
				$array_assign['PARENT'] = 'span';
			}
		$is_owner = false;
		if(!empty($this->contact_name)){
			if(!empty($this->contact_name_owner)){
				global $current_user;
				$is_owner = $current_user->id == $this->contact_name_owner;
			}
		}

		if( ACLController::checkAccess('Contacts', 'view', $is_owner)){
				$array_assign['CONTACT'] = 'a';
		}else{
				$array_assign['CONTACT'] = 'span';
		}

		return $array_assign;
	}

	public function getDefaultStatus()
    {
         $def = $this->field_defs['status'];
         if (isset($def['default'])) {
             return $def['default'];
         } else {
            $app = return_app_list_strings_language($GLOBALS['current_language']);
            if (isset($def['options']) && isset($app[$def['options']])) {
                $keys = array_keys($app[$def['options']]);
                return $keys[0];
            }
        }
        return '';
    }

    public function addToERM(){
        
        $userERM=$this->getERMUser();
        
        $fechaIni=substr($this->date_start,0,10);
        $fechaFin=substr($this->date_due,0,10);
        $horasEst=str_replace ("," , ".",$this->estimateTimeByType());
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Usuario-' . $userERM);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Subject-' . $this->name);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Description-' . $this->description);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Fecha Inicio Proc-' . $fechaIni. 'Fecha Inicio Raw-'.$this->date_start);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Fecha Fin-' .$fechaFin. 'Fecha Fin Raw-'.$this->date_due );
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Tiempo Estimado-' .$horasEst. 'Tiempo Est Raw-'.$this->estimateTimeByType());
        
        $strInsertIssue="<issue>";
        $strInsertIssue=$strInsertIssue."<project_id>".$this->getERMProy()."</project_id>";
        $strInsertIssue=$strInsertIssue."<tracker_id>5</tracker_id>";
        $strInsertIssue=$strInsertIssue."<status_id>11</status_id>";
        $strInsertIssue=$strInsertIssue."<priority_id>44</priority_id>";
        $strInsertIssue=$strInsertIssue."<assigned_to_id>".$userERM."</assigned_to_id>";
        $strInsertIssue=$strInsertIssue."<subject>".$this->name."</subject>";
        $strInsertIssue=$strInsertIssue."<start_date>".$fechaIni."</start_date>";
        $strInsertIssue=$strInsertIssue."<due_date>".$fechaFin."</due_date>";
        $strInsertIssue=$strInsertIssue."<description>".$this->description."</description>";
        $strInsertIssue=$strInsertIssue."<estimated_hours>".$horasEst."</estimated_hours>";
        $strInsertIssue=$strInsertIssue."<custom_fields type='array'>";
        $strInsertIssue=$strInsertIssue."<custom_field id='51'>";
        $strInsertIssue=$strInsertIssue."<value>Tareas Aperturas</value>";
        $strInsertIssue=$strInsertIssue."</custom_field>";
        $strInsertIssue=$strInsertIssue."</custom_fields>";
        $strInsertIssue=$strInsertIssue."</issue>";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Creacion Tarea-' . $strInsertIssue);
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues.xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
        
        curl_setopt($ch, CURLOPT_POST, TRUE);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strInsertIssue);
                        
        $response = curl_exec($ch);
                
        $ermid=$this->getIdFromResponse($response);
        
        $this->ERM_tasks_id=$ermid;
        $this-> ignore_update_c=true;
        $this->save();
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Respuesta-').$response;
        
        curl_close($ch);
        
    }

    public function getIdFromResponse($text){        
        $issueresp = new SimpleXMLElement($text);
        return $issueresp->id;        
    }

    public function updateFromERM(){
                                          
        $userERM=$this->getERMUser();
                
        $fechaIni=substr($this->date_start,0,10);
        $fechaFin=substr($this->date_due,0,10);
        $horasEst=str_replace ("," , ".",$this->estimateTimeByType());
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]ID-' . $this->ERM_tasks_id);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Usuario-' . $userERM);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Subject-' . $this->name);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Description-' . $this->description);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Fecha Inicio Proc-' . $fechaIni. 'Fecha Inicio Raw-'.$this->date_start);
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Fecha Fin-' .$fechaFin. 'Fecha Fin Raw-'.$this->date_due );
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Tiempo Estimado-' .$horasEst. 'Tiempo Est Raw-'.$this->estimateTimeByType());
        
        $strInsertIssue="<issue>";
        $strInsertIssue=$strInsertIssue."<project_id>".$this->getERMProy()."</project_id>";        
        $strInsertIssue=$strInsertIssue."<status_id>".$this->getStatusERM()."</status_id>";       
        $strInsertIssue=$strInsertIssue."<assigned_to_id>".$userERM."</assigned_to_id>";
        $strInsertIssue=$strInsertIssue."<subject>".$this->name."</subject>";
        $strInsertIssue=$strInsertIssue."<start_date>".$fechaIni."</start_date>";
        $strInsertIssue=$strInsertIssue."<due_date>".$fechaFin."</due_date>";
        $strInsertIssue=$strInsertIssue."<description>".$this->description."</description>";
        $strInsertIssue=$strInsertIssue."<estimated_hours>".$horasEst."</estimated_hours>";
        $strInsertIssue=$strInsertIssue."</issue>";     
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Peticion-'.$strInsertIssue);                                       
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues/".$this->ERM_tasks_id.".xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$strInsertIssue);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Mod Tarea ERM]Respuesta-'.$response);
        
    }    
    
    public function getERMUser(){
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Entra-');
        
        $userId=$this->assigned_user_id;
        $userERM='';
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]UsuarioId-' . $userId);
        
        //Si está asignada a un usuario
        if ($userId!=null){
            $user=new User();
            $user -> retrieve($userId);
            $userERM = $user -> user_ERM;           
        }
        
        return $userERM;
    }
    
    public function getCRMUser($ERMUser){
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Entra-');
        
        $userCRM='';
        
        $db = DBManagerFactory::getInstance();
        $query = "select * from users where deleted=0 and user_ERM='" . $ERMUser . "'";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][getCRMUser]Consulta usuario - ' .$query);

        $result = $db -> query($query, true);       

        while ($row = $db -> fetchByAssoc($result)) {                        
            $userCRM=$row['id'];            
        }        
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][getCRMUser]UsuarioCRM - ' .$userCRM);    
        
        return $userCRM;
    }
    

    public function getStatusERM(){
        
        $output='';
        
        switch ($this->status) {
            case 'Not Started':
                $output='11';
                break;
            
            case 'In Progress':
                $output='2';
                break;
                
            case 'Pending Input':
                $output='13';
                break;
                
            case 'Completed':
                $output='6';
                break;
                
            case 'Canceled':
                $output='7';
                break;                
            
            case 'Deferred':
                $output='12';
                break;                
            
            case 'Paused':
                $output='13';
                break;       
        }
        
        return $output;
        
    }
    
    public function setStatustoERM($status){
        
        $output='';
        
        switch ($status) {
            case '11':
                $output='Not Started';
                break;
            
            case '2':
                $output='In Progress';
                break;
                
            case '13':
                $output='Pending Input';
                break;
                
            case '6':
                $output='Completed';
                break;
                
            case '7':
                $output='Canceled';
                break;                
            
            case '12':
                $output='Deferred';
                break; 
                
            case '8':
                $output='In Progress';
                break;
           
            case '9':
                $output='In Progress';
                break; 
                 
            case '10':
               $output='In Progress';
                break;        
            
            case 'Paused':
                $output='13';
                break;       
        }
        
        return $output;
        
    }
    
    public function getERMProy(){
       $ERMProy='';
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Busqueda proyecto ERM');
       
       //Se puede buscar por nombre
       
       //https://expandenegocio.easyredmine.com/projects.xml?name=01-Pre-Consultor%C3%ADa%20-%20Adagio&limit=1000&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6
       
       $franquiciaId='';
       if ($this->parent_type=='Expan_Franquicia'){
           $franquiciaId=$this->parent_id;
       }else if ($this->parent_type=='Expan_GestionSolicitudes'){
           $gestion=new Expan_GestionSolicitudes();
           $gestion->retrieve($this->parent_id);
           $franquiciaId=$gestion->franquicia;                     
       }
       
       $franquicia= new  Expan_Franquicia();
       $franquicia->retrieve($franquiciaId);
       
       $ERMProy=$franquicia->proy_ERM;
       
       $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]ProyectoERM-' . $ERMProy);
       
       return  $ERMProy;
    }

    public function estimateTimeByType(){
        
        $estTime=1;
        
        $db = DBManagerFactory::getInstance();
        $query = "select * from expan_tipo_tarea where id='" . $this -> task_type . "'";
        
        $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Consulta horas - ' .$query);

        $result = $db -> query($query, true);       

        while ($row = $db -> fetchByAssoc($result)) {
                         
            $estTime=$row['est_time'];
            $GLOBALS['log'] -> info('[ExpandeNegocio][Crear Tarea ERM]Tiempo Est BD-' .$row['est_time']);
        }            
        return $estTime;
    } 

}
