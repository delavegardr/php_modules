<?php

class Response {

    static public function CORSEnable(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }
    
    static private function setHeader(){
        header('Content-Type: application/json; charset=utf-8');
    }

    static public function toJson( $data ){
        Response::setHeader();
        Response::CORSEnable();
        //SE PUEDE AGREGAR EL PARAMETRO JSON_FORCE_OBJECT PARA QUE LO DEVUELVA COMO UN OBJETO Y NO COMO UN ARRAY
        return json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

    static public function toJsonError( $statusCode, $msg ){
        Response::setHeader();
        Response::CORSEnable();
        http_response_code( $statusCode );

        $data["errorCode"] = $statusCode;
        $data["errorText"] = $msg;

        //SE PUEDE AGREGAR EL PARAMETRO JSON_FORCE_OBJECT PARA QUE LO DEVUELVA COMO UN OBJETO Y NO COMO UN ARRAY
        return json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

    static public function toJsonWithStatus( $ok, $description, $data ){
        $data = [
            "ok" => $ok,
            "description" => $description,
            "data" => $data,
        ];

        Response::setHeader();
        Response::CORSEnable();

        //SE PUEDE AGREGAR EL PARAMETRO JSON_FORCE_OBJECT PARA QUE LO DEVUELVA COMO UN OBJETO Y NO COMO UN ARRAY
        return json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

	static public function toJsonWithCountData( $data ){
        array_unshift( $data, [ "totalRegistros" => count($data) ] );

        Response::setHeader();
        Response::CORSEnable();

        //SE PUEDE AGREGAR EL PARAMETRO JSON_FORCE_OBJECT PARA QUE LO DEVUELVA COMO UN OBJETO Y NO COMO UN ARRAY
		return json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
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
