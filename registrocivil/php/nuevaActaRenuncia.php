<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);


if (($id) && ($nombre) && ($apellido)) {

    //En la BD las cedulas de identidad se guardan con el prefijo V- o E-
    $idcompleto="";

    if ($tipoid=='ci')
        $idcompleto=$tipoci.$id;
    else
        $idcompleto=$id;
        

    $result = mysql_query("SELECT * FROM renuncia_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);
    if ($row) { //Si la solicitud ya existe se recarga la pagina con los datos insertados
                // y se envia un mensaje de error atraves de la funcion repetido()
        $plantilla = new Panel("../html/plantilla.htm");
        
        $plantilla->add("onload",'onload="repetido('."'".$idcompleto."'".','."'".$tipoid."'".')"');

        $pnlcontenido = new Panel("../html/nuevaActaRenuncia.html");

        $result = mysql_query("SELECT * FROM autoridad");
        $autoridades = '';
        //Se llena el combobox de Autoridades Civiles
        while ($row = mysql_fetch_array($result)) {
            $autoridad = '<option value="' . $row["ci"] . '">' . $row["nombre"] . ' ' . $row["apellido"] . '</option>';
            $autoridades = $autoridades . $autoridad;
        }
        $pnlcontenido->add("autoridades", $autoridades);

        
        $pnlcontenido->add("nombre", $nombre);
        $pnlcontenido->add("apellido", $apellido);

        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

    } else { //Si no existe, se inserta en BD

        //En la BD las cedulas de identidad se guardan con el prefijo V- o E-
        $idcompleto_testigo1 = "";

        if ($tipoid1 == 'ci')
            $idcompleto_testigo1 = $tipoci1 . $id_testigo1;
        else
            $idcompleto_testigo1=$id_testigo1;

        $idcompleto_testigo2 = "";

        if ($tipoid2 == 'ci')
            $idcompleto_testigo2 = $tipoci2 . $id_testigo2;
        else
            $idcompleto_testigo2=$id_testigo2;

        mysql_query("INSERT INTO renuncia_nacionalidad  VALUES ('$idcompleto','$tipoid','$acta_no',curdate(),
                    '$nombre','$apellido','$fecha_n','$edo_civil','$profesion','$domicilio','$testigo1','$testigo2',
                    '$nac_testigo1','$nac_testigo2','$idcompleto_testigo1','$tipoid1','$idcompleto_testigo2','$tipoid2','$autoridad');");
        echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='renuncia.php';</script>";
    }
}  else { //Si no se reciben datos, la pantalla se esta cargando por primera vez
    
    $plantilla = new Panel("../html/plantilla.htm");
    $pnlcontenido = new Panel("../html/nuevaActaRenuncia.html");

    $result = mysql_query("SELECT * FROM autoridad");
    $autoridades = '';
    //Se llena el combobox de Autoridades Civiles
    while ($row = mysql_fetch_array($result)) {
        $autoridad = '<option value="' . $row["ci"] . '">' . $row["nombre"] . ' ' . $row["apellido"] . '</option>';
        $autoridades = $autoridades . $autoridad;
    }
    $pnlcontenido->add("autoridades", $autoridades);


    $plantilla->add("contenido", $pnlcontenido);
    $plantilla->show();
}


include "../db/cerrar_conexion.php";
?>
