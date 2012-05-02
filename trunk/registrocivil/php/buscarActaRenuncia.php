<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";

//Carga una pantalla intermediaria desde la cual hay links para imprimir las Actas tanto original como copia
//Por medio del ID del solicitante recibido, se forman dinamicamente los links que llevan a las paginas
//que imprimen en PDF las Actas

extract($_POST);


if ($id) {

    //En la BD las cedulas de identidad se guardan con el prefijo V- o E-
    $idcompleto = "";

    if ($tipoid == 'ci')
        $idcompleto = $tipoci . $id;
    else
        $idcompleto=$id;


    $result = mysql_query("SELECT * FROM renuncia_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);

    if ($row) { //Si la Acta existe
        $plantilla = new Panel("../html/plantilla.htm");

        $pnlcontenido = new Panel("../html/buscarActaRenuncia.html");

        $pnlcontenido->add("solicitante", $row['nombre'] . ' ' . $row['apellido']);
        $pnlcontenido->add("libro","/registrocivil/php/imprimirLibroActaRenuncia.php?id=".$idcompleto);
        $pnlcontenido->add("copia","/registrocivil/php/imprimirCopiaActaRenuncia.php?id=".$idcompleto);


        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

        
    } else { //Si no existe
        echo "<script type=\"text/javascript\">alert(\"No existe una Acta de Renuncia a la Nacionalidad Venezolana registrada para la C.I. o Pasaporte introducido\"); window.location='renuncia.php';</script>";
    }
}



include "../db/cerrar_conexion.php";
?>