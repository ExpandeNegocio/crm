<?php

  require_once ('custom/include/ComunInformes.php');

  class AvisosAdmin
  {

    const MARC_FRAN='#FRAN#';
    const MARC_MODULO='#MODULO#';
    const MARC_FECHA='#FECHA#';

    const ENTRADA_PORTAL='ENTRADA_PORTAL';
    const SALIDA_PORTAL='SALIDA_PORTAL';
    const FACT_MAILING='FACT_MAILING';
    const CREACION_EVENTO='CREACION_EVENTO';
    const ACT_EVENTO='ACT_EVENTO';
    const FACT_EVENTO='FACT_EVENTO';

    const EMAIL_ADMIN='administracion@expandenegocio.com';

    const BODY_ENTRADA_PORTAL = '<P> #FRAN# ha sido dada de alta en #MODULO#, con fecha de fin #FECHA#. Ya puedes intruducir los costes de la acción</P>';
    const SUBJECT_ENTRADA_PORTAL ='Alta de franquicia en portal';

    const BODY_SALIDA_PORTAL = '<P>#FRAN# finaliza el periodo de contratación en #MODULO# el #FECHA#. Ya puedes introducir los costes de la acción.</P>';
    const SUBJECT_SALIDA_PORTAL ='Finalización de contratación de portal';

    const BODY_FACT_MAILING = '<P> Está programado el envío de un mailing de la cadena #FRAN# el #FECHA#. ya se puede proceder a la facturación. recuerda además volcar en esta pestaña el coste de la acción.</P>';
    const SUBJECT_FACT_MAILING ='Facturación de evento';

    const BODY_CREACION_EVENTO = '<P>Se ha creado el evento #MODULO#, Ya puede revisar las condiciones  y tipo de asistencia de cada cadena y los costes asociados al evento</P>';
    const SUBJECT_CREACION_EVENTO ='Se ha creado un nuevo evento';

    const BODY_ACT_EVENTO = '<P>Se han actualizado las cadenas que asisten al evento #MODULO#, revise las condiciones de asistencia de las nuevas franquicias.</P>';
    const SUBJECT_ACT_EVENTO ='Se ha añadido una nueva franquicia al evento';

    const BODY_FACT_EVENTO = '<P>Está programado el evento #MODULO# para el #FECHA#. ya se puede proceder a la facturación. recuerda además volcar en esta pestaña el coste de la acción.</P>';
    const SUBJECT_FACT_EVENTO ='Aviso de facturación de evento';


    function enviaCorreo($tipoAviso,$franquicia,$nombre,$fecha){

      $bodys= array(
        self::ENTRADA_PORTAL=>self::BODY_ENTRADA_PORTAL,
        self::SALIDA_PORTAL=>self::BODY_SALIDA_PORTAL,
        self::FACT_MAILING=>self::BODY_FACT_MAILING,
        self::CREACION_EVENTO=>self::BODY_CREACION_EVENTO,
        self::ACT_EVENTO=>self::BODY_ACT_EVENTO,
        self::FACT_EVENTO=>self::BODY_FACT_EVENTO
      );

      $subjects=array(
        self::ENTRADA_PORTAL=>self::SUBJECT_ENTRADA_PORTAL,
        self::SALIDA_PORTAL=>self::SUBJECT_SALIDA_PORTAL,
        self::FACT_MAILING=>self::SUBJECT_FACT_MAILING,
        self::CREACION_EVENTO=>self::SUBJECT_CREACION_EVENTO,
        self::ACT_EVENTO=>self::SUBJECT_ACT_EVENTO,
        self::FACT_EVENTO=>self::SUBJECT_FACT_EVENTO
      );

      $subject= $subjects[$tipoAviso];
      $body=$bodys[$tipoAviso];

      $body=$this->montabodycorreo($body,$franquicia,$nombre,$fecha);

      EnviarCorreo(self::EMAIL_ADMIN, $subject, null, $body);
    }

    function montabodycorreo($text,$franquicia,$nombre,$fecha){

      $text = str_replace(self::MARC_FRAN, $franquicia, $text);
      $text = str_replace(self::MARC_MODULO, $nombre, $text);
      $text = str_replace(self::MARC_FECHA, $fecha, $text);

      return $text;
    }

  }