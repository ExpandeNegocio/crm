<?php
/*****************************************************************************
 * The contents of this file are subject to the RECIPROCAL PUBLIC LICENSE
 * Version 1.1 ("License"); You may not use this file except in compliance
 * with the License. You may obtain a copy of the License at
 * http://opensource.org/licenses/rpl.php. Software distributed under the
 * License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND,
 * either express or implied.
 *
 * You may:
 * a) Use and distribute this code exactly as you received without payment or
 *    a royalty or other fee.
 * b) Create extensions for this code, provided that you make the extensions
 *    publicly available and document your modifications clearly.
 * c) Charge for a fee for warranty or support or for accepting liability
 *    obligations for your customers.
 *
 * You may NOT:
 * a) Charge for the use of the original code or extensions, including in
 *    electronic distribution models, such as ASP (Application Service
 *    Provider).
 * b) Charge for the original source code or your extensions other than a
 *    nominal fee to cover distribution costs where such distribution
 *    involves PHYSICAL media.
 * c) Modify or delete any pre-existing copyright notices, change notices,
 *    or License text in the Licensed Software
 * d) Assert any patent claims against the Licensor or Contributors, or
 *    which would in any way restrict the ability of any third party to use the
 *    Licensed Software.
 *
 * You must:
 * a) Document any modifications you make to this code including the nature of
 *    the change, the authors of the change, and the date of the change.
 * b) Make the source code for any extensions you deploy available via an
 *    Electronic Distribution Mechanism such as FTP or HTTP download.
 * c) Notify the licensor of the availability of source code to your extensions
 *    and include instructions on how to acquire the source code and updates.
 * d) Grant Licensor a world-wide, non-exclusive, royalty-free license to use,
 *    reproduce, perform, modify, sublicense, and distribute your extensions.
 *
 * The Original Code is: AnySoft Informatica
 *                       Marcelo Leite (aka Mr. Milk)
 *                       2005-10-01 mrmilk@anysoft.com.br
 *
 * The Initial Developer of the Original Code is AnySoft Informatica Ltda.
 * Portions created by AnySoft are Copyright (C) 2005 AnySoft Informatica Ltda
 * All Rights Reserved.
 *
 * Code Rewrited By Wei Dong (trophular@gmail.com) to make it compatible with SugarCRM 6.x
 ********************************************************************************/
class Gantt extends SugarBean
{
    var $long_date        = "Y-m-d";
    var $short_date        = "Y/m";

    var $fields = array(
        'name',
        'user_name',
        'date_start',
        'date_finish',
        'estimated_effort',
        'percent_complete',
    );
    var $colors = array(
        'Not Started'     => '#cccccc',
        'In Progress'    => '#0094F2',
        'Completed'        => '#777777',
        'Pending Input'    => 'ff9e9e',
        'Deferred'        => 'red',
    );
    var $db;
    var $id;
    var $start;
    var $end;
    var $project;
    var $description;
    var $user;
    var $hr_prev;
    var $hr_real;

    var $date = "Y-m-d";
    var $zoom = 5;
    var $in   = 6;
    var $out  = 4;
    var $days_col;
    var $days_tot;
    var $cols_tot;
    var $days_mod;

    function ACLAccess()
    {
        return true;
    }

    function Draw($id)
    {
        global $app_list_strings, $mod_strings;

        $this->id = $id;
        $result = $this->get_data($id);
        $rows   = $this->db->getRowCount($result);

        if($rows >0)
        {
            while(100 % $this->zoom > 0 && $this->zoom > 0)
                $this->zoom--;

            $days_tot = (strtotime($this->end)-strtotime($this->start)+86400)/86400;
            $this->days_tot = $days_tot;
            while($this->days_tot % $this->zoom > 0)
                $this->days_tot++;
            $this->cols_tot = $this->days_tot / $this->zoom;
            $this->days_col = $this->days_tot / $this->cols_tot;
            $this->days_mod = $this->days_tot - $days_tot;

            $this->out = $this->zoom+1;
            while(100 % $this->out > 0 && $this->out < $days_tot)
                $this->out++;
            $this->in = $this->zoom-1;
            while(100 % $this->in > 0 && $this->in > 0)
                $this->in--;

            $timeu = date("Y-m-d H:i:s", strtotime($this->start));
            $this->add_header();

            for($i=0; $i<$this->cols_tot; $i++)
            {
                $title = date($this->date, strtotime($timeu));
                echo "        <td class='hdr_class' nowrap>$title</td>"."\n";
                $timeu = date("Y-m-d H:i:s", strtotime("+".$this->days_col." days", strtotime($timeu)));
            }

            echo "    </tr>"."\n";

            $i = 0;
            $milestone = false;
            $indent = "";
            while ($i < $rows)
            {
                $row = $this->db->fetchByAssoc($result);
                echo "    <tr>"."\n";
                foreach($this->fields as $name)
                {
                    if(substr($name, 0, 4)=="name")
                    {
                        if($milestone)
                        {
                            if ($order_num != $row["order_number"])
                            {
                                $milestone = false;
                                $indent = "";
                            }
                        }
                        $task_id = $row['id'];
                        $link = "index.php?module=ProjectTask&action=DetailView&record=$task_id";
                        echo "        <td class='field' nowrap><a href='{$link}'>".$indent.$row["$name"]."</a></td>"."\n";

                        if($row["milestone_flag"]=='on')
                        {
                            $milestone = true;
                            $order_num = $row["order_number"];
                            $indent .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                    }
                    elseif(strstr($name, "date"))
                        echo "        <td class='field' nowrap>".date($this->date, strtotime($row["$name"]))."</td>"."\n";
                    elseif($name=='status')
                    {
                        $class = str_replace(" ", "", strtolower($row["status"]));
                        echo "        <td class='field' nowrap>".$app_list_strings['project_task_status_options'][$row["$name"]]."</td>"."\n";
                    }
                    else
                        echo "        <td class='field' nowrap>".$row["$name"]."</td>"."\n";
                }
                $timeline = $row['timesheet'];
                if($this->days_mod > 0) $timeline .= str_repeat('A', $this->days_mod);
                $class = str_replace(" ", "", strtolower($row["status"]));
                $timeline = preg_replace("/B*/e", '$this->span_task("\\0", 0)', $timeline);
                $timeline = preg_replace("/Y*/e", '$this->span_task("\\0", 1, $class)', $timeline);
                $timeline = preg_replace("/A*/e", '$this->span_task("\\0", 2)', $timeline);

                echo "        <td height=100% class='dummy' nowrap colspan='$this->cols_tot'>\n";
                echo "            <table cellspacing=0 cellpadding=0 class='dummy'>\n";
                echo "                <tr>\n";
                echo "$timeline";
                echo "                </tr>\n";
                echo "            </table>\n";
                echo "        </td>\n";
                echo "    </tr>"."\n";
                $i++;
            }
            $this->add_footer();
        }
    }

    function span_task($task, $type, $class='notask')
    {
        if(strlen($task)>0)
        {
            $size = round(strlen($task) * 100 / $this->days_tot, 1);
            return "                    <td width='$size%' class='$class' nowrap>&nbsp;</td>\n";
        }
        else
            return $task;
    }

    function add_header()
    {
        global $app_list_strings, $mod_strings;
        $mode = ($this->date == $this->short_date) ? $this->long_date : $this->short_date;

        echo "<html>"."\n";
        echo "<title>".$mod_strings['LBL_GANTT_TITLE']."</title>"."\n";
        echo "<head>"."\n";
        $this->add_style();
        echo     $mod_strings['LBL_GANTT_TITLE']."\n";
        echo "    <div align=right>"."\n";
        echo '        <input title="Short Date" style="width: 70;" class="button" type="submit" name="button" value="'.$mode.'" onclick="window.location='."'index.php?module=Gantt&action=DetailView&project_id={$this->id}&date=$mode&zoom=".$this->zoom."';".'"'.">"."\n";
        echo '        <input title="Zoom (+)" class="button" type="submit" name="button" value="'.$mod_strings['LBL_GANTT_ZOOMIN'].'" onclick="window.location='."'index.php?module=Gantt&action=DetailView&project_id={$this->id}&date=$this->date&zoom=".$this->in."';".'"'.">"."\n";
        echo '        <input title="Zoom (-)" class="button" type="submit" name="button" value="'.$mod_strings['LBL_GANTT_ZOOMOUT'].'" onclick="window.location='."'index.php?module=Gantt&action=DetailView&project_id={$this->id}&date=$this->date&zoom=".$this->out."';".'"'.">"."\n";
        echo "    </div>"."\n";
        echo "<hr></head>"."\n";
        echo "<body>"."\n";

        echo "<table width=100% cellspacing=0 cellpadding=0>"."\n";
        echo "    <tr>"."\n";
        echo "        <td class='projfield' width=15%>".$mod_strings['LBL_GANTT_PROJECT_NAME']."</td>"."\n";
        $link = "index.php?module=Project&action=DetailView&record=$this->id";
        echo "        <td class='projdata' width=35%><a href='{$link}'>$this->project</a></td>"."\n";
        echo "        <td class='projfield' width=25%>".$mod_strings['LBL_GANTT_PROJECT_EST_HOURS']."</td>"."\n";
        echo "        <td class='projdata' width=25%>$this->hr_prev</td>"."\n";
        echo "    </tr>"."\n";
        echo "    <tr>"."\n";
        echo "        <td class='projfield'>".$mod_strings['LBL_GANTT_PROJECT_USER']."</td>"."\n";
        echo "        <td class='projdata'>$this->user</td>"."\n";
        echo "        <td class='projfield'>".$mod_strings['LBL_GANTT_PROJECT_PERCENT_COMPLETE']."</td>"."\n";
        echo "        <td class='projdata'>$this->hr_real</td>"."\n";
        echo "    </tr>"."\n";
        echo "    <tr>"."\n";
        echo "        <td valign='top' class='projfield'>".$mod_strings['LBL_GANTT_PROJECT_DESCRIPTION']."</td>"."\n";
        echo "        <td class='projdata' colspan=3>$this->description</td>"."\n";
        echo "    </tr>"."\n";
        echo "</table>"."<br>\n";

        echo "<table width='100%' align=center cellspacing=0 cellpadding=0>"."\n";
        echo "    <tr>"."\n";
        foreach($this->fields as $name)
            echo "        <td valign='top' class='hdr_class'>".$mod_strings['LBL_GANTT_TASK_'.strtoupper($name)]."</td>"."\n";
    }

    function add_footer()
    {
        global $app_list_strings;
        echo "</table>"."<br>\n";
        echo "<div>Legenda</div>";
        echo "<table border=0 cellspacing=0 cellpadding=0>"."\n";
        echo "    <tr><td class='notstarted' width='15' style='border: 1px solid #ffffff' nowrap>&nbsp;</td><td class='legend'>&nbsp;".$app_list_strings['project_task_status_options']['Not Started']."</td></tr>"."\n";
        echo "    <tr><td class='inprogress' style='border: 1px solid #ffffff' nowrap>&nbsp;</td><td class='legend'>&nbsp;".$app_list_strings['project_task_status_options']['In Progress']."</td></tr>"."\n";
        echo "    <tr><td class='completed' style='border: 1px solid #ffffff' nowrap>&nbsp;</td><td class='legend'>&nbsp;".$app_list_strings['project_task_status_options']['Completed']."</td></tr>"."\n";
        echo "    <tr><td class='pendinginput' style='border: 1px solid #ffffff' nowrap>&nbsp;</td><td class='legend'>&nbsp;".$app_list_strings['project_task_status_options']['Pending Input']."</td></tr>"."\n";
        echo "    <tr><td class='deferred' style='border: 1px solid #ffffff' nowrap>&nbsp;</td><td class='legend'>&nbsp;".$app_list_strings['project_task_status_options']['Deferred']."</td></tr>"."\n";
        echo "</table>"."<br>\n";
        echo "</body>"."\n";
        echo "</html>"."\n";
    }

    function get_data($id)
    {

        if(isset($_REQUEST['module']) && $_REQUEST['module']=='ProjectTask') {
            $sql  = "SELECT project_id FROM project_task WHERE deleted=0 AND id='$id'";
            $result = $this->db->query($sql);
            $row = $this->db->fetchByAssoc($result);
            $id = $row['project_id'];
            $this->id = $id;
        }

        $sql  = "SELECT MIN(date_start) AS start, SUM(estimated_effort) as hr_prev, SUM(estimated_effort*percent_complete)/SUM(estimated_effort) as hr_real FROM project_task WHERE deleted=0 AND project_id='$id'";
        $result = $this->db->query($sql);
        $row = $this->db->fetchByAssoc($result);
        $this->start = $row['start'];
        $this->hr_prev = $row['hr_prev'];
        $this->hr_real = $row['hr_real'];

        $sql  = "SELECT MAX(date_finish) AS end FROM project_task WHERE deleted=0 AND project_id='$id'";
        $result = $this->db->query($sql);
        $row = $this->db->fetchByAssoc($result);
        $this->end = $row['end'];

        $sql  = "SELECT ";
        $sql .= "  name, project.description, user_name ";
        $sql .= "FROM ";
        $sql .= "  project ";
        $sql .= "INNER JOIN ";
        $sql .= "  users ";
        $sql .= "ON";
        $sql .= "  project.assigned_user_id=users.id ";
        $sql .= "WHERE";
        $sql .= "  project.deleted=0 AND project.id='$id' ";
        $result = $this->db->query($sql);
        $row = $this->db->fetchByAssoc($result);
        $this->project = $row['name'];
        $this->description = $row['description'];
        $this->user = $row['user_name'];

        $sql  = "SELECT project_task.id, project_task.status, milestone_flag, order_number, ";
        foreach($this->fields as $name)
            $sql .= $name.', ';
        $sql .= "  CONCAT(REPEAT('B', TO_DAYS(date_start) - TO_DAYS('$this->start')), REPEAT('Y', TO_DAYS(date_finish) - TO_DAYS(date_start)+1), REPEAT('A', TO_DAYS('$this->end') - TO_DAYS(date_finish))) AS timesheet ";
        $sql .= "FROM ";
        $sql .= "  project_task ";
        $sql .= "INNER JOIN ";
        $sql .= "  users ";
        $sql .= "ON ";
        $sql .= "  project_task.assigned_user_id=users.id ";
        $sql .= "WHERE";
        $sql .= "  project_task.deleted=0 AND project_id='$id' ";
        $sql .= "ORDER BY";
        $sql .= "  order_number, date_start, time_start, milestone_flag DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    function add_style()
    {
    $notstarted = $this->colors['Not Started'];
    $inprogress = $this->colors['In Progress'];
    $completed = $this->colors['Completed'];
    $pendinginput = $this->colors['Pending Input'];
    $deferred = $this->colors['Deferred'];

    $style = <<<EOQ
    <style>
    h3 {
        font-family: Times New Roman, Tahoma, serif, Arial, Verdana, Helvetica;
        font-size: 18px;
        font-variant: small-caps;
        font-weight: bold;
        color: black;
    }
    div {
        font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    body {
        margin: 10px 5px 5px 5px;
        background-color: #ffffff;
        font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
        font-size: 11px;
        color: #003399;
        }
    td.projdata {
        font-size: 12px;
        font-variant: small-caps;
        padding: 4px;
        border-top: 0px;
        border-left: 0px;
        border-right: 1px solid #dfdfdf;
        border-bottom: 1px solid #dfdfdf;
    }
    td.projfield {
        font-size: 12px;
        font-variant: small-caps;
        font-weight: bold;
        padding: 4px;
        border-top: 0px;
        border-left: 0px;
        border-right: 1px solid #dfdfdf;
        border-bottom: 1px solid #dfdfdf;
    }
    table.dummy {
        font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
        font-size: 11px;
        height: 100%;
        width: 100%;
        border: 0;
    }
    td.dummy {
        width: 100%;
        padding: 2px;
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 1px solid #dfdfdf;
    }
    table {
        font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
        color: #444444;
        font-size: 11px;
        border: 1px solid #bbbbbb;
        }
    td {
        font-size: 11px;
        padding: 0px;
        border-right: 1px solid #dfdfdf;
        border-bottom: 1px solid #dfdfdf;
    }
    td.legend {
        padding: 1px;
        border-right: 1px solid #dfdfdf;
        border-bottom: 1px solid #dfdfdf;
        }
    td.field {
        padding: 4px;
        border-top: 0px;
        border-left: 0px;
        border-right: 1px solid #dfdfdf;
        border-bottom: 1px solid #dfdfdf;
        }
    td.hdr_class {
        background-color: gray;
        color: #ffffff;
        padding: 5px;
        text-align: center;
        border-right: 1px solid #ffffff;
        }
    td.notask {
        border: 0px;
        padding: 0px;
        }
    td.notstarted {
        background-color: $notstarted;
        }
    td.inprogress {
        background-color: $inprogress;
        }
    td.completed {
        background-color: $completed;
        }
    td.pendinginput {
        background-color: $pendinginput;
        }
    td.deferred {
        background-color: $deferred;
        }
    .button {
        border: 1px solid #FF8383;
        background-color: #ffffff;
        font-size: 11px;
        color: #666666;
        margin: 0px;
    }
    .callroom_a {
        font-family: Times New Roman, Tahoma, serif, Arial, Verdana, Helvetica;
        color: red;
        font-size: 16pt;
        font-weight: bold;
    }
    .callroom_b {
        font-family: Times New Roman, Tahoma, serif, Arial, Verdana, Helvetica;
        color: black;
        font-size: 16pt;
        font-weight: bold;
        font-variant: small-caps;
    }
    a:link, a:visited {
        color: #444444;
        font-size: 11px;
        text-decoration: none;
    }
    a:hover {
        color: #0094F2;
        text-decoration: underline;
    }
    </style>
EOQ;
    echo $style."\n";
    }
}
