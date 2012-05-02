<?php

session_start();
include "../DB/conexion.php";
require('../fpdf16/fpdf.php');
require('funciones.php');

//Apoyado por la libreria FPDF, se construye el PDF correspondiente a la Copia Certificada
//del Acta de Renuncia a la Nacionalidad Venezolana

extract($_REQUEST);

//Se obtienen los datos del Acta
$result = mysql_query("SELECT * FROM renuncia_nacionalidad WHERE id = '$id'");
$row = mysql_fetch_array($result);

//Se obtienen los datos de la Autoridad Civil
$result2 = mysql_query("SELECT * FROM autoridad WHERE ci = '$row[fk_autoridad]'");
$row2 = mysql_fetch_array($result2);

//Nombre completo de la Autoridad Civil
$autoridad=strtoupper($row2['nombre'].' '.$row2['apellido']);

//Le sigue a Acta No.
$acta_no="(".$row['acta_no'].") ".ucfirst(NumeroALetras($row['acta_no']));

//El no. de folio no se maneja en la BD en estos momentos
$folio="XXX";

$fecha=strtotime($row['fecha']);
setlocale(LC_ALL, 'es_ES.UTF-8');
$fechacompleta=NumeroALetras(date("j", $fecha)).' de '.ucfirst(strftime("%B",$fecha)).' de '.NumeroALetras(date("Y", $fecha));


//Datos del solicitante
$nombrecompleto=strtoupper($row['nombre'].' '.$row['apellido']);

$edad=NumeroALetras(CalcularEdad($row['fecha_nac'], $row['fecha']));

$edo_civil=strtoupper($row['edo_civil']);

$profesion=strtoupper($row['profesion']);

if ($row['tipoid'] == 'ci')
    $idcompleto = 'de la cédula de identidad Nº '.$row['id'];
else
    $idcompleto='del pasaporte venezolano Nº '.$row['id'];


//Datos del testigo 1
$testigo1=strtoupper($row[testigo1]);

if ($row['tipoid_testigo1'] == 'ci')
    $idcompleto_testigo1 = 'de la cédula de identidad Nº '.$row['id_testigo1'];
else
    $idcompleto_testigo1='del pasaporte venezolano Nº '.$row['id_testigo1'];

$nac_testigo1=$row['nac_testigo1'];


//Datos del testigo 2
$testigo2=strtoupper($row[testigo2]);

if ($row['tipoid_testigo2'] == 'ci')
    $idcompleto_testigo2 = 'de la cédula de identidad Nº '.$row['id_testigo2'];
else
    $idcompleto_testigo2='del pasaporte venezolano Nº '.$row['id_testigo2'];

$nac_testigo2=$row['nac_testigo2'];


$fechacompleta2="En San Antonio de Los Altos, a los ".NumeroALetras(date("j", $fecha)).' días del mes de '.ucfirst(strftime("%B",$fecha)).' de '.NumeroALetras(date("Y", $fecha));


$encabezadocopia="Quien Suscribe ".$row2['nombre'].' '.$row2['apellido']." Registrador(a) Civil del Municipio Los Salias Según Resolución Nº 073/2006, publicada en Gaceta Municipal Nº 08/03, Año 23, de fecha 17 de Marzo de 2006 CERTIFICA la autenticidad del acta que a continuación se copia: ";

$cierrecopia="Es copia fiel y exacta de su original que aparece en los Libros de Nacionalidad llevados por este despacho durante el año ".
    date("Y", $fecha)." bajo el Acta Nº ".$row['acta_no']." Al folio Nº ".$folio." Que se expide ".lcfirst($fechacompleta2)." Años 1810 y 1859.";

$contenido="Acta No. ".$acta_no.", ".$autoridad.", actuando en mi carácter de Registrador(a) Civil en el Municipio Los Salias, del Estado Bolivariano de Miranda, según consta en resolución Nº 073/2006, publicada en Gaceta Municipal Nº 08/03, Año 23, de fecha 17 de Marzo de 2006, y en ejercicio de la disposición legal contenida en los artículos 5 ó 7 de la Resolución Número 081214-1137 emanada del Poder Electoral, de fecha 15 de Diciembre de 2008 y publicada en Gaceta Oficial Número 39.097, de fecha 13 de Enero de 2009, hago constar que hoy "
.$fechacompleta.", se ha presentado el(la) ciudadano(a) ".$nombrecompleto.", de Nacionalidad Venezolana por nacimiento/naturalización, de ".$edad.
" años de edad, de estado civil ".$edo_civil.", de profesión ".$profesion.", titular ".$idcompleto.", domiciliado(a) en ".$row['domicilio'].
", y expone: Declaro mi voluntad de renunciar a la nacionalidad venezolana por nacimiento/naturalización y fundo mi petición de conformidad con el artículo 36 de la Constitución de la República Bolivariana de Venezuela; 14 y 46 de la Ley de Nacionalidad y Ciudadanía. Los testigos presenciales de este acto "
.$testigo1.", de Nacionalidad ".$nac_testigo1.", titular ".$idcompleto_testigo1." y ".$testigo2.", de Nacionalidad ".$nac_testigo2.", titular "
.$idcompleto_testigo2.". Leída la presente Acta al Renunciante y a los Testigos, manifestaron todos su conformidad y en consecuencia firman. El(la) Registrador(a) Civil del Municipio Los Salias "
.$row2['nombre'].' '.$row2['apellido']." (fdo) Ilegible. El Renunciante: ".$nombrecompleto." (fdo) ilegible. Los testigos (fdos) ilegibles. La Secretaria (fdo) ilegible. ";

$contenido=$encabezadocopia.$contenido.$cierrecopia;

//Necesario para los acentos
$contenido = utf8_decode($contenido);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../images/escudo.jpg', 100, 5, 15);
$pdf->Ln(17);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Republica Bolivariana de Venezuela', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(195, 5, 'Estado Miranda', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(195, 5, 'Municipio Los Salias', 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(195, 12, 'ACTA DE RENUNCIA A LA NACIONALIDAD VENEZOLANA', 0, 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Ln(15);

//En esta celda se imprime el contenido del Acta
$pdf->MultiCell(0, 5, $contenido, 'J');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(0, 0, $autoridad, 0, 1, 'C');

$pdf->Cell(0, 10, 'Registrador(a) Civil del Municipio Los Salias del Estado Bolivariano de Miranda', 0, 0, 'C');


$pdf->Output('Acta_Renuncia_' . $nombre . '.pdf', 'I');



include "../db/cerrar_conexion.php";
?>