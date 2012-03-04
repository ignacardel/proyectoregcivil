<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);


if ($id) {

    $idcompleto="";
    
    if ($tipoid=='ci')
        $idcompleto=$tipoci.$id;
    else
        $idcompleto=$id;
        

    $result = mysql_query("SELECT * FROM renuncia_nacionalidad WHERE id = '$idcompleto'");
    $row = mysql_fetch_array($result);
    
	if ($row) {
        $plantilla = new Panel("../html/plantilla.htm");
        
        $plantilla->add("onload",'onload="repetido('."'".$idcompleto."'".','."'".$tipoid."'".')"');

        $pnlcontenido = new Panel("../html/buscarActaRenuncia.html");
		
		$plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();

       
	   
	}
}



include "../db/cerrar_conexion.php";
?>