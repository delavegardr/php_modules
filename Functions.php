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
        $source = str_replace( '&lt;','<',$source );
        $source = str_replace( '&gt;','>',$source );
        $source = str_replace( '&apos;',"'",$source );
        $source = str_replace( '&ordm;','°',$source );
        $source = str_replace( '&micro;','µ',$source );

        //Tabla de entidades html segun https://www.htmlhelp.com/reference/html40/entities/symbols.html
        $source = str_replace( '&fnof;','ƒ',$source );
        $source = str_replace( '&Alpha;','Α',$source );
        $source = str_replace( '&Beta;','Β',$source );
        $source = str_replace( '&Gamma;','Γ',$source );
        $source = str_replace( '&Delta;','Δ',$source );
        $source = str_replace( '&Epsilon;','Ε',$source );
        $source = str_replace( '&Zeta;','Ζ',$source );
        $source = str_replace( '&Eta;','Η',$source );
        $source = str_replace( '&Theta;','Θ',$source );
        $source = str_replace( '&Iota;','Ι',$source );
        $source = str_replace( '&Kappa;','Κ',$source );
        $source = str_replace( '&Lambda;','Λ',$source );
        $source = str_replace( '&Mu;','Μ',$source );
        $source = str_replace( '&Nu;','Ν',$source );
        $source = str_replace( '&Xi;','Ξ',$source );
        $source = str_replace( '&Omicron;','Ο',$source );
        $source = str_replace( '&Pi;','Π',$source );
        $source = str_replace( '&Rho;','Ρ',$source );
        $source = str_replace( '&Sigma;','Σ',$source );
        $source = str_replace( '&Tau;','Τ',$source );
        $source = str_replace( '&Upsilon;','Υ',$source );
        $source = str_replace( '&Phi;','Φ',$source );
        $source = str_replace( '&Chi;','Χ',$source );
        $source = str_replace( '&Psi;','Ψ',$source );
        $source = str_replace( '&Omega;','Ω',$source );
        $source = str_replace( '&alpha;','α',$source );
        $source = str_replace( '&beta;','β',$source );
        $source = str_replace( '&gamma;','γ',$source );
        $source = str_replace( '&delta;','δ',$source );
        $source = str_replace( '&epsilon;','ε',$source );
        $source = str_replace( '&zeta;','ζ',$source );
        $source = str_replace( '&eta;','η',$source );
        $source = str_replace( '&theta;','θ',$source );
        $source = str_replace( '&iota;','ι',$source );
        $source = str_replace( '&kappa;','κ',$source );
        $source = str_replace( '&lambda;','λ',$source );
        $source = str_replace( '&mu;','μ',$source );
        $source = str_replace( '&nu;','ν',$source );
        $source = str_replace( '&xi;','ξ',$source );
        $source = str_replace( '&omicron;','ο',$source );
        $source = str_replace( '&pi;','π',$source );
        $source = str_replace( '&rho;','ρ',$source );
        $source = str_replace( '&sigmaf;','ς',$source );
        $source = str_replace( '&sigma;','σ',$source );
        $source = str_replace( '&tau;','τ',$source );
        $source = str_replace( '&upsilon;','υ',$source );
        $source = str_replace( '&phi;','φ',$source );
        $source = str_replace( '&chi;','χ',$source );
        $source = str_replace( '&psi;','ψ',$source );
        $source = str_replace( '&omega;','ω',$source );
        $source = str_replace( '&thetasym;','ϑ',$source );
        $source = str_replace( '&upsih;','ϒ',$source );
        $source = str_replace( '&piv;','ϖ',$source );
        $source = str_replace( '&bull;','•',$source );
        $source = str_replace( '&hellip;','…',$source );
        $source = str_replace( '&prime;','′',$source );
        $source = str_replace( '&Prime;','″',$source );
        $source = str_replace( '&oline;','‾',$source );
        $source = str_replace( '&frasl;','⁄',$source );
        $source = str_replace( '&weierp;','℘',$source );
        $source = str_replace( '&image;','ℑ',$source );
        $source = str_replace( '&real;','ℜ',$source );
        $source = str_replace( '&trade;','™',$source );
        $source = str_replace( '&alefsym;','ℵ',$source );
        $source = str_replace( '&larr;','←',$source );
        $source = str_replace( '&uarr;','↑',$source );
        $source = str_replace( '&rarr;','→',$source );
        $source = str_replace( '&darr;','↓',$source );
        $source = str_replace( '&harr;','↔',$source );
        $source = str_replace( '&crarr;','↵',$source );
        $source = str_replace( '&lArr;','⇐',$source );
        $source = str_replace( '&uArr;','⇑',$source );
        $source = str_replace( '&rArr;','⇒',$source );
        $source = str_replace( '&dArr;','⇓',$source );
        $source = str_replace( '&hArr;','⇔',$source );
        $source = str_replace( '&forall;','∀',$source );
        $source = str_replace( '&part;','∂',$source );
        $source = str_replace( '&exist;','∃',$source );
        $source = str_replace( '&empty;','∅',$source );
        $source = str_replace( '&nabla;','∇',$source );
        $source = str_replace( '&isin;','∈',$source );
        $source = str_replace( '&notin;','∉',$source );
        $source = str_replace( '&ni;','∋',$source );
        $source = str_replace( '&prod;','∏',$source );
        $source = str_replace( '&sum;','∑',$source );
        $source = str_replace( '&minus;','−',$source );
        $source = str_replace( '&lowast;','∗',$source );
        $source = str_replace( '&radic;','√',$source );
        $source = str_replace( '&prop;','∝',$source );
        $source = str_replace( '&infin;','∞',$source );
        $source = str_replace( '&ang;','∠',$source );
        $source = str_replace( '&and;','∧',$source );
        $source = str_replace( '&or;','∨',$source );
        $source = str_replace( '&cap;','∩',$source );
        $source = str_replace( '&cup;','∪',$source );
        $source = str_replace( '&int;','∫',$source );
        $source = str_replace( '&there4;','∴',$source );
        $source = str_replace( '&sim;','∼',$source );
        $source = str_replace( '&cong;','≅',$source );
        $source = str_replace( '&asymp;','≈',$source );
        $source = str_replace( '&ne;','≠',$source );
        $source = str_replace( '&equiv;','≡',$source );
        $source = str_replace( '&le;','≤',$source );
        $source = str_replace( '&ge;','≥',$source );
        $source = str_replace( '&sub;','⊂',$source );
        $source = str_replace( '&sup;','⊃',$source );
        $source = str_replace( '&nsub;','⊄',$source );
        $source = str_replace( '&sube;','⊆',$source );
        $source = str_replace( '&supe;','⊇',$source );
        $source = str_replace( '&oplus;','⊕',$source );
        $source = str_replace( '&otimes;','⊗',$source );
        $source = str_replace( '&perp;','⊥',$source );
        $source = str_replace( '&sdot;','⋅',$source );
        $source = str_replace( '&lceil;','⌈',$source );
        $source = str_replace( '&rceil;','⌉',$source );
        $source = str_replace( '&lfloor;','⌊',$source );
        $source = str_replace( '&rfloor;','⌋',$source );
        $source = str_replace( '&lang;','⟨',$source );
        $source = str_replace( '&rang;','⟩',$source );
        $source = str_replace( '&loz;','◊',$source );
        $source = str_replace( '&spades;','♠',$source );
        $source = str_replace( '&clubs;','♣',$source );
        $source = str_replace( '&hearts;','♥',$source );
        $source = str_replace( '&diams;','♦',$source );
        
        return $source;
    }

    static public function setDateFormat ( $date ){
        return date( 'd/m/Y H:i:s', strtotime($date) );
    }
    
}
