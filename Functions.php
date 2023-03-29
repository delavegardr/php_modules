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

	static public function getCurrentDate( $format = "Y-m-d" ){
		return date( $format );
	}

    static public function getCurrentDateTime( $format = "Y-m-d H:i:s" ){
		return date( $format, time());
	}
    
    static public function getCurrentYear(){
        return date("Y");
    }

    static public function strToDateInText( String $date ){
        $time = strtotime( $date );
        $d = date( "d", $time);
        $m = date( "F", $time);
        $y = date( "Y", $time);

        //PROVISORIO
        $mesesEng = [
            "January"   => "Enero",
            "February"  => "Febrero",
            "March"     => "Marzo",
            "April"     => "Abril",
            "May"       => "Mayo",
            "June"      => "Junio",
            "July"      => "Julio",
            "August"    => "Agosto",
            "September" => "Setiembre",
            "Octuber"   => "Octubre",
            "November"  => "Noviembre",
            "December"  => "Diciembre",
        ];

        $res = "$d de $mesesEng[$m] de $y";
        return $res;
	}

    static public function htmlToUTF8( $source ){
        $source = str_replace( '&amp;'   , '&', $source );
        $source = str_replace( '&aacute;', 'á', $source );
        $source = str_replace( '&eacute;', 'é', $source );
        $source = str_replace( '&iacute;', 'í', $source );
        $source = str_replace( '&oacute;', 'ó', $source );
        $source = str_replace( '&uacute;', 'ú', $source );
        $source = str_replace( '&Aacute;', 'Á', $source );
        $source = str_replace( '&Eacute;', 'É', $source );
        $source = str_replace( '&Iacute;', 'Í', $source );
        $source = str_replace( '&Oacute;', 'Ó', $source );
        $source = str_replace( '&Uacute;', 'Ú', $source );
        $source = str_replace( '&Nacute;', 'Ñ', $source );
        $source = str_replace( '&nacute;', 'ñ', $source );
        $source = str_replace( '&nbsp;'  , ' ', $source );
        
        return $source;
    }

}
