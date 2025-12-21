<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
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

          Paginator::useBootstrapFive();
          Paginator::useBootstrapFour();


        Blade::directive('datetime', function ($expression){
            $expression = trim($expression,'\'');
            $expression = trim($expression,'"');
            $dateObject= date_create($expression);

            if(!empty($dateObject)){
                   $dateformat=  $dateObject->format('d/m/Y H:i:s');
               return "<?php echo '$dateformat'; ?>";
}

});
}
}
