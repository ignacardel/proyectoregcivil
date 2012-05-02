<?php
$conexion = mysql_connect("localhost","root","") or die ("<center>ERROR DE CONECCION</center>");
mysql_select_db("registrocivil",$conexion);
if(!$conexion)
echo "NO CONECTO";
?>
