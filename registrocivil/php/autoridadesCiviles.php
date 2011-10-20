<?php

session_start();
$pathFix = dirname(__FILE__);
require_once ("../classes/Panel.php");
include "../db/conexion.php";

$plantilla = new Panel("../html/plantilla.htm");

$pnlcontenido = new Panel("../html/autoridadesCiviles.html");

$tabla_completa = "";


$result = mysql_query("select * from autoridad order by apellido,nombre");

while ($row = mysql_fetch_array($result)) {
    $tabla =
 '  <table width="716" border="0">
    <tr>
      <td>' . $row['apellido'] . '  ,  ' . $row['nombre'] . '</td>
      <td  width="149"><a href="../php/modificarAutoridad.php?autoridad=' . $row["ci"] . '">Modificar</a></td>
    </tr>
  </table>';

    $tabla_completa = $tabla_completa . $tabla;
}

mysql_free_result($result);

$pnlcontenido->add("informacion", $tabla_completa);

$plantilla->add("contenido", $pnlcontenido);

$plantilla->show();
include "../db/cerrar_conexion.php";
?>