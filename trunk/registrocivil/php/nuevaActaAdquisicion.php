<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);


if (($id) && ($nombre) && ($apellido)) {


    $idcompleto="";
    
    if ($tipoid=='ci')
        $idcompleto=$tipoci.$id;
    else
        $idcompleto=$id;
        

    $result = mysql_query("SELECT * FROM adquisicion_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);
    if ($row) {
        $plantilla = new Panel("../html/plantilla.htm");
        
        $plantilla->add("onload",'onload="repetido('."'".$idcompleto."'".','."'".$tipoid."'".')"');

        $pnlcontenido = new Panel("../html/nuevaActaAdquisicion.html");

        $result = mysql_query("SELECT * FROM autoridad");
        $autoridades = '';
        while ($row = mysql_fetch_array($result)) {
            $autoridad = '<option value="' . $row["ci"] . '">' . $row["nombre"] . ' ' . $row["apellido"] . '</option>';
            $autoridades = $autoridades . $autoridad;
        }
        $pnlcontenido->add("autoridades", $autoridades);

        
        $pnlcontenido->add("nombre", $nombre);
        $pnlcontenido->add("apellido", $apellido);

        //$pnlcontenido->add("mensaje", 'Ya existe una Autoridad Civil registrada con la C.I. ' . $ci);
        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

    } else {

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
}  else {
    
    $plantilla = new Panel("../html/plantilla.htm");
    $pnlcontenido = new Panel("../html/nuevaActaAdquisicion.html");

    $result = mysql_query("SELECT * FROM autoridad");
    $autoridades = '';

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
