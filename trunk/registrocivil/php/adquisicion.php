<?php

session_start();
$pathFix = dirname(__FILE__);
require_once ("../classes/Panel.php");
include "../db/conexion.php";


$plantilla = new Panel("../html/plantilla.htm");

$pnlcontenido = new Panel("../html/adquisicion.html");

$plantilla->add("contenido", $pnlcontenido);
$plantilla->show();
include "../db/cerrar_conexion.php";
?>