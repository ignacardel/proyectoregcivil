<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);
extract($_REQUEST);

if (($nombre) && ($apellido)) { //Se reciben datos de modificacion una vez la pantalla ya ha sido cargada

    mysql_query("UPDATE autoridad SET  nombre='$nombre',apellido='$apellido'  WHERE ci='$ci'");
    echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='autoridadesCiviles.php';</script>";
    
} else if ($ci_modificar) { //Se carga la pantalla a partir del formulario de busqueda
    
    $result = mysql_query("SELECT * from autoridad where ci='$ci_modificar'");
    $row = mysql_fetch_array($result);
    if (!$row) { //Si la autoridad no existe
        echo "<script type=\"text/javascript\">alert(\"C.I. no registrada\"); window.location='autoridadesCiviles.php';</script>";
    } else { //Si existe
        $plantilla = new Panel("../html/plantilla.htm");

        $pnlcontenido = new Panel("../html/modificarAutoridad.html");
        $pnlcontenido->add("nombre", $row['nombre']);
        $pnlcontenido->add("ci", $row['ci']);
        $pnlcontenido->add("apellido", $row['apellido']);

        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();
    }
    
} else if ($autoridad) { //Se carga la pantalla a partir del listado de autoridades
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