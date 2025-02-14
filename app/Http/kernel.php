<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
 

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */


    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */

   protected $routeMiddleware = [
    // Other middlewares
    'set.currency' => \App\Http\Middleware\SetCurrency::class,
    'check.session' => \App\Http\Middleware\CheckSession::class,
  
];
  protected $middlewareAliases = [
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\Admin::class,
        
        
    ];

    

    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $trackings = Tracking::where('status', '!=', 'Delivered')->get();
        foreach ($trackings as $tracking) {
            $this->trackOrder($tracking->tracking_number);
        }
    })->hourly();
}

}
