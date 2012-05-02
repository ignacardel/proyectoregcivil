<?php

session_start();
require_once ("../CLASSES/Panel.php");
include "../DB/conexion.php";


extract($_POST);

if (($ci) && ($nombre) && ($apellido)) { //Si se reciben datos, se esta intentando agregar una nueva autoridad

    $result = mysql_query("SELECT * FROM autoridad WHERE ci = '$ci'");
    $row = mysql_fetch_array($result);
    if ($row) { //Si la autoridad ya existe se recarga la pagina con los datos insertados
                // y se envia un mensaje de error atraves de la funcion repetido()
        $plantilla = new Panel("../html/plantilla.htm");
        $plantilla->add("onload",'onload="repetido('.$ci.')"');

        $pnlcontenido = new Panel("../html/agregarAutoridad.html");
        $pnlcontenido->add("nombre", $nombre);
        $pnlcontenido->add("apellido", $apellido);
        $pnlcontenido->add("ci", $ci);
        $plantilla->add("contenido", $pnlcontenido);
        $plantilla->show();
        
    } else { //Si no existe, se inserta en BD
        mysql_query("INSERT INTO autoridad  VALUES ('$ci','$nombre','$apellido');");
        echo "<script type=\"text/javascript\">alert(\"Operacion realizada con éxito\"); window.location='autoridadesCiviles.php';</script>";
    }
} else {  //Si no se reciben datos, la pantalla se esta cargando por primera vez

    $plantilla = new Panel("../html/plantilla.htm");
    $pnlcontenido = new Panel("../html/agregarAutoridad.html");
    $plantilla->add("contenido", $pnlcontenido);
    $plantilla->show();
    
}


include "../db/cerrar_conexion.php";
?>
