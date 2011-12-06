<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);
extract($_REQUEST);

if (($nombre) && ($apellido)) {

    mysql_query("UPDATE autoridad SET  nombre='$nombre',apellido='$apellido'  WHERE ci='$ci'");
    echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='autoridadesCiviles.php';</script>";
    
} else if ($ci_modificar) {
    
    $result = mysql_query("SELECT * from autoridad where ci='$ci_modificar'");
    $row = mysql_fetch_array($result);
    if (!$row) {
        echo "<script type=\"text/javascript\">alert(\"C.I. no registrada\"); window.location='autoridadesCiviles.php';</script>";
    } else {
        $plantilla = new Panel("../html/plantilla.htm");

        $pnlcontenido = new Panel("../html/modificarAutoridad.html");
        $pnlcontenido->add("nombre", $row['nombre']);
        $pnlcontenido->add("ci", $row['ci']);
        $pnlcontenido->add("apellido", $row['apellido']);

        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();
    }
    
} else if ($autoridad) {
    $result = mysql_query("SELECT * from autoridad where ci='$autoridad'");
    $row = mysql_fetch_array($result);
    $plantilla = new Panel("../html/plantilla.htm");

    $pnlcontenido = new Panel("../html/modificarAutoridad.html");
    $pnlcontenido->add("nombre", $row['nombre']);
    $pnlcontenido->add("ci", $row['ci']);
    $pnlcontenido->add("apellido", $row['apellido']);

    $plantilla->add("contenido", $pnlcontenido);
    $plantilla->show();
}


include "../db/cerrar_conexion.php";
?>