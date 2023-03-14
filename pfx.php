<?php

class PFX {
    private $file;
    private $privateKey;
    private $publicKey;

    public function __construct($file, $password)
    {   
        $pfx = file_get_contents( $file );
        if ( !$pfx ){
            throw new Exception( "No pudo abrir el archivo pfx $file" );
        }

        openssl_pkcs12_read($pfx, $resPfxData, $password);

        if (empty($resPfxData) || !isset( $resPfxData['cert'] ) || !isset( $resPfxData['pkey'] )) {
            throw new Exception( "No se pudo cargar el certificado pfx $file" );
        }

        $this->setFile( $file );

        $pfxCert = $resPfxData['cert'];
        $pfxPKey = $resPfxData['pkey'];
        $passphrase = '';

        $this->setPrivateKey( openssl_pkey_get_private( $pfxPKey, $passphrase ) );
        $this->setPublicKey( openssl_pkey_get_details( $this->privateKey )['key'] );
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function getPublicKey()
    {
        return $this->publicKey;
    }

}
