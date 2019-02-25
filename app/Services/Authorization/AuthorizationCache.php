<?php
namespace App\Services\Authorization;

use App\Models\Galleris;

use Orumad\ConfigCache\Facades\ConfigCache;
use Cache;

class AuthorizationCache {

    protected $authorizationService = null ;
    protected $cache_lifetime = 10000 ;
    protected $cache_run = true ;
    protected $auth_run = true ;

    public function __construct() {
        $this->authorizationService = app()->make('AuthorizationService');
    }

    public function getAuthorization($id_role, $name_access, $arrRole){
        $arrIdRole = null ;
        if($this->auth_run == false){
          return true;
        }
        if( $this->cache_run ){
          $arrIdRole = Cache::tags(['getAuthorization'])->get('getAuthorization:nmAc'.$name_access);
          if( is_null( $arrIdRole ) ){
              $arrIdRole = Cache::tags(['getAuthorization'])->remember('getAuthorization:nmAc'.$name_access,
                $this->cache_lifetime, function() use ( $name_access, $arrRole) {
                return $this->authorizationService->getInit( $name_access, $arrRole);
              });
          }
        }else{
          $arrIdRole = $this->authorizationService->getInit($name_access, $arrRole);
        }
        return $this->authorizationService->getAuthorization($id_role, $arrIdRole);
    }

    public function getUserFromToken( $token, $platfrom, $device){
        $user = null ;
        if( $this->cache_run ){
          $user = Cache::tags(['getUserFromToken'])->get('getUserFromToken:token'.$token.'device:'.json_encode($device));
          if( is_null( $user ) ){
              $user = Cache::tags(['getUserFromToken'])->remember('getUserFromToken:token'.$token.'device:'.json_encode($device),
                $this->cache_lifetime, function() use ( $token, $platfrom, $device) {
                return $this->authorizationService->getUserFromToken( $token, $platfrom, $device);
              });
          }
        }else{
          $user = $this->authorizationService->getUserFromToken( $token, $platfrom, $device);
        }
        return $user;
    }
}
