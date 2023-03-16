<?php

class Response {

    static private function setHeader(){
        header('Content-Type: application/json; charset=utf-8');
    }

    static public function toJson( $data ){
        Response::setHeader();
        return json_encode( $data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

    static public function toJsonWithStatus( $ok, $description, $data ){
        $data = [
            "ok" => $ok,
            "description" => $description,
            "data" => $data,
        ];

        Response::setHeader();
        return json_encode( $data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

	static public function toJsonWithCountData( $data ){
        array_unshift( $data, [ "totalRegistros" => count($data) ] );

        Response::setHeader();
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
