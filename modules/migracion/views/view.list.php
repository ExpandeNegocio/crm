<?php

	require_once('data/SugarBean.php');
	require_once('modules/Expan_GestionSolicitudes/Expan_GestionSolicitudes.php');
	require_once('modules/Expan_Solicitud/Expan_Solicitud.php');
	require_once('custom/include/EnvioAutoCorreos.php');


	class migracionViewList extends SugarView{
	    public function displayM1()
	    {
	        echo '<h1>Hello World</h1>';

	        $db =  DBManagerFactory::getInstance();
			$query = "select * from expan_solicitud";

			$result = $db->query($query, true);

			//Recorro las colicitudes

		    while ($row = $db->fetchByAssoc($result)){
	    		//echo  $row['first_name'].' - ';

	    		$caracteres = split(',', $row['franquicias_secundarias']);
				

				foreach  ($caracteres as $valor){
					$valor=str_replace('^','',$valor);

					$idfran='';

					$franq = BeanFactory::getBean("Expan_Franquicia", $valor);



					if ($franq ==null){
						$idfran='380f0dc1-e38e-83e2-8c74-53df9ab90ac1';
					}else{	
						$idfran=$franq->id;
					}

					$nombre='Gestion - '.$row["first_name"].' '.$row["last_name"].' - '.$GLOBALS['app_list_strings']['franquicia_list'][$valor];

					$uidGestion=trim($this->getGUID(), '{}');

					$query ='insert into expan_gestionsolicitudes (assigned_user_id,
						candidatura_caliente,
						chk_entrevista,
						chk_envio_contrato,
						chk_envio_documentacion,
						chk_envio_precontrato,
						chk_informacion_adicional,
						chk_recepcio_cuestionario,
						chk_visita_central,
						chk_visita_local,
						created_by,
						date_entered,
						date_modified,
						deleted,
						description,
						envio_documentacion,
						estado_sol,
						f_entrevista,
						f_envio_contrato,
						f_envio_precontrato,
						f_informacion_adicional,
						f_recepcion_cuestionario,
						f_visita_central,
						f_visita_local,
						franquicia,
						id,
						modified_user_id,
						name,
						observaciones_informe) VALUES ('."'".$franq->assigned_user_id."',"
													.$row["candidatura_caliente"].','
													.$row["chk_entrevista"].','
													.$row["chk_envio_contrato"].','
													.$row["chk_envio_documentacion"].','
													.$row["chk_envio_precontrato"].','
													.$row["chk_informacion_adicional"].','
													.$row["chk_recepcio_cuestionario"].','
													.$row["chk_visita_central"].','
													.$row["chk_visita_local"].','
													."'".$row["created_by"]."',"
													."'".$row["date_entered"]."',"
													."'".$row["date_modified"]."',"
													.$row["deleted"].','
													."'".$row["description"]."',"
													."'".$row["envio_documentacion"]."',"
													."'".$row["estado_sol"]."',"
													."'".$row["f_entrevista"]."',"
													."'".$row["f_envio_contrato"]."',"
													."'".$row["f_envio_precontrato"]."',"
													."'".$row["f_informacion_adicional"]."',"
													."'".$row["f_recepcion_cuestionario"]."',"
													."'".$row["f_visita_central"]."',"
													."'".$row["f_visita_local"]."',"
													."'".$idfran."',"
													."'".$uidGestion."',"
													."'1',"
													."'".$nombre."',"
													."''".')';

					$db->query($query, true);	

					echo $query.'<br>';

					$uid=trim($this->getGUID(), '{}');

					$query='insert into expan_solicitud_expan_gestionsolicitudes_1_c (date_modified,
																					deleted,
																					expan_soli5dcccitudes_idb,
																					expan_solicitud_expan_gestionsolicitudes_1expan_solicitud_ida,
																					id) VALUES
																					('
																					."'".$row["created_by"]."',"
																					.'0'.','
																					."'".$uidGestion."',"
																					."'".$row['id']."',"
																					."'".$uid."'"
																					.')';

					$db->query($query, true);	

				}
				echo '<br>';
			}

			echo '<br><br><br><br><br>TODO OK<br><br><br><br><br><br>';
			
	    }

	    function display(){

 			$db =  DBManagerFactory::getInstance();
			$query = "select * from expan_solicitud_calls_c";

			$resultCall = $db->query($query, true);

			while ($rowCall = $db->fetchByAssoc($resultCall)){

				echo $rowCall['id'].' - ';
				

				$solicitud = BeanFactory::getBean("Expan_Solicitud", $rowCall['expan_solicitud_callsexpan_solicitud_ida']);

				echo $solicitud->id.' - ';
				echo $solicitud->franquicias_secundarias;
				if ($solicitud!=null){
					$solicitud->load_relationship('expan_solicitud_expan_gestionsolicitudes_1');

					foreach ($solicitud->expan_solicitud_expan_gestionsolicitudes_1->getBeans() as $gestion) {
	    				echo 'Gestion - '.$gestion->id;

		    			$uid=trim($this->getGUID(), '{}');

						$query='insert into expan_gestionsolicitudes_calls_1_c ('
																	.'date_modified,'
																	.'deleted,'
																	.'expan_gestionsolicitudes_calls_1calls_idb,'
																	.'expan_gestionsolicitudes_calls_1expan_gestionsolicitudes_ida,'
																	.'id) VALUES ('
																	."'".$rowCall['date_modified']."',"
																	.'0'.','
																	."'".$gestion->id."',"
																	."'".$rowCall['id']."',"																	
																	."'".$uid."'"
																	.')';
						$db->query($query, true);

		   			}
	   			}
				echo '<br>';

			}

			echo '<br><br><br><br><br>TODO OK<br><br><br><br><br><br>';
	    }

		function getGUID(){
		    if (function_exists('com_create_guid')){
		        return com_create_guid();
		    }else{
		        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
		        $charid = strtoupper(md5(uniqid(rand(), true)));
		        $hyphen = chr(45);// "-"
		        $uuid = chr(123)// "{"
		            .substr($charid, 0, 8).$hyphen
		            .substr($charid, 8, 4).$hyphen
		            .substr($charid,12, 4).$hyphen
		            .substr($charid,16, 4).$hyphen
		            .substr($charid,20,12)
		            .chr(125);// "}"
		        return $uuid;
		    }
		}

	}    

?>