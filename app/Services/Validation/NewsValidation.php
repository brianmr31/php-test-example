<?php
namespace App\Services\Validation;

use Orumad\ConfigCache\Facades\ConfigCache;
use Cache;

class NewsValidation {

    public function __construct() {

    }
    public function check( $request ){
        $result['success'] = true ;
        $i = 0 ;
        $input = $request->input('title');
        if( is_null($input) ){
            $result['success'] = false ;
            $result['error'][$i] = "title is missing" ;
            $i++ ;
        }
        $input = $request->input('context');
        if( is_null($input) ){
            $result['success'] = false ;
            $result['error'][$i] = "context is missing" ;
            $i++ ;
        }
        $input = $request->input('publish');
        if( is_null($input) ){
            $result['success'] = false ;
            $result['error'][$i] = "publish is missing" ;
            $i++ ;
        }
        return $result ;
     }
}
