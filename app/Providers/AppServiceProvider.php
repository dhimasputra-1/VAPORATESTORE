<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\RoleMiddleware;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // app/Providers/RouteServiceProvider.php
 public function boot(Router $router)
    {
        // Daftarkan middleware jika perlu
        $router->aliasMiddleware('role', RoleMiddleware::class);
    }
}
