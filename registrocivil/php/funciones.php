<?php

 function CalcularEdad($fecha_n,$fecha) {
     
    $y=date('Y', strtotime($fecha));
    $m=date('n', strtotime($fecha));
    $d=date('j', strtotime($fecha));
    //$y = date('Y');
    //$m = date('n');
    //$d = date('j');
    list($yr, $mo, $day) = explode('-', $fecha_n);
    $now = ($y * 10000 + $m * 100 + $d);
    $past = ($yr * 10000 + $mo * 100 + $day);
    $diff = ($past - $now);
    if ($diff > 0) {
        $edad = 0;
    } else {
        $edad = (($y - $yr) - 1);
        if (($m > $mo) || (($m >= $mo) && ($d >= $day))) {
            $edad++;
        }
    }
    return $edad;
}

function NumeroALetras($n) {

    $cent = array(
        1 => 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
        'quinientos', 'seiscientos', 'setecientos', 'ochocientos',
        'novecientos');

    $dec = array('', '', '', 'treinta', 'cuarenta', 'cincuenta',
        'sesenta', 'setenta', 'ochenta', 'noventa');

    $uni = array('', ' y un', ' y dos', ' y tres', ' y cuatro',
        ' y cinco', ' y seis', ' y siete', ' y ocho', ' y nueve');



    for ($i = 0; $i < 100; $i++) {

        $d = (int) ($i / 10);

        $u = $i % 10;

        $num[$i] = $dec[$d] . $uni[$u];
    }



    $num[0] = '';

    $num[1] = 'un';

    $num[2] = 'dos';

    $num[3] = 'tres';

    $num[4] = 'cuatro';

    $num[5] = 'cinco';

    $num[6] = 'seis';

    $num[7] = 'siete';

    $num[8] = 'ocho';

    $num[9] = 'nueve';

    $num[10] = 'diez';

    $num[11] = 'once';

    $num[12] = 'doce';

    $num[13] = 'trece';

    $num[14] = 'catorce';

    $num[15] = 'quince';

    $num[16] = 'dieciseis';

    $num[17] = 'diecisiete';

    $num[18] = 'dieciocho';

    $num[19] = 'diecinueve';

    $num[20] = 'veinte';

    $num[21] = 'veintiun';

    $num[22] = 'veintidos';

    $num[23] = 'veintitres';

    $num[24] = 'veinticuatro';

    $num[25] = 'veinticinco';

    $num[26] = 'veintiseis';

    $num[27] = 'veintisiete';

    $num[28] = 'veintiocho';

    $num[29] = 'veintinueve';

    $num[30] = 'treinta';

    $num[40] = 'cuarenta';

    $num[50] = 'cincuenta';

    $num[60] = 'sesenta';

    $num[70] = 'setenta';

    $num[80] = 'ochenta';

    $num[90] = 'noventa';

    $num[100] = 'cien';



    if ($n <= 100) {

        return $num[$n];
    } else if ($n < 1000) {

        $c = (int) ($n / 100);

        return("$cent[$c] " . NumeroALetras($n % 100));
    } else if ($n < 1000000) {

        $c = (int) ($n / 1000);

        $p = NumeroALetras($c);

        return("$p mil " . NumeroALetras($n % 1000));
    } else {

        $c = (int) ($n / 1000000);

        $p = NumeroALetras($c);

        $q = ($p == 'un') ? 'millón' : 'millones';

        return("$p $q " . NumeroALetras($n % 1000000));
    }
}

?>
