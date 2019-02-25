<?php

namespace App\Services\Utils;

use \Auth;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class AuthUtilService {

    protected $tools = null;

    public function __construct() {
        $this->tools = app()->make('ToolService');
    }
    public function getIdUser(){
      $id_user = null ;
      if( is_null( Auth::user() ) ){
        $id_user = null;
      }else {
        $id_user = Auth::user()->id_user ;
      }
      return $id_user;
    }
    public function getIdRole(){
      $id_role = null ;
      if( is_null( Auth::user() ) ){
        $id_role = null;
      }else {
        $id_role = Auth::user()->id_role ;
      }
      return $id_role;
    }
    public function hashSha256($data){
        return hash("sha256",$data);
    }

public function getPublicKey(){
  $pubkey = <<< EOF
-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMJa3MzjKQgORw68i9RWfxIsVKEDDGil
0TVcwMddr3DFXnq/w3mD2yLHTjCYHuxF7LckXb8eic3/X583jfixOR8CAwEAAQ==
-----END PUBLIC KEY-----
EOF;
  return $pubkey ;
}
public function getPrivateKey(){
  $privkey = <<< EOF
-----BEGIN PRIVATE KEY-----
MIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAwlrczOMpCA5HDryL
1FZ/EixUoQMMaKXRNVzAx12vcMVeer/DeYPbIsdOMJge7EXstyRdvx6Jzf9fnzeN
+LE5HwIDAQABAkB9vAaoTjVXTtVNhVD419RxT1iYqb43XT7RROY6lDNRwl1R4HCy
mlZ/+WFr/KkFrPADfrPY5egMwTdSv8O33bYhAiEA4Zehwo84cZlByad8FUsp+LrD
TFcc7K9t8IPfTUiskIcCIQDcjVev9pTsrl3EXHzxFrrmWXHk1gVBRvFXafDtYI+w
qQIhAME4xAdF7p12HCAhgSkn4QI2zTIk5xReyfaYrPmgBpYfAiEAw/EOplX7mQqQ
Y5OHrOj0wxFUDmnV4ViVsYN9eGcBQYECIHbKrqH2vs1YunIJEEyxd5DnqfpOQbG0
WWUBlefAcwnK
-----END PRIVATE KEY-----
EOF;
  return $privkey ;
}
    public function generateRandomString($length){
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charsLength = strlen($characters) -1;
        $string = "";
        for($i=0; $i<$length; $i++){
            $randNum = mt_rand(0, $charsLength);
            $string .= $characters[$randNum];
        }
        return $string;
    }
    public function encrypt(String $positionId){
        openssl_public_encrypt(
          $positionId.$this->generateRandomString(31).$this->tools->getCurrentTime(),
          $crypted,
          $this->getPublicKey());
        $base64encode = base64_encode($crypted);
        return $base64encode;
    }
    public function decrypt($base64encode){
        $base64decode = base64_decode($base64encode);
        openssl_private_decrypt($base64decode, $decrypted, $this->getPrivateKey());
        if(is_null($decrypted)){
          return false;
        }
        return true;
    }
    public function getRoleId($base64encode){
        $base64decode = base64_decode($base64encode);
        openssl_private_decrypt($base64decode, $decrypted, $this->getPrivateKey());
        if(is_null($decrypted)){
          return "0" ;
        }
        return $decrypted[0];
    }
    public function getRealIpAddr( $request ){
      $iparr = explode(",", $request->header("X-Forwarded-For") );
      return $iparr[0] ;
    }
    public function getPlatform( $request ){
      return $request->header("User-Agent") ;
    }

    public function getRoleAdmin(){
      return ['admin'];
    }
    public function getRoleClient(){
      return ['client'];
    }
    public function getRoleBoth(){
      return ['admin','client'];
    }
}
