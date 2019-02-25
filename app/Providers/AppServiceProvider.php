<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public function register() {
      $this->app->singleton('AuthorizationCache',
                  \App\Services\Authorization\AuthorizationCache::class);
      $this->app->singleton('AuthorizationService',
                  \App\Services\Authorization\AuthorizationService::class);

      $this->app->singleton('ToolService',
                  \App\Services\Utils\ToolService::class);
      $this->app->singleton('AuthUtilService',
                  \App\Services\Utils\AuthUtilService::class);
      $this->app->singleton('LogDataService',
                  \App\Services\Log\LogDataService::class);
      $this->app->singleton('LogQueryService',
                  \App\Services\Log\LogQueryService::class);

      $this->app->singleton('NewsValidation',
                  \App\Services\Validation\NewsValidation::class);
      $this->app->singleton('NewsCache',
                  \App\Services\Cache\NewsCache::class);
      $this->app->singleton('NewsService',
                  \App\Services\Data\NewsService::class);
    }
}
