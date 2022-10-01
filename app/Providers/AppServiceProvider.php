<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
        Paginator::defaultView('vendor.pagination.custome');

        Paginator::defaultSimpleView('simple-pagination');
        Blade::directive('currency', function ($expression) 
        {
            return "Rp<?php echo number_format($expression,0,',','.'); ?>";
        });

        Blade::directive('currency_k', function ($expression) 
        {
            $input="<?php echo substr($expression,0,-3)?>";
            $coba="12";
            $float_coba=(float)$input;
            $float_input=floatval($input);
            // $nominal=  is_numeric($input);
            
            return $input.'k';
        });
    }
}
