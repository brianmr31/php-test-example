<?php

namespace App\Services\Utils;

use Spatie\ImageOptimizer\OptimizerChainFactory;

class ToolService {

    public function __construct() {

    }
    public function getDefaultData($request, $id_model){
        $arrReq = [] ;
        $size = $request->input('size');
        if( is_null($size) ){
          $arrReq[0] = 10 ;
        }
        $sort = $request->input('sort');
        if( is_null($sort) ){
          $arrReq[1] = $id_model ;
        }
        $by = $request->input('by');
        if( is_null($by) ){
          $arrReq[2] = 'ASC' ;
        }
        $column = $request->input('column');
        if( is_null($column) ){
          $arrReq[3] = null ;
        }
        $code = $request->input('code');
        if( is_null($code) ){
          $arrReq[4] = null ;
        }
        return $arrReq ;
    }
    public function orderBy($results, $sortBy, $direction ) {
      $results->orderBy($sortBy, $direction);
      return $results ;
    }

    public function whereLike($results, $column, $code, $size ){
      if( $column != null && $code != null ){
          $arrColumn = explode(',',$column);
          $arrCode = explode(',',$code);
          if( ( count($arrColumn) > 1 && count($arrCode) > 1 ) && (count($arrColumn) == count($arrCode)) ){
              $results = $results->WhereNull('deleted_at');
              for($i =0; $i < count($arrColumn); $i++ ){
                $code = "%".$arrCode[$i]."%";
                $results = $results->where($arrColumn[$i],'LIKE',$code);
              }
              $results = $results->paginate($size);
          }else{
              $code = "%".$code."%";
              $results = $results->WhereNull('deleted_at')->where($column,'LIKE',$code)->paginate($size);
          }
      }else{
          $results = $results->WhereNull('deleted_at')->paginate($size);
      }
      return $results ;
    }

    public function createAlias( $input ){
      return preg_replace('/\s+/', '-', $input); ;
    }

    public function saveImage($path, $file, $name){
      $optimizerChain = OptimizerChainFactory::create();
      $file->move($path,$name);
      $optimizerChain->optimize($path.$name);
    }
    public function generateKodePembayaran($data){
      $count= $data + 1 ;
      $test = '';
      //return array( 'code' => 6-strlen($getkodepem['count']) );
      for($i=1;$i <= (6-strlen($count));$i++){
          $test = '0'.$test;
      }
      return date('dmy').$test.$count ;
    }
    public static function getCurrentTime(){
      return date("Y-m-d H:i:00");
    }
    public static function getDateAddDay(String $day, $date ){
      return date ("Y-m-d H:i:00",strtotime ( $day.' day' , strtotime ( $date ) ) ) ;
    }
}
