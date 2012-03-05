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


    $result = mysql_query("SELECT * FROM renuncia_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);

    if ($row) {
        $plantilla = new Panel("../html/plantilla.htm");

        $pnlcontenido = new Panel("../html/buscarActaRenuncia.html");

        $pnlcontenido->add("solicitante", $row['nombre'] . ' ' . $row['apellido']);
        $pnlcontenido->add("libro","/registrocivil/php/imprimirLibroActaRenuncia?id=".$idcompleto);
        $pnlcontenido->add("copia","/registrocivil/php/imprimirCopiaActaRenuncia?id=".$idcompleto);


        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

        
    } else {
        echo "<script type=\"text/javascript\">alert(\"No existe una Acta de Renuncia a la Nacionalidad Venezolana registrada para la C.I. o Pasaporte introducido\"); window.location='renuncia.php';</script>";
    }
}



include "../db/cerrar_conexion.php";
?>