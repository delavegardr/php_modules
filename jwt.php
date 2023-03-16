<?php

require_once "vendor/autoload.php";

/******************
 * INSTRUCCIONES
 * 
 * Documentación: https://github.com/firebase/php-jwt
 * Firebase\JWT Deben instalarlo con composer -> composer require firebase/php-jwt
 *****************/

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class IJWT {
    private $algoritmo;
    private $secretkey;

    public function __construct( $algoritmo, $secretkey ){ 
        $this->algoritmo = $algoritmo;
        $this->secretkey = $secretkey;
    }

    
    public function getAlgoritmo(){
        return $this->algoritmo;
    }

    public function getSecretkey(){
        return $this->secretkey;
    }

    public function getTtl(){
        return $this->ttl;
    }

    private function getPayload( $data, $ttl ){
        $time = time();
        
        $payload = [
            "iat"  => $time,
            "exp"  => $time + $ttl,
            "data" => $data,
        ];

        return $payload;
    }

    public function generate( $data, $ttl ){
        $payload = $this->getPayload( $data, $ttl );

        $res = JWT::encode( $payload, $this->getSecretkey(), $this->getAlgoritmo() );
        return $res;
    }
    
    public function generateAndSign( $data, $ttl ){
        $token = $this->generate( $data, $ttl );
        $tokenSign = JWT::sign( $token, $this->getSecretkey(), $this->getAlgoritmo() );
        
        return $tokenSign;
    }

    public function decode( $token, $publicKey ){
        try {
            $decoded = JWT::decode( $token, new Key( $publicKey, $this->getAlgoritmo() ));
        } catch (ExpiredException $e) {
            log_message( 'error', $e->getMessage() );
            return false;
        } catch (SignatureInvalidException $e ) {
            log_message( 'error', $e->getMessage() );
            return false;
        } catch (UnexpectedValueException $e ) {
            log_message( 'error', $e->getMessage() );
            return false;
        }

        return $decoded;
    }

}