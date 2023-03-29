<?php

class Request {

    static private function makeHeaders( $headers ){
        $resHeaders = [];
        foreach ($headers as $key => $value) {
            $resHeaders[] = $key . ': ' . $value;
        }

        return $resHeaders;
    }

    static public function get( String $url, array $data, array $headers = [] ){
        $headers = Request::makeHeaders( $headers );
        $params = http_build_query($data);

        if ( !empty($params) ){
            $url .= '?' . $params;
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ( count($headers) > 0 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    static public function post( String $url, array $data, array $headers = [] ){
        $strHeaders = Request::makeHeaders( $headers );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ( count($headers) > 0 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $strHeaders);
        }
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $data ) );
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}