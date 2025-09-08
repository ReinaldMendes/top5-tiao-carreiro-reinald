<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define as rotas da aplicação.
     */
    public function boot()
    {
        parent::boot();

        $this->routes(function () {
            // Rotas da API (com prefixo /api)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rotas web normais
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
