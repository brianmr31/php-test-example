<?php
namespace App\Services\Data;

use App\Models\News;

use Orumad\ConfigCache\Facades\ConfigCache;
use Cache;

class NewsService {

    protected $logData = null ;
    protected $logQuery = null ;
    protected $tools = null ;

    protected $toolsAuth = null ;

    public function __construct() {
        $this->logData = app()->make('LogDataService');
        $this->logQuery = app()->make('LogQueryService');
        $this->tools = app()->make('ToolService');

        $this->toolsAuth = app()->make('AuthUtilService');
    }

    public function listNews($size, $sortBy, $direction, $column, $code){
      $this->logData->printInfo("listNews size:".$size.";sortBy:".$sortBy.";direction:".$direction.
            ";column:".$column.";code:".$code);
      $results = News::select('id_new', 'title', 'publish', 'id_user',
             'deleted_at', 'created_at','updated_at');
      $results = $this->tools->orderBy($results, $sortBy, $direction);
      $results = $this->tools->whereLike($results, $column, $code, $size);
      $this->logQuery->printInfo();
      return $results ;
    }
    public function listNewsInternet($size, $sortBy, $direction, $column, $code){
      $this->logData->printInfo("listNewsInternet size:".$size.";sortBy:".$sortBy.";direction:".$direction.
            ";column:".$column.";code:".$code);
      $results = News::select('id_new', 'title', 'context', 'publish', 'id_user',
             'deleted_at', 'created_at','updated_at');
      $results = $this->tools->orderBy($results, $sortBy, $direction);
      $results = $this->tools->whereLike($results, $column, $code, $size);
      $this->logQuery->printInfo();
      return $results ;
    }
    public function getNews($id){
      $this->logData->printInfo("getNews id:".$id);
      $results = News::find($id);
      if(is_null($results)){
        $results['success'] = false ;
        $results['error'][0] = "news is missing" ;
        return $results ;
      }
      $this->logQuery->printInfo();
      return $results ;
    }
    public function getNewsInternet($alias){
      $this->logData->printInfo("getNewsInternet alias:".$alias);
      $results = News::select('title', 'alias', 'context', 'publish', 'id_user', 'deleted_at', 'created_at', 'updated_at')
                 ->where('alias',$alias)->first();
      if(is_null($results)){
        $results['success'] = false ;
        $results['error'][0] = "news is missing" ;
        return $results ;
      }
      $this->logQuery->printInfo();
      return $results ;
    }
    public function addNews($params){
      $this->logData->printInfo("addNews params:".json_encode($params));
      $params['alias'] = $this->tools->createAlias($params['title']);
      $params['id_user'] = $this->toolsAuth->getIdUser() ; // user
      $results = News::create($params);
      $this->logQuery->printInfo();
      return $results ;
    }
    public function delNews($id){
      $this->logData->printInfo("delNews id:".$id);
      $results = News::find($id);
      if(is_null($results)){
        $results['success'] = false ;
        $results['error'][0] = "news is missing" ;
      }else{
        $results->delete();
        $results = null ;
        $results['success'] = true ;
      }
      $this->logQuery->printInfo();
      return $results ;
    }
    public function putNews($params ,$id){
      $this->logData->printInfo("putNews id:".$id."params:".json_encode($params));
      $params['alias'] = $this->tools->createAlias($params['title']);
      $params['id_user'] = 1 ; // user
      $results = News::find($id);
      if(is_null($results)){
        $results['success'] = false ;
        $results['error'][0] = "news is missing" ;
      }else{
        $results->update($params);
        $results->save();
      }
      $this->logQuery->printInfo();
      return $results ;
    }
}
