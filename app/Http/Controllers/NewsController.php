<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller {

    protected $newsCache = null ;
    protected $newsValidation = null ;
    protected $tools = null ;

    protected $authorizationCache = null ;
    protected $authTools = null ;

    protected $cache_run ;
    protected $cache_lifetime = 1 ;

    public function __construct() {
      $this->newsCache = app()->make('NewsCache');
      $this->newsValidation = app()->make('NewsValidation');
      $this->tools = app()->make('ToolService');

      $this->authorizationCache = app()->make('AuthorizationCache');
      $this->authTools = app()->make('AuthUtilService');
    }

    public function listNews(Request $request){
      if( $this->authorizationCache->getAuthorization( $this->authTools->getIdRole() ,
        'NewsController@listNews', $this->authTools->getRoleAdmin() ) == false ) {
        $results['success'] = false ;
        $results['error'][0] = "you not authorize" ;
        return response($results, 401);
      }
      $arrReq = $this->tools->getDefaultData($request, 'id_new');
      return $this->newsCache->listNews($arrReq[0], $arrReq[1], $arrReq[2],
                          $arrReq[3], $arrReq[4], $request->input('page'));
    }
    public function listNewsInternet(Request $request){
      $arrReq = $this->tools->getDefaultData($request, 'id_new');
      return $this->newsCache->listNewsInternet($arrReq[0], $arrReq[1], $arrReq[2],
                          $arrReq[3], $arrReq[4], $request->input('page'));
    }
    public function getNews(Request $request, $id){
      if( $this->authorizationCache->getAuthorization( $this->authTools->getIdRole(),
        'NewsController@getNews', $this->authTools->getRoleAdmin() ) == false ) {
        $results['success'] = false ;
        $results['error'][0] = "you not authorize" ;
        return response($results, 401);
      }
      return $this->newsCache->getNews($id);
    }
    public function getNewsInternet(Request $request, $alias){
      return $this->newsCache->getNewsInternet($alias);
    }
    public function addNews(Request $request){
      if( $this->authorizationCache->getAuthorization( $this->authTools->getIdRole(),
        'NewsController@addNews', $this->authTools->getRoleAdmin() ) == false ) {
        $results['success'] = false ;
        $results['error'][0] = "you not authorize" ;
        return response($results, 401);
      }
      $result = $this->newsValidation->check($request);
      if($result['success'] == true ){
          $result = $this->newsCache->addNews($request->all());
      }
      return $result ;
    }
    public function delNews(Request $request, $id){
      if( $this->authorizationCache->getAuthorization( $this->authTools->getIdRole(),
        'NewsController@delNews', $this->authTools->getRoleAdmin() ) == false ) {
        $results['success'] = false ;
        $results['error'][0] = "you not authorize" ;
        return response($results, 401);
      }
      return $this->newsCache->delNews($id);
    }
    public function putNews(Request $request, $id){
      if( $this->authorizationCache->getAuthorization( $this->authTools->getIdRole(),
        'NewsController@putNews', $this->authTools->getRoleAdmin() ) == false ) {
        $results['success'] = false ;
        $results['error'][0] = "you not authorize" ;
        return response($results, 401);
      }
      $result = $this->newsValidation->check($request);
      if($result['success'] == true ){
          $result = $this->newsCache->putNews($request->all(), $id);
      }
      return $result ;
    }
}
