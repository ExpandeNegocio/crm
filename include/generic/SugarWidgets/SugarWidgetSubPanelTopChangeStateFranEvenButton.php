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

class SugarWidgetSubPanelTopChangeStateFranEvenButton extends SugarWidgetSubPanelTopButton
{
    private $estado = "";   

    //button_properties is a collection of properties associated with the widget_class definition. layoutmanager
    function SugarWidgetSubPanelTopChangeStateFranEvenButton($button_properties=array())
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

        return '<script type="text/javascript" >function cambiarEstadoFranquiciaEvento(estado) {
                 if (confirm("¿Esta seguro de que quieres cambiar el estado las franquicias seleccionadas?")) {
                   
                    //Recogemos la lista de gestiones a cambiar
                                                                                  
                    var lista=document.getElementsByClassName("checkbox");
            
                    var idFranquicias="";
                    var prim=true;
                    
                    for (i=0;i<lista.length;i++){    
                        if (lista[i].checked==true){
                            if (prim==true){
                                idFranquicias=lista[i].name.replace("checkbox_display_prueba-","");    
                            }else{
                                idFranquicias=idFranquicias+"!"+lista[i].name.replace("checkbox_display_prueba-","");
                            }   
                            prim=false;                                                                     
                        }                        
                    }                       
                    
                    var idEvento = $("input[name$=\"record\"]" ).val();
                    
                    url = "index.php?entryPoint=consultarFranquicia&tipo=FranqEstadoEvento+&estado="+ estado + "&evento="+ idEvento + "&franquicias=" + idFranquicias;                                           
                    $.ajax({
                        type : "POST",
                        url : url,
                        data : "tipo=FranqEstadoEvento" + "&estado=" + estado + "&evento="+ idEvento + "&franquicias=" + idFranquicias,
                        success : function(data) {
                            YAHOO.SUGAR.MessageBox.hide();
                            if ( data = "Ok") {
                                document.location.reload();                 
                            } else {
                                alert("No se han podido cambiar el estado y/o las gestiones asociadas  " + estado);
                            }            
                        },
                        error : function(jqXHR, textStatus, errorThrown) {
                            alert("No se han podido cambiar el estado y/o las gestiones asociadas - " + textStatus + " - " + errorThrown);            
                        }
                    });

                }else {
                    return false;
                }                            
            }

         </script>
        
         <input type="button" name="' . $this->getWidgetId() . '" id="' . $this->getWidgetId() . '" class="button"' . "\n"
                . ' title="' . $this->value."-".$GLOBALS['app_list_strings']['lst_tipo_participa_Evento'][$widget_data['estado']] . '"'
            . ' value="' . $this->value."-".$GLOBALS['app_list_strings']['lst_tipo_participa_Evento'][$widget_data['estado']] . "\"\n"
            . " onclick='cambiarEstadoFranquiciaEvento(".$widget_data['estado'].");' />\n";
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

}
?>