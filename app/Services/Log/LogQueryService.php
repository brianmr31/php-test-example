<?php
namespace App\Services\Log ;

use \Log;
use Orumad\ConfigCache\Facades\ConfigCache;

class LogQueryService {

  protected $print_query = null ;

  public function __construct(){
    $this->print_query = ConfigCache::get('app.query');
    if( $this->print_query  ){
       \DB::connection()->enableQueryLog();
    }
  }

  public function printInfo(){
    if( $this->print_query ){
      $queries = \DB::getQueryLog();
      Log::info("|> ".json_encode($queries) );
      \DB::flushQueryLog();
      \DB::connection()->disableQueryLog();
    }
  }

}
