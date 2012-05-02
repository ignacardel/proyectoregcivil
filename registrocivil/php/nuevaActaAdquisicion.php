<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);


if (($id) && ($nombre) && ($apellido)) { //Si se reciben datos, se esta intentando agregar una nueva Acta

    //En la BD las cedulas de identidad se guardan con el prefijo V- o E-
    $idcompleto="";
    
    if ($tipoid=='ci')
        $idcompleto=$tipoci.$id;
    else
        $idcompleto=$id;
        

    $result = mysql_query("SELECT * FROM adquisicion_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);
    if ($row) { //Si la solicitud ya existe se recarga la pagina con los datos insertados
                // y se envia un mensaje de error atraves de la funcion repetido()
        $plantilla = new Panel("../html/plantilla.htm");
        
        $plantilla->add("onload",'onload="repetido('."'".$idcompleto."'".','."'".$tipoid."'".')"');

        $pnlcontenido = new Panel("../html/nuevaActaAdquisicion.html");

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
        $idcompleto_madre = "";

        if ($tipoidmadre == 'ci')
            $idcompleto_madre = $tipocimadre . $id_madre;
        else
            $idcompleto_madre=$id_madre;

        $idcompleto_padre = "";

        if ($tipoidpadre == 'ci')
            $idcompleto_padre = $tipocipadre . $id_padre;
        else
            $idcompleto_padre=$id_padre;

        mysql_query("INSERT INTO adquisicion_nacionalidad  VALUES ('$idcompleto','$tipoid','$acta_no',curdate(),
                    '$nombre','$apellido','$fecha_n','$edo_civil','$profesion','$padre', '$idcompleto_padre',
					'$tipoidpadre', '$nac_padre', '$madre', '$idcompleto_madre', '$tipoidmadre','$nac_madre', 
					'$origen','$domicilio','$autoridad');");
										
        echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='adquisicion.php';</script>";
    }
}  else { //Si no se reciben datos, la pantalla se esta cargando por primera vez
    
    $plantilla = new Panel("../html/plantilla.htm");
    $pnlcontenido = new Panel("../html/nuevaActaAdquisicion.html");

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
