<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');

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

        //
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
        Route::namespace($this->namespace)->group(function () {

            Route::group(['namespace' => 'Back', 'middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
                require base_path('routes/back.php');
            });

            Route::middleware('web')
                ->group(function () {
                    // Authentication Routes...
                    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
                    Route::post('login', 'Auth\LoginController@login');
                    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

                    Route::namespace('Front')->group(function () {
                        require base_path('routes/front.php');
                    });
                });
        });


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
             ->middleware(['api', 'auth:api'])
             ->namespace($this->namespace."\\API")
             ->group(base_path('routes/api.php'));
    }
}
