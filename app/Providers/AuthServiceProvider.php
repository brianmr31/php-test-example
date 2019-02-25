<?php

namespace App\Providers;

use App\Models\Users;
use App\Services\Utils\AuthUtilService;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use Cache;

class AuthServiceProvider extends ServiceProvider {

    protected $authTools = null ;
    protected $authorizationCache = null ;
    protected $cache_run ;
    protected $cache_lifetime ;

    public function register()  {
        $this->authTools = app()->make('AuthUtilService'); // new AuthUtilService();
        $this->authorizationCache = app()->make('AuthorizationCache'); // new AuthUtilService();
        $this->cache_run      = false ;
        $this->cache_lifetime = 10000 ;
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot() {
        $this->app['auth']->viaRequest('api', function ($request) {

            $platfrom = $this->authTools->getPlatform($request) ;
            $device = $this->authTools->getRealIpAddr($request) ;

            $headerAuthorization = $request->header('Authorization') ;
            $token = explode(" ", $headerAuthorization );
            if( count($token) == 2 ){
                if ($token[0]=="Basic" ) {
                   $result = $this->authTools->decrypt($token[1]);
                   if($result){
                       if( true ){
                           $cache = Cache::get("token".$token[1]);
                           if( $cache ){
                               return $cache ;
                           }
                           return Cache::remember("token".$token[1], $this->cache_lifetime,
                             function() use ( $token, $platfrom, $device ) {
                                return $this->authorizationCache->getUserFromToken( $token[1], $platfrom, $device) ;
                           });
                       }else{
                           return $this->authorizationCache->getUserFromToken( $token[1], $platfrom, $device) ;
                      }
                   }
                }
            }
        });
    }
}
