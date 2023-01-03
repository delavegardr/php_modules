<?php

/* CLASE ESTATICA QUE IMPLEMENTA LA LOGICA DE LOS JOINS DE SQL */
/* LOS ARRAYS (sets) QUE SE PASAN DEBEN SER ARRAYS INDEXADOS QUE CONTIENEN OBJETOS */ 

/* POR EL MOMENTO SE TRABAJA CON DOS CONJUNTOS */

class QuerySqlPhysical {

    /* RETORNA UN NUEVO ARREGLO CON TODOS LOS ELEMENTOS QUE SE ENCUENTREN EN LA INTERSECCION DE AMBOS CONJUNTOS */
    public static function JOIN( $setA = [], $setB = [], $onA = '', $onB = '' ){

        if ( (count($setA) == 0) || (count($setB) == 0) || ($onA == '') || ($onB == '') ){
            return [];
        }

        $resJoinSet = [];
        foreach( $setA as $itemA ){
            if ( property_exists($itemA, $onA) ){
                
                $ocurrencia = 0;
                foreach( $setB as $itemB ){
                    if ( property_exists($itemB, $onB) ){ 
                        
                        if ($itemA->$onA == $itemB->$onB){
                            $property = $onA;
                            if ( $ocurrencia > 0 ){
                                $property .= '_' .$ocurrencia;
                            }
                            $itemA->$property = $itemB;
                            
                            $resJoinSet[] = $itemA;

                            $ocurrencia++;
                        }

                    }  
                }

            }
        }    

        return $resJoinSet;
    }   

    /* RETORNA UN NUEVO ARREGLO CON TODOS LOS ELEMENTOS DEL CONJUNTO A Y SI EXISTE EL MATCH EN LOS ELEMENTOS DEL CONJUNTO B LOS AGREGA AL RESULTADO */
    public static function LEFT_JOIN( $setA = [], $setB = [], $onA = '', $onB = '' ){

        if ( (count($setA) == 0) ){
            return [];
        }

        if ( ($onA == '') || ($onB == '') ){
            return $setA;
        }

        $resJoinSet = [];
        foreach( $setA as $itemA ){
            if ( property_exists($itemA, $onA) ){
                
                $ocurrencia = 0;
                foreach( $setB as $itemB ){
                    if ( property_exists($itemB, $onB) ){ 
                        
                        if ($itemA->$onA == $itemB->$onB){
                            $property = $onA;
                            if ( $ocurrencia > 0 ){
                                $property .= '_' .$ocurrencia;
                            }
                            $itemA->$property = $itemB;
                        
                            $ocurrencia++;
                        }

                    }  
                }

            }

            $resJoinSet[] = $itemA;
        }    

        return $resJoinSet;
    }    

}