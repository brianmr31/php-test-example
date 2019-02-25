<?php
namespace App\Services\Authorization;

use App\Models\Access;
use App\Models\RoleAccess;
use App\Models\Roles;
use App\Models\Tokens;

use Orumad\ConfigCache\Facades\ConfigCache;
use Cache;

class AuthorizationService {

    // protected $logData = null ;
    // protected $logQuery = null ;
    protected $tools = null ;

    public function __construct() {
        // $this->logData = app()->make('LogDataService');
        // $this->logQuery = app()->make('LogQueryService');
        $this->tools = app()->make('ToolService');
    }

    public function getInit($name_access, $arrRole){
        $arrIdRole = null ;
        $roleAccess = null ;

        $access = Access::where('name_access', $name_access)->first();
        if( is_null($access) ){
            $paramsAccess['name_access'] = $name_access ;
            $access = Access::create($paramsAccess);
        }

        $count = count($arrRole) ;
        for($i = 0; $i < $count; $i++) {
            $role = Roles::where('name_role', $arrRole[$i])->first();
            if( is_null($role) ){
                $paramsRole['name_role'] = $arrRole[$i] ;
                $role = Roles::create($paramsRole);
            }
            $roleAccess = RoleAccess::where('id_role', $role->id_role)->where('id_access', $access->id_access)->first();
            if( is_null($roleAccess) ){
                $paramsRoleAccess['id_role'] = $role->id_role;
                $paramsRoleAccess['id_access'] = $access->id_access;
                $roleAccess = RoleAccess::create($paramsRoleAccess);
            }
            $arrIdRole[$i] = $role->id_role;
        }
        return $arrIdRole ;
    }
    public function getAuthorization($id_role, $arrIdRole){
        $authorization = false ;
        if( in_array($id_role, $arrIdRole) ){
            $authorization = true ;
        }
        return $authorization ;
    }
    public function getUserFromToken($token, $platfrom, $device){
        $token = Tokens::where('token', $token)->where('platform',$platfrom)->where('device',$device)->first();
        if( is_null($token) ){
          return null ;
        }
        if( $token->exp_at < $this->tools->getCurrentTime() ){
          return null ;
        }
        return $token->user ;
    }
}
