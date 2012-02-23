<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);

if (($ci) && ($nombre) && ($apellido)) {

    $result = mysql_query("SELECT * FROM autoridad WHERE ci = '$ci'");
    $row = mysql_fetch_array($result);
    if ($row) {
        $plantilla = new Panel("../html/plantilla.htm");
        $plantilla->add("onload",'onload="repetido('.$ci.')"');

        $pnlcontenido = new Panel("../html/agregarAutoridad.html");
        $pnlcontenido->add("nombre", $nombre);
        $pnlcontenido->add("apellido", $apellido);
        $pnlcontenido->add("ci", $ci);
        //$pnlcontenido->add("mensaje", 'Ya existe una Autoridad Civil registrada con la C.I. ' . $ci);
        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();
        
    } else {
        mysql_query("INSERT INTO autoridad  VALUES ('$ci','$nombre','$apellido');");
        echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='autoridadesCiviles.php';</script>";
    }
} else {
    
    $plantilla = new Panel("../html/plantilla.htm");
    $pnlcontenido = new Panel("../html/agregarAutoridad.html");
    $plantilla->add("contenido", $pnlcontenido);
    $plantilla->show();
    
}


include "../db/cerrar_conexion.php";
?>
