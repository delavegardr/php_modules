<?php

class Response {

    static public function toJson( $ok, $description, $data ){
        $data = [
            "ok" => $ok,
            "description" => $description,
            "data" => $data,
        ];

        return json_encode( $data );
    }

    static public function toXml( $ok, $description, $data ){
        $data = [
            "ok" => $ok,
            "description" => $description,
            "data" => $data,
        ];

        return false; //HAY QUE IMPLEMENTARLA 
    }

}
