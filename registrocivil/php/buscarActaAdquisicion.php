<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);


if ($id) {

    $idcompleto = "";

    if ($tipoid == 'ci')
        $idcompleto = $tipoci . $id;
    else
        $idcompleto=$id;


    $result = mysql_query("SELECT * FROM adquisicion_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);

    if ($row) {
        $plantilla = new Panel("../html/plantilla.htm");

        $pnlcontenido = new Panel("../html/buscarActaAdquisicion.html");

        $pnlcontenido->add("solicitante", $row['nombre'] . ' ' . $row['apellido']);
        $pnlcontenido->add("libro","/registrocivil/php/imprimirLibroActaAdquisicion.php?id=".$idcompleto);
        $pnlcontenido->add("copia","/registrocivil/php/imprimirCopiaActaAdquisicion.php?id=".$idcompleto);


        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

        
    } else {
        echo "<script type=\"text/javascript\">alert(\"No existe una Acta de la Declaración de Acogerse a la Nacionalidad Venezolana Por Nacimiento para la C.I. o Pasaporte introducido\"); window.location='adquisicion.php';</script>";
    }
}


include "../db/cerrar_conexion.php";
?>