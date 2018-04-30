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




require_once('include/generic/SugarWidgets/SugarWidgetSubPanelTopButton.php');

class SugarWidgetSubPanelTopChangeStateButton extends SugarWidgetSubPanelTopButton
{
    private $estado = "";   
    
    const TABLA_DESCARTADO='tipo_descarte';
    const TABLA_TIPO_PARADA='tipo_parada';
    const TABLA_TIPO_POSITIVO='tipo_positivo';

	//button_properties is a collection of properties associated with the widget_class definition. layoutmanager
	function SugarWidgetSubPanelTopChangeStateButton($button_properties=array())
	{
		$this->button_properties=$button_properties;
	}

    public function getWidgetId()
    {
        return parent::getWidgetId(false) . 'select_button';
    }

    public function getDisplayName()
    {
        return $GLOBALS['app_strings']['LBL_CHANGE_STATE_BUTTON_LABEL'];
    }
	//widget_data is the collection of attributes associated with the button in the layout_defs file.
	function display(&$widget_data)
	{
		global $app_strings;
		
		$estado=$widget_data['estado'];
		
		$initial_filter = '';

	    $this->title     = $this->getTitle();
        $this->accesskey = $this->getAccesskey();
        $this->value     = $this->getDisplayName();

		if (is_array($this->button_properties)) {
			if( isset($this->button_properties['title'])) {
				$this->title = $app_strings[$this->button_properties['title']];
			}
			if( isset($this->button_properties['accesskey'])) {
				$this->accesskey = $app_strings[$this->button_properties['accesskey']];
			}
			if( isset($this->button_properties['form_value'])) {
				$this->value = $app_strings[$this->button_properties['form_value']];
			}
			if( isset($this->button_properties['module'])) {
				$this->module_name = $this->button_properties['module'];
			}
		}

        $nombreEstado="";  

        $estilos='<style>
                    /* The Modal (background) */
                    .modal {
                        display: none; /* Hidden by default */
                        position: fixed; /* Stay in place */
                        z-index: 1; /* Sit on top */
                        padding-top: 100px; /* Location of the box */
                        left: 0;
                        top: 0;
                        width: 100%; /* Full width */
                        height: 100%; /* Full height */
                        overflow: auto; /* Enable scroll if needed */
                        background-color: rgb(0,0,0); /* Fallback color */
                        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                    }
                    
                    /* Modal Content */
                    .modal-content {
                        background-color: #fefefe;
                        margin: auto;
                        padding: 20px;
                        border: 1px solid #888;
                        width: 400px;
                    }
                    
                    /* The Close Button */
                    .close {
                        color: #aaaaaa;
                        float: right;
                        font-size: 28px;
                        font-weight: bold;
                    }
                    
                    .close:hover,
                    .close:focus {
                        color: #000;
                        text-decoration: none;
                        cursor: pointer;
                    }
                    </style>';

        switch ($widget_data['estado']) {
        	case 3:
                $listaTiposParada=$this->getTipos($this::TABLA_TIPO_PARADA);
                $comboParadas=$this->createCombo($listaTiposParada,$widget_data['estado']);  
                
                 $modal='<div id="myModal3" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">                            
                            <p>Selecciona el Subestado</p>'.
                            $comboParadas.                           
                            '<input type="button" value="Cambiar" title="Cambiar" onclick=\'recogeValCombo(3);\' />
                        </div>        
                    </div>';
                   
        		break;
        	
            case 4:
                $listaTiposDescarte=$this->getTipos($this::TABLA_DESCARTADO);
                $comboDescartes=$this->createCombo($listaTiposDescarte,$widget_data['estado']);
                 $modal='<div id="myModal4" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <p>Selecciona el Subestado</p>'.
                            $comboDescartes.                           
                            '<input type="button" value="Cambiar" title="Cambiar" onclick=\'recogeValCombo(4);\' />
                        </div>        
                    </div>';
                
                
                break;
                
            case 5:
                $listaTiposPositivo=$this->getTipos($this::TABLA_TIPO_POSITIVO); 
                $comboPositivos=$this->createCombo($listaTiposPositivo,$widget_data['estado']);                
                 $modal='<div id="myModal5" class="modal">
                
                        <!-- Modal content -->
                        <div class="modal-content">
                            <p>Selecciona el Subestado</p>'.
                            $comboPositivos.                           
                            '<input type="button" value="Cambiar" title="Cambiar" onclick=\'recogeValCombo(5);\' />
                        </div>        
                    </div>';
                
                break;
            
        	default:
                $script=$scriptCambioEstado;
        		$estilos='';
                $modal='';
        		break;
        }      
               
        if ($widget_data['estado']==Expan_GestionSolicitudes::ESTADO_PARADO || 
            $widget_data['estado']==Expan_GestionSolicitudes::ESTADO_DESCARTADO ||
            $widget_data['estado']==Expan_GestionSolicitudes::ESTADO_POSITIVO ){                         
                
            $boton='<input type="button" name="' . $this->getWidgetId() . '" id="' . $this->getWidgetId() . '" class="button"' . "\n"
                    . ' title="' . $this->value."-".$GLOBALS['app_list_strings']['estado_sol_list'][$widget_data['estado']] . '"'
                    . ' value="' . $this->value."-".$widget_data['estado'] . "\"\n"
                    . " onclick='openModal(".$widget_data['estado'].");' />\n";  
                
                                              
        }else{
            
            $boton='<input type="button" name="' . $this->getWidgetId() . '" id="' . $this->getWidgetId() . '" class="button"' . "\n"
                    . ' title="' . $this->value."-".$GLOBALS['app_list_strings']['estado_sol_list'][$widget_data['estado']] . '"'
                    . ' value="' . $this->value."-".$widget_data['estado'] . "\"\n"
                    . " onclick='cambiarEstadoGestion(".$widget_data['estado'].",0);' />\n";
            
        }
        
        $script='<script type="text/javascript" src="/sugarcrm/include/javascript/CambioEstadoMasivo.js"></script>';
        //$script='<script type="text/javascript" src="/sugarcrm/include/javascript/EditSolicitud.js"></script>';
        
        return $estilos.$script.$modal.$script.$boton;
                       
	}

    /**
    * @return string
    */
    protected function getTitle()
    {
       return translate('LBL_CHANGE_STATE_BUTTON_TITLE');
    }

    /**
    * @return string
    */
    protected function getAccesskey()
    {
       return translate('LBL_SELECT_BUTTON_KEY');
    }

    function getTipos($nombreTabla){
        
        $listaTipo=array();
        
        $db = DBManagerFactory::getInstance();

        $query = "select * from ".$nombreTabla. " order by Orden";
        
        $result = $db -> query($query, true);

        while ($row = $db -> fetchByAssoc($result)) {
            $listaTipo[$row["id"]]=$row["Nombre"];                   
        }
        
        return $listaTipo;        
    }

    function createCombo($lista,$idCombo){

        $cadena='<select id="selector'.$idCombo.'">';        
        foreach ($lista as $clave => $valor) {            
            $cadena=$cadena.'<option value="'.$clave.'">'.$valor.'</option>';                      
        } 
        $cadena=$cadena.'</select>';

        return $cadena;
    }

}
?>
