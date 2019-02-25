<?php
namespace App\Services\Log ;

use \Auth;
use \Log;
use Orumad\ConfigCache\Facades\ConfigCache;

class LogDataService {

    protected $print_log ;

    public function getUser(){
      $user = null ;
      if( is_null( Auth::user() ) ){
        $user = "internet";
      }else {
        $user = Auth::user()->fullname ;
      }
      return $user;
    }

    public function __construct(){
      $this->print_log = ConfigCache::get('app.log');
    }
    public function printInfo( $data ){
      if( $this->print_log ){
        Log::info("|>".$this->getUser()."|-|".$data);
      }
    }

  }
