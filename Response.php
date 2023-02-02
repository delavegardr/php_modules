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

	static public function toJsonWithOutStatus( $data ){
		array_unshift($data,[ "totalRegistros" => count($data) ]);

		return json_encode( $data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
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
