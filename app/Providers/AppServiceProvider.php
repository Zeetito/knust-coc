<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // Custom Directive to take care of permissions
        Blade::directive('allowedTo', function ($expression) {
            return "<?php if (auth()->check() && ({$expression}) && \\App\\Helpers\\AuthorizationHelper::allowedTo({$expression})): ?>";
        });

        Blade::directive('endallowedTo', function () {
            return '<?php endif; ?>';
        });

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
