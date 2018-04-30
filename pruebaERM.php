<?php
$ch = curl_init();

//https://expandenegocio.easyredmine.com/issues.xml?sort=&offset=0&limit=1000&status_id=6&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6

curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/issues.xml?key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");



//curl_setopt($ch, CURLOPT_URL, "https://expandenegocio.easyredmine.com/projects.xml?limit=2000&key=6db1cb022e190c19bc44dc5f94af4596ee5422d6");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/xml"
));


/*$response = curl_exec($ch);

echo curl_error($ch);

curl_close($ch);

$proyectos = new SimpleXMLElement($response);
echo $proyectos->total_count;

foreach ($proyectos as $proyecto) {
//	echo $proyecto->id."<br>";
}

//var_dump($response);
//echo $response;

*/

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "<issue>    
    <project_id>639</project_id>
    <tracker_id>5</tracker_id>
    <status_id>11</status_id>
    <priority_id>44</priority_id>
    <assigned_to_id>26</assigned_to_id>
    <subject>issue subject</subject>
    <description>
        issue description
    </description>    
     <custom_fields type='array'>
        <custom_field id='51'>
            <value>Tareas Aperturas</value>
        </custom_field>
    </custom_fields>    
</issue>");


/*
    <id>7777</id>
    <project_id>639</project_id>
    <tracker_id>5</tracker_id>
    <status_id>1</status_id>
    <priority_id>10</priority_id>
    <author_id>26</author_id>
    <assigned_to_id>53</assigned_to_id>
    <subject>issue subject</subject>
    <description>
        issue description
    </description>
    <start_date>2014-04-11</start_date>
    <due_date>2014-04-11</due_date>
    <done_ratio>0</done_ratio>
    <estimated_hours>1.0</estimated_hours>
    </watcher_user_ids>
    <custom_fields type='array'>
        <custom_field id=51 name='Actividad Asociada' internal_name='' field_format='list'>
          <value>Reunión Interna</value>
        </custom_field>
        <custom_field id=54 name='Obligatoriedad' internal_name='' field_format='list'>
          <value>Si</value>
        </custom_field>
    </custom_fields>*/



/*curl_setopt($ch, CURLOPT_POSTFIELDS, '<project>
    <id>800</id>
    <identifier>800</identifier>    
    <name>NuevoProyecto</name>
    <description>Hola</description>
    <status>1</status>
    <author_id>5</author_id>
    <custom_fields type="array">
        <custom_field id="49" name="Fecha Inicio" internal_name="" field_format="date">
            <value>2017-12-22</value>
        </custom_field>
        <custom_field id="50" name="Fecha Fin" internal_name="" field_format="date">
            <value/>
        </custom_field>
        <custom_field id="52" name="Tipo" internal_name="" field_format="list">
            <value>Cliente</value>
        </custom_field>
    </custom_fields>
</project>');*/



curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/xml"
));

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);
echo $response;

$issueresp = new SimpleXMLElement($response);

echo "<br>";

echo $issueresp->id;
?>