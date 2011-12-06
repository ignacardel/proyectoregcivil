<?php

session_start();
$pathFix = dirname(__FILE__);
require_once ("../classes/Panel.php");
include "../db/conexion.php";


$plantilla = new Panel("../html/plantilla.htm");

$pnlcontenido = new Panel("../html/autoridadesCiviles.html");

$result = mysql_query("select * from autoridad order by apellido,nombre");

if (mysql_num_rows($result)!=0) { //Si hay autoridades
    $tabla_completa = "";
    while ($row = mysql_fetch_array($result)) {
        $tabla =
     '  <table width="716" border="0">
        <tr>
        <td>' . $row['apellido'] . '  , ' . $row['nombre'] . '</td>
          <td  width="149"><a href="../php/modificarAutoridad.php?autoridad=' . $row["ci"] . '">Modificar</a></td>
        </tr>
      </table>';
        
        $tabla_completa = $tabla_completa . $tabla;
    }

    $pnlcontenido->add("informacion", $tabla_completa);
    mysql_free_result($result);
    
} else { //Si no hay autoridades
    $msg = '<p>No hay Autoridades Civiles registradas.</p>';
    $pnlcontenido->add("informacion", $msg);
}

$plantilla->add("contenido", $pnlcontenido);
$plantilla->show();
include "../db/cerrar_conexion.php";
?>