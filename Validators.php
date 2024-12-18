<?php

class Validator {

    static public function isARut( String $rut ): bool{
        //El 9no y 10mo digito deben ser 0.
        //La tira formada por la concatenación de los digitos del 3 al 8 debe ser distinta de '000000'.
        //El nro formado por los 2 primeros digitos debe ser mayor que 0 y menor que 22.
        //Luego se multiplica uno a uno los digitos del rut contra los digitos del patron (el 12vo digito no es necesario que se multiplique).
        //Se suman todos los digitos del paso anterior.
        //Luego se deduce el 12vo digito y se verifica contra el 12vo digito que se paso por parametro.

        $patron = [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        
        $rut = str_split( $rut );
        if ( !(count($rut) == 12) ){
            return false;
        }
        //Transformo los elementos a enteros para poder comenzar a verificar los digitos       
        $v = [ 
            intval($rut[0]), 
            intval($rut[1]), 
            intval($rut[2]), 
            intval($rut[3]), 
            intval($rut[4]), 
            intval($rut[5]), 
            intval($rut[6]), 
            intval($rut[7]), 
            intval($rut[8]), 
            intval($rut[9]), 
            intval($rut[10]),
            intval($rut[11]),
        ];

        if ( $v[8] <> 0 ){
            return false;
        }
        if ( $v[9] <> 0 ){
            return false;
        }   
        
        $digitos = $rut[2] . $rut[3] . $rut[4] . $rut[5] . $rut[6] . $rut[7];
        if ($digitos == '000000') {
            return false;
        }   

        $d = ( $v[0] * 10 ) + $v[1];
        if ( ($d < 1) || ($d > 22) ){
            return false;
        }   

        for ($i=0; $i < count( $v ) - 1; $i++) { 
            $v[$i] = ($v[$i] * $patron[$i]);
        }
        
        $x = 0;
        for ($i=0; $i <= 10; $i++) { 
            $x = $x + $v[$i];
        }

        //Deduzco el 12vo digito
        $r = $x % 11;
        $x = 11 - $r;

        if ( $x < 10 ) {
            $digitoVer = $x;
        } else {
            if ( $x = 11 ) {
                $digitoVer = 0;
            } else {
                $digitoVer = -1;
            }
        }

        return ($digitoVer == $rut[11]);
    }

    static public function isACI( String $ci ): bool{
        /*
        Se toman los 7 números de la cédula y se multiplican cada uno por 2987634 (este es el codigo base de las cedulas uruguayas)
        uno a uno (el primer número por el 2, el segundo por el 9 y así sucesivamente, cuando cada
        resultado supera un dígito, se toma sólo la unidad). Ej: C.I.: 1.234.567-x -> 2987634 -> 2, 8, 4, 8, 0, 8, 8
        Se hace la sumatoria de los resultados, en el ejemplo sería 2+8+4+8+0+8+8=38
         Se busca el primer numero más grande que 38 que termina en 0 y se le resta: 40-38= 2
         (es lo mismo que 10-(38 mod 10)). Es x=2 pues, el dígito verificador para la cédula 1.234.567.
        */
        // a1*10 es todo el numero menos la unidad ya q se desplaza un numero hacia la izq.
        //solo lo resto al anterior, asi hago con todos los numeros
        
        //Genero un array con el patron ya que voy a utilizar cada digito '2987634';
        $patron = [ 2,9,8,7,6,3,4 ];

        //Genero un array con cada digito de la CI
        $ci = str_split( $ci );

        //Relleno con 0 a la izq
        while ( count($ci) < 8 ) {
            array_unshift( $ci, 0 );
        }

        $vb1 = number_format( intval($ci[0]) * $patron[0], 0 );
        $vb2 = number_format( intval($ci[1]) * $patron[1], 0 );
        $vb3 = number_format( intval($ci[2]) * $patron[2], 0 );
        $vb4 = number_format( intval($ci[3]) * $patron[3], 0 );
        $vb5 = number_format( intval($ci[4]) * $patron[4], 0 );
        $vb6 = number_format( intval($ci[5]) * $patron[5], 0 );
        $vb7 = number_format( intval($ci[6]) * $patron[6], 0 );
        
        //Tomo la unidad de cada resultado anterior
        $b1 = ($vb1 % 10); 
        $b2 = ($vb2 % 10);
        $b3 = ($vb3 % 10);
        $b4 = ($vb4 % 10);
        $b5 = ($vb5 % 10);
        $b6 = ($vb6 % 10);
        $b7 = ($vb7 % 10);
       
        //Hago la sumatoria de todas las unidades obtenidas
        $sum1 = $b1 + $b2 + $b3 + $b4 + $b5 + $b6 + $b7;
        //Me acerco al nro que termina en 0 pero utilizo la formula con el modulo
        $mod = ($sum1 % 10);
        //Obtengo el dig verificador
        $digVerificador = abs(10 - $mod);
        //verificador := (verificador mod 10); //Esto se hacia en el caso que el digito verificador = 10 porque el $mod = 0. Se trata de solucionar agregando 0s a la izq del array $ci.
        $digVerificadorDado = $ci[ count($ci) - 1 ];

        return $digVerificadorDado == $digVerificador;
    }
}