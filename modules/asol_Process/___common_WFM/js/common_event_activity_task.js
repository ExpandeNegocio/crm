function acv_generateFunction_HTML(rowIndex, value, fielType, defaultLanguage) {

    var cell_Function_innerHTML = '';

    switch (fielType) {

        case "int":
        case "bigint":
        case "decimal":
        case "double":
        case "currency":
        case "enum":
        case 'c_var':///+++

            cell_Function_innerHTML = getCellFunctionHtml_forEnums(rowIndex, value, defaultLanguage);
            break;

        case "datetime":
        case "date":
        case "timestamp":

            cell_Function_innerHTML = getCellFunctionHtml_forDates(rowIndex, value, defaultLanguage);
            break;

        case "bool":
        case "tinyint(1)":

            cell_Function_innerHTML = getCellFunctionHtml_forBool(rowIndex, value, defaultLanguage);
            break;

        default:

            cell_Function_innerHTML = getCellFunctionHtml_forDefault(rowIndex, value, defaultLanguage);
            break;

    }
    
    return cell_Function_innerHTML;
}

function getCellFunctionHtml_forEnums(fieldIndex, selectedValue, defaultLanguage) {

    var calculatedFunctionValues = selectedValue.split("${comma}");
    selectedValue = calculatedFunctionValues[0];
    
    var cell_Function_HTML = "<select id='function_"+fieldIndex+"' class='function' name='function' onChange=''>";
    var functionValues = ["0", "COUNT", "MIN", "MAX", "SUM", "AVG"];
    var functionLabels = ["", "COUNT", "MIN", "MAX", "SUM", "AVG"];
    
    for (x = 0; x < functionValues.length; x++) {
        cell_Function_HTML += (functionValues[x] == selectedValue) ? "<option value='"+functionValues[x]+"' selected>"+functionLabels[x]+"</option>" : "<option value='"+functionValues[x]+"'>"+functionLabels[x]+"</option>";
    }
    cell_Function_HTML += "</select>";
    cell_Function_HTML += getCellFunctionsConfigureCalculated(fieldIndex, calculatedFunctionValues[0], calculatedFunctionValues[1], defaultLanguage);
    return cell_Function_HTML;

}

function getCellFunctionHtml_forDates(fieldIndex, selectedValue, defaultLanguage) {

    var calculatedFunctionValues = selectedValue.split("${comma}");
    selectedValue = calculatedFunctionValues[0];
    
    var cell_Function_HTML = "<select id='function_"+fieldIndex+"' class='function' name='function' onChange=''>";
    var functionValues = ["0", "MIN", "MAX"];
    var functionLabels = ["", "MIN", "MAX"];
    for (x = 0; x < functionValues.length; x++) {
        cell_Function_HTML += (functionValues[x] == selectedValue) ? "<option value='"+functionValues[x]+"' selected>"+functionLabels[x]+"</option>" : "<option value='"+functionValues[x]+"'>"+functionLabels[x]+"</option>";
    }
    cell_Function_HTML += "</select>";
    cell_Function_HTML += getCellFunctionsConfigureCalculated(fieldIndex, calculatedFunctionValues[0], calculatedFunctionValues[1], defaultLanguage);
    return cell_Function_HTML;

}

function getCellFunctionHtml_forBool(fieldIndex, selectedValue, defaultLanguage) {

    var calculatedFunctionValues = selectedValue.split("${comma}");
    selectedValue = calculatedFunctionValues[0];
    
    var cell_Function_HTML = "<select id='function_"+fieldIndex+"' class='function' name='function' onChange=''>";
    var functionValues = ["0", "COUNT", "SUM"];
    var functionLabels = ["", "COUNT", "SUM"];
    for (x = 0; x < functionValues.length; x++) {
        cell_Function_HTML += (functionValues[x] == selectedValue) ? "<option value='"+functionValues[x]+"' selected>"+functionLabels[x]+"</option>" : "<option value='"+functionValues[x]+"'>"+functionLabels[x]+"</option>";
    }
    cell_Function_HTML += "</select>";
    cell_Function_HTML += getCellFunctionsConfigureCalculated(fieldIndex, calculatedFunctionValues[0], calculatedFunctionValues[1], defaultLanguage);
    return cell_Function_HTML;

}

function getCellFunctionHtml_forDefault(fieldIndex, selectedValue, defaultLanguage) {
    
    var calculatedFunctionValues = selectedValue.split("${comma}");
    selectedValue = calculatedFunctionValues[0];

    var cell_Function_HTML = "<select id='function_"+fieldIndex+"' class='function' name='function'  onChange=''>";
    var functionValues =  ["0", "COUNT"];
    var functionLabels =  ["", "COUNT"];
    for (x = 0; x < functionValues.length; x++) {
        cell_Function_HTML += (functionValues[x] == selectedValue) ? "<option value='"+functionValues[x]+"' selected>"+functionLabels[x]+"</option>" : "<option value='"+functionValues[x]+"'>"+functionLabels[x]+"</option>";
    }
    cell_Function_HTML += "</select>";
    cell_Function_HTML += getCellFunctionsConfigureCalculated(fieldIndex, calculatedFunctionValues[0], calculatedFunctionValues[1], defaultLanguage);
    return cell_Function_HTML;

}

function getCellFunctionsConfigureCalculated(fieldIndex, selectedValue, calculatedFormula, defaultLanguage) {
    
    if (typeof(calculatedFormula) == 'undefined')
        calculatedFormula = '';
    
    var lbl_report_save = SUGAR.language.get(wfm_module, 'LBL_REPORT_SAVE');
    var lbl_report_clear = SUGAR.language.get(wfm_module, 'LBL_REPORT_CLEAR');
    var lbl_report_cancel = SUGAR.language.get(wfm_module, 'LBL_REPORT_CANCEL');
    var lbl_report_calculated_function_for = SUGAR.language.get(wfm_module, 'LBL_REPORT_CALCULATED_FUNCTION_FOR');

    var calculatedFunctionImg = (calculatedFormula == '') ? "asol_reports_calculated_function.png" : "asol_reports_calculated_function_filled.png"; 
    
    
    
    var cell_Function_Configure_Calculated_HTML = " " +
                                                "<script>var dialogCalculatedFunction_"+fieldIndex+";</script>" +
                                                "<img id='configure_calculated_btn_"+fieldIndex+"' name='configure_calculated_btn_"+fieldIndex+"' src='modules/asol_Process/___common_WFM/images/"+calculatedFunctionImg+"' style='vertical-align:text-bottom' onmouseout='this.style.cursor=\"default\"' onmouseover='this.style.cursor=\"pointer\"' onClick='getMySQLFunctionsHTML("+fieldIndex+", \""+defaultLanguage+"\"); dialogCalculatedFunction_"+fieldIndex+" = $(\"#configure_calculated_div_"+fieldIndex+"\").dialog( { modal: true, overlay: { opacity: 0.8, background: \"black\" }, position: [\"center\", \"center\"], width: 1000, show: \"drop\", hide: \"drop\", resizable:true, title: \""+lbl_report_calculated_function_for+" \\\"\"+  ($(\"#acv_variable_name_"+fieldIndex+"\").val() ||  $(\"#fieldName_"+fieldIndex+"\").html()) +\"\\\"\" } );'>";
    

    cell_Function_Configure_Calculated_HTML += "<div id='configure_calculated_div_"+fieldIndex+"' name='configure_calculated_div_"+fieldIndex+"' style='display:none'>" +
                                                    "<input type='hidden' id='configure_calculated_tmp_value_"+fieldIndex+"' name='configure_calculated_tmp_value_"+fieldIndex+"' value='"+calculatedFormula+"'>" +                                             
                                                    "<textarea id='configure_calculated_value_"+fieldIndex+"' name='configure_calculated_value_"+fieldIndex+"' rows='2' cols='40' style='width:100%'>"+calculatedFormula+"</textarea>" +
                                                    "<br><br>" +
                                                    "<input type='button' value='"+lbl_report_save+"' onClick='$(\"#configure_calculated_tmp_value_"+fieldIndex+"\").val($(\"#configure_calculated_value_"+fieldIndex+"\").val()); reDrawCalculatedFunctionImg("+fieldIndex+"); dialogCalculatedFunction_"+fieldIndex+".dialog(\"close\");'>" +
                                                    "<input type='button' value='"+lbl_report_clear+"' onClick='$(\"#configure_calculated_value_"+fieldIndex+"\").val(\"\");'>" +
                                                    "<input type='button' value='"+lbl_report_cancel+"' onClick='$(\"#configure_calculated_value_"+fieldIndex+"\").val($(\"#configure_calculated_tmp_value_"+fieldIndex+"\").val()); dialogCalculatedFunction_"+fieldIndex+".dialog(\"close\");'>" +
                                                    "<br><br>" +
                                                "</div>";
    
    
    return cell_Function_Configure_Calculated_HTML;
    
}

function getMySQLFunctionsHTML(fieldIndex, defaultLanguage) {
    
    var lang = document.documentElement.lang;
    
    if(document.getElementById("mySQLFunctions"+fieldIndex) === null) {
        $("#configure_calculated_div_"+fieldIndex).append("<div id='mySQLFunctions"+fieldIndex+"' class='mySQLFunctions'></div>");
    }
    $.ajax({
        url: 'modules/asol_Process/___common_WFM/mySQLFunctions/mySQLFunctions.'+lang+'.html',
        success: function(data) {
            $('#mySQLFunctions'+fieldIndex).html(data);
        },
        error: function(data2) {
            $.ajax({
                url: 'modules/asol_Process/___common_WFM/mySQLFunctions/mySQLFunctions.'+defaultLanguage+'.html',
                success: function(data2) {
                    $('#mySQLFunctions'+fieldIndex).html(data2);
                }
            });
        }
    });


}

function reDrawCalculatedFunctionImg(imageIndex) {
    
    var filled = ($("#configure_calculated_value_"+imageIndex).val() != '');
    
    if (filled)
        $("#configure_calculated_btn_"+imageIndex).attr('src', 'modules/asol_Process/___common_WFM/images/asol_reports_calculated_function_filled.png');
    else
        $("#configure_calculated_btn_"+imageIndex).attr('src', 'modules/asol_Process/___common_WFM/images/asol_reports_calculated_function.png'); 

}
