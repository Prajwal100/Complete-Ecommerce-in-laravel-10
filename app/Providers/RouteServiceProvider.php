<?php

  namespace App\Providers;

  use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
  use Illuminate\Support\Facades\Route;

  class RouteServiceProvider extends ServiceProvider
  {
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
      //

      parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
      $this->mapApiRoutes();
      $this->mapWebRoutes();
      $this->mapUserRoutes();
      $this->mapAdminRoutes();
      $this->map2faRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
      Route::middleware('web')
          ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
      Route::prefix('api')
          ->middleware('api')
          ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "user" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapUserRoutes()
    {
      Route::prefix('user')
          ->middleware(['web', 'auth'])
          ->group(base_path('routes/user.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
      Route::prefix('admin')
          ->middleware(['web', 'auth'])
          ->group(base_path('routes/admin.php'));
    }

    /**
     * Define 2fa routes protected with auth middleware admin namespace used
     */
    public function map2faRoutes()
    {
      Route::middleware(['web', 'auth', '2fa'])
          ->prefix('2fa')
          ->group(base_path('routes/2fa.php'));
    }
  }
