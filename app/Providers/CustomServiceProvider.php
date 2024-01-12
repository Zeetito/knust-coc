<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        if (session()->has('custom.previousUrls')) {
            // Get the latest URL from the array
            $latestUrl = end(session('custom.previousUrls'));

            // Get the current URL
            $currentUrl = url()->current();

            // Add the current URL to the list if it's different from the latest URL
            if ($latestUrl !== $currentUrl) {
                session()->push('custom.previousUrls', $currentUrl);
            }
        } else {
            // If the array doesn't exist, initialize it with the current URL
            session(['custom.previousUrls' => [url()->current()]]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
