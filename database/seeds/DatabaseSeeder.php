<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    protected $newsService = null ;

    public function __construct() {
        $this->newsService = app()->make('NewsService');
    }

    public function run() {
        $paramNews['title'] = "Hello World";
        $paramNews['context'] = "<h1> Hello World </h1>";
        $paramNews['publish'] = 1 ;
        $this->newsService->addNews($paramNews);
        $paramNews['title'] = "Hello World 2";
        $paramNews['context'] = "<h1> Hello World 2</h1>";
        $paramNews['publish'] = 1 ;
        $this->newsService->addNews($paramNews);
    }
}
