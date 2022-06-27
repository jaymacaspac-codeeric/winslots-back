<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('template.template', function ($view) {
            if(session('agent_id') == '2838' && session('admin_type') == 1) {
                $pending_deposit_count = DB::table('info_deposit')
                                        ->where('status', 2)
                                        ->count();
            } else {
                $pending_deposit_count = DB::table('info_deposit as d')
                                        ->leftJoin('info_agent as a', 'd.user_id', 'a.agent_id')
                                        ->leftJoin('info_users as u', 'd.user_id', 'u.user_id')
                                        ->where('u.agent_id', session('agent_id'))
                                        ->where('a.parent', session('agent_id'))
                                        ->where('d.status', '2')
                                        ->count();
            }


            $view->with([
                'site'                      => getSiteSettings(),
                'rate'                      => getAgentRate(),
                'admin'                     => getAdmin(),
                'paymentMethod'             => getPaymentMethod(),
                'pending_deposits_count'    => $pending_deposit_count
            ]);
        });
    }
}
