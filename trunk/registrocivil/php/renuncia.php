<?php

session_start();
$pathFix = dirname(__FILE__);
require_once ("../classes/Panel.php");
include "../db/conexion.php";

//Se carga la pantalla de Renuncia a la Nacionalidad

$plantilla = new Panel("../html/plantilla.htm");

$pnlcontenido = new Panel("../html/renuncia.html");

$plantilla->add("contenido", $pnlcontenido);
$plantilla->show();
include "../db/cerrar_conexion.php";
?>