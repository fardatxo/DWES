<?php

// VARIAABLES
$dayNumber = date('w');
$dayOfMonth = date('d');    
$monthNumber = date('n');   
$year = date('Y');  
/*
switch ($dayNumber) {
    case 0: $dayName = "Domingo"; break;
    case 1: $dayName = "Lunes"; break;
    case 2: $dayName = "Martes"; break;
    case 3: $dayName = "Miércoles"; break;
    case 4: $dayName = "Jueves"; break;
    case 5: $dayName = "Viernes"; break;
    case 6: $dayName = "Sábado"; break;
    default: $dayName = "Día desconocido";
}


switch ($monthNumber) {
    case 1: $monthName = "enero"; break;
    case 2: $monthName = "febrero"; break;
    case 3: $monthName = "marzo"; break;
    case 4: $monthName = "abril"; break;
    case 5: $monthName = "mayo"; break;
    case 6: $monthName = "junio"; break;
    case 7: $monthName = "julio"; break;
    case 8: $monthName = "agosto"; break;
    case 9: $monthName = "septiembre"; break;
    case 10: $monthName = "octubre"; break;
    case 11: $monthName = "noviembre"; break;
    case 12: $monthName = "diciembre"; break;
    default: $monthName = "mes desconocido";
}
*/

$dia = date('w');
$mes = date('d'); 

$dia = ['Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo'];
$mes = ['January' => 'enero','February' => 'febrero','March' => 'marzo','April' => 'abril','May' => 'mayo','June'      => 'junio','July'      => 'julio', 'August'    => 'agosto','September' => 'septiembre','October'   => 'octubre','November'  => 'noviembre','December'  => 'diciembre'];

?>

<footer>
    
    <p>
        <?php echo ''.$dia[date('l')].','.date('d').'  de '.$mes[date('F')].' de '.date('Y'); ?>
    </p>
</footer>
