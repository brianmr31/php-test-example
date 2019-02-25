<?php
namespace App\Services\Cache;

use Orumad\ConfigCache\Facades\ConfigCache;
use Cache;

class NewsCache {

    protected $newsService = null ;

    protected $cache_run ;
    protected $cache_lifetime = 1 ;

    public function __construct() {
        // $this->cache_run = ConfigCache::get('app.cache_run');
        // \Log::info("|> cache_run ".$this->cache_run);
        $this->newsService = app()->make('NewsService');
    }

    public function listNews($size, $sortBy, $direction, $column, $code, $page){
        if( $this->cache_run ){
          $results = Cache::tags(['listNews'])->get('listNews:sz'.$size.'sr'.$sortBy.'di'.$direction.'cl'.$column.'co'.$code.'pg'.$page);
          if( is_null( $results ) ){
              $results = Cache::tags(['listNews'])->remember('listNews:sz'.$size.'sr'.$sortBy.'di'.$direction.
                    'cl'.$column.'co'.$code.'pg'.$page, $this->cache_lifetime,
              function() use ($size ,$sortBy ,$direction ,$column ,$code) {
                return $this->newsService->listNews($size, $sortBy, $direction, $column, $code);
              });
          }
          return $results ;
        }else{
          return $this->newsService->listNews($size, $sortBy, $direction, $column, $code);
        }
    }
    public function listNewsInternet($size, $sortBy, $direction, $column, $code, $page){
        if( $this->cache_run ){
          $results = Cache::tags(['listNewsInternet'])->get('listNewsInternet:sz'.$size.'sr'.$sortBy.'di'.$direction.'cl'.$column.'co'.$code.'pg'.$page);
          if( is_null( $results ) ){
              $results = Cache::tags(['listNewsInternet'])->remember('listNewsInternet:sz'.$size.'sr'.$sortBy.'di'.$direction.
                    'cl'.$column.'co'.$code.'pg'.$page, $this->cache_lifetime,
              function() use ($size ,$sortBy ,$direction ,$column ,$code) {
                return $this->newsService->listNewsInternet($size, $sortBy, $direction, $column, $code);
              });
          }
          return $results ;
        }else{
          return $this->newsService->listNewsInternet($size, $sortBy, $direction, $column, $code);
        }
    }
    public function getNews($id){
        if( $this->cache_run ){
          $results = Cache::tags(['getNews'])->get('getNews:id'.$id);
          if( is_null( $results ) ){
              $results = Cache::tags(['getNews'])->remember('getNews:id'.$id, $this->cache_lifetime,
              function() use ($id) {
                return $this->newsService->getNews($id);
              });
          }
          return $results ;
        }else{
          return $this->newsService->getNews($id);
        }
    }
    public function getNewsInternet($alias){
        if( $this->cache_run ){
          $results = Cache::tags(['getNewsInternet'])->get('getNewsInternet:alias'.$alias);
          if( is_null( $results ) ){
              $results = Cache::tags(['getNewsInternet'])->remember('getNewsInternet:alias'.$alias, $this->cache_lifetime,
              function() use ($alias) {
                return $this->newsService->getNewsInternet($alias);
              });
          }
          return $results ;
        }else{
          return $this->newsService->getNewsInternet($alias);
        }
    }
    public function addNews($params){
      return $this->newsService->addNews($params);
    }
    public function delNews($id){
      return $this->newsService->delNews($id);
    }
    public function putNews($params ,$id){
      return $this->newsService->putNews($params ,$id);
    }
}
