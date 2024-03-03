<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;
use App\Observers\SettingsObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {            
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (env('DB_DATABASE') && env('APP_INSTALL')) {
            if (\Schema::hasTable('settings')) {
                $result = Settings::where('type', 'email')->pluck('value', 'name')->toArray();
                if (isset($result['driver'])) {
                    \Config::set([
                        // 'mail.driver'     => $result['driver'],
                        // 'mail.host'       => $result['host'],
                        // 'mail.port'       => $result['port'],
                        // 'mail.from'       => [
                        //                         'address' => $result['from_address'],
                        //                         'name'    => $result['from_name']
                        //                     ],
                        // 'mail.encryption' => $result['encryption'],
                        // 'mail.username'   => $result['username'],
                        // 'mail.password'   => $result['password']
                        ]);
                }
            }

            Settings::observe(SettingsObserver::class);
            Bank::observe(BankObserver::class);
        }
        // dd(request());
        // if(!request()->secure() && request()->getRequestUri() != '/health' && env('APP_ENV') !== 'local') {        
        //     $this->app['request']->server->set('HTTPS','on');
        //     URL::forceScheme('https');
        // }
        if(request()->getRequestUri() != '/health' && env('APP_ENV') !== 'local') {        
            $this->app['request']->server->set('HTTPS','on');
            URL::forceScheme('https');
        }
    }

    
}
