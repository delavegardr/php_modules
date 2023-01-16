<?php

class Functions {

    static public function formatFloat($nro, $cantDec){
        return number_format($nro, $cantDec);
    }

    static public function truncFraction( $nro, $cantAfterComa ){
        //REDONDEO A 2 DECIMALES
        $factor = pow(10, $cantAfterComa); //pow = potencia, 10 ^ $cantAfterComa
        $nroAux = round($nro * $factor);
        $res = $nroAux / $factor;
        
        return $res;
    }

    static public function secondsToHours( $cantSeg ){
        //LO PASO DE SEGUNDOS A MIN
        $totalMin = $cantSeg / 60;

        //CALCULO CUANTAS HORAS SON (LA PARTE ENTERA SON LAS HORAS)
        $horas = ($totalMin / 60);
        $cantHor = number_format( $horas , 0);
        
        $cantMin = $totalMin % 60;
        
        $totalHoras = $cantHor + ( $cantMin / 100 );
        
        return $totalHoras;
    }

    static public function getCurrentYear(){
        return date("Y");
    }

}